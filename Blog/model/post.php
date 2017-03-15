<?php

require_once 'connexion.php';

function getPosts(){
    $db = connectDb();
    $sql = "SELECT commentaire, nomMedia FROM media AS m, post AS p WHERE m.idPost = p.idPost";
    $request = $db->prepare($sql);
    $request->execute();
    return $request->fetchAll(PDO::FETCH_ASSOC);
}

function addPostComment($commentaire,$typeMedia,$nomMedia)
{
    $db = connectDb();
    $sql = "INSERT INTO post(commentaire, datePost)".
            "VALUE(:commentaire,NOW())";            
    $request = $db->prepare($sql);    
    $request->execute(array($commentaire));
    $lastid = $db->lastInsertId();
    
    $sql1 = "INSERT INTO media(typeMedia, nomMedia)".
            "VALUE(:typeMedia, :nomMedia)";    
    $request1 = $db->prepare($sql1);
    $request1->execute(array($typeMedia, $nomMedia));
}
