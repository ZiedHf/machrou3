<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Assoc Clients Project'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Clients'), ['controller' => 'Clients', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Client'), ['controller' => 'Clients', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Projects'), ['controller' => 'Projects', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Project'), ['controller' => 'Projects', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="assocClientsProjects index large-9 medium-8 columns content">
    <h3><?= __('Assoc Clients Projects') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('client_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('project_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($assocClientsProjects as $assocClientsProject): ?>
            <tr>
                <td><?= $this->Number->format($assocClientsProject->id) ?></td>
                <td><?= $assocClientsProject->has('client') ? $this->Html->link($assocClientsProject->client->name, ['controller' => 'Clients', 'action' => 'view', $assocClientsProject->client->id]) : '' ?></td>
                <td><?= $assocClientsProject->has('project') ? $this->Html->link($assocClientsProject->project->name, ['controller' => 'Projects', 'action' => 'view', $assocClientsProject->project->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $assocClientsProject->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $assocClientsProject->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $assocClientsProject->id], ['confirm' => __('Are you sure you want to delete # {0}?', $assocClientsProject->id)]) ?>
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
