<div class="row-fluid">
    <div class="col-md-12">
        <?= $this->Form->create($priority) ?>
        <fieldset>
            <legend><?= __('Edit Priority') ?></legend>
            <?php
                echo $this->Form->input('name', ['class' => 'form-control']);
                echo $this->Form->input('order_priority', ['class' => 'form-control', 'label' => __('order')]);
            ?>
        </fieldset>
        <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary marginbottom10px']) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
