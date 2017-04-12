<?php
require_once 'model/post.php';
?>
<html>
    <head>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <meta charset="UTF-8">
        <title></title>


    </head>
    <body>
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="./index.php">Blog</a>
                </div>
                <ul class="nav navbar-nav">
                    <li class="active"><a href="./index.php">Home</a></li>
                    <li><a href="./includePost.php">Post</a></li>
                </ul>
            </div>
        </nav>        
        <div class="container">
            <h1>Bienvenue sur le Blog</h1>
            <?php
            foreach ($posts as $post):
                $medias = getMedias($post['idPost']);
                foreach ($medias as $media) :
                    if ($media['typeMedia'] == "image/jpeg" || $media['typeMedia'] == "image/png" || $media['typeMedia'] == "image/jpg" || $media['typeMedia'] == "image/gif") :?>
                        <figure><img src="./img/<?php echo $media['idMedia'] ?>" class="img-responsive" width="256" height="256"></figure>                    
                    <?php elseif ($media['typeMedia'] == "video/mp4" || $media['typeMedia'] == "video/webm" || $media['typeMedia'] == "video/ogg") : ?>
                        <video src="./video/<?php echo $media['idMedia'] ?>" controls></video>
                    <?php elseif($media['typeMedia'] == "audio/mp3" || $media['typeMedia'] == "audio/wav") : ?>
                        <audio src="./audio/<?php echo $media['idMedia'] ?>" controls></audio>
                    <?php
                    endif;
                endforeach;
                ?>
                <figcaption><?php echo $post['commentaire']; ?></figcaption>
<?php endforeach; ?>
        </div>
    </body>
</html>
