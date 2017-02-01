<?php

function connectDb ()
{
    $host = "localhost";
    $dbname = "bd_blog_facebook";
    $user = "root";
    $password = "";
    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
    
    $bd = new PDO ('mysql:host='.$host.';dbname='.$dbname.';charset=utf8',$user,$password,$pdo_options);
    
    return $bd;
}

