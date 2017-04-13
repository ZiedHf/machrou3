<!--
$project ==> les info d'un projet
$files ==> Les noms des fichiers
$images ==> Les noms des images
-->
<div class="row">
    <div class="col-md-12 col-sm-12">
        <h2>Projet : <?=$project->name?></h2>
        <hr>
        <div class="col-lg-offset-1">
            <table class="table table-bordered">
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
                            <div class="progress-bar" role="progressbar" aria-valuenow="<?=($project->accomplishment > 10) ? $project->accomplishment : 10?>" aria-valuemin="0" aria-valuemax="<?=($project->accomplishment > 10) ? $project->accomplishment : 10?>" style="min-width: 10%; width: <?=$project->accomplishment?>%;">
                              <?=$project->accomplishment?>%
                            </div>
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

<div class="row">
    <div class="col-md-12 col-sm-12">
        <h3><?=__('Employees')?></h3>
        <hr>
        <?php if(!empty($project->users)){ ?>
        <div class="col-lg-offset-1">
            <table class="table table-bordered">
                <tr>
                    <td><?=__('Name')?></td>
                    <td><?=__('Time dedicated')?></td>
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
        </div>
        <?php }else{ ?>
            <div class="col-lg-offset-1">
                <?=__('No employee associated', ['', __('employee')])?>
            </div>
        <?php } ?>
    </div>
</div>

<div class="row">
    <div class="col-md-12 col-sm-12">
        <h3><?=__('Urls')?></h3>
        <hr>
        <?php if(!empty($project->project_urls)){ ?>
        <div class="col-lg-offset-1">
            <table class="table table-bordered">
                <tr>
                    <td><?=__('Name')?></td>
                    <td><?=__('Url')?></td>
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
        </div>
        <?php }else{ ?>
            <div class="col-lg-offset-1">
                <?=__('No .. associated to this', ['', __('url'), 'ce '.__('project')])?>
            </div>
        <?php } ?>
    </div>
</div>

<div class="row">
    <div class="col-md-12 col-sm-12">
        <h3><?=__('Criterions')?></h3>
        <hr>
        <?php if(!empty($project->criterions)){ ?>
        <div class="col-lg-offset-1">
            <table class="table table-bordered">
                <tr>
                    <td><?=__('Name')?></td>
                    <td><?=__('Content')?></td>
                    <td><?=__('Percent')?></td>
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
        </div>
        <?php }else{ ?>
            <div class="col-lg-offset-1">
                <?=__('No .. associated to this', ['', __('criterion'), 'ce '.__('project')])?>
            </div>
        <?php } ?>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <h3>Gallery</h3>
        <hr>
        <div class="row">
            <?php 
                if($images !== false) { 
                    foreach ($images as $key => $image) { ?>
                        <div class="col-sm-4 col-xs-12 desc">
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
                                                                                                ['class' => 'img-responsive', 
                                                                                                'style' => '']
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
                    <div class="col-lg-offset-1">
                        <?=__('No attachement', ['e', 'image'])?>
                    </div>
            <?php
                }
            ?>
        </div>
    </div>
</div><!-- /row -->