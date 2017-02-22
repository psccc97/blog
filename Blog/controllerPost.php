<?php

if(filter_has_var(INPUT_POST, 'submit')){
    $commentaire = trim(filter_input(INPUT_POST, 'commentaire',FILTER_SANITIZE_STRING));
    $typeMedia = $_FILES['img']['type'];
    $nomMedia = $_FILES['img']['name'];
    $destination = "img/".$nomMedia;
    $source = $_FILES['img']['tmp_name'];
    
    require_once 'model/post.php';
    
    addPostComment($commentaire, $typeMedia, $nomMedia);        
    $result = move_uploaded_file($source, $destination);
    
    header('location: index.php');
}
