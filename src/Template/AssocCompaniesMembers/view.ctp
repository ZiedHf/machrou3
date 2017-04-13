<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Assoc Companies Member'), ['action' => 'edit', $assocCompaniesMember->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Assoc Companies Member'), ['action' => 'delete', $assocCompaniesMember->id], ['confirm' => __('Are you sure you want to delete # {0}?', $assocCompaniesMember->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Assoc Companies Members'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Assoc Companies Member'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Members'), ['controller' => 'Members', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Member'), ['controller' => 'Members', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Companies'), ['controller' => 'Companies', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Company'), ['controller' => 'Companies', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="assocCompaniesMembers view large-9 medium-8 columns content">
    <h3><?= h($assocCompaniesMember->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Member') ?></th>
            <td><?= $assocCompaniesMember->has('member') ? $this->Html->link($assocCompaniesMember->member->name, ['controller' => 'Members', 'action' => 'view', $assocCompaniesMember->member->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Company') ?></th>
            <td><?= $assocCompaniesMember->has('company') ? $this->Html->link($assocCompaniesMember->company->name, ['controller' => 'Companies', 'action' => 'view', $assocCompaniesMember->company->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($assocCompaniesMember->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('AccessLevel') ?></th>
            <td><?= $this->Number->format($assocCompaniesMember->accessLevel) ?></td>
        </tr>
    </table>
</div>
