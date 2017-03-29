<?php

require_once 'connexion.php';

function getPosts() {
    $db = connectDb();
    $sql = "SELECT * FROM post";
    $request = $db->prepare($sql);
    $request->execute();
    return $request->fetchAll(PDO::FETCH_ASSOC);    
}

function getMedias($idPost)
{
  $db = connectDb();
  $sql = "SELECT * FROM media WHERE idPost = :idPost";
  $request = $db->prepare($sql);
  $request->bindParam(":idPost", $idPost);
  $request->execute();
  return $request->fetchAll(PDO::FETCH_ASSOC);
  
}

function addPostComment($commentaire, $file) {
    
        $db = connectDb();
        $sql = "INSERT INTO post(commentaire, datePost)" .
                "VALUES(:commentaire,NOW())";
        $request = $db->prepare($sql);
        $request->bindParam(":commentaire",$commentaire);
        $request->execute();
        $lastid = $db->lastInsertId();

        for ($i = 0; $i < count($file['img']['name']); $i++) {
        $sql1 = "INSERT INTO media(typeMedia, nomMedia, idPost)" .
                "VALUES(:typeMedia, :nomMedia, :lastid)";
        $request1 = $db->prepare($sql1);
        $typeMedia = $_FILES['img']['type'][$i];
        $nomMedia = $_FILES['img']['name'][$i];
        $destination = "img/".$nomMedia;
        $source = $_FILES['img']['tmp_name'][$i];
        
        $request1->bindParam(":typeMedia",$typeMedia);
        $request1->bindParam(":nomMedia",$nomMedia);
        $request1->bindParam(":lastid",$lastid);
        $request1->execute();
        $result = move_uploaded_file($source, $destination);
    }
}
