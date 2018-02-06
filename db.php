<?php
$host = 'mysql.cba.pl';
$db   = 'amayahitomi';
$user = 'amayahitomi';
$pass = 'Qwert1';
$charset = 'utf8';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$opt = [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,];
$pdo = new PDO($dsn, $user, $pass, $opt);


function pdoSet($allowed, &$values, $source = array()) {
    $set = '';
    $values = array();
    if (!$source) $source = &$_POST;
    foreach ($allowed as $field) {
        if (isset($source[$field])) {
            $set.="`".str_replace("`","``",$field)."`". "=:$field, ";
            $values[$field] = $source[$field];
        }
    }
    return substr($set, 0, -2);
}


