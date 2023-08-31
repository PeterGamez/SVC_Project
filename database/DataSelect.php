<?php

namespace Database;

class DataSelect
{
    protected $maintable;
    protected $query;
    protected $jointable = [];
    protected $whereConditions = [];
    protected $whereOperator;
    protected $bindParams = [];
    protected $order = [];
    protected $group = [];
    protected $limit;

    protected function __construct(string $table, array $conditions = null)
    {
        $this->maintable = $table;
        $this->query = "SELECT * FROM $table";
        if (is_array($conditions)) {
            foreach ($conditions as $field => $value) {
                $this->where($field, $value);
            }
        }
    }

    final public function select(string ...$fields): self
    {
        $this->query = str_replace("*", implode(", ", $fields), $this->query);
        return $this;
    }

    final public function join(string $table, string $column1, string $column2, string $type = "INNER"): self
    {
        $this->jointable[] = " $type JOIN $table ON $table.$column1 = " . $this->maintable . ".$column2";
        return $this;
    }

    final public function where(string $column, array|string $value, string $operator = "="): self
    {
        if (is_array($value)) {
            $placeholders = implode(', ', array_fill(0, count($value), '?'));
            $this->whereConditions[] = "$column IN ($placeholders)";
            $this->bindParams = [...$this->bindParams, ...$value];
        } else {
            $this->whereConditions[] = "$column $operator ?";
            $this->bindParams[] = $value;
        }
        return $this;
    }

    final public function operator(string $operator): self
    {
        $operator = strtoupper($operator);
        $this->whereOperator = ($operator == 'OR') ? 'OR' : 'AND';
        return $this;
    }

    final public function order(string ...$columns): self
    {
        $this->order = $columns;
        return $this;
    }

    final public function group(string ...$columns): self
    {
        $this->group = $columns;
        return $this;
    }

    final public function limit(int $value): self
    {
        $this->limit = $value;
        return $this;
    }

    private function query(): void
    {
        if (!empty($this->jointable)) {
            $this->query .= implode(' ', $this->jointable);
        }

        if (!empty($this->whereConditions)) {
            $this->query .= " WHERE " . implode(' ' . $this->whereOperator . ' ', $this->whereConditions);
        }

        if (!empty($this->order)) {
            $this->query .= " ORDER BY " . implode(', ', $this->order);
        }

        if (!empty($this->group)) {
            $this->query .= " GROUP BY " . implode(', ', $this->group);
        }

        if (!empty($this->limit)) {
            $this->query .= " LIMIT " . $this->limit;
        }
    }

    /** return query */
    final public function get(): array
    {
        $this->query();
        return Model::buildFind($this->query, $this->bindParams);
    }

    final public function getOne(): ?array
    {
        $this->query();
        return Model::buildFindOne($this->query, $this->bindParams);
    }

    final public function sql(): string
    {
        $this->query();
        return $this->query;
    }
}
