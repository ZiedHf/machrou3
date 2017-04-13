<div class="row-fluid">
    <div class="col-md-12">
        <?= $this->Form->create($assocTeamsMember) ?>
        <fieldset>
            <legend><?= __('Edit Assoc Teams Member') ?></legend>
            <?php
                echo $this->Form->input('team_id', ['label' => __('Team'), 'class' => 'form-control', 'options' => $teams]);
                echo $this->Form->input('member_id', ['label' => __('Member'), 'class' => 'form-control', 'options' => $members]);
                echo $this->Form->input('accessLevel', ['label' => __('accessLevel'), 'class' => 'form-control', 'options' => unserialize(ACCESSLEVEL_CUSTOMIZE)]);
            ?>
        </fieldset>
        <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary marginbottom10px']) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
