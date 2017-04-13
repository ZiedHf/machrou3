<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Assoc Departements User'), ['action' => 'edit', $assocDepartementsUser->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Assoc Departements User'), ['action' => 'delete', $assocDepartementsUser->id], ['confirm' => __('Are you sure you want to delete # {0}?', $assocDepartementsUser->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Assoc Departements Users'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Assoc Departements User'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Departements'), ['controller' => 'Departements', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Departement'), ['controller' => 'Departements', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="assocDepartementsUsers view large-9 medium-8 columns content">
    <h3><?= h($assocDepartementsUser->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Departement') ?></th>
            <td><?= $assocDepartementsUser->has('departement') ? $this->Html->link($assocDepartementsUser->departement->name, ['controller' => 'Departements', 'action' => 'view', $assocDepartementsUser->departement->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $assocDepartementsUser->has('user') ? $this->Html->link($assocDepartementsUser->user->name, ['controller' => 'Users', 'action' => 'view', $assocDepartementsUser->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($assocDepartementsUser->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('AccessLevel') ?></th>
            <td><?= $this->Number->format($assocDepartementsUser->accessLevel) ?></td>
        </tr>
    </table>
</div>
