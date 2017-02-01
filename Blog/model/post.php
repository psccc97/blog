<?php

require_once 'connexion.php';

function getPosts(){
    $db = connectDb();
    $sql = "SELECT * FROM post";
    $request = $db->prepare($sql);
    $request->execute();
    return $request->fetchAll(PDO::FETCH_ASSOC);
}

function addPostComment($commentaire,$typeMedia,$nomMedia)
{
    $db = connectDb();
    $sql = "INSERT INTO post(commentaire, typeMedia, nomMedia, datePost)".
            "VALUE(?,?,?,NOW())";
    $request = $db->prepare($sql);
    $request->execute(array($commentaire,$typeMedia,$nomMedia));
    return $request;
}
