<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Assoc Clients Project'), ['action' => 'edit', $assocClientsProject->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Assoc Clients Project'), ['action' => 'delete', $assocClientsProject->id], ['confirm' => __('Are you sure you want to delete # {0}?', $assocClientsProject->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Assoc Clients Projects'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Assoc Clients Project'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Clients'), ['controller' => 'Clients', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Client'), ['controller' => 'Clients', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Projects'), ['controller' => 'Projects', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Project'), ['controller' => 'Projects', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="assocClientsProjects view large-9 medium-8 columns content">
    <h3><?= h($assocClientsProject->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Client') ?></th>
            <td><?= $assocClientsProject->has('client') ? $this->Html->link($assocClientsProject->client->name, ['controller' => 'Clients', 'action' => 'view', $assocClientsProject->client->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Project') ?></th>
            <td><?= $assocClientsProject->has('project') ? $this->Html->link($assocClientsProject->project->name, ['controller' => 'Projects', 'action' => 'view', $assocClientsProject->project->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($assocClientsProject->id) ?></td>
        </tr>
    </table>
</div>
