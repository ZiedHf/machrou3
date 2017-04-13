<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Assoc Departements Member'), ['action' => 'edit', $assocDepartementsMember->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Assoc Departements Member'), ['action' => 'delete', $assocDepartementsMember->id], ['confirm' => __('Are you sure you want to delete # {0}?', $assocDepartementsMember->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Assoc Departements Members'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Assoc Departements Member'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Departements'), ['controller' => 'Departements', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Departement'), ['controller' => 'Departements', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Members'), ['controller' => 'Members', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Member'), ['controller' => 'Members', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="assocDepartementsMembers view large-9 medium-8 columns content">
    <h3><?= h($assocDepartementsMember->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Departement') ?></th>
            <td><?= $assocDepartementsMember->has('departement') ? $this->Html->link($assocDepartementsMember->departement->name, ['controller' => 'Departements', 'action' => 'view', $assocDepartementsMember->departement->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Member') ?></th>
            <td><?= $assocDepartementsMember->has('member') ? $this->Html->link($assocDepartementsMember->member->name, ['controller' => 'Members', 'action' => 'view', $assocDepartementsMember->member->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($assocDepartementsMember->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('AccessLevel') ?></th>
            <td><?= $this->Number->format($assocDepartementsMember->accessLevel) ?></td>
        </tr>
    </table>
</div>
