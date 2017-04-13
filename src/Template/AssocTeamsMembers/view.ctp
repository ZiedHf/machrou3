<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Assoc Teams Member'), ['action' => 'edit', $assocTeamsMember->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Assoc Teams Member'), ['action' => 'delete', $assocTeamsMember->id], ['confirm' => __('Are you sure you want to delete # {0}?', $assocTeamsMember->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Assoc Teams Members'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Assoc Teams Member'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Teams'), ['controller' => 'Teams', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Team'), ['controller' => 'Teams', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Members'), ['controller' => 'Members', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Member'), ['controller' => 'Members', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="assocTeamsMembers view large-9 medium-8 columns content">
    <h3><?= h($assocTeamsMember->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Team') ?></th>
            <td><?= $assocTeamsMember->has('team') ? $this->Html->link($assocTeamsMember->team->name, ['controller' => 'Teams', 'action' => 'view', $assocTeamsMember->team->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Member') ?></th>
            <td><?= $assocTeamsMember->has('member') ? $this->Html->link($assocTeamsMember->member->name, ['controller' => 'Members', 'action' => 'view', $assocTeamsMember->member->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($assocTeamsMember->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('AccessLevel') ?></th>
            <td><?= $this->Number->format($assocTeamsMember->accessLevel) ?></td>
        </tr>
    </table>
</div>
