<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset('UTF-8') ?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <?= $this->Html->meta('favicon.ico', 'favicon/favicon.ico', ['type' => 'icon']); ?>
    <?= $this->Html->meta(['href' => 'favicon/apple-touch-icon.png', 'rel' => 'apple-touch-icon', 'sizes' => '180x180']); ?>
    <?= $this->Html->meta(['href' => 'favicon/favicon-32x32.png', 'rel' => 'icon', 'sizes' => '32x32', 'type' => 'image/png']); ?>
    <?= $this->Html->meta(['href' => 'favicon/favicon-16x16.png', 'rel' => 'icon', 'sizes' => '16x16', 'type' => 'image/png']); ?>
    <?= $this->Html->meta(['href' => 'favicon/manifest.json', 'rel' => 'manifest']); ?>
    <?= $this->Html->meta(['href' => 'favicon/safari-pinned-tab.svg', 'rel' => 'mask-icon', 'color' => '#5bbad5']); ?>
    <?= $this->Html->meta('theme-color', '#ffffff'); ?>

    <title>
        <?php $cakeDescription = 'PM | Dashboard'; ?>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <!-- Tell the browser to be responsive to screen width -->
    <?= $this->Html->meta('viewport', 'width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no'); ?>
    <!-- Bootstrap 3.3.6 -->
    <?= $this->Html->css('../AdminLTE/bootstrap/css/bootstrap.min.css') ?>
    <!-- Font Awesome -->
    <?= $this->Html->css('font-awesome/css/font-awesome.min') ?>
    <!-- Ionicons -->
    <?= $this->Html->css('https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css') ?>
    <!-- Theme style -->
    <?= $this->Html->css('../AdminLTE/dist/css/AdminLTE.css') ?>
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <?= $this->Html->css('../AdminLTE/dist/css/skins/_all-skins.min.css') ?>

    <?= $this->Html->css('style') ?>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <!--a href="#" class="logo"-->
    <?= $this->Html->link('<span class="logo-mini"><b>C</b>PM</span>
      <span class="logo-lg"><b>Consult</b>PM</span>',
            ['controller' => 'Consult', 'action' => 'index', '_full' => true], ['class' => 'logo', 'escape' => false]); ?>
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <!--span class="logo-mini"><b>C</b>PM</span-->
      <!-- logo for regular state and mobile devices -->
      <!--span class="logo-lg"><b>Consult</b>PM</span-->
    <!--/a-->
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only"><?=__('Toggle navigation')?></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <?= $this->Html->image('dashboard/avatar.jpg', ['class' => 'user-image', 'alt' => 'User Image']); ?>
                <span class="hidden-xs">User</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                  <?= $this->Html->image('dashboard/avatar.jpg', ['class' => 'img-circle', 'alt' => 'User Image']); ?>

                <p>
                  User - PM member
                  <small>(<?=__('Departement')?>)</small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat"><?=__('Profile')?></a>
                </div>
                <div class="pull-right">
                  <?= $this->Html->link(__('Sign out'), ['controller' => 'Authentifications', 'action' => 'logout', '_full' => true], ['class' => 'btn btn-default btn-flat']); ?>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <?= $this->element('sidebar/menu') ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?=(isset($pageName)) ? __($pageName) : ''?>
        <small><?= __('Control panel') ?></small>
      </h1>
      <ol class="breadcrumb">
        <li>
            <?= $this->Html->link('<i class="fa fa-dashboard"></i>'.__('Home'), ['controller' => 'Consult', 'action' => 'index', '_full' => true], ['escape' => false]); ?>
        </li>
        <li>
            <?= $this->Html->link(__('Dashboard'), ['controller' => 'Dashboard', 'action' => 'index', '_full' => true], ['escape' => false]); ?>
        </li>
        <?php if(isset($pageName) && ($pageName !== 'Dashboard')){ ?>
            <li class="active"><?=__($pageName)?></li>
        <?php } ?>
      </ol>
    </section>

    <?= $this->Flash->render() ?>
    <?= $this->Flash->render('Auth', ['element' => 'error']); ?>
    <!-- Main content -->
    <section class="content">
        <!-- Info boxes -->
        <div class="row bg-white">
            <div class="col-md-12">
                <?= $this->fetch('content') ?>
            </div>
        </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b><?=__('Version')?></b> <?=Version?>
    </div>
    <strong>Copyright &copy; 2016 <a href="http://khidma.tn">Khidma.tn</a>.</strong> All rights
    reserved.
  </footer>

  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<?= $this->HTML->script('../AdminLTE/plugins/jQuery/jquery-2.2.3.min.js') ?>
<!--?= $this->HTML->script('http://code.jquery.com/jquery-3.1.0.min.js') ?-->


<!-- jQuery UI 1.11.4 -->
<?= $this->HTML->script('https://code.jquery.com/ui/1.11.4/jquery-ui.min.js') ?>
<!-- Bootstrap 3.3.6 -->
<?= $this->HTML->script('../AdminLTE/bootstrap/js/bootstrap.min.js') ?>
<!-- AdminLTE App -->
<?= $this->HTML->script('../AdminLTE/dist/js/app.min.js') ?>



<?= $this->HTML->script('script.js') ?>
<?= $this->fetch('script'); ?>
</body>
</html>
