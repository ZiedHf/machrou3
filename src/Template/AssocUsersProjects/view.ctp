<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Assoc Users Project'), ['action' => 'edit', $assocUsersProject->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Assoc Users Project'), ['action' => 'delete', $assocUsersProject->id], ['confirm' => __('Are you sure you want to delete # {0}?', $assocUsersProject->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Assoc Users Projects'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Assoc Users Project'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Projects'), ['controller' => 'Projects', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Project'), ['controller' => 'Projects', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="assocUsersProjects view large-9 medium-8 columns content">
    <h3><?= h($assocUsersProject->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $assocUsersProject->has('user') ? $this->Html->link($assocUsersProject->user->name, ['controller' => 'Users', 'action' => 'view', $assocUsersProject->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Project') ?></th>
            <td><?= $assocUsersProject->has('project') ? $this->Html->link($assocUsersProject->project->name, ['controller' => 'Projects', 'action' => 'view', $assocUsersProject->project->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($assocUsersProject->id) ?></td>
        </tr>
    </table>
</div>
