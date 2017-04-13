<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Assoc Departements Criterion'), ['action' => 'edit', $assocDepartementsCriterion->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Assoc Departements Criterion'), ['action' => 'delete', $assocDepartementsCriterion->id], ['confirm' => __('Are you sure you want to delete # {0}?', $assocDepartementsCriterion->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Assoc Departements Criterions'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Assoc Departements Criterion'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Departements'), ['controller' => 'Departements', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Departement'), ['controller' => 'Departements', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Criterions'), ['controller' => 'Criterions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Criterion'), ['controller' => 'Criterions', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="assocDepartementsCriterions view large-9 medium-8 columns content">
    <h3><?= h($assocDepartementsCriterion->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Departement') ?></th>
            <td><?= $assocDepartementsCriterion->has('departement') ? $this->Html->link($assocDepartementsCriterion->departement->name, ['controller' => 'Departements', 'action' => 'view', $assocDepartementsCriterion->departement->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Criterion') ?></th>
            <td><?= $assocDepartementsCriterion->has('criterion') ? $this->Html->link($assocDepartementsCriterion->criterion->name, ['controller' => 'Criterions', 'action' => 'view', $assocDepartementsCriterion->criterion->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($assocDepartementsCriterion->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Percent') ?></th>
            <td><?= $this->Number->format($assocDepartementsCriterion->percent) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Content') ?></h4>
        <?= $this->Text->autoParagraph(h($assocDepartementsCriterion->content)); ?>
    </div>
</div>
