<!DOCTYPE html>
<html lang="en">
  <head>
    <?= $this->Html->charset('UTF-8') ?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?= $this->Html->meta('viewport', 'width=device-width, initial-scale=1.0'); ?>
    
    <?= (isset($cakeDescription)) ? $this->Html->meta('description', $cakeDescription) : $this->Html->meta('description', 'Gestion des projets') ?>
    <?= $this->Html->meta('author', 'Khidma company'); ?>
    <title>
        <?= Name_app ?> <?= Version ?> :
        <?= $this->fetch('title') ?>
    </title>
    <!--?= $this->Html->meta('icon') ?-->
    <?= $this->Html->meta('favicon.ico', 'favicon/favicon.ico', ['type' => 'icon']); ?>
    <?= $this->Html->meta(['href' => 'favicon/apple-touch-icon.png', 'rel' => 'apple-touch-icon', 'sizes' => '180x180']); ?>
    <?= $this->Html->meta(['href' => 'favicon/favicon-32x32.png', 'rel' => 'icon', 'sizes' => '32x32', 'type' => 'image/png']); ?>
    <?= $this->Html->meta(['href' => 'favicon/favicon-16x16.png', 'rel' => 'icon', 'sizes' => '16x16', 'type' => 'image/png']); ?>
    <?= $this->Html->meta(['href' => 'favicon/manifest.json', 'rel' => 'manifest']); ?>
    <?= $this->Html->meta(['href' => 'favicon/safari-pinned-tab.svg', 'rel' => 'mask-icon', 'color' => '#5bbad5']); ?>
    <?= $this->Html->meta('theme-color', '#ffffff'); ?>


    <!-- Bootstrap core CSS -->
    <?= $this->Html->css('../dashgumfree/assets/css/bootstrap.css') ?>
    <!--external css-->
    <?= $this->Html->css('font-awesome/css/font-awesome.css') ?>
    
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
  </head>

  <body>

    <?= $this->fetch('content') ?>

    <!--main content end-->

    <!-- js placed at the end of the document so the pages load faster -->
    <?= $this->Html->script('../dashgumfree/assets/js/jquery.js') ?>
    <!--?= $this->Html->script('../dashgumfree/assets/js/jquery-1.8.3.min.js') ?-->
    <?= $this->Html->script('../dashgumfree/assets/js/bootstrap.min.js') ?>
    
    <?= $this->fetch('script'); ?>
  </body>
</html>
