<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Assoc Projects Criterion'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Projects'), ['controller' => 'Projects', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Project'), ['controller' => 'Projects', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Criterions'), ['controller' => 'Criterions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Criterion'), ['controller' => 'Criterions', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="assocProjectsCriterions index large-9 medium-8 columns content">
    <h3><?= __('Assoc Projects Criterions') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('project_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('criterion_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($assocProjectsCriterions as $assocProjectsCriterion): ?>
            <tr>
                <td><?= $this->Number->format($assocProjectsCriterion->id) ?></td>
                <td><?= $assocProjectsCriterion->has('project') ? $this->Html->link($assocProjectsCriterion->project->name, ['controller' => 'Projects', 'action' => 'view', $assocProjectsCriterion->project->id]) : '' ?></td>
                <td><?= $assocProjectsCriterion->has('criterion') ? $this->Html->link($assocProjectsCriterion->criterion->name, ['controller' => 'Criterions', 'action' => 'view', $assocProjectsCriterion->criterion->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $assocProjectsCriterion->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $assocProjectsCriterion->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $assocProjectsCriterion->id], ['confirm' => __('Are you sure you want to delete # {0}?', $assocProjectsCriterion->id)]) ?>
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
