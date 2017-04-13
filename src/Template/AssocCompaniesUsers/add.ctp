<div class="row-fluid">
    <div class="col-md-12">
        <?= $this->Form->create($assocCompaniesUser) ?>
        <fieldset>
            <legend><?= __('Add Assoc Companies User') ?></legend>
            <?php
                echo $this->Form->input('user_id', ['label' => __('User'), 'class' => 'form-control', 'options' => $users]);
                echo $this->Form->input('company_id', ['label' => __('Company'), 'class' => 'form-control', 'options' => $companies]);
                echo $this->Form->input('accessLevel', ['label' => __('accessLevel'), 'class' => 'form-control', 'options' => unserialize(ACCESSLEVEL_CUSTOMIZE)]);
                //echo $this->Form->input('companyManager', ['label' => __('companyManager'), 'class' => 'form-control', 'options' => [0 => __('No'), 1 => __('Yes')]]);
            ?>
        </fieldset>
        <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary margintop10px marginbottom10px']) ?>
        <?= $this->Form->end() ?>
    </div>
</div>