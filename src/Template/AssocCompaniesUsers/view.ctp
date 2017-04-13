<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Assoc Companies User'), ['action' => 'edit', $assocCompaniesUser->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Assoc Companies User'), ['action' => 'delete', $assocCompaniesUser->id], ['confirm' => __('Are you sure you want to delete # {0}?', $assocCompaniesUser->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Assoc Companies Users'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Assoc Companies User'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Companies'), ['controller' => 'Companies', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Company'), ['controller' => 'Companies', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="assocCompaniesUsers view large-9 medium-8 columns content">
    <h3><?= h($assocCompaniesUser->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $assocCompaniesUser->has('user') ? $this->Html->link($assocCompaniesUser->user->name, ['controller' => 'Users', 'action' => 'view', $assocCompaniesUser->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Company') ?></th>
            <td><?= $assocCompaniesUser->has('company') ? $this->Html->link($assocCompaniesUser->company->name, ['controller' => 'Companies', 'action' => 'view', $assocCompaniesUser->company->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($assocCompaniesUser->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('AccessLevel') ?></th>
            <td><?= $this->Number->format($assocCompaniesUser->accessLevel) ?></td>
        </tr>
    </table>
</div>
