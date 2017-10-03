<!--
$project ==> les info d'un projet
$files ==> Les noms des fichiers
$images ==> Les noms des images
-->
<div class="row">
    <div class="col s12">
        <h4>Projet : <?=$project->name?></h4>
        <hr>
        <div class="col m11 offset-m1">
            <table class="bordered highlight">
                <tr>
                    <th><?=__('Project name')?> :</th>
                    <td><?=$project->name?></td>
                </tr>
                <tr>
                    <th><?=__('ProjectManager')?> :</th>
                    <td>
                        <?=($projectManager !== null) ? $this->Html->link($projectManager->name.' '.$projectManager->lastName, ['controller' => 'Consult', 'action' => 'viewUserInfo', $projectManager->id]) : '-'?>
                    </td>
                </tr>
                <tr>
                    <th><?=__('Date Begin')?> :</th>
                    <td>
                        <?=($project->dateBegin !== null) ? h($project->dateBegin) : '-'?>
                    </td>
                </tr>
                <tr>
                    <th><?=__('Date End')?> :</th>
                    <td>
                        <?=($project->dateEnd !== null) ? h($project->dateEnd) : '-'?>
                    </td>
                </tr>
                <tr>
                    <th><?=__('Accomplishment')?> :</th>
                    <td>
                        <div class="progress">
                          <div class="determinate" style="width: <?=$project->accomplishment?>%"></div>
                        </div>
                    </td>
                </tr>
                <?php if(!empty($project->teams)){ ?>
                <tr>
                    <th><?=__('Teams')?> :</th>
                    <td>
                        <?php
                            $lastElement = end($project->teams);
                            foreach ($project->teams as $key => $team){
                                echo $this->Html->link($team->name, ['controller' => 'Consult', 'action' => 'viewTeamInfo', $team->id]).($team === $lastElement ? '.' : ', ');
                            }
                        ?>
                    </td>
                </tr>
                <?php } ?>
                <tr>
                    <th><?=__('Priority')?> :</th>
                    <td><?=(!empty($project->priority)) ? $project->priority->name : '-';?></td>
                </tr>
                <tr>
                    <th><?=__('Stage')?> :</th>
                    <td><?=(!empty($project->project_stage)) ? $project->project_stage->name : '-';?></td>
                </tr>
                <tr>
                    <th><?=__('Description')?> :</th>
                    <td><?=(($project->description != Null) && ($project->description !='')) ? $project->description : '-'?></td>
                </tr>
                <tr>
                    <th><?=__('Objective')?> :</th>
                    <td><?=(($project->objective != Null) && ($project->objective !='')) ? $project->objective : '-'?></td>
                </tr>
                <tr>
                    <th><?=__('Documents')?> :</th>
                    <td>
                        <?php
                            //scan directory and get all files
                            $project_id = $project->id;
                            if(!empty($files)){
                                echo '<ul class="liststyle">';
                                foreach($files as $keyFiles => $file){
                                    echo "<li>";
                                    echo $this->Html->link('<i class="fa fa-download iconstyle" aria-hidden="true"></i> '.$file, ['controller' => 'Projects', 'action' => 'viewDoc', '_full' => true, $project->id, $file], ['escape' => false]);
                                    //if($file !== $myLastElement) echo ' || ';
                                    echo '</li>';
                                }
                                echo '</ul>';
                            }else{
                                echo __('No attachement', ['', 'document']);
                                //echo 'aucun document n\'est attaché.';
                            }
                        ?>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>

<hr>

<div class="row">
    <div class="col s12">

        <h4><?=__('Employees')?></h4>

        <div class="col m11 offset-m1">
        <?php if(!empty($project->users)){ ?>

            <table class="bordered highlight">
                <tr>
                    <th><?=__('Name')?></th>
                    <th><?=__('Time dedicated')?></th>
                </tr>
                <?php
                    foreach ($project->users as $key => $employee) {
                        $time_dedicated = $employee['_joinData']->time_dedicated;
                ?>
                <tr>
                    <td><?=$this->Html->link($employee->name.' '.$employee->lastName, ['controller' => 'Consult', 'action' => 'viewUserInfo', $employee->id]);?></td>
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
                </tr>
                <?php } ?>
            </table>

        <?php }else{ ?>
            <div class="card-alert card grey lighten-5 z-depth-2">
                <div class="card-content grey-text">
                    <p><?=__('No employee associated', ['', __('employee')])?></p>
                </div>
            </div>
        <?php } ?>
        </div>
    </div>
