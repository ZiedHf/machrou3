<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Assoc Users Actiondisciplinaire'), ['action' => 'edit', $AssocUsersActiondisciplinaires->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Assoc Users Actiondisciplinaire'), ['action' => 'delete', $AssocUsersActiondisciplinaires->id], ['confirm' => __('Are you sure you want to delete # {0}?', $AssocUsersActiondisciplinaires->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Assoc Users Actiondisciplinaire'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Assoc Users Actiondisciplinaire'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Actiondisciplinaires'), ['controller' => 'Actiondisciplinaires', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Actiondisciplinaire'), ['controller' => 'Actiondisciplinaires', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="AssocUsersActiondisciplinaires view large-9 medium-8 columns content">
    <h3><?= h($AssocUsersActiondisciplinaires->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Actiondisciplinaire') ?></th>
            <td><?= $AssocUsersActiondisciplinaires->has('actiondisciplinaire') ? $this->Html->link($AssocUsersActiondisciplinaires->actiondisciplinaire->name, ['controller' => 'Actiondisciplinaires', 'action' => 'view', $AssocUsersActiondisciplinaires->actiondisciplinaire->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $AssocUsersActiondisciplinaires->has('user') ? $this->Html->link($AssocUsersActiondisciplinaires->user->name, ['controller' => 'Users', 'action' => 'view', $AssocUsersActiondisciplinaires->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($AssocUsersActiondisciplinaires->id) ?></td>
        </tr>
    </table>
</div>
