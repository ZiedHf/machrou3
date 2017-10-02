<?php //debug($projects); die(); ?>
<table class="table_sorter table table-bordered row-border hover order-column" data-products="projectsTable">
    <thead>
        <tr>
            <th><?=__('Project name')?></th>
            <th><?=__('Accomplishment')?></th>
            <th><?=__('Priority')?></th>
            <th><?=__('Stage')?></th>
            <?php if(!empty($projects[0]->teams)){ ?><th><?=__('Équipe')?></th><?php } ?>
            <th><?=__('More info')?></th>
            <th><?=__('Documents')?></th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th><?=__('Project name')?></th>
            <th><?=__('Accomplishment')?></th>
            <th><?=__('Priority')?></th>
            <th><?=__('Stage')?></th>
            <?php if(!empty($projects[0]->teams)){ ?><th><?=__('Équipe')?></th><?php } ?>
            <th><?=__('More info')?></th>
            <th><?=__('Documents')?></th>
        </tr>
        <tr class="tablesorter-ignoreRow">
          <th colspan="<?= (!empty($projects[0]->teams)) ? "7" : "6" ?>" class="ts-pager form-horizontal">
            <button type="button" class="btn first"><i class="small material-icons">first_page</i></button>
            <button type="button" class="btn prev"><i class="small material-icons">navigate_before</i></button>
            <span class="pagedisplay"></span>
            <!-- this can be any element, including an input -->
            <button type="button" class="btn next"><i class="small material-icons">navigate_next</i></button>
            <button type="button" class="btn last"><i class="small material-icons">last_page</i></button>
            <select class="pagesize browser-default" title="Select page size">
              <option selected="selected" value="10">10</option>
              <option value="20">20</option>
              <option value="30">30</option>
              <option value="40">40</option>
            </select>
            <select class="pagenum browser-default" title="Select page number"></select>
          </th>
        </tr>
    </tfoot>
    <tbody>
    <?php foreach ($projects as $key => $project) { ?>
    <tr>
        <td><?=$this->Html->link($project->name, ['controller' => 'consult', 'action' => $action, (isset($departement_id)) ? $departement_id : $project->teams[0]->departement_id, $project->id])?></td>
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
        <td><?=(empty($project->priority)) ? '-' : $project->priority->name?></td>
        <td><?=(empty($project->project_stage)) ? '-' : $project->project_stage->name?></td>
        <?php if(!empty($project->teams)){ ?>
            <td>
                <?php
                    $lastElement = end($project->teams);
                    foreach ($project->teams as $key => $team) {
                        echo $this->Html->link($team->name, ['controller' => 'Consult', 'action' => 'viewTeamInfo', $team->id]).($team === $lastElement ? '.' : ', ');
                    }
                ?>
            </td>
        <?php } ?>

        <td>
            <?php
                $info = "";
                if(((!isset($project->description))||($project->description ===""))&&(empty($project->users))){
                    $disabled = "disabled";
                }else{
                    $disabled="enable";
                    if(!empty($project->description)) {$info .= '<u><b>'.__('Description').' :</b></u><p>'.$project->description.'</p>';}
                    if(!empty($project->users)){
                        $info .= '<u><b>'.__('Employees list').' :</b></u> <ul>';
                        foreach($project->users as $key => $employee){
                            if(empty($employee['_joinData']['time_dedicated'])){
                                $time_dedicated = '-';
                            }else{
                                $time_dedicated = $employee['_joinData']['time_dedicated'].'%';
                            }
                            $info .= '<li>'.$employee['name'].' '.$employee['lastName'].' : '.$time_dedicated.'</li>';
                        }
                        $info .= '</ul>';
                    }
                }
            ?>

            <a class="btn tooltipped <?=$disabled?>" data-position="bottom" data-delay="50" data-html="true" data-tooltip="<?=$info?>">
              <i class="large material-icons">more_horiz</i>
            </a>

            <!--a tabindex="0" class="btn btn-default no-padding" role="button" data-toggle="popover" data-html='true' data-trigger="focus" title="</?=__('More info')?> :" data-content="</?=$info?>" </?=$disabled?>>
                <span class="fa-stack">
                    <i class="fa fa-info-circle fa-stack-2x"></i>
                    </?=($disabled == "disabled") ? '<i class="fa fa-ban fa-stack-2x text-danger"></i>' : ""?>
                </span>
            </a-->
        </td>
        <td>
            <?php
                //scan directory and get all files
                $project_id = $project->id;
                if(isset($files[$project_id])){
                    echo '<ul class="liststyle">';
                    foreach($files[$project_id] as $keyFiles => $file){
                        echo "<li>";
                        echo $this->Html->link('<i class="small material-icons">file_download</i> '.$file, ['controller' => 'Projects', 'action' => 'viewDoc', '_full' => true, $project->id, $file], ['escape' => false]);
                        echo '</li>';
                    }
                    echo '</ul>';
                }else{
                    echo '-';
                }
            ?>
        </td>
    </tr>
    <?php } ?>
    </tbody>
</table>
