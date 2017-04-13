<div class="row-fluid">
    <div class="col-md-12">
        <?= $this->Form->create($member, ['enctype' => 'multipart/form-data']) ?>
        
        <legend>
            <?= __('Add Member') ?>
            <div class="pull-right">
                <?= $this->Html->link(__('<i class="fa fa-list-ul" aria-hidden="true"></i>'), ['action' => 'index'], ['escape' => false]) ?>
            </div>
        </legend>
        
        <div class="bs-example bs-example-tabs" data-example-id="togglable-tabs"> 
                <ul class="nav nav-tabs" id="myTabs" role="tablist"> 
                    <li role="presentation" class="active">
                        <a href="#member" id="user-tab" role="tab" data-toggle="tab" aria-controls="user"><?=__('Members')?></a>
                    </li> 
                    <li role="presentation" class="">
                        <a href="#accessRights" role="tab" id="criterions-tab" data-toggle="tab" aria-controls="criterions"><?=__('Access Rights')?></a>
                    </li>
                 </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade active in" role="tabpanel" id="member" aria-labelledby="member-tab"> 
                        <div class="form-group">
                            <?php
                                echo $this->Form->input('name', ['label' => __('name'), 'class' => 'form-control']);
                                echo $this->Form->input('lastName', ['label' => __('lastName'), 'class' => 'form-control']);
                                echo $this->Form->input('password', ['label' => __('Password'), 'class' => 'form-control']);
                                echo $this->Form->input('email', ['label' => __('Email'), 'class' => 'form-control']);
                                echo $this->Form->input('description', ['label' => __('description'), 'class' => 'form-control']);
                                echo $this->Form->input('path_image');
                            ?>
                        </div>
                    </div>
                
                    <div class="tab-pane fade" role="tabpanel" id="accessRights" aria-labelledby="accessRights-tab">
                        <div class="form-group">
                            <?php
                                echo $this->Form->label(__('Criterions'));
                                echo $this->Form->input('criterions_rights', ['type' => 'checkbox', 'data-toggle' => 'toggle', 'label' => false, 'class' => 'form-control']);
                                
                                echo $this->Form->label(__('Priorities'));
                                echo $this->Form->input('priorities_rights', ['type' => 'checkbox', 'data-toggle' => 'toggle', 'label' => false, 'class' => 'form-control']);
                                
                                echo $this->Form->label(__('Stages'));
                                echo $this->Form->input('stages_rights', ['type' => 'checkbox', 'data-toggle' => 'toggle', 'label' => false, 'class' => 'form-control']);
                                
                                echo $this->Form->label(__('Clients'));
                                echo $this->Form->input('clients_rights', ['type' => 'checkbox', 'data-toggle' => 'toggle', 'label' => false, 'class' => 'form-control']);
                            ?>
                        </div>
                    </div>
                </div>
        
        
        <?= $this->Form->button(__('Submit')) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
    
<?php
    
    $this->Html->css('bootstrap-toggle/bootstrap-toggle.min.css', ['block' => true]);
    $this->Html->script('../css/bootstrap-toggle/bootstrap-toggle.min.js', ['block' => true]);
    
    $this->Html->scriptStart(['block' => true]);
        //echo "initializeAddUserPage();";
    $this->Html->scriptEnd();
?>
