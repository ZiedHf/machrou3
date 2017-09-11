<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Assoc Users Criterion'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Criterions'), ['controller' => 'Criterions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Criterion'), ['controller' => 'Criterions', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="assocUsersCriterions index large-9 medium-8 columns content">
    <h3><?= __('Assoc Users Criterions') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('criterion_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($assocUsersCriterions as $assocUsersCriterion): ?>
            <tr>
                <td><?= $assocUsersCriterion->has('user') ? $this->Html->link($assocUsersCriterion->user->name, ['controller' => 'Users', 'action' => 'view', $assocUsersCriterion->user->id]) : '' ?></td>
                <td><?= $assocUsersCriterion->has('criterion') ? $this->Html->link($assocUsersCriterion->criterion->name, ['controller' => 'Criterions', 'action' => 'view', $assocUsersCriterion->criterion->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $assocUsersCriterion->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $assocUsersCriterion->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $assocUsersCriterion->id], ['confirm' => __('Are you sure you want to delete # {0}?', $assocUsersCriterion->id)]) ?>
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
