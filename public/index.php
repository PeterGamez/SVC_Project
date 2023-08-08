<?php

session_start();

if (empty($_SESSION['id'])) {
    $_SESSION['id'] = session_id();
    $_SESSION['login'] = false;
    $_SESSION['user_role'] = 'visitor';
}

require_once dirname(__DIR__) . '/app/autoload.php';
