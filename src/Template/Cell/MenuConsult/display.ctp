<!--sidebar start-->
    <aside class="menu-index">
        <div id="sidebar"  class="nav-collapse ">
            <!-- sidebar menu start-->
            <ul class="sidebar-menu" id="nav-accordion">

                <!--p class="centered">
                    <a href="profile.html">
                        </?=$this->Html->image('../webroot/dashgumfree/assets/img/ui-sam.jpg')?>
                    </a>
                </p-->
                <h5 class="centered">Menu</h5>

                <li class="mt">
                    <?php 
                        if($pageName == 'Dashboard') {$active = 'active';}else{$active = '';}
                        echo $this->Html->link('<i class="fa fa-dashboard"></i><span>'.__('Dashboard').'</span>', ['controller' => 'consult', 'action' => 'index'], ['class'=>"$active", 'escape' => false]);
                    ?>
                </li>

                <li class="sub-menu">
                    <?php 
                        if($pageName == 'Companies') {$active = 'active';}else{$active = '';}
                        echo $this->Html->link('<i class="fa fa-building" aria-hidden="true"></i>'.__('Companies').'</span>', ['controller' => 'consult', 'action' => 'companies'], ['class'=>"$active", 'escape' => false]);
                    ?>
                </li>
                
                <li class="sub-menu">
                    <?php 
                        if($pageName == 'Départements') {$active = 'active';}else{$active = '';}
                        echo $this->Html->link('<i class="fa fa-university"></i><span>'.__('Departements').'</span>', ['controller' => 'consult', 'action' => 'departements'], ['class'=>"$active", 'escape' => false]);
                    ?>
                </li>

                <li class="sub-menu">
                    <?php 
                        if($pageName == 'Equipes') {$active = 'active';}else{$active = '';}
                        echo $this->Html->link('<i class="fa fa-users"></i><span>'.__('Teams').'</span>', ['controller' => 'consult', 'action' => 'teamsList'], ['class'=>"$active", 'escape' => false]);
                    ?>
                </li>

                <!--li class="sub-menu">
                    </?php 
                        if($pageName == 'Projets') {$active = 'active';}else{$active = '';}
                        echo $this->Html->link('<i class="fa fa-wrench"></i><span>'.__('Projects').'</span>', ['controller' => 'consult', 'action' => 'projectsList'], ['class'=>"$active", 'escape' => false]);
                    ?>
                </li-->

                <li class="sub-menu">
                    <?php 
                        if($pageName == 'Employés') {$active = 'active';}else{$active = '';}
                        echo $this->Html->link('<i class="fa fa-user-circle-o"></i><span>'.__('Employees').'</span>', ['controller' => 'consult', 'action' => 'employeesList'], ['class'=>"$active", 'escape' => false]);
                    ?>
                </li>

                <li class="sub-menu">
                    <?php 
                        if($pageName == 'Clients') {$active = 'active';}else{$active = '';}
                        echo $this->Html->link('<i class="fa fa-address-book"></i><span>'.__('Clients').'</span>', ['controller' => 'consult', 'action' => 'clientsList'], ['class'=>"$active", 'escape' => false]);
                    ?>
                </li>
                
                <li class="sub-menu">
                    <?php 
                        if($pageName == 'Projets') {$active = 'active';}else{$active = '';}
                        echo $this->Html->link('<i class="fa fa-wrench"></i><span>'.__('Projects').'</span>', [], ['href'=>'javascript:;', 'class'=>"$active", 'escape' => false]);
                    ?>
                    <ul class="sub">
                        <li><?=$this->Html->link(__('All projects'), ['controller' => 'consult', 'action' => 'projectsList'])?></li>
                        <?php 
                            foreach ($menu_stages as $key => $stage) {
                        ?>
                            <li><?=$this->Html->link($stage->name, ['controller' => 'Consult', 'action' => 'ProjectsList', $stage->id])?></li>
                        <?php
                            }
                        ?>
                        
                    </ul>
                </li>
                
                <li class="sub-menu">
                    <?php 
                        if($pageName == 'Calendar') {$active = 'active';}else{$active = '';}
                        echo $this->Html->link('<i class="fa fa-calendar" aria-hidden="true"></i><span>'.__('Calendar').'</span>', ['controller' => 'consult', 'action' => 'calendar'], ['class'=>"$active", 'escape' => false]);
                    ?>
                </li>
                <!--li class="sub-menu">
                    </?php 
                        if($pageName == 'Rapports') {$active = 'active';}else{$active = '';}
                        echo $this->Html->link('<i class="fa fa-files-o"></i><span>Rapports</span>', ['controller' => 'consult', 'action' => 'index'], ['class'=>"$active", 'escape' => false]);
                    ?>
                    
                </li-->

                <!--li class="sub-menu">
                    </?php 
                        if($pageName == 'Evaluation') {$active = 'active';}else{$active = '';}
                        echo $this->Html->link('<i class="fa fa-area-chart"></i><span>Evaluation</span>', [], ['href'=>'javascript:;', 'classe' => "$active",'escape' => false]);
                    ?>
                    <ul class="sub">
                        <li></?=$this->Html->link('Par projet', [])?></li>
                        <li></?=$this->Html->link('Par employée', [])?></li>
                    </ul>
                </li-->
            </ul>
            <!-- sidebar menu end-->
        </div>
    </aside>
    <!--sidebar end-->