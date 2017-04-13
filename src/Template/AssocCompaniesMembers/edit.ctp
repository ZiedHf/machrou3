<div class="row-fluid">
    <div class="col-md-12">
        <?= $this->Form->create($assocCompaniesMember) ?>
        <fieldset>
            <legend><?= __('Edit Assoc Companies Member') ?></legend>
            <?php
                echo $this->Form->input('member_id', ['label' => __('Member'), 'class' => 'form-control', 'options' => $members]);
                echo $this->Form->input('company_id', ['label' => __('Comapny'), 'class' => 'form-control', 'options' => $companies]);
                echo $this->Form->input('accessLevel', ['label' => __('accessLevel'), 'class' => 'form-control', 'options' => unserialize(ACCESSLEVEL_CUSTOMIZE)]);
                //echo $this->Form->input('companyManager', ['label' => __('comapanyManager'), 'class' => 'form-control', 'options' => [0 => __('No'), 1 => __('Yes')]]);
            ?>
        </fieldset>
        <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary marginbottom10px']) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
