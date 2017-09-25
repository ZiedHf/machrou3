<!--header class="header black-bg">
        <div class="sidebar-toggle-box">
            <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
        </div>
        </?= $this->Html->link(Name_app, ['action' => 'index'], ['class' => 'logo']) ?>
        <div class="nav notify-row" id="top_menu">
            <ul class="nav top-menu">
        </div>
        <div class="top-menu">
            <ul class="nav pull-right top-menu">
                <li>
                    </?=$this->Html->link('<i class="fa fa-pencil-square-o"></i>', ['controller' => 'Dashboard', 'action' => 'index'], ['escape' => false])?></li>
                <li>
                    </?=$this->Html->link('<i class="fa fa-sign-out"></i>', ['controller' => 'Authentifications', 'action' => 'logout'], ['escape' => false])?>
                </li>
            </ul>
        </div>
  </header-->

  <header>
    <ul id="dropdown1" class="dropdown-content">
      <li>
        <?=$this->Html->link('<i class="material-icons left">dashboard</i> Adminstration', ['controller' => 'Dashboard', 'action' => 'index'], ['class' => 'blue-text', 'escape' => false])?>
      </li>
      <li>
        <?=$this->Html->link('<i class="material-icons left">exit_to_app</i> Déconnexion', ['controller' => 'Authentifications', 'action' => 'logout'], ['class' => 'blue-text', 'escape' => false])?>
      </li>
    </ul>
    <!--Menu Slider-->
    <?= $this->cell('MenuConsult', ['pageName' => $pageName]) ?>
    <nav>
      <div class="nav-wrapper blue">
        <a href="#" data-activates="slide-out" class="button-collapse show-on-large left"><i class="material-icons">menu</i></a>
        <a href="#" class="brand-logo center">Logo</a>
        <ul class="hide-on-med-and-down right">
          <li>
            <?=$this->Html->link('<i class="material-icons left">dashboard</i> Adminstration', ['controller' => 'Dashboard', 'action' => 'index'], ['escape' => false])?>
          </li>
          <li>
            <?=$this->Html->link('<i class="material-icons left">exit_to_app</i> Déconnexion', ['controller' => 'Authentifications', 'action' => 'logout'], ['escape' => false])?>
          </li>
        </ul>
        <ul class="hide-on-large-only right">
          <li><a class="dropdown-button" data-beloworigin="true" href="#!" data-activates="dropdown1">Menu<i class="material-icons right">arrow_drop_down</i></a></li>
        </ul>
      </div>
    </nav>

    <?= $this->cell('Slider') ?>

  </header>
