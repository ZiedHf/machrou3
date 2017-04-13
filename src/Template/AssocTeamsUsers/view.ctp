<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Assoc Teams User'), ['action' => 'edit', $assocTeamsUser->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Assoc Teams User'), ['action' => 'delete', $assocTeamsUser->id], ['confirm' => __('Are you sure you want to delete # {0}?', $assocTeamsUser->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Assoc Teams Users'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Assoc Teams User'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Teams'), ['controller' => 'Teams', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Team'), ['controller' => 'Teams', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="assocTeamsUsers view large-9 medium-8 columns content">
    <h3><?= h($assocTeamsUser->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Team') ?></th>
            <td><?= $assocTeamsUser->has('team') ? $this->Html->link($assocTeamsUser->team->name, ['controller' => 'Teams', 'action' => 'view', $assocTeamsUser->team->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $assocTeamsUser->has('user') ? $this->Html->link($assocTeamsUser->user->name, ['controller' => 'Users', 'action' => 'view', $assocTeamsUser->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($assocTeamsUser->id) ?></td>
        </tr>
    </table>
</div>
