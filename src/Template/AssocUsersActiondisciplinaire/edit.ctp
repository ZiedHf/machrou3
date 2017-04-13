<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $AssocUsersActiondisciplinaires->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $AssocUsersActiondisciplinaires->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Assoc Users Actiondisciplinaire'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Actiondisciplinaires'), ['controller' => 'Actiondisciplinaires', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Actiondisciplinaire'), ['controller' => 'Actiondisciplinaires', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="AssocUsersActiondisciplinaires form large-9 medium-8 columns content">
    <?= $this->Form->create($AssocUsersActiondisciplinaires) ?>
    <fieldset>
        <legend><?= __('Edit Assoc Users Actiondisciplinaire') ?></legend>
        <?php
            echo $this->Form->input('action_disciplinaire_id', ['options' => $actiondisciplinaires]);
            echo $this->Form->input('user_id', ['options' => $users]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary marginbottom10px']) ?>
    <?= $this->Form->end() ?>
</div>
