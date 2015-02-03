<?php

require_once $_SERVER["DOCUMENT_ROOT"] . '/vendor/autoload.php';

session_start();
$conf = get_conf();
$db = Database::get_db($conf['db']['host'], $conf['db']['dbname'], $conf['db']['username'], $conf['db']['passwd']);

if ($db) {
    Route::start();
}