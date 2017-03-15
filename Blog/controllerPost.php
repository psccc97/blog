<?php

if(filter_has_var(INPUT_POST, 'submit')){
    $commentaire = trim(filter_input(INPUT_POST, 'commentaire',FILTER_SANITIZE_STRING));
                
    $file = $_FILES;
    
    require_once 'model/post.php';
    
    addPostComment($commentaire, $file);        
   
    
    header('location: index.php');
}
