<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $assocTeamsCriterion->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $assocTeamsCriterion->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Assoc Teams Criterions'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Teams'), ['controller' => 'Teams', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Team'), ['controller' => 'Teams', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Criterions'), ['controller' => 'Criterions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Criterion'), ['controller' => 'Criterions', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="assocTeamsCriterions form large-9 medium-8 columns content">
    <?= $this->Form->create($assocTeamsCriterion) ?>
    <fieldset>
        <legend><?= __('Edit Assoc Teams Criterion') ?></legend>
        <?php
            echo $this->Form->input('team_id', ['options' => $teams]);
            echo $this->Form->input('criterion_id', ['options' => $criterions]);
            echo $this->Form->input('content');
            echo $this->Form->input('percent');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary marginbottom10px']) ?>
    <?= $this->Form->end() ?>
</div>
