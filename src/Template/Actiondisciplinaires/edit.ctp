<?= $this->Form->create($actiondisciplinaire) ?>
<fieldset>
    <legend>
        <?= __('Edit Actiondisciplinaire') ?>
        <div class="pull-right">
            <?= $this->Html->link(__('<i class="fa fa-list-ul" aria-hidden="true"></i>'), ['action' => 'index'], ['escape' => false]) ?>
        </div>
    </legend>
    <?php
        echo $this->Form->input('name', ['label' => 'Nom', 'class' => 'form-control']);
        echo $this->Form->input('description', ['class' => 'form-control']);
    ?>
</fieldset>
<?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary marginbottom10px']) ?>
<?= $this->Form->end() ?>
