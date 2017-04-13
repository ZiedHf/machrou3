<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Assoc Projects Team'), ['action' => 'edit', $assocProjectsTeam->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Assoc Projects Team'), ['action' => 'delete', $assocProjectsTeam->id], ['confirm' => __('Are you sure you want to delete # {0}?', $assocProjectsTeam->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Assoc Projects Teams'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Assoc Projects Team'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Projects'), ['controller' => 'Projects', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Project'), ['controller' => 'Projects', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Teams'), ['controller' => 'Teams', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Team'), ['controller' => 'Teams', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="assocProjectsTeams view large-9 medium-8 columns content">
    <h3><?= h($assocProjectsTeam->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Project') ?></th>
            <td><?= $assocProjectsTeam->has('project') ? $this->Html->link($assocProjectsTeam->project->name, ['controller' => 'Projects', 'action' => 'view', $assocProjectsTeam->project->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Team') ?></th>
            <td><?= $assocProjectsTeam->has('team') ? $this->Html->link($assocProjectsTeam->team->name, ['controller' => 'Teams', 'action' => 'view', $assocProjectsTeam->team->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($assocProjectsTeam->id) ?></td>
        </tr>
    </table>
</div>
