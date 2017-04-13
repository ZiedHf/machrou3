<div class="row-fluid">
    <div class="col-md-12">
        <?= $this->Form->create($rapport) ?>
        <fieldset>
            <legend>
                <?= __('Edit Rapport') ?>
                <div class="pull-right">
                    <?= $this->Html->link(__('<i class="fa fa-list-ul" aria-hidden="true"></i>'), ['action' => 'index'], ['escape' => false]) ?>
                </div>
            </legend>
            <?php
                echo $this->Form->input('name', ['label' => 'Nom', 'class' => 'form-control']);
                echo $this->Form->input('rapport', ['label' => 'Rapport', 'class' => 'form-control']);
                echo $this->Form->input('user_id', ['options' => $users, 'empty' => true, 'class' => 'form-control']);
            ?>
        </fieldset>
        <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary marginbottom10px']) ?>
        <?= $this->Form->end() ?>
    </div>
</div>

