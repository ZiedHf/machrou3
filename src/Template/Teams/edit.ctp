<div class="row-fluid">
    <div class="col-md-12">
        <?= $this->Form->create($team, ['enctype' => 'multipart/form-data']) ?>
        <fieldset>
            <legend>
                <?= __('Edit Team') ?>
                <div class="pull-right">
                    <?= $this->Html->link(__('<i class="fa fa-list-ul" aria-hidden="true"></i>'), ['action' => 'index'], ['escape' => false]) ?>
                </div>
            </legend>

            <div class="bs-example bs-example-tabs" data-example-id="togglable-tabs"> 
                <ul class="nav nav-tabs" id="myTabs" role="tablist"> 
                    <li role="presentation" class="active">
                        <a href="#team" id="team-tab" role="tab" data-toggle="tab" aria-controls="team"><?=__('Team')?></a>
                    </li> 
                    <li role="presentation" class="">
                        <a href="#criterions" role="tab" id="criterions-tab" data-toggle="tab" aria-controls="criterions"><?=__('Criterions')?></a>
                    </li>
                 </ul> 
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade active in" role="tabpanel" id="team" aria-labelledby="team-tab"> 

                        <div class="form-group">
                            <?php
                                echo $this->Form->input('name', ['label' => __('Name'), 'class' => 'form-control']);
                                echo $this->Form->input('description', ['label' => __('Description'), 'class' => 'form-control']);
                                echo $this->Form->input('departement_id', ['label' => __('Departement'), 'options' => $departements, 'class' => 'form-control']);
                                echo $this->Form->input('users._ids', ['label' => __('Employees'), 'options' => $users, 'empty' => false, 'multiple' => 'multiple', 'class' => 'form-control']);
                                //echo $this->Form->input('projects._ids', ['label' => __('Projects'), 'options' => $projects,  'empty' => false, 'multiple' => 'multiple', 'class' => 'form-control']);
                            ?>
                            <!--DELETE FILES-->
                            <?=$this->Form->input('path_dir', ['id' => 'path_dir', 'type' => 'hidden', 'value' => $team->path_image]);?>
                            <div class="row margintop20px">
                                <?php 
                                    $hidden = '';
                                    if(!empty($files)){ 
                                        $hidden = 'hidden';
                                ?>
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
                            <?php
                                echo $this->Form->input('image', ['label' => __('Image'), 'id' => 'filer_input', 'type' => 'file', 'templates' => ['inputContainer' => '<div id="imageInput" class="'.$hidden.'">{{content}}</div>'], 'style' => 'display: none;', 'class' => 'form-control']);
                            ?>
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
                                        echo $this->Form->input('criterions_percent['.$key.']', ['id' => 'rangeinput-'.$key, 'value' => $percent, 'type' => 'text', 'templates' => ['inputContainer' => '<div class="margintop40px marginbottom15px">{{content}}</div>'], 'class' => 'range-example-input', 'label' => false]);
                                    }
                                }else{
                            ?>
                                    <div class="col-md-8 col-md-offset-2 col-sm-12 col-xs-12 alert alert-info margintop20px" role="alert">
                                        <i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                                        <span class="sr-only"><?=__('Info');?> :</span>
                                        <?= __('No .. associated to this', ['', __('criterion'), 'cette '.__('team')]) ?>
                                    </div>
                            <?php
                                }
                            ?>
                        </div>
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
    
    $this->Html->css('../js/jQuery.filer-1.3.0/css/jquery.filer.css', ['block' => true]);
    $this->Html->css('../js/jQuery.filer-1.3.0/css/themes/jquery.filer-dragdropbox-theme.css', ['block' => true]);
    $this->Html->script('jQuery.filer-1.3.0/js/jquery.filer.min.js', ['block' => true]);
    $this->Html->scriptStart(['block' => true]);
        echo "var DOSSIER_RACINE = '".DOSSIER_RACINE."';";
        echo "initializeEditTeamPage(DOSSIER_RACINE);";
    $this->Html->scriptEnd();
?>
