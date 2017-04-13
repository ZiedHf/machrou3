<div class="row">
    <div class="col-md-12 col-sm-12">
        <h2><?=__('Team')?> : <?=$team->name?></h2>
        <hr>
        <div class="col-lg-offset-1">
            <table class="table table-bordered">
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
            <hr>
            <?php if(!empty($team->projects)){ ?>
            <table id="projectsTable" class="table table-bordered display" cellspacing="0">
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
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" aria-valuenow="<?=($project->accomplishment > 10) ? $project->accomplishment : 10?>" aria-valuemin="0" aria-valuemax="<?=($project->accomplishment > 10) ? $project->accomplishment : 10?>" style="min-width: 10%; width: <?=$project->accomplishment?>%;">
                                <?=$project->accomplishment?>%
                            </div>
                        </div>
                    </td>
                </tr>
                <?php } ?>
                </tbody>
            </table>
            <?php } ?>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 col-sm-12">
        <h3><?=__('Criterions')?></h3>
        <hr>
        <?php if(!empty($team->criterions)){ ?>
        <div class="col-lg-offset-1">
            <table class="table table-bordered">
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
            <div class="col-lg-offset-1">
                <?=__('No .. associated to this', ['', __('criterion'), 'cette '.__('team')])?>
            </div>
        <?php } ?>
    </div>
</div>