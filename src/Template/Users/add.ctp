<div class="row-fluid">
    <div class="col-md-12">
        <?= $this->Form->create($user, ['enctype' => 'multipart/form-data']) ?>
        <fieldset>
            <legend>
                <?= __('Add Employee') ?>
                <div class="pull-right">
                    <?= $this->Html->link(__('<i class="fa fa-list-ul" aria-hidden="true"></i>'), ['action' => 'index'], ['escape' => false]) ?>
                </div>
            </legend>

            <div class="bs-example bs-example-tabs" data-example-id="togglable-tabs"> 
                <ul class="nav nav-tabs" id="myTabs" role="tablist"> 
                    <li role="presentation" class="active">
                        <a href="#user" id="user-tab" role="tab" data-toggle="tab" aria-controls="user"><?=__('Employee')?></a>
                    </li> 
                    <li role="presentation" class="">
                        <a href="#criterions" role="tab" id="criterions-tab" data-toggle="tab" aria-controls="criterions"><?=__('Criterions')?></a>
                    </li>
                    <!--li role="presentation" class="">
                        <a href="#accessRight" role="tab" id="accessRight-tab" data-toggle="tab" aria-controls="accessRight"></?=__('Access Right')?></a>
                    </li-->
                 </ul> 
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade active in" role="tabpanel" id="user" aria-labelledby="user-tab"> 

                        <div class="form-group">
                            <?php
                                echo $this->Form->input('name', ['label' => __('name'), 'class' => 'form-control']);
                                echo $this->Form->input('lastName', ['label' => __('lastName'), 'class' => 'form-control']);
                                echo $this->Form->input('password', ['label' => __('Password'), 'class' => 'form-control']);
                                echo $this->Form->input('email', ['label' => __('Email'), 'class' => 'form-control']);
                                //echo $this->Form->input('type', ['options' => $type, 'class' => 'form-control']);
                                //echo $this->Form->input('projects._ids', ['options' => $projects, 'empty' => true, 'multiple' => 'multiple']);
                                echo $this->Form->input('teams._ids', ['label' => __('Teams'), 'options' => $teams, 'empty' => false, 'multiple' => 'multiple', 'class' => 'form-control']);
                                echo $this->Form->input('description', ['label' => __('Description'), 'class' => 'form-control']);
                                echo $this->Form->input('image', ['id' => 'filer_input', 'type' => 'file', 'label' => __('Image'), 'class' => 'form-control']);
                            ?>
                        </div>
                    </div>

                    <div class="tab-pane fade" role="tabpanel" id="criterions" aria-labelledby="criterions-tab">
                        <div class="form-group">
                            <?php 
                                if(!empty($criterions->toArray())){
                                    foreach ($criterions as $key => $criterion) {
                                        echo $this->Form->label('criterions['.$key.']', $criterion);
                                        echo $this->Form->input('criterions['.$key.']', ['label' => false, 'class' => 'form-control']);
                                        //echo $this->Form->input('criterions_percent['.$key.']', ['label' => false, 'type' => 'number', 'max' => '100', 'min' => '0', 'class' => 'form-control width-5per']);
                                        echo $this->Form->input('criterions_percent['.$key.']', ['id' => 'rangeinput-'.$key, 'type' => 'text', 'templates' => ['inputContainer' => '<div class="margintop40px marginbottom15px">{{content}}</div>'], 'class' => 'range-example-input', 'label' => false]);
                                    }
                                }else{
                            ?>
                                    <div class="col-md-8 col-md-offset-2 col-sm-12 col-xs-12 alert alert-info margintop20px" role="alert">
                                        <i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                                        <span class="sr-only"><?=__('Info');?> :</span>
                                        <?= __('No .. associated to this', ['', __('criterion'), 'ce '.__('employee')]) ?>
                                    </div>
                            <?php
                                }
                            ?>
                        </div>
                    </div>
                    <!--
                    <div class="tab-pane fade" role="tabpanel" id="accessRight" aria-labelledby="accessRight-tab">
                        <div class="form-group">
                            <?php
                                /*
                                echo $this->Form->label(__('Criterions'));
                                echo $this->Form->input('criterions_rights', ['type' => 'checkbox', 'data-toggle' => 'toggle', 'label' => false, 'class' => 'form-control']);
                                
                                echo $this->Form->label(__('Priorities'));
                                echo $this->Form->input('priorities_rights', ['type' => 'checkbox', 'data-toggle' => 'toggle', 'label' => false, 'class' => 'form-control']);
                                
                                echo $this->Form->label(__('Stages'));
                                echo $this->Form->input('stages_rights', ['type' => 'checkbox', 'data-toggle' => 'toggle', 'label' => false, 'class' => 'form-control']);
                                
                                echo $this->Form->label(__('Clients'));
                                echo $this->Form->input('clients_rights', ['type' => 'checkbox', 'data-toggle' => 'toggle', 'label' => false, 'class' => 'form-control']);
                                */
                            ?>
                        </div>
                    </div>
                    -->
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
    
    $this->Html->css('../js/jQuery.filer-1.3.0/css/jquery.filer.css', ['block' => true]);
    $this->Html->css('../js/jQuery.filer-1.3.0/css/themes/jquery.filer-dragdropbox-theme.css', ['block' => true]);
    $this->Html->script('jQuery.filer-1.3.0/js/jquery.filer.min.js', ['block' => true]);
    
    $this->Html->css('bootstrap-toggle/bootstrap-toggle.min.css', ['block' => true]);
    $this->Html->script('../css/bootstrap-toggle/bootstrap-toggle.min.js', ['block' => true]);
    
    $this->Html->scriptStart(['block' => true]);
        echo "initializeAddUserPage();";
    $this->Html->scriptEnd();
?>
