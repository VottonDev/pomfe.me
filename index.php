<?php
session_start();
require_once 'inc/Videos.php';
require_once 'inc/Redirect.php';

$videos = new Videos;

$videos->cache();

$title = $_SESSION['file_count'] . ' webms';

if(empty($_GET['videoId']))
{
    $videoId = $videos->random();

    if(!$videoId)
    {
        Redirect(Url());
    }
    
    Redirect(Url() . $videoId);
}
else
{
    $video_url = $videos->get($_GET['videoId']);

    if(!$video_url)
    {
        Redirect(Url());
    }
}
?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="utf-8">

    <title><?php echo $title; ?></title>

    <link rel="shortcut icon" href="favicon.gif" type="image/x-icon">

    <link rel="stylesheet" href="assets/css/style.css" type="text/css">

</head>

<body>

    <div class="text">
        <a href="btc:1mvWL6ERHZ3jfg2crYNwzDNKfY2xdvJgX" target="_blank">Donate to me</a>
    </div>

    <a href="<?php echo Url(); ?>">
        <video class="video" autoplay loop>
            <source src="<?php echo $video_url; ?>" type="video/webm">
        </video>
    </a>

</body>

</html>