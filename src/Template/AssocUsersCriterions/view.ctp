<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Assoc Users Criterion'), ['action' => 'edit', $assocUsersCriterion->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Assoc Users Criterion'), ['action' => 'delete', $assocUsersCriterion->id], ['confirm' => __('Are you sure you want to delete # {0}?', $assocUsersCriterion->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Assoc Users Criterions'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Assoc Users Criterion'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Criterions'), ['controller' => 'Criterions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Criterion'), ['controller' => 'Criterions', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="assocUsersCriterions view large-9 medium-8 columns content">
    <h3><?= h($assocUsersCriterion->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $assocUsersCriterion->has('user') ? $this->Html->link($assocUsersCriterion->user->name, ['controller' => 'Users', 'action' => 'view', $assocUsersCriterion->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Criterion') ?></th>
            <td><?= $assocUsersCriterion->has('criterion') ? $this->Html->link($assocUsersCriterion->criterion->name, ['controller' => 'Criterions', 'action' => 'view', $assocUsersCriterion->criterion->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($assocUsersCriterion->id) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Content') ?></h4>
        <?= $this->Text->autoParagraph(h($assocUsersCriterion->content)); ?>
    </div>
</div>
