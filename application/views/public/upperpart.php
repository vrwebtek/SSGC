<?php defined('BASEPATH') OR exit('No direct script access allowed');

	$tags=$seo_keywords[0]['tags'];
	$description=$seo_keywords[0]['description'];
	$author=$seo_keywords[0]['author'];
	$title=$seo_keywords[0]['title'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo $title." | SSGC Taxpro"; ?></title>
    <meta charset="utf-8">
    <meta name="description" content="<?php echo $description; ?>">
	<meta name="keywords" content="<?php echo $tags; ?>">
    <meta name="author" content="<?php echo $author; ?>">
	<link rel="author" href="https://plus.google.com/" />
	<link rel="canonical" href="<?php echo current_url(); ?>" />

    <meta name="format-detection" content="telephone=no"/>
    <link rel="icon" href="<?php echo base_url('assets/public/images/favicon.ico');?>" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo base_url('assets/public/css/grid.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/public/css/style.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/public/css/camera.css');?>"/>
    <link rel="stylesheet" href="<?php echo base_url('assets/public/css/owl.carousel.css');?>"/>
    <script src="<?php echo base_url('assets/public/js/jquery.js'); ?>"></script>
    <script src="<?php echo base_url('assets/public/js/jquery-migrate-1.2.1.js'); ?>"></script>
    <script src="<?php echo base_url('assets/public/js/jquery.equalheights.js');?>"></script>
    <!--[if (gt IE 9)|!(IE)]><!-->
    <script src="<?php echo base_url('assets/public/js/jquery.mobile.customized.min.js');?>"></script>
    <!--<![endif]-->
    <script src="<?php echo base_url('assets/public/js/camera.js');?>"></script>
    <script src="<?php echo base_url('assets/public/js/owl.carousel.js');?>"></script>
    <!--[if lt IE 9]>
    <div style=' clear: both; text-align:center; position: relative;'>
        <a href="http://windows.microsoft.com/en-US/internet-explorer/products/ie/home?ocid=ie6_countdown_bannercode">
            <img src="http://storage.ie6countdown.com/assets/100/images/banners/warning_bar_0000_us.jpg" border="0"
                 height="42" width="820"
                 alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today."/>
        </a>
    </div>
    <script src="js/html5shiv.js"></script>
    <link rel="stylesheet" type="text/css" media="screen" href="css/ie.css">
    <![endif]-->
</head>
<body>
<div class="page">