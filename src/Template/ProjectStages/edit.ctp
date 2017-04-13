<div class="row-fluid">
    <div class="col-md-12">
        <?= $this->Form->create($projectStage) ?>
        <fieldset>
            <legend><?= __('Edit Project Stage') ?></legend>
            <?php
                echo $this->Form->input('name', ['class' => 'form-control']);
                echo $this->Form->input('order_stage', ['class' => 'form-control', 'label' => __('order')]);
            ?>
        </fieldset>
        <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary marginbottom10px']) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
