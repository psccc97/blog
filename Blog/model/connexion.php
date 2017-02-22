<?php

define('HOST', "localhost");
$dbname = "bd_blog_facebook";
$user = "root";
$password = "";
$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;

function connectDb() {
    static $bd = NULL;

    if ($bd === NULL) {
        try {
            $bd = new PDO('mysql:host=' . HOST . ';dbname=' . $dbname . ';charset=utf8', $user, $password, $pdo_options);
        } catch (PDOException $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
    return $bd;
}
