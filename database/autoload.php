<?php

namespace Database;

use Exception;

try {
    $conn = mysqli_connect(config('database.host'), config('database.user'), config('database.password'), config('database.database'));
    if (!$conn) {
        echo ('Connection failed: ' . mysqli_connect_error());
        die();
    }
} catch (Exception $e) {
    echo ('Exception: database connection failed');
    die();
}

mysqli_set_charset($conn, 'utf8');
date_default_timezone_set("Asia/Bangkok");

require_once __ROOT__ . '/database/DataSelect.php';
require_once __ROOT__ . '/database/Model.php';