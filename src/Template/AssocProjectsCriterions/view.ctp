<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Assoc Projects Criterion'), ['action' => 'edit', $assocProjectsCriterion->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Assoc Projects Criterion'), ['action' => 'delete', $assocProjectsCriterion->id], ['confirm' => __('Are you sure you want to delete # {0}?', $assocProjectsCriterion->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Assoc Projects Criterions'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Assoc Projects Criterion'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Projects'), ['controller' => 'Projects', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Project'), ['controller' => 'Projects', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Criterions'), ['controller' => 'Criterions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Criterion'), ['controller' => 'Criterions', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="assocProjectsCriterions view large-9 medium-8 columns content">
    <h3><?= h($assocProjectsCriterion->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Project') ?></th>
            <td><?= $assocProjectsCriterion->has('project') ? $this->Html->link($assocProjectsCriterion->project->name, ['controller' => 'Projects', 'action' => 'view', $assocProjectsCriterion->project->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Criterion') ?></th>
            <td><?= $assocProjectsCriterion->has('criterion') ? $this->Html->link($assocProjectsCriterion->criterion->name, ['controller' => 'Criterions', 'action' => 'view', $assocProjectsCriterion->criterion->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($assocProjectsCriterion->id) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Content') ?></h4>
        <?= $this->Text->autoParagraph(h($assocProjectsCriterion->content)); ?>
    </div>
</div>
