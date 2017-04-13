<div class="row-fluid">
    <div class="col-md-12">
        <?= $this->Form->create($departement) ?>
        <fieldset>
            <legend>
                <?= __('Edit Departement') ?>
                <div class="pull-right">
                    <?= $this->Html->link(__('<i class="fa fa-list-ul" aria-hidden="true"></i>'), ['action' => 'index'], ['escape' => false]) ?>
                </div>
            </legend>
            <div class="bs-example bs-example-tabs" data-example-id="togglable-tabs"> 
                <ul class="nav nav-tabs" id="myTabs" role="tablist"> 
                    <li role="presentation" class="active">
                        <a href="#departement" id="departement-tab" role="tab" data-toggle="tab" aria-controls="departement"><?=__('Departement')?></a>
                    </li> 
                    <li role="presentation" class="">
                        <a href="#criterions" role="tab" id="criterions-tab" data-toggle="tab" aria-controls="criterions"><?=__('Criterions')?></a>
                    </li>
                 </ul> 
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade active in" role="tabpanel" id="departement" aria-labelledby="departement-tab"> 

                        <div class="form-group">
                            <?php
                                echo $this->Form->input('name', ['label' => __('Name'), 'class' => 'form-control']);
                                echo $this->Form->input('company_id', ['label' => __('Company'), 'options' => $companies, 'empty' => true, 'class' => 'form-control']);
                                echo $this->Form->input('description', ['label' => __('Description'), 'class' => 'form-control']);
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
                                        echo $this->Form->input('criterions_percent['.$key.']', ['id' => 'rangeinput-'.$key, 'type' => 'text', 'templates' => ['inputContainer' => '<div class="margintop40px marginbottom15px">{{content}}</div>'], 'class' => 'range-example-input', 'label' => false]);
                                    }
                                }else{
                            ?>
                                    <div class="col-md-8 col-md-offset-2 col-sm-12 col-xs-12 alert alert-info margintop20px" role="alert">
                                        <i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                                        <span class="sr-only"><?=__('Info');?> :</span>
                                        <?= __('No .. associated to this', ['', __('criterion'), 'ce '.__('departement')]) ?>
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
    
    $this->Html->scriptStart(['block' => true]);
        echo "initializeEditDepartementPage();";
    $this->Html->scriptEnd();
?>
