<?php
require __DIR__ . "/vendor/autoload.php";

use App\DB\Database;

$db = Database::getConnection();
echo "Database connection successful";
