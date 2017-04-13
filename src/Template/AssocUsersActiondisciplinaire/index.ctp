<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Assoc Users Actiondisciplinaire'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Actiondisciplinaires'), ['controller' => 'Actiondisciplinaires', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Actiondisciplinaire'), ['controller' => 'Actiondisciplinaires', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="AssocUsersActiondisciplinaires index large-9 medium-8 columns content">
    <h3><?= __('Assoc Users Actiondisciplinaire') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('action_disciplinaire_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($AssocUsersActiondisciplinaires as $AssocUsersActiondisciplinaires): ?>
            <tr>
                <td><?= $this->Number->format($AssocUsersActiondisciplinaires->id) ?></td>
                <td><?= $AssocUsersActiondisciplinaires->has('actiondisciplinaire') ? $this->Html->link($AssocUsersActiondisciplinaires->actiondisciplinaire->name, ['controller' => 'Actiondisciplinaires', 'action' => 'view', $AssocUsersActiondisciplinaires->actiondisciplinaire->id]) : '' ?></td>
                <td><?= $AssocUsersActiondisciplinaires->has('user') ? $this->Html->link($AssocUsersActiondisciplinaires->user->name, ['controller' => 'Users', 'action' => 'view', $AssocUsersActiondisciplinaires->user->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $AssocUsersActiondisciplinaires->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $AssocUsersActiondisciplinaires->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $AssocUsersActiondisciplinaires->id], ['confirm' => __('Are you sure you want to delete # {0}?', $AssocUsersActiondisciplinaires->id)]) ?>
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
