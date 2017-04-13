<div class="row-fluid">
    <div class="col-md-12">
        <?= $this->Form->create($userUrl) ?>
        <fieldset>
            <legend><?= __('Add Url') ?></legend>
            <?php
                echo $this->Form->input('name', ['class' => 'form-control']);
                echo $this->Form->input('url', ['type' => 'text', 'class' => 'form-control']);
                echo $this->Form->input('user_id', ['label' => __('Employee'), 'options' => $users, 'class' => 'form-control']);
            ?>
        </fieldset>
    </div>
</div>
<?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary marginbottom10px']) ?>
<?= $this->Form->end() ?>
