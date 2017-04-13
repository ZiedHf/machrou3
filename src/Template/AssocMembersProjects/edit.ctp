<div class="row-fluid">
    <div class="col-md-12">
        <?= $this->Form->create($assocMembersProject) ?>
        <fieldset>
            <legend><?= __('Edit Assoc Members Project') ?></legend>
            <?php
                echo $this->Form->input('member_id', ['label' => __('Member'), 'class' => 'form-control', 'options' => $members]);
                echo $this->Form->input('project_id', ['label' => __('Project'), 'class' => 'form-control', 'options' => $projects]);
                echo $this->Form->input('accessLevel', ['label' => __('accessLevel'), 'class' => 'form-control', 'options' => unserialize(ACCESSLEVEL_CUSTOMIZE)]);
            ?>
        </fieldset>
        <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary marginbottom10px']) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
