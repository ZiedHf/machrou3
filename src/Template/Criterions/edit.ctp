<div class="row-fluid">
    <div class="col-md-12">
        <?= $this->Form->create($criterion) ?>
        <fieldset>
            <legend>
                <?= __('Edit Criterion') ?>
                <div class="pull-right">
                    <?= $this->Html->link(__('<i class="fa fa-list-ul" aria-hidden="true"></i>'), ['action' => 'index'], ['escape' => false]) ?>
                </div>
            </legend>
            <?php
                echo $this->Form->input('name', ['label' => __('name'), 'class' => 'form-control']);
                echo $this->Form->input('type', ['options' => $types_criterions, 'label' => __('Type'), 'class' => 'form-control']);
            ?>
        </fieldset>
        <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary marginbottom10px']) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