</div>

<hr>

<div class="row">
    <div class="col s12">
        <h4><?=__('Urls')?></h4>

        <div class="col m11 offset-m1">
        <?php if(!empty($project->project_urls)){ ?>
            <table class="bordered highlight">
                <tr>
                    <th><?=__('Name')?></th>
                    <th><?=__('Url')?></th>
                </tr>
                <?php
                    foreach ($project->project_urls as $key => $url) {
                ?>
                <tr>
                    <td><?=h($url->name);?></td>
                    <td><?= $this->Html->link(h($url->url), $url->url, ['target' => '_blank']) ?></td>
                </tr>
                <?php } ?>
            </table>

        <?php }else{ ?>
          <div class="card-alert card grey lighten-5 z-depth-2">
              <div class="card-content grey-text">
                  <p><?=__('No .. associated to this', ['', __('url'), 'ce '.__('project')])?></p>
              </div>
          </div>
        <?php } ?>
        </div>
    </div>
</div>

<hr>

<div class="row">
    <div class="col s12">
        <h4><?=__('Criterions')?></h4>

        <div class="col m11 offset-m1">
        <?php if(!empty($project->criterions)){ ?>
            <table class="bordered highlight">
                <tr>
                    <th><?=__('Name')?></th>
                    <th><?=__('Content')?></th>
                    <th><?=__('Percent')?></th>
                </tr>
                <?php
                    foreach ($project->criterions as $key => $criterion) {
                ?>
                <tr>
                    <td><?=h($criterion->name);?></td>
                    <td><?=h($criterion['_joinData']->content);?></td>
                    <td><?=(isset($criterion['_joinData']->percent)) ? h($criterion['_joinData']->percent).'%' : '-';?></td>
                </tr>
                <?php } ?>
            </table>

        <?php }else{ ?>
                <div class="card-alert card grey lighten-5 z-depth-2">
                    <div class="card-content grey-text">
                        <p><?=__('No .. associated to this', ['', __('criterion'), 'ce '.__('project')])?></p>
                    </div>
                </div>
        <?php } ?>
        </div>
    </div>
</div>

<hr>

<div class="row">
    <div class="col s12">
        <h4><?=__('Gallery')?></h4>

        <div class="row">
          <div class="col s12 m11 offset-m1">
            <?php
                if($images !== false) {
                    foreach ($images as $key => $image) { ?>
                        <div class="col s12 m6 desc">
                            <div class="project-wrapper">
                                <div class="project">
                                    <div class="photo-wrapper">
                                        <div class="photo">
                                            <!--a class="fancybox" href="../../../webroot/dashgumfree/assets/img/portfolio/port05.jpg"-->
                                                <?php
                                                    echo $this->Html->link(
                                                                            $this->Html->image(
                                                                                                $this->Url->build(['controller' => 'App',
                                                                                                    'action' => 'viewPic',
                                                                                                    $project->path_dir,
                                                                                                    $image
                                                                                                ], true),
                                                                                                ['class' => 'responsive-img']
                                                                                                ),
                                                                            $this->Url->build(['controller' => 'App',
                                                                                                    'action' => 'viewPic',
                                                                                                    $project->path_dir,
                                                                                                    $image
                                                                                                ], true),
                                                                            ['class' => 'fancybox', 'escape' => false]
                                                                            );
                                                ?>
                                                <!--img class="img-responsive" src="../../../webroot/dashgumfree/assets/img/portfolio/port05.jpg" alt=""-->
                                            <!--/a-->
                                        </div>
                                        <div class="overlay"></div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- col-lg-4 -->
            <?php
                    }
                }else{
            ?>
                    <div class="card-alert card grey lighten-5 z-depth-2">
                        <div class="card-content grey-text">
                            <p><?=__('No attachement', ['e', 'image'])?></p>
                        </div>
                    </div>
            <?php
                }
            ?>
          </div>
        </div>
    </div>
</div><!-- /row -->
