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
    
    <?= $this->Html->css('../dashgumfree/assets/js/gritter/css/jquery.gritter.css') ?>
    <?= $this->Html->css('../dashgumfree/assets/lineicons/style.css') ?>
    
    <!-- Custom styles for this template -->
    
    <?= $this->Html->css('style_dashgumfree') ?>
    <?= $this->Html->css('../dashgumfree/assets/css/style.css') ?>
    <?= $this->Html->css('../dashgumfree/assets/css/style-responsive.css') ?>

    <?= $this->Html->script('../dashgumfree/assets/js/chart-master/Chart.js') ?>
    
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
  </head>

  <body>

    <section id="container" >
        <!-- **********************************************************************************************************************************************************
        TOP BAR CONTENT & NOTIFICATIONS
        *********************************************************************************************************************************************************** -->
        <!--header start-->
          <?= $this->element('sidebar/header') ?>
        <!--header end-->
        <!-- **********************************************************************************************************************************************************
        MAIN SIDEBAR MENU
        *********************************************************************************************************************************************************** -->
          <!--?= $this->element('sidebar/menu', [$pageName]) ?-->
        <?= $this->cell('MenuConsult', ['pageName' => $pageName]) ?>
        <?= $this->fetch('content') ?>

        <!--main content end-->

    </section>
    <section class="footer_section">
    <!--footer start-->
        <?= $this->element('sidebar/footer') ?>
    <!--footer end-->
    </section>
    <!-- js placed at the end of the document so the pages load faster -->
    <?= $this->Html->script('../dashgumfree/assets/js/jquery.js') ?>
    <!--?= $this->Html->script('../dashgumfree/assets/js/jquery-1.8.3.min.js') ?-->
    <?= $this->Html->script('../dashgumfree/assets/js/bootstrap.min.js') ?>
    <?= $this->Html->script('../dashgumfree/assets/js/jquery.dcjqaccordion.2.7.js') ?>
    <?= $this->Html->script('../dashgumfree/assets/js/jquery.scrollTo.min.js') ?>
    <?= $this->Html->script('../dashgumfree/assets/js/jquery.nicescroll.js') ?>
    <?= $this->Html->script('../dashgumfree/assets/js/jquery.sparkline.js') ?>
    

    <!--common script for all pages-->
    <?= $this->Html->script('../dashgumfree/assets/js/common-scripts.js') ?>
    
    <?= $this->Html->script('../dashgumfree/assets/js/gritter/js/jquery.gritter.js') ?>
    <?= $this->Html->script('../dashgumfree/assets/js/gritter-conf.js') ?>

    <!--script for this page-->
    <!--?= $this->Html->script('../dashgumfree/assets/js/sparkline-chart.js') ?>
    </?= $this->Html->script('../dashgumfree/assets/js/zabuto_calendar.js') ?-->
    
    <?= $this->Html->script('script') ?>
    <?= $this->fetch('script'); ?>
  </body>
</html>
