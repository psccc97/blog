<?php

if (filter_has_var(INPUT_POST, 'submit')) {
    if (!empty($_POST['commentaire']) && !empty($_FILES)) {
        $commentaire = trim(filter_input(INPUT_POST, 'commentaire', FILTER_SANITIZE_STRING));
        $file = $_FILES;
        require_once 'model/post.php';
        addPostComment($commentaire, $file);
        header('location: index.php');
    } else {
        echo "Les champs ne sont pas rempli";
    }
}
