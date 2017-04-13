<header class="header black-bg">
        <div class="sidebar-toggle-box">
            <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
        </div>
        <!--logo start-->
        <!--a href="index.html" class="logo"><b>DASHGUM FREE</b></a-->
        <?= $this->Html->link(Name_app, ['action' => 'index'], ['class' => 'logo']) ?>
        <!--logo end-->
        <div class="nav notify-row" id="top_menu">
            <!--  notification start -->
            <ul class="nav top-menu">
                <!-- settings start -->
                <!--li class="dropdown">

                </li-->
        </div>
        <div class="top-menu">
            <ul class="nav pull-right top-menu">
                <li>
                    <?=$this->Html->link('<i class="fa fa-pencil-square-o"></i>', ['controller' => 'Dashboard', 'action' => 'index'], ['escape' => false])?></li>
                <li>
                    <?=$this->Html->link('<i class="fa fa-sign-out"></i>', ['controller' => 'Authentifications', 'action' => 'logout'], ['escape' => false])?>
                </li>
            </ul>
        </div>
  </header>