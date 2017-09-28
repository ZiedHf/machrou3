<!DOCTYPE html>
<!--
Copyright (C) Khidma Company,  All Rights Reserved
Unauthorized copying of this file, via any medium is strictly prohibited
Proprietary and confidential
Written by Zied Haffoudhi <ziedhaffoudhi@gmail.com>, 2017.
-->
<html lang="fr">
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


      <?= $this->Html->css('../machrou3_template/css/icon.css') ?>
      <?= $this->Html->css('../machrou3_template/materialize/css/materialize.min.css') ?>

      <?= $this->Html->css('../machrou3_template/fonts/Planewalker/font.css') ?>
      <?= $this->Html->css('../machrou3_template/fonts/ChantelliAntiqua/font.css') ?>
      <?= $this->Html->css('../machrou3_template/css/style_login.css') ?>
      <?= $this->Html->css('../machrou3_template/css/style.css') ?>



      <?= $this->fetch('meta') ?>
      <?= $this->fetch('css') ?>
    </head>

    <body class="blue lighten-5">

      <?= $this->fetch('content') ?>

      <footer>
        <?= $this->Html->script('https://code.jquery.com/jquery-3.2.1.min.js') ?>
        <!--?= $this->Html->script('../dashgumfree/assets/js/jquery-1.8.3.min.js') ?-->
        <?= $this->Html->script('../machrou3_template/materialize/js/materialize.min.js') ?>

        <?= $this->Html->script('../machrou3_template/js/script.js') ?>

        <?= $this->fetch('script'); ?>

      </footer>

    </body>
</html>
