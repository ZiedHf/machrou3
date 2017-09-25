    <!--aside class="menu-index">
        <div id="sidebar"  class="nav-collapse ">
            <ul class="sidebar-menu" id="nav-accordion">
                <h5 class="centered">Menu</h5>
                <li class="mt">
                    </?php
                        if($pageName == 'Dashboard') {$active = 'active';}else{$active = '';}
                        echo $this->Html->link('<i class="fa fa-dashboard"></i><span>'.__('Dashboard').'</span>', ['controller' => 'consult', 'action' => 'index'], ['class'=>"$active", 'escape' => false]);
                    ?>
                </li>
                <li class="sub-menu">
                    </?php
                        if($pageName == 'Companies') {$active = 'active';}else{$active = '';}
                        echo $this->Html->link('<i class="fa fa-building" aria-hidden="true"></i>'.__('Companies').'</span>', ['controller' => 'consult', 'action' => 'companies'], ['class'=>"$active", 'escape' => false]);
                    ?>
                </li>
                <li class="sub-menu">
                    </?php
                        if($pageName == 'Départements') {$active = 'active';}else{$active = '';}
                        echo $this->Html->link('<i class="fa fa-university"></i><span>'.__('Departements').'</span>', ['controller' => 'consult', 'action' => 'departements'], ['class'=>"$active", 'escape' => false]);
                    ?>
                </li>
                <li class="sub-menu">
                    </?php
                        if($pageName == 'Equipes') {$active = 'active';}else{$active = '';}
                        echo $this->Html->link('<i class="fa fa-users"></i><span>'.__('Teams').'</span>', ['controller' => 'consult', 'action' => 'teamsList'], ['class'=>"$active", 'escape' => false]);
                    ?>
                </li>
                <li class="sub-menu">
                    </?php
                        if($pageName == 'Employés') {$active = 'active';}else{$active = '';}
                        echo $this->Html->link('<i class="fa fa-user-circle-o"></i><span>'.__('Employees').'</span>', ['controller' => 'consult', 'action' => 'employeesList'], ['class'=>"$active", 'escape' => false]);
                    ?>
                </li>
                <li class="sub-menu">
                    </?php
                        if($pageName == 'Clients') {$active = 'active';}else{$active = '';}
                        echo $this->Html->link('<i class="fa fa-address-book"></i><span>'.__('Clients').'</span>', ['controller' => 'consult', 'action' => 'clientsList'], ['class'=>"$active", 'escape' => false]);
                    ?>
                </li>
                <li class="sub-menu">
                    </?php
                        if($pageName == 'Projets') {$active = 'active';}else{$active = '';}
                        echo $this->Html->link('<i class="fa fa-wrench"></i><span>'.__('Projects').'</span>', [], ['href'=>'javascript:;', 'class'=>"$active", 'escape' => false]);
                    ?>
                    <ul class="sub">
                        <li></?=$this->Html->link(__('All projects'), ['controller' => 'consult', 'action' => 'projectsList'])?></li>
                        </?php
                            foreach ($menu_stages as $key => $stage) {
                        ?>
                            <li></?=$this->Html->link($stage->name, ['controller' => 'Consult', 'action' => 'ProjectsList', $stage->id])?></li>
                        </?php
                            }
                        ?>

                    </ul>
                </li>
                <li class="sub-menu">
                    </?php
                        if($pageName == 'Calendar') {$active = 'active';}else{$active = '';}
                        echo $this->Html->link('<i class="fa fa-calendar" aria-hidden="true"></i><span>'.__('Calendar').'</span>', ['controller' => 'consult', 'action' => 'calendar'], ['class'=>"$active", 'escape' => false]);
                    ?>
                </li>
            </ul>
        </div>
    </aside-->
    <ul id="slide-out" class="side-nav">
      <li>
        <div class="user-view">
          <div class="background blue lighten-2">

          </div>
          <a href="#!user"><img class="circle" src="./images/anonymous.jpg"></a>
          <a href="#!name"><span class="white-text name">John Doe</span></a>
          <a href="#!email"><span class="white-text email">jdandturk@gmail.com</span></a>
        </div>
      </li>
      <li>
        <?php
            if($pageName == 'Dashboard') {$active = 'grey lighten-3';}else{$active = '';}
            echo $this->Html->link('<i class="material-icons">home</i><span>'.__('Dashboard').'</span>', ['controller' => 'consult', 'action' => 'index'], ['class'=>"waves-effect waves-blue $active", 'escape' => false]);
        ?>
      </li>
      <li><div class="divider"></div></li>
      <li><a class="subheader">Acteurs</a></li>
      <li>
        <?php
            if($pageName == 'Companies') {$active = 'grey lighten-3';}else{$active = '';}
            echo $this->Html->link('<i class="material-icons">store</i><span>'.__('Companies').'</span>', ['controller' => 'consult', 'action' => 'companies'], ['class'=>"waves-effect waves-blue $active", 'escape' => false]);
        ?>
      </li>
      <li>
        <?php
            if($pageName == 'Départements') {$active = 'grey lighten-3';}else{$active = '';}
            echo $this->Html->link('<i class="material-icons">view_compact</i><span>'.__('Departements').'</span>', ['controller' => 'consult', 'action' => 'departements'], ['class'=>"waves-effect waves-blue $active", 'escape' => false]);
        ?>
      </li>
      <li>
        <?php
            if($pageName == 'Equipes') {$active = 'grey lighten-3';}else{$active = '';}
            echo $this->Html->link('<i class="material-icons">group_work</i><span>'.__('Teams').'</span>', ['controller' => 'consult', 'action' => 'teamsList'], ['class'=>"waves-effect waves-blue $active", 'escape' => false]);
        ?>
      </li>
      <li>
        <?php
            if($pageName == 'Employés') {$active = 'grey lighten-3';}else{$active = '';}
            echo $this->Html->link('<i class="material-icons">group</i><span>'.__('Collaborateurs').'</span>', ['controller' => 'consult', 'action' => 'employeesList'], ['class'=>"waves-effect waves-blue $active", 'escape' => false]);
        ?>
      </li>
      <li>
        <?php
            if($pageName == 'Clients') {$active = 'grey lighten-3';}else{$active = '';}
            echo $this->Html->link('<i class="material-icons">recent_actors</i><span>'.__('Clients').'</span>', ['controller' => 'consult', 'action' => 'clientsList'], ['class'=>"waves-effect waves-blue $active", 'escape' => false]);
        ?>
      </li>
      <li><div class="divider"></div></li>
      <li><a class="subheader"><?=__('Projects')?></a></li>
      <li>
        <ul class="collapsible collapsible-accordion">
          <li class="bold">
            <?php
                if($pageName == 'Projets') {$active = 'grey lighten-3';}else{$active = '';}
                echo $this->Html->link('<i class="material-icons">work</i><span>'.__('Projects').'</span>', '#!', ['href'=>'javascript:;', 'class'=>"collapsible-header waves-effect waves-blue", 'escape' => false]);
            ?>
            <div class="collapsible-body">
              <ul>
                <li><?=$this->Html->link(__('All projects'), ['controller' => 'consult', 'action' => 'projectsList'])?></li>
                <?php
                    foreach ($menu_stages as $key => $stage) {
                ?>
                    <li><?=$this->Html->link($stage->name, ['controller' => 'Consult', 'action' => 'ProjectsList', $stage->id])?></li>
                <?php
                    }
                ?>
              </ul>
            </div>
          </li>
        </ul>
      </li>

      <li>
        <?php
            if($pageName == 'Calendar') {$active = 'grey lighten-3';}else{$active = '';}
            echo $this->Html->link('<i class="material-icons">date_range</i><span>'.__('Calendar').'</span>', ['controller' => 'consult', 'action' => 'calendar'], ['class'=>"waves-effect waves-blue $active", 'escape' => false]);
        ?>
      </li>
    </ul>
