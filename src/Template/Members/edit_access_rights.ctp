<div class="row-fluid">
    <div class="col-md-12">
        <?= $this->Form->create($member) ?>
        <fieldset>
            <legend>
                <?= __('Edit Member') . ':' . __('Access Rights') ?>
                <div class="pull-right">
                    <?= $this->Html->link(__('<i class="fa fa-list-ul" aria-hidden="true"></i>'), ['action' => 'index'], ['escape' => false]) ?>
                </div>
            </legend>

            <div class="tab-content" id="myTabContent">
                        <?php
                            echo $this->Form->input('name', ['label' => __('name'), 'class' => 'form-control', 'readonly' => true]);
                            echo $this->Form->input('lastName', ['label' => __('lastName'), 'class' => 'form-control', 'readonly' => true]);

                            echo $this->Form->label(__('Criterions'));
                            echo $this->Form->input('authentification.criterions_manager', ['type' => 'checkbox', 'data-toggle' => 'toggle', 'label' => false, 'class' => 'form-control']);

                            echo $this->Form->label(__('Priorities'));
                            echo $this->Form->input('authentification.priorities_manager', ['type' => 'checkbox', 'data-toggle' => 'toggle', 'label' => false, 'class' => 'form-control']);

                            echo $this->Form->label(__('Stages'));
                            echo $this->Form->input('authentification.projectstages_manager', ['type' => 'checkbox', 'data-toggle' => 'toggle', 'label' => false, 'class' => 'form-control']);

                            echo $this->Form->label(__('Clients'));
                            echo $this->Form->input('authentification.clients_manager', ['type' => 'checkbox', 'data-toggle' => 'toggle', 'label' => false, 'class' => 'form-control']);
                        ?>

            </div>
        </fieldset>
        <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary marginbottom10px']) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
<?php 
    $this->Html->css('bootstrap-toggle/bootstrap-toggle.min.css', ['block' => true]);
    $this->Html->script('../css/bootstrap-toggle/bootstrap-toggle.min.js', ['block' => true]);
?>

