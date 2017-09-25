<div class="container">
<section>
    <div class="row">
      <div class="col s12">
        <h1 class="fontsforweb_fontid_70660 center"><?=Name_app?><sub><?=Version?></sub></h1>
      </div>
      <div class="col s12">
        <?= $this->Flash->render('auth') ?>
        <?= $this->Flash->render() ?>
      </div>
      <div class="row">
        <div class="col s12 m4 hoverable">
          <div class="card sticky-action">
            <div class="card-image waves-effect waves-block center">
              <i class="material-icons x-large blue-text text-darken-2">store</i>
            </div>
            <div class="card-content">
              <span class="card-title activator grey-text text-darken-4"><?=__('Companies')?><i class="material-icons right">more_vert</i></span>
            </div>
            <div class="card-action">
              <p><?=$this->Html->link(__('Consult'), ['controller' => 'consult', 'action' => 'companies']);?></p>
            </div>
            <div class="card-reveal">
              <span class="card-title grey-text text-darken-4"><?=__('Companies')?><i class="material-icons right">close</i></span>
              <p><?=__('x x are available', $arrayNumber['numberDeps'], __('departements'))?>.</p>
            </div>
          </div>
        </div>
        <div class="col s12 m4 hoverable">
          <div class="card sticky-action">
            <div class="card-image waves-effect waves-block center">
              <i class="material-icons x-large blue-text text-darken-2">view_compact</i>
            </div>
            <div class="card-content">
              <span class="card-title activator grey-text text-darken-4"><?=__('Departements')?><i class="material-icons right">more_vert</i></span>
            </div>
            <div class="card-action">
              <p><?=$this->Html->link(__('Consult'), ['controller' => 'consult', 'action' => 'departements']);?></p>
            </div>
            <div class="card-reveal">
              <span class="card-title grey-text text-darken-4"><?=__('Departements')?><i class="material-icons right">close</i></span>
              <p><?=__('x x are available', $arrayNumber['numberDeps'], __('departements'))?>.</p>
            </div>
          </div>
        </div>
        <div class="col s12 m4 hoverable">
          <div class="card sticky-action">
            <div class="card-image waves-effect waves-block center">
              <i class="material-icons x-large blue-text text-darken-2">group_work</i>
            </div>
            <div class="card-content">
              <span class="card-title activator grey-text text-darken-4"><?=__('Teams')?><i class="material-icons right">more_vert</i></span>
            </div>
            <div class="card-action">
              <p><?=$this->Html->link(__('Consult'), ['controller' => 'consult', 'action' => 'teamsList']);?></p>
            </div>
            <div class="card-reveal">
              <span class="card-title grey-text text-darken-4"><?=__('Teams')?><i class="material-icons right">close</i></span>
              <p><?=__('x x are available', $arrayNumber['numberTeams'], __('teams'))?>.</p>
            </div>
          </div>
        </div>
        <div class="col s12 m4 hoverable">
          <div class="card sticky-action">
            <div class="card-image waves-effect waves-block center">
              <i class="material-icons x-large blue-text text-darken-2">group</i>
            </div>
            <div class="card-content">
              <span class="card-title activator grey-text text-darken-4"><?=__('Employees')?><i class="material-icons right">more_vert</i></span>
            </div>
            <div class="card-action">
              <p><?=$this->Html->link(__('Consult'), ['controller' => 'consult', 'action' => 'employeesList']);?></p>
            </div>
            <div class="card-reveal">
              <span class="card-title grey-text text-darken-4"><?=__('Employees')?><i class="material-icons right">close</i></span>
              <p><?=__('We are x employees', $arrayNumber['numberEmp'], __('employees'))?>.</p>
            </div>
          </div>
        </div>
        <div class="col s12 m4 hoverable">
          <div class="card sticky-action">
            <div class="card-image waves-effect waves-block center">
              <i class="material-icons x-large blue-text text-darken-2">work</i>
            </div>
            <div class="card-content">
              <span class="card-title activator grey-text text-darken-4"><?=__('Projects')?><i class="material-icons right">more_vert</i></span>
            </div>
            <div class="card-action">
              <p><?=$this->Html->link(__('Consult'), ['controller' => 'consult', 'action' => 'projectsList']);?></p>
            </div>
            <div class="card-reveal">
              <span class="card-title grey-text text-darken-4"><?=__('Projects')?><i class="material-icons right">close</i></span>
              <p><?=__('Our teams work on x projects', __('teams'), $arrayNumber['numberProjects'], __('projects'))?>.</p>
            </div>
          </div>
        </div>
        <div class="col s12 m4 hoverable">
          <div class="card sticky-action">
            <div class="card-image waves-effect waves-block center">
              <i class="material-icons x-large blue-text text-darken-2">recent_actors</i>
            </div>
            <div class="card-content">
              <span class="card-title activator grey-text text-darken-4"><?=__('Clients')?><i class="material-icons right">more_vert</i></span>
            </div>
            <div class="card-action">
              <p><?=$this->Html->link(__('Consult'), ['controller' => 'consult', 'action' => 'clientsList']);?></p>
            </div>
            <div class="card-reveal">
              <span class="card-title grey-text text-darken-4"><?=__('Clients')?><i class="material-icons right">close</i></span>
              <p><?=__('We are working with x clients', $arrayNumber['numberClients'], __('clients'))?>.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
</section>

<section>
  <div class="row">
    <div class="col s12">
      <ul class="collection">

        <?php
            foreach ($projectStages as $key => $stage) {
        ?>
              <li class="collection-item avatar">
                <i class="material-icons circle blue">work</i>
                <span class="title"><?=$stage->name?></span>
                <p><?=$stage->total_projects?> <?=($stage->total_projects > 1) ? __('Projects') : __('Project') ?></p>
                <?=$this->Html->link('<i class="material-icons">link</i>', ['controller' => 'Consult', 'action' => 'projectsList', $stage->id], ['class' => 'secondary-content', 'escape' => false])?>
              </li>
        <?php
            }
        ?>
      </ul>
    </div>
  </div>
</section>
</div>

<?php
$this->Html->scriptStart(['block' => true]);
    echo "info_charts = ".  json_encode($info_charts).";";
    echo "initializeConsultPage();";
$this->Html->scriptEnd();
?>
