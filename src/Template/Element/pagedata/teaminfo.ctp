<div class="row">
  <div class="col s12">
    <h4><?=__('Team')?> : <?=$team->name?></h4>
    <hr>
    <div class="col m11 offset-m1">
      <table class="bordered highlight">
        <tr>
          <th><?=__('Name')?> :</th>
          <td><?=$team->name?></td>
        </tr>
        <tr>
          <th><?=__('Departement')?> :</th>
          <td><?=$team->departement->name?></td>
        </tr>
        <tr>
          <th><?=__('Employees')?> :</th>
          <td>
            <?php
            $lastElement = end($team->users);
            $users = "";
            foreach ($team->users as $key => $user) {
              echo $this->Html->link($user->name, ['controller' => 'consult', 'action' => 'viewUser', $team->departement->id, $user->id])?><?=($lastElement == $user) ? '. ' : ', ';
            }
            ?>

          </td>
        </tr>
        <tr>
          <th><?=__('Description')?> :</th>
          <td><?=(($team->description != Null) && ($team->description !='')) ? $team->description : '-'?></td>
        </tr>
      </table>
    </div>
  </div>
</div>

<hr>

<div class="row">
  <div class="col s12 m11 offset-m1">
    <h5><?=__('Projects')?></h5>
    <?php if(!empty($team->projects)){ ?>
      <table class="bordered highlight">
        <thead>
          <tr>
            <th><?=__('Project')?> :</th>
            <th><?=__('Accomplishment')?> :</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($team->projects as $keyProject => $project){ ?>
            <tr>
              <td><?=$this->Html->link($project->name,['controller' => 'Consult', 'action' => 'viewProjectInfo', $team->departement->id, $project->id])?></td>
              <td>
                <!--div class="progress">
                  <div class="progress-bar" role="progressbar" aria-valuenow="</?=($project->accomplishment > 10) ? $project->accomplishment : 10?>" aria-valuemin="0" aria-valuemax="</?=($project->accomplishment > 10) ? $project->accomplishment : 10?>" style="min-width: 10%; width: </?=$project->accomplishment?>%;">
                    </?=$project->accomplishment?>%
                  </div>
                </div-->
                <div class="progress">
                  <div class="determinate" style="width: <?=$project->accomplishment?>%"></div>
                </div>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    <?php }else{ ?>
      <div class="card-alert card grey lighten-5 z-depth-2">
          <div class="card-content grey-text">
              <p><?=__('No .. associated to this', ['', __('project'), 'cette '.__('team')])?></p>
          </div>
      </div>
    <?php } ?>
  </div>
</div>

<hr>

<div class="row">
  <div class="col s12 m11 offset-m1">
    <h5><?=__('Criterions')?></h5>

    <?php if(!empty($team->criterions)){ ?>
      <div class="col-lg-offset-1">
        <table class="bordered highlight">
          <tr>
            <td><?=__('Name')?></td>
            <td><?=__('Content')?></td>
            <td><?=__('Percent')?></td>
          </tr>
          <?php
          foreach ($team->criterions as $key => $criterion) {
            ?>
            <tr>
              <td><?=h($criterion->name);?></td>
              <td><?=h($criterion['_joinData']->content);?></td>
              <td><?=(isset($criterion['_joinData']->percent)) ? h($criterion['_joinData']->percent).'%' : '-';?></td>
            </tr>
          <?php } ?>
        </table>
      </div>
    <?php }else{ ?>
      <div class="card-alert card grey lighten-5 z-depth-2">
          <div class="card-content grey-text">
              <p><?=__('No .. associated to this', ['', __('criterion'), 'cette '.__('team')])?></p>
          </div>
      </div>
    <?php } ?>
  </div>
</div>
