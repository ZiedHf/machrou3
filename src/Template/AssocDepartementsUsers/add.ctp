<div class="row-fluid">
    <div class="col-md-12">
        <?= $this->Form->create($assocDepartementsUser) ?>
        <fieldset>
            <legend><?= __('Add Assoc Departements User') ?></legend>
            <?php
                echo $this->Form->input('user_id', ['label' => __('User'), 'class' => 'form-control', 'options' => $users]);
                echo $this->Form->input('departement_id', ['label' => __('Departement'), 'class' => 'form-control', 'options' => $departements]);
                echo $this->Form->input('accessLevel', ['label' => __('accessLevel'), 'class' => 'form-control', 'options' => unserialize(ACCESSLEVEL_CUSTOMIZE)]);
            /*
                echo $this->Form->input('departement_id', ['options' => $departements]);
                echo $this->Form->input('user_id', ['options' => $users]);
                echo $this->Form->input('accessLevel');
                echo $this->Form->input('departementManager');*/
            ?>
        </fieldset>
        <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary margintop10px marginbottom10px']) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
