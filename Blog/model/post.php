<?php

require_once 'connexion.php';

function getPosts() {
    $db = connectDb();
    $sql = "SELECT commentaire, nomMedia FROM media AS m, post AS p WHERE m.idPost = p.idPost";
    $request = $db->prepare($sql);
    $request->execute();
    return $request->fetchAll(PDO::FETCH_ASSOC);
}

function addPostComment($commentaire, $file) {
    
        $db = connectDb();
        $sql = "INSERT INTO post(commentaire, datePost)" .
                "VALUES(:commentaire,NOW())";
        $request = $db->prepare($sql);
        $request->execute(array($commentaire));
        $lastid = $db->lastInsertId();

        for ($i = 0; $i < count($file); $i++) {
        $sql1 = "INSERT INTO media(typeMedia, nomMedia, idPost)" .
                "VALUES(:typeMedia, :nomMedia, :lastid)";
        $request1 = $db->prepare($sql1);
        $typeMedia = $_FILES['img']['type'][$i];
        $nomMedia = $_FILES['img']['name'][$i];
        $destination = "img/".$nomMedia;
        $source = $_FILES['img']['tmp_name'][$i];
        $request1->execute(array($typeMedia, $nomMedia, $lastid));
        $result = move_uploaded_file($source, $destination);
    }
}
