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
                "VALUES( :typeMedia, :nomMedia, :lastid)";
        $request1 = $db->prepare($sql1);
        $id = uniqid();
        $typeMedia = $_FILES['img']['type'][$i];
        $nomMedia = $_FILES['img']['name'][$i];
        $destination = "img/".$nomMedia.$id;
        $source = $_FILES['img']['tmp_name'][$i];
                
        $request1->bindParam(":typeMedia",$typeMedia);
        $request1->bindParam(":nomMedia",$nomMedia.$id);
        $request1->bindParam(":lastid",$lastid);
        $request1->execute();
        $result = move_uploaded_file($source, $destination);
    }
    
    for($y = 0; $y<count($file['video']['name']); $y++){        
        $sql2 = "INSERT INTO media(typeMedia, nomMedia, idPost)" .
                "VALUES(:typeMedia, :nomMedia, :lastid)";
        $request2 = $db->prepare($sql2);
        $id2 = uniqid();
        $typeMedia2 = $_FILES['video']['type'][$y];
        $nomMedia2 = $_FILES['video']['name'][$y];
        $destination2 = "video/".$nomMedia.$id2;
        $source2 = $_FILES['video']['tmp_name'][$y];
                
        $request2->bindParam(":typeMedia",$typeMedia2);
        $request2->bindParam(":nomMedia",$nomMedia2);
        $request2->bindParam(":lastid",$lastid);
        $request2->execute();
        $result2 = move_uploaded_file($source2, $destination2);
    }
    
    for($x = 0; $x<count($file['audio']['name']); $x++){
        $sql3 = "INSERT INTO media(typeMedia, nomMedia, idPost)" .
                "VALUES(:typeMedia, :nomMedia, :lastid)";
        $request3 = $db->prepare($sql3);
        $id3 = uniqid();
        $typeMedia3 = $_FILES['audio']['type'][$x];
        $nomMedia3 = $_FILES['audio']['name'][$x];
        $destination3 = "audio/".$nomMedia.$id3;
        $source3 = $_FILES['audio']['tmp_name'][$x];
                
        $request3->bindParam(":typeMedia",$typeMedia3);
        $request3->bindParam(":nomMedia",$nomMedia3);
        $request3->bindParam(":lastid",$lastid);
        $request3->execute();
        $result3 = move_uploaded_file($source3, $destination3);
    }
}
