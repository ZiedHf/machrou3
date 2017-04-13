<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Assoc Departements Criterion'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Departements'), ['controller' => 'Departements', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Departement'), ['controller' => 'Departements', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Criterions'), ['controller' => 'Criterions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Criterion'), ['controller' => 'Criterions', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="assocDepartementsCriterions index large-9 medium-8 columns content">
    <h3><?= __('Assoc Departements Criterions') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('departement_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('criterion_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('percent') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($assocDepartementsCriterions as $assocDepartementsCriterion): ?>
            <tr>
                <td><?= $this->Number->format($assocDepartementsCriterion->id) ?></td>
                <td><?= $assocDepartementsCriterion->has('departement') ? $this->Html->link($assocDepartementsCriterion->departement->name, ['controller' => 'Departements', 'action' => 'view', $assocDepartementsCriterion->departement->id]) : '' ?></td>
                <td><?= $assocDepartementsCriterion->has('criterion') ? $this->Html->link($assocDepartementsCriterion->criterion->name, ['controller' => 'Criterions', 'action' => 'view', $assocDepartementsCriterion->criterion->id]) : '' ?></td>
                <td><?= $this->Number->format($assocDepartementsCriterion->percent) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $assocDepartementsCriterion->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $assocDepartementsCriterion->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $assocDepartementsCriterion->id], ['confirm' => __('Are you sure you want to delete # {0}?', $assocDepartementsCriterion->id)]) ?>
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
