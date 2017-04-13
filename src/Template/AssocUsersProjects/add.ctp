<div class="row-fluid">
    <div class="col-md-12">
        <?= $this->Form->create($assocUsersProject) ?>
        <fieldset>
            <legend><?= __('Add Assoc Users Project') ?></legend>
            <?php
                echo $this->Form->input('user_id', ['label' => __('User'), 'class' => 'form-control', 'options' => $users]);
                echo $this->Form->input('project_id', ['label' => __('Project'), 'class' => 'form-control', 'options' => $projects]);
                echo $this->Form->input('accessLevel', ['label' => __('accessLevel'), 'class' => 'form-control', 'options' => unserialize(ACCESSLEVEL)]);
            ?>
        </fieldset>
        <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary marginbottom10px']) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
