<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Assoc Teams Criterion'), ['action' => 'edit', $assocTeamsCriterion->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Assoc Teams Criterion'), ['action' => 'delete', $assocTeamsCriterion->id], ['confirm' => __('Are you sure you want to delete # {0}?', $assocTeamsCriterion->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Assoc Teams Criterions'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Assoc Teams Criterion'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Teams'), ['controller' => 'Teams', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Team'), ['controller' => 'Teams', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Criterions'), ['controller' => 'Criterions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Criterion'), ['controller' => 'Criterions', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="assocTeamsCriterions view large-9 medium-8 columns content">
    <h3><?= h($assocTeamsCriterion->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Team') ?></th>
            <td><?= $assocTeamsCriterion->has('team') ? $this->Html->link($assocTeamsCriterion->team->name, ['controller' => 'Teams', 'action' => 'view', $assocTeamsCriterion->team->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Criterion') ?></th>
            <td><?= $assocTeamsCriterion->has('criterion') ? $this->Html->link($assocTeamsCriterion->criterion->name, ['controller' => 'Criterions', 'action' => 'view', $assocTeamsCriterion->criterion->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($assocTeamsCriterion->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Percent') ?></th>
            <td><?= $this->Number->format($assocTeamsCriterion->percent) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Content') ?></h4>
        <?= $this->Text->autoParagraph(h($assocTeamsCriterion->content)); ?>
    </div>
</div>
