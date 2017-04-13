<div class="row-fluid">
    <div class="col-md-12">
        <?= $this->Form->create($project, ['id' => 'project_edit', 'enctype' => 'multipart/form-data']) ?>
        
            <legend>
                <?= __('Edit Project') ?>
                <div class="pull-right">
                    <?= $this->Html->link(__('<i class="fa fa-list-ul" aria-hidden="true"></i>'), ['action' => 'index'], ['escape' => false]) ?>
                </div>
            </legend>

            <div class="bs-example bs-example-tabs" data-example-id="togglable-tabs"> 
                <ul class="nav nav-tabs" id="myTabs" role="tablist"> 
                    <li role="presentation" class="active">
                        <a href="#project" id="project-tab" role="tab" data-toggle="tab" aria-controls="project"><?=__('Project')?></a>
                    </li> 
                    <li role="presentation" class="">
                        <a href="#criterions" role="tab" id="criterions-tab" data-toggle="tab" aria-controls="criterions"><?=__('Criterions')?></a>
                    </li>
                 </ul> 
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade active in" role="tabpanel" id="project" aria-labelledby="project-tab"> 

                        <div class="form-group">
                            <?= $this->Form->input('name', ['label' => __('Name'), 'class' => 'form-control']); ?><br>

                                    <div class="row">
                                        <div class='col-md-offset-1'>
                                            <div class='col-sm-6 col-md-5'>
                                                <div class="form-group">
                                                    <?=$this->Form->label('dateBegin', __('Date Begin'));?>
                                                    <div class='input-group date' id='datetimepickerBg'>
                                                        <?= $this->Form->input('dateBegin', ['label' => false, 'type' => 'text', 'class' => 'form-control']); ?>
                                                        <span class="input-group-addon">
                                                            <span class="glyphicon glyphicon-calendar"></span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class='col-sm-6 col-md-5'>
                                                <div class="form-group">
                                                    <?=$this->Form->label('dateBegin', __('Date End'));?>
                                                    <div class='input-group date' id='datetimepickerEnd'>
                                                        <?= $this->Form->input('dateEnd', ['label' => false, 'type' => 'text', 'class' => 'form-control']); ?>
                                                        <span class="input-group-addon">
                                                            <span class="glyphicon glyphicon-calendar"></span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                            <?php
                                echo $this->Form->input('project_stage_id', ['label' => __('Stages'), 'options' => $stages, 'empty' => true, 'class' => 'form-control']);
                                echo $this->Form->input('priority_id', ['label' => __('Priorities'), 'options' => $priorities, 'empty' => true, 'class' => 'form-control']);
                                echo $this->Form->input('clients._ids', ['label' => __('Clients'), 'options' => $clients, 'multiple' => 'multiple', 'class' => 'form-control']);
                            ?>
                            <div class="row margintop20px">
                                <div class="col-sm-12 col-md-6"><?=$this->Form->input('teams._ids', ['label' => __('Teams'), 'options' => $teams, 'multiple' => 'multiple', 'class' => 'form-control']);?></div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <?=$this->Form->label('employees[]', __('Employees'));?>
                                        </div>

                                        <div id="warning-noemployees" class="col-md-8 col-md-offset-2 col-sm-12 col-xs-12 alert alert-warning margintop2px" role="alert">
                                            <i class="fa fa-check-circle" aria-hidden="true"></i>
                                            <span><?=__('No .. selected', ['e', __('team')]);?></span>
                                        </div>

                                        <table id="employees_table" class="table table-bordered table-hover">
                                            <tr class="active">
                                                <th><?=__('Choose')?></th>
                                                <th><?=__('Name')?></th>
                                                <th><?=__('ProjectManager')?></th>
                                                <th><?=__('Percent')?></th>
                                            </tr>
                                            <?php
                                                foreach ($employees as $key => $employee) {
                                                    if(in_array($key, $employees_thisproject)){
                                                        $checked = true;
                                                        //echo 'true';
                                                        $time_dedicated = $time_dedicated_byIds[$key];
                                                    }else{
                                                        $checked = false;
                                                        $time_dedicated = '';
                                                    }
                                                    $radio_selected = ($projectManager_id == $key) ? 'checked' : '';
                                            ?>
                                                    <tr id="tr-<?=$key?>" class="hidden">
                                                            <td>
                                                                <?=$this->Form->checkbox('employees[]', ['data-employee' => $key, 'checked' => $checked, 'value' => $key, 'hiddenField' => false]) ?>
                                                            </td>
                                                            <td><?=$employee?></td>
                                                            <td>
                                                                <?= $this->Form->radio('chefproject', [['value' => $key, 'text' => '', 'checked' => $radio_selected]], ['hiddenField' => false]) ?>
                                                            </td>
                                                            <td>
                                                                <div class="input-group margin-bottom-sm">
                                                                    <span class="input-group-addon"><i class="fa fa-percent fa-fw"></i></span>
                                                                    <?= $this->Form->input('time_dedicated', ['id' => 'time-dedicated-'.$key, 'name' => 'time-dedicated-'.$key, 'value' => $time_dedicated, 'type' => 'number', 'min' => 0, 'max' => 100, 'data-time-dedicated' => $key, 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'form-control display-inlineblock width-60per', 'disabled' => !$checked, 'placeholder' => "%"]) ?>
                                                                </div>
                                                                <!--?=$this->Form->input('time_dedicated', ['id' => 'time-dedicated-'.$key, 'name' => 'time-dedicated-'.$key, 'value' => $time_dedicated, 'type' => 'number', 'min' => 0, 'max' => 100, 'data-time-dedicated' => $key, 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'form-control display-inlineblock width-60per', 'disabled' => true, 'placeholder' => "%"])?-->
                                                            </td>
                                                        </tr>
                                            <?php } ?>
                                        </table>
                                        <div class="margintop2px">
                                            <?= $this->Form->button(__('display all the', [__('employees')]), ['id' => 'autreEmployees', 'title' => __('display all employees of teams', [__('employees'), __('teams'), 'e']),'type' => 'button', 'class' => 'btn btn-default']) ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row margintop40px marginbottom15px">
                                <div class="row">
                                    <div class="col-xs-12 col-md-2"><?=$this->Form->label('accomplishment', __('Accomplissement'))?></div>
                                    <div class="col-xs-12 col-md-10 margintop6px"><?=$this->Form->input('accomplishment', ['id' => 'rangeinput', 'type' => 'text', 'templates' => ['inputContainer' => '<div class="">{{content}}</div>'], 'class' => 'range-example-input', 'label' => false])?></div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-md-6"><?=$this->Form->input('description', ['label' => __('Description'), 'class' => 'form-control'])?></div>
                                    <div class="col-xs-12 col-md-6"><?=$this->Form->input('objective', ['label' => __('Objective'), 'class' => 'form-control'])?></div>
                                </div>
                                <!--DELETE FILES-->
                                <?=$this->Form->input('path_dir', ['id' => 'path_dir', 'type' => 'hidden', 'value' => $project->path_dir]);?>
                                <div class="row margintop20px">
                                    <?php if(!empty($files)){ ?>
                                    <div class="row">
                                            <?php
                                                foreach ($files as $key => $file){
                                            ?>
                                                    <div class="col-xs-12 col-sm-8 col-sm-offset-2">
                                                        <div class="alert alert-info">
                                                            <div class="row">
                                                                <!--div class="col-xs-8"></?=(strlen($files[$key]) > 50) ? substr($files[$key], 0, 50).'...' : $files[$key]?></div-->
                                                                <div class="col-xs-8"><?=$file?></div>
                                                                <div class="col-xs-4"><a id="delete-file-<?=$key?>" class="btn btn-danger pull-right" data-file="<?php echo $file ?>"><?=__('Delete')?></a></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                            <?php
                                                }
                                            ?>
                                    </div>
                                    <?php }else{ ?>
                                        <div class="col-sm-12 col-md-8 col-md-offset-2 alert alert-warning">
                                            <?=__('no x are available', ['', 'document'])?>
                                        </div>
                                    <?php } ?>  
                                </div>
                                <div class="row">
                                    <?=$this->Form->input('path_doc', ['label' => __('Documents'), 'name' => 'path_doc[]', 'id' => 'filer_input', 'type' => 'file', 'class' => 'form-control', 'multiple' => 'multiple']);?>
                                </div>
                            <?php
                                //echo $this->Form->input('accomplishment', ['label' => __('Accomplissement'), 'class' => 'form-control']);
                                //echo $this->Form->label('accomplishment', __('Accomplissement'));
                                //echo $this->Form->input('accomplishment', ['id' => 'rangeinput', 'type' => 'text', 'templates' => ['inputContainer' => '<div class="margintop40px marginbottom15px">{{content}}</div>'], 'class' => 'range-example-input', 'label' => false]);
                                //echo $this->Form->input('description', ['label' => __('Description'), 'class' => 'form-control']);
                                //echo $this->Form->input('objective', ['label' => __('Objective'), 'class' => 'form-control']);
                                //echo $this->Form->input('path_doc', ['type' => 'file', 'label' => 'Documents', 'class' => 'form-control']);
                                //echo $this->Form->input('path_doc', ['label' => __('Documents'), 'name' => 'path_doc[]', 'id' => 'filer_input', 'type' => 'file', 'class' => 'form-control', 'multiple' => 'multiple']);
                            ?>
                                
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" role="tabpanel" id="criterions" aria-labelledby="criterions-tab">
                        <div class="form-group">
                            <?php 
                                if(!empty($criterions->toArray())){
                                    foreach ($criterions as $key => $criterion) {
                                        if(isset($content_byIds[$key])){
                                            $value = $content_byIds[$key];
                                            $percent = $percent_byIds[$key];
                                        }else{
                                            $value = null;
                                            $percent = null;
                                        }
                                        echo $this->Form->label('criterions['.$key.']', $criterion);
                                        echo $this->Form->input('criterions['.$key.']', ['label' => false, 'value' => $value, 'class' => 'form-control']);
                                        //echo $this->Form->input('criterions_percent['.$key.']', ['label' => false, 'value' => $percent, 'type' => 'number', 'max' => '100', 'min' => '0', 'class' => 'form-control width-5per']);
                                        echo $this->Form->input('criterions_percent['.$key.']', ['id' => 'rangeinput-'.$key, 'type' => 'text', 'value' => $percent, 'templates' => ['inputContainer' => '<div class="margintop40px marginbottom15px">{{content}}</div>'], 'class' => 'range-example-input', 'label' => false]);
                                    }
                                }else{
                            ?>
                                    <div class="col-md-8 col-md-offset-2 col-sm-12 col-xs-12 alert alert-info margintop20px" role="alert">
                                        <i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                                        <span class="sr-only"><?=__('Info');?> :</span>
                                        <?= __('No .. associated to this', ['', __('criterion'), 'ce '.__('projet')]) ?>
                                    </div>
                            <?php
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary marginbottom10px']) ?>
        <?= $this->Form->end() ?>
    </div>
</div>

<?php
    //Range input
    $this->Html->css('../js/rangeSliderPluginAsRange/dist/css/asRange.min.css', ['block' => true]);
    $this->Html->script('rangeSliderPluginAsRange/dist/jquery-asRange.min.js', ['block' => true]);
    
    $this->Html->css('../js/jQuery.filer-1.3.0/css/jquery.filer.css', ['block' => true]);
    $this->Html->css('../js/jQuery.filer-1.3.0/css/themes/jquery.filer-dragdropbox-theme.css', ['block' => true]);
    $this->Html->script('jQuery.filer-1.3.0/js/jquery.filer.min.js', ['block' => true]);
    //Bootstrap datetimepicker
    $this->Html->script('moment.min.js', ['block' => true]);
    $this->Html->script('bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js', ['block' => true]);
    $this->Html->css('../js/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css', ['block' => true]);
    
    $this->Html->scriptStart(['block' => true]);
        //echo "root ='".ROOT."';";
        echo "var DOSSIER_RACINE = '".DOSSIER_RACINE."';";
        //echo "var root = 'C:/xampp/htdocs/reporting/';";
        echo "usersbyteam = ".json_encode($usersbyteam).";";
        echo "initializeEditProjectPage(usersbyteam, DOSSIER_RACINE);";
    $this->Html->scriptEnd();
?>
