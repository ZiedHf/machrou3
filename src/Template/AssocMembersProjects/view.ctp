<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Assoc Members Project'), ['action' => 'edit', $assocMembersProject->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Assoc Members Project'), ['action' => 'delete', $assocMembersProject->id], ['confirm' => __('Are you sure you want to delete # {0}?', $assocMembersProject->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Assoc Members Projects'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Assoc Members Project'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Members'), ['controller' => 'Members', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Member'), ['controller' => 'Members', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Projects'), ['controller' => 'Projects', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Project'), ['controller' => 'Projects', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="assocMembersProjects view large-9 medium-8 columns content">
    <h3><?= h($assocMembersProject->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Member') ?></th>
            <td><?= $assocMembersProject->has('member') ? $this->Html->link($assocMembersProject->member->name, ['controller' => 'Members', 'action' => 'view', $assocMembersProject->member->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Project') ?></th>
            <td><?= $assocMembersProject->has('project') ? $this->Html->link($assocMembersProject->project->name, ['controller' => 'Projects', 'action' => 'view', $assocMembersProject->project->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($assocMembersProject->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('AccessLevel') ?></th>
            <td><?= $this->Number->format($assocMembersProject->accessLevel) ?></td>
        </tr>
    </table>
</div>
