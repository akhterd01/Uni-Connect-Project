<?php 
    if(!isset($_SESSION)) {
        session_start();
    }
?>
<?php
    $bgImgArray = array("site_images/bg-1.jpg", "site_images/bg-2.jpg", "site_images/bg-3.jpg", "site_images/bg-4.jpg", "site_images/bg-5.jpg", "site_images/bg-6.jpg", "site_images/bg-7.jpg", "site_images/bg-8.jpg", "site_images/bg-9.jpg", "site_images/bg-10.jpg", "site_images/bg-11.jpg");
    $i = rand(0, count($bgImgArray) - 1);
    $img = $bgImgArray[$i];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .body-img {
            background-image: url('<?php echo $img;?>');
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="stylesheets/base-style.css">
    <link rel="stylesheet" href="stylesheets/framework.css">
    <title><?php echo $title; ?></title>
</head>
<body>