<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Assoc Teams Criterion'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Teams'), ['controller' => 'Teams', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Team'), ['controller' => 'Teams', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Criterions'), ['controller' => 'Criterions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Criterion'), ['controller' => 'Criterions', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="assocTeamsCriterions index large-9 medium-8 columns content">
    <h3><?= __('Assoc Teams Criterions') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('team_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('criterion_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('percent') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($assocTeamsCriterions as $assocTeamsCriterion): ?>
            <tr>
                <td><?= $this->Number->format($assocTeamsCriterion->id) ?></td>
                <td><?= $assocTeamsCriterion->has('team') ? $this->Html->link($assocTeamsCriterion->team->name, ['controller' => 'Teams', 'action' => 'view', $assocTeamsCriterion->team->id]) : '' ?></td>
                <td><?= $assocTeamsCriterion->has('criterion') ? $this->Html->link($assocTeamsCriterion->criterion->name, ['controller' => 'Criterions', 'action' => 'view', $assocTeamsCriterion->criterion->id]) : '' ?></td>
                <td><?= $this->Number->format($assocTeamsCriterion->percent) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $assocTeamsCriterion->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $assocTeamsCriterion->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $assocTeamsCriterion->id], ['confirm' => __('Are you sure you want to delete # {0}?', $assocTeamsCriterion->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
