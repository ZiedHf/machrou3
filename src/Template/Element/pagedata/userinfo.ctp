<div class="row">
    <div class="col s12">
        <h4><?=__('Employee')?> : <?php echo "$user->name $user->lastName"; ?></h4>
        <hr>
        <div class="col-lg-offset-1">
            <table class="table table-bordered">
                <tr>
                    <th><?=__('Name')?> :</th>
                    <td><?php echo "$user->name $user->lastName"; ?></td>
                </tr>
                <tr>
                    <th><?=__('Email')?> :</th>
                    <td><?=(!empty($user->authentification->email)) ? $user->authentification->email : '-' ?></td>
                </tr>
                <?php if(!empty($user->teams)){ ?>
                <tr>
                    <th><?=__('Teams')?> :</th>
                    <td>
                        <?php
                            $lastElement = end($user->teams);
                            foreach ($user->teams as $key => $team){
                                if($team === $lastElement){
                                    echo $this->Html->link($team->name, ['controller' => 'Consult', 'action' => 'viewTeamInfo', $team->id]).'.';
                                }else{
                                    echo $this->Html->link($team->name, ['controller' => 'Consult', 'action' => 'viewTeamInfo', $team->id]).', ';
                                }
                            }
                        ?>
                    </td>
                </tr>
                <?php } ?>
                <tr>
                    <th><?=__('Description')?> :</th>
                    <td><?=(($user->description != Null) && ($user->description !='')) ? $user->description : '-'?></td>
                </tr>
            </table>
        </div>
        <hr>
        <div class="col-lg-offset-1">
            <h3><?=__('Project')?> :</h3>
            <?php if(!empty($user->projects)){ ?>

                <table id="projectsTable" class="table table-bordered display" cellspacing="0">
                    <thead>
                        <tr>
                            <th><?=__('Project')?></th>
                            <th><?=__('Time dedicated')?></th>
                            <th><?=__('Accomplishment')?></th>
                            <th><?=__('ProjectManager')?></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th><?=__('Project')?></th>
                            <th><?=__('Time dedicated')?></th>
                            <th><?=__('Accomplishment')?></th>
                            <th><?=__('ProjectManager')?></th>
                        </tr>
                    </tfoot>
                    <tbody>
                    <?php
                        foreach($user->projects as $key => $project){
                            $time_dedicated = $project['_joinData']->time_dedicated;
                    ?>
                    <tr>
                        <td><?= (!empty($user->team)) ? $this->Html->link($project->name,['controller' => 'Consult', 'action' => 'viewProjectInfo', $team->departement->id, $project->id]) : $this->Html->link($project->name,['controller' => 'Consult', 'action' => 'viewProjectInfo', 0, $project->id]) ?></td>
                        <td>
                            <?php if((isset($time_dedicated))&&($time_dedicated !== '')){ ?>
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" aria-valuenow="<?=($time_dedicated > 10) ? $time_dedicated : 10?>" aria-valuemin="0" aria-valuemax="<?=($time_dedicated > 10) ? $time_dedicated : 10?>" style="min-width: 10%; width: <?=$time_dedicated?>%;">
                                  <?=$time_dedicated?>%
                                </div>
                            </div>
                            <?php }else{ ?>
                            -
                            <?php } ?>
                        </td>
                        <td>
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" aria-valuenow="<?=($project->accomplishment > 10) ? $project->accomplishment : 10?>" aria-valuemin="0" aria-valuemax="<?=($project->accomplishment > 10) ? $project->accomplishment : 10?>" style="min-width: 10%; width: <?=$project->accomplishment?>%;">
                                  <?=$project->accomplishment?>%
                                </div>
                            </div>
                        </td>
                        <td>
                            <?php if($project['_joinData']->projectManager === 1){ ?>
                                <i class="fa fa-check-circle green" aria-hidden="true"></i>
                            <?php }else{ ?>
                                -
                            <?php } ?>
                        </td>
                    </tr>
                    <?php } ?>
                    </tbody>
                </table>

            <?php }else{ ?>
                <div class="col-lg-offset-1">
                    <?=__('No .. associated to this', ['', __('projet'), 'ce '.__('employee')])?>
                </div>
            <?php } ?>
        </div>
        <hr>
        <div class="col-lg-offset-1">
            <div class="col-md-12 col-sm-12">
                <h3><?=__('Urls')?></h3>
                <hr>
                <?php if(!empty($user->user_urls)){ ?>
                <div class="col-lg-offset-1">
                    <table class="table table-bordered">
                        <tr>
                            <td><?=__('Name')?></td>
                            <td><?=__('Url')?></td>
                        </tr>
                        <?php
                            foreach ($user->user_urls as $key => $url) {
                        ?>
                        <tr>
                            <td><?=h($url->name);?></td>
                            <td><?= $this->Html->link(h($url->url), $url->url, ['target' => '_blank']) ?></td>
                        </tr>
                        <?php } ?>
                    </table>
                </div>
                <?php }else{ ?>
                    <div class="col-lg-offset-1">
                        <?=__('No .. associated to this', ['', __('url'), 'ce '.__('employee')])?>
                    </div>
                <?php } ?>
            </div>
        </div>
        <hr>
        <div class="col-lg-offset-1">
            <div class="col-md-12 col-sm-12">
                <h3><?=__('Criterions')?></h3>
                <hr>
                <?php if(!empty($user->criterions)){ ?>
                <div class="col-lg-offset-1">
                    <table class="table table-bordered">
                        <tr>
                            <td><?=__('Name')?></td>
                            <td><?=__('Content')?></td>
                            <td><?=__('Percent')?></td>
                        </tr>
                        <?php
                            foreach ($user->criterions as $key => $criterion) {
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
                        <?=__('No .. associated to this', ['', __('criterion'), 'ce '.__('employee')])?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
