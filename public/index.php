<?php

declare(strict_types = 1);

$root = dirname(__DIR__) . DIRECTORY_SEPARATOR;

//create constantes path
define('APP_PATH', $root . 'app' . DIRECTORY_SEPARATOR);    // => c:\xampp\htdocs\mini-project\app\
define('FILES_PATH', $root . 'transaction_files' . DIRECTORY_SEPARATOR);
define('VIEWS_PATH', $root . 'views' . DIRECTORY_SEPARATOR);

//import app.php file
require APP_PATH . "App.php";

//call fn defined to App.php file
$files = getTransactionFiles(FILES_PATH);

//var_dump($files);

//var_dump(fopen($files[0], 'r'));

$transactions = [];
foreach ($files as $file) {
    $transactions = array_merge($transactions, getTransactions($file));
}

print_r($transactions);