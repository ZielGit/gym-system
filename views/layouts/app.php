<!DOCTYPE html>

<!--
 // WEBSITE: https://themefisher.com
 // TWITTER: https://twitter.com/themefisher
 // FACEBOOK: https://www.facebook.com/themefisher
 // GITHUB: https://github.com/themefisher/
-->

<html lang="en">
<head>

  <!-- Basic Page Needs
  ================================================== -->
  <meta charset="utf-8">
  <title>Gym - <?php yieldContent('title'); ?></title>

  <!-- Mobile Specific Metas
  ================================================== -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="Health Care Medical Html5 Template">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
  <meta name="author" content="Themefisher">
  <meta name="generator" content="Themefisher Novena HTML Template v1.0">
  
  <!-- theme meta -->
  <meta name="theme-name" content="novena" />

  <!-- Favicon -->
  <link rel="shortcut icon" type="image/x-icon" href="/images/favicon.png" />

  <!-- Essential stylesheets -->
  <link rel="stylesheet" href="/novena/plugins/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="/novena/plugins/icofont/icofont.min.css">
  <link rel="stylesheet" href="/novena/plugins/slick-carousel/slick/slick.css">
  <link rel="stylesheet" href="/novena/plugins/slick-carousel/slick/slick-theme.css">

  <!-- Main Stylesheet -->
  <link rel="stylesheet" href="/novena/css/style.css">
  <?php yieldContent('styles'); ?>
</head>
<body id="top">
    <?php includePartial('partials.header'); ?>

	<!-- Slider Start -->
	<?php yieldContent('content'); ?>

	<!-- footer Start -->
	<?php includePartial('partials.footer'); ?>
    <!-- Essential Scripts -->
    <script src="/novena/plugins/jquery/jquery.js"></script>
    <script src="/novena/plugins/bootstrap/bootstrap.min.js"></script>
    <script src="/novena/plugins/slick-carousel/slick/slick.min.js"></script>
    <script src="/novena/plugins/shuffle/shuffle.min.js"></script>
    <script src="/novena/js/script.js"></script>
    <?php yieldContent('scripts'); ?>
</body>
</html>