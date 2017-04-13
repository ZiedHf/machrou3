<div class="row-fluid">
    <div class="col-md-12">
            <?= $this->Form->create($project, ['id' => 'project_add', 'enctype' => 'multipart/form-data']) ?>
            <fieldset>
                <legend>
                    <?= __('Add Project') ?>
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
                                            <div class='col-md-6 col-md-5'>
                                                <div class="form-group">
                                                    <?=$this->Form->label('dateEnd', __('Date End'));?>
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
                                    <div class="col-sm-12 col-md-6"><?= $this->Form->input('teams._ids', ['label' => __('Teams'), 'options' => $teams, 'multiple' => 'multiple', 'class' => 'form-control']) ?></div>
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
                                                    <?php foreach ($employees as $key => $employee) { ?>
                                                        <tr id="tr-<?=$key?>" class="hidden">
                                                            <td>
                                                                <?= $this->Form->checkbox('employees[]', ['data-employee' => $key, 'checked' => false, 'value' => $key, 'hiddenField' => false]) ?>
                                                            </td> 
                                                            <td><?=$employee?></td>
                                                            <td>
                                                                <?= $this->Form->radio('chefproject', [['value' => $key, 'text' => '']], ['hiddenField' => false]) ?>
                                                            </td>
                                                            <td>
                                                                <div class="input-group margin-bottom-sm">
                                                                    <span class="input-group-addon"><i class="fa fa-percent fa-fw"></i></span>
                                                                    <?= $this->Form->input('time_dedicated', ['id' => 'time-dedicated-'.$key, 'name' => 'time-dedicated-'.$key, 'type' => 'number', 'min' => 0, 'max' => 100, 'data-time-dedicated' => $key, 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'form-control display-inlineblock width-60per', 'disabled' => true, 'placeholder' => "%"]) ?>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>
                                                </table>
                                            </div>
                                        </div>

                                </div>
                                
                                <div class="row margintop40px marginbottom15px">
                                    <div class="row">
                                        <div class="col-xs-12 col-md-2"><?=$this->Form->label('accomplishment', __('Accomplissement'))?></div>
                                        <div class="col-xs-12 col-md-10 margintop6px"><?=$this->Form->input('accomplishment', ['id' => 'rangeinput', 'type' => 'text', 'templates' => ['inputContainer' => '<div class="marginbottom15px">{{content}}</div>'], 'class' => 'range-example-input', 'label' => false])?></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12 col-md-6"><?=$this->Form->input('description', ['label' => __('Description'), 'class' => 'form-control'])?></div>
                                        <div class="col-xs-12 col-md-6"><?=$this->Form->input('objective', ['label' => __('Objective'), 'class' => 'form-control'])?></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12"><?=$this->Form->input('path_doc', ['label' => __('Documents'), 'name' => 'path_doc[]', 'id' => 'filer_input', 'type' => 'file', 'class' => 'form-control', 'multiple' => 'multiple'])?></div>
                                    </div>
                                </div>
                                <!--div class="row">
                                    <div class="col-xs-12">
                                    <?php
                                        /*echo $this->Form->input('description', ['label' => __('Description'), 'class' => 'form-control']);
                                        echo $this->Form->input('objective', ['label' => __('Objective'), 'class' => 'form-control']);
                                        //echo $this->Form->input('accomplishment', ['label' => __('Accomplishment'), 'class' => 'form-control', 'min' => 0, 'max' => 100]);
                                        //<input id="ex1" data-slider-id='ex1Slider' type="text" data-slider-min="0" data-slider-max="20" data-slider-step="1" data-slider-value="14"/>
                                        //echo $this->Form->label('accomplishment', __('Accomplishment'), ['class' => 'marginbottom15px']);
                                        echo $this->Form->input('accomplishment', ['id' => 'rangeinput', 'type' => 'text', 'templates' => ['inputContainer' => '<div class="margintop40px marginbottom15px">{{content}}</div>'], 'class' => 'range-example-input', 'label' => false]);
                                        
                                        echo $this->Form->datetime('dataBegin', ['label' => 'Date de début', 'default' => time(),
                                                                                'year' => [
                                                                                    'class' => 'width-5per display-inline form-control',
                                                                                ],
                                                                                'month' => [
                                                                                    'class' => 'width-5per display-inline form-control ',
                                                                                    'data-type' => 'month'
                                                                                ],
                                                                                'day' => [
                                                                                    'class' => 'width-5per display-inline form-control',
                                                                                    'data-type' => 'day',
                                                                                ],
                                                                                'hour' => [
                                                                                    'class' => 'width-5per display-inline form-control',
                                                                                    'data-type' => 'hour',
                                                                                ],
                                                                                'minute' => [
                                                                                    'class' => 'width-5per display-inline form-control',
                                                                                    'data-type' => 'minute',
                                                                                ]
                                                                            ]);
                                         */
                                        //echo $this->Form->input('path_doc', ['label' => __('Documents'), 'name' => 'path_doc[]', 'id' => 'filer_input', 'type' => 'file', 'class' => 'form-control', 'multiple' => 'multiple']);
                                    ?>
                                    </div>
                                </div-->
                            </div>

                        </div>


                        <div class="tab-pane fade" role="tabpanel" id="criterions" aria-labelledby="criterions-tab">
                            <?php 
                                if(!empty($criterions->toArray())){
                                    foreach ($criterions as $key => $criterion) {
                                        echo $this->Form->label('criterions['.$key.']', $criterion);
                                        echo $this->Form->input('criterions['.$key.']', ['label' => false, 'class' => 'form-control']);
                                        //echo $this->Form->input('criterions_percent['.$key.']', ['label' => false, 'type' => 'number', 'max' => '100', 'min' => '0', 'class' => 'form-control width-5per']);
                                        //echo $this->Form->label('accomplishment', __('Accomplishment'), ['class' => 'marginbottom15px']);
                                        echo $this->Form->input('criterions_percent['.$key.']', ['id' => 'rangeinput-'.$key, 'type' => 'text', 'templates' => ['inputContainer' => '<div class="margintop40px marginbottom15px">{{content}}</div>'], 'class' => 'range-example-input', 'label' => false]);
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
            </fieldset>
            <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary marginbottom10px']) ?>
            <?= $this->Form->end() ?>
    </div>
</div>
<?php
    //range input
    $this->Html->css('../js/rangeSliderPluginAsRange/dist/css/asRange.min.css', ['block' => true]);
    $this->Html->script('rangeSliderPluginAsRange/dist/jquery-asRange.min.js', ['block' => true]);
    //$this->Html->script('rangeSliderPluginAsRange/dist/jquery-asRange.es.js', ['block' => true]);
    
    $this->Html->css('../js/jQuery.filer-1.3.0/css/jquery.filer.css', ['block' => true]);
    $this->Html->css('../js/jQuery.filer-1.3.0/css/themes/jquery.filer-dragdropbox-theme.css', ['block' => true]);
    $this->Html->script('jQuery.filer-1.3.0/js/jquery.filer.min.js', ['block' => true]);
    //Bootstrap datetimepicker
    $this->Html->script('moment.min.js', ['block' => true]);
    $this->Html->script('bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js', ['block' => true]);
    $this->Html->css('../js/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css', ['block' => true]);
    /*$this->Html->css('http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css', ['block' => true]);
    $this->Html->css('../js/timepicker/dist/jquery-ui-timepicker-addon.css', ['block' => true]);
    $this->Html->script('timepicker/dist/jquery-ui-timepicker-addon.js', ['block' => true]);*/
    
    $this->Html->scriptStart(['block' => true]);
        echo "usersbyteam = ".json_encode($usersbyteam).";";
        echo "initializeAddProjectPage(usersbyteam);";
    $this->Html->scriptEnd();
?>
