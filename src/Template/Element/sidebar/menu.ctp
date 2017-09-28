<!--sidebar start-->
    <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
            <?= $this->Html->image('dashboard/avatar.jpg', ['class' => 'img-circle', 'alt' => 'User Image']); ?>
        </div>
        <div class="pull-left info">
          <p><?=__('User')?></p>
        </div>
      </div>
      <!-- search form -->
      <!--form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form-->
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header"><?=__('MENU')?></li>
        <li <?=(isset($pageName))&&($pageName === 'Dashboard') ? 'class="active"' : '' ?>>
            <?= $this->Html->link('<i class="fa fa-dashboard"></i><span>'.__('Dashboard').'</span>', ['controller' => 'Dashboard', 'action' => 'index', '_full' => true], ['escape' => false]); ?>
        </li>
        <li <?=(isset($pageName))&&($pageName === 'Companies') ? 'class="active"' : '' ?>>
            <?= $this->Html->link('<i class="fa fa-building"></i><span>'.__('Companies').'</span>', ['controller' => 'Companies', 'action' => 'index', '_full' => true], ['escape' => false]); ?>
        </li>
        <li <?=(isset($pageName))&&($pageName === 'Départements') ? 'class="active"' : '' ?>>
            <?= $this->Html->link('<i class="fa fa-university"></i><span>'.__('Departements').'</span>', ['controller' => 'Departements', 'action' => 'index', '_full' => true], ['escape' => false]); ?>
        </li>
        <li <?=(isset($pageName))&&($pageName === 'Teams') ? 'class="active"' : '' ?>>
            <?= $this->Html->link('<i class="fa fa-users"></i><span>'.__('Teams').'</span>', ['controller' => 'Teams', 'action' => 'index', '_full' => true], ['escape' => false]); ?>
        </li>
        <li <?=(isset($pageName))&&($pageName === 'Users') ? 'class="active"' : '' ?>>
            <?= $this->Html->link('<i class="fa fa-user-circle-o"></i><span>'.__('Employees').'</span>', ['controller' => 'Users', 'action' => 'index', '_full' => true], ['escape' => false]); ?>
        </li>
        <li <?=(isset($pageName))&&($pageName === 'Clients') ? 'class="active"' : '' ?>>
            <?= $this->Html->link('<i class="fa fa-address-book" aria-hidden="true"></i><span>'.__('Clients').'</span>', ['controller' => 'Clients', 'action' => 'index', '_full' => true], ['escape' => false]); ?>
        </li>
        <li <?=(isset($pageName))&&($pageName === 'Members') ? 'class="active"' : '' ?>>
            <?= $this->Html->link('<i class="fa fa-key" aria-hidden="true"></i><span>'.__('Members').'</span>', ['controller' => 'Members', 'action' => 'index', '_full' => true], ['escape' => false]); ?>
        </li>
        <li <?=(isset($pageName))&&($pageName === 'Projets') ? 'class="active"' : '' ?>>
            <?= $this->Html->link('<i class="fa fa-wrench"></i><span>'.__('Projects').'</span>', ['controller' => 'Projects', 'action' => 'index', '_full' => true], ['escape' => false]); ?>
        </li>
        <li class="<?=(isset($pageName))&&(($pageName === 'UserUrls')||($pageName === 'ProjectUrls')) ? 'active' : '' ?> treeview">
            <?= $this->Html->link('<i class="fa fa-link"></i><span>'.__('Urls').'</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>',
                                    '#',
                                    ['escape' => false]); ?>
            <ul class="treeview-menu">
              <li <?=(isset($pageName))&&($pageName === 'ProjectUrls') ? 'class="active"' : '' ?>>
                  <?= $this->Html->link('<i class="fa fa-circle-o"></i><span>'.__('Projects Urls').'</span>', ['controller' => 'ProjectUrls', 'action' => 'index', '_full' => true], ['escape' => false]); ?>
              </li>
              <li <?=(isset($pageName))&&($pageName === 'UserUrls') ? 'class="active"' : '' ?>>
                  <?= $this->Html->link('<i class="fa fa-circle-o"></i><span>'.__('Users Urls').'</span>', ['controller' => 'UserUrls', 'action' => 'index', '_full' => true], ['escape' => false]); ?>
              </li>
            </ul>
        </li>
        <li <?=(isset($pageName))&&($pageName === 'Criterions') ? 'class="active"' : '' ?>>
            <?= $this->Html->link('<i class="fa fa-area-chart"></i><span>'.__('Criterions').'</span>', ['controller' => 'Criterions', 'action' => 'index', '_full' => true], ['escape' => false]); ?>
        </li>
        <li <?=(isset($pageName))&&($pageName === 'Priorities') ? 'class="active"' : '' ?>>
            <?= $this->Html->link('<i class="fa fa-angle-double-right"></i><span>'.__('Priorities').'</span>', ['controller' => 'Priorities', 'action' => 'index', '_full' => true], ['escape' => false]); ?>
        </li>
        <li <?=(isset($pageName))&&($pageName === 'ProjectStages') ? 'class="active"' : '' ?>>
            <?= $this->Html->link('<i class="fa fa-tasks"></i><span>'.__('ProjectStages').'</span>', ['controller' => 'ProjectStages', 'action' => 'index', '_full' => true], ['escape' => false]); ?>
        </li>
        <li class="<?=(isset($pageName))&&(in_array($pageName, ['assocCompaniesUsers', 'assocDepartementsUsers', 'assocTeamsUsers', 'assocUsersProjects'])) ? 'active' : '' ?> treeview">
            <?= $this->Html->link('<i class="fa fa-universal-access" aria-hidden="true"></i>'.__('AccessRight').'/'.__('Users').'</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>',
                                    '#',
                                    ['escape' => false]); ?>
            <ul class="treeview-menu">
              <li <?=(isset($pageName))&&($pageName === 'assocCompaniesUsers') ? 'class="active"' : '' ?>>
                  <?= $this->Html->link('<i class="fa fa-caret-square-o-right" aria-hidden="true"></i>'.__('Users').'/'.__('Companies').'</span>', ['controller' => 'AssocCompaniesUsers', 'action' => 'index', '_full' => true], ['escape' => false]); ?>
              </li>
              <li <?=(isset($pageName))&&($pageName === 'assocDepartementsUsers') ? 'class="active"' : '' ?>>
                  <?= $this->Html->link('<i class="fa fa-caret-square-o-right" aria-hidden="true"></i>'.__('Users').'/'.__('Departements').'</span>', ['controller' => 'AssocDepartementsUsers', 'action' => 'index', '_full' => true], ['escape' => false]); ?>
              </li>
              <li <?=(isset($pageName))&&($pageName === 'assocTeamsUsers') ? 'class="active"' : '' ?>>
                  <?= $this->Html->link('<i class="fa fa-caret-square-o-right" aria-hidden="true"></i>'.__('Users').'/'.__('Teams').'</span>', ['controller' => 'AssocTeamsUsers', 'action' => 'index', '_full' => true], ['escape' => false]); ?>
              </li>
              <li <?=(isset($pageName))&&($pageName === 'assocUsersProjects') ? 'class="active"' : '' ?>>
                  <?= $this->Html->link('<i class="fa fa-caret-square-o-right" aria-hidden="true"></i>'.__('Users').'/'.__('Projects').'</span>', ['controller' => 'AssocUsersProjects', 'action' => 'index', '_full' => true], ['escape' => false]); ?>
              </li>
            </ul>
        </li>
        <li class="<?=(isset($pageName))&&(in_array($pageName, ['assocCompaniesMembers', 'assocDepartementsMembers', 'assocTeamsMembers', 'assocMembersProjects'])) ? 'active' : '' ?> treeview">
            <?= $this->Html->link('<i class="fa fa-universal-access" aria-hidden="true"></i>'.__('AccessRight').'/'.__('Members').'</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>',
                                    '#',
                                    ['escape' => false]); ?>
            <ul class="treeview-menu">
              <li <?=(isset($pageName))&&($pageName === 'assocCompaniesMembers') ? 'class="active"' : '' ?>>
                  <?= $this->Html->link('<i class="fa fa-caret-square-o-right" aria-hidden="true"></i>'.__('Members').'/'.__('Companies').'</span>', ['controller' => 'AssocCompaniesMembers', 'action' => 'index', '_full' => true], ['escape' => false]); ?>
              </li>
              <li <?=(isset($pageName))&&($pageName === 'assocDepartementsMembers') ? 'class="active"' : '' ?>>
                  <?= $this->Html->link('<i class="fa fa-caret-square-o-right" aria-hidden="true"></i>'.__('Members').'/'.__('Departements').'</span>', ['controller' => 'AssocDepartementsMembers', 'action' => 'index', '_full' => true], ['escape' => false]); ?>
              </li>
              <li <?=(isset($pageName))&&($pageName === 'assocTeamsMembers') ? 'class="active"' : '' ?>>
                  <?= $this->Html->link('<i class="fa fa-caret-square-o-right" aria-hidden="true"></i>'.__('Members').'/'.__('Teams').'</span>', ['controller' => 'AssocTeamsMembers', 'action' => 'index', '_full' => true], ['escape' => false]); ?>
              </li>
              <li <?=(isset($pageName))&&($pageName === 'assocMembersProjects') ? 'class="active"' : '' ?>>
                  <?= $this->Html->link('<i class="fa fa-caret-square-o-right" aria-hidden="true"></i>'.__('Members').'/'.__('Projects').'</span>', ['controller' => 'AssocMembersProjects', 'action' => 'index', '_full' => true], ['escape' => false]); ?>
              </li>
            </ul>
        </li>
        <!--li </?=(isset($pageName))&&($pageName === 'Action disciplinaire') ? 'class="active"' : '' ?>>
            </?= $this->Html->link('<i class="fa fa-flag"></i><span>'.__('Disciplinary actions').'</span>', ['controller' => 'Actiondisciplinaires', 'action' => 'index', '_full' => true], ['escape' => false]); ?>
        </li-->
        <!--li </?=(isset($pageName))&&($pageName === 'Rapports') ? 'class="active"' : '' ?>>
            </?= $this->Html->link('<i class="fa fa-paper-plane"></i><span>'.__('Reports').'</span>', ['controller' => 'Rapports', 'action' => 'index', '_full' => true], ['escape' => false]); ?>
        </li-->
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
    <!--sidebar end-->
