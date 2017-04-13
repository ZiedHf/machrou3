<div class="row-fluid">
    <div class="col-md-12">
        <?= $this->Form->create($assocTeamsUser) ?>
        <fieldset>
            <legend><?= __('Edit Assoc Teams User') ?></legend>
            <?php
                echo $this->Form->input('team_id', ['label' => __('Team'), 'class' => 'form-control', 'options' => $teams]);
                echo $this->Form->input('user_id', ['label' => __('User'), 'class' => 'form-control', 'options' => $users]);
                echo $this->Form->input('accessLevel', ['label' => __('accessLevel'), 'class' => 'form-control', 'options' => unserialize(ACCESSLEVEL)]);
            ?>
        </fieldset>
        <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary marginbottom10px']) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
