<div class="row-fluid">
    <div class="col-md-12">
        <?= $this->Form->create($company) ?>
        <fieldset>
            <legend><?= __('Edit Company') ?></legend>
            <?php
                echo $this->Form->input('name', ['label' => __('Name'), 'class' => 'form-control']);
                echo $this->Form->input('email', ['label' => __('Email'), 'class' => 'form-control']);
                echo $this->Form->input('adresse', ['label' => __('Adresse'), 'class' => 'form-control']);
                echo $this->Form->input('description', ['label' => __('Description'), 'class' => 'form-control']);
            ?>
        </fieldset>
        <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary margintop10px marginbottom10px']) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
