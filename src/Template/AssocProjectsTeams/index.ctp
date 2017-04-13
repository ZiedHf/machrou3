<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Assoc Projects Team'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Projects'), ['controller' => 'Projects', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Project'), ['controller' => 'Projects', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Teams'), ['controller' => 'Teams', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Team'), ['controller' => 'Teams', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="assocProjectsTeams index large-9 medium-8 columns content">
    <h3><?= __('Assoc Projects Teams') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('project_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('team_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($assocProjectsTeams as $assocProjectsTeam): ?>
            <tr>
                <td><?= $this->Number->format($assocProjectsTeam->id) ?></td>
                <td><?= $assocProjectsTeam->has('project') ? $this->Html->link($assocProjectsTeam->project->name, ['controller' => 'Projects', 'action' => 'view', $assocProjectsTeam->project->id]) : '' ?></td>
                <td><?= $assocProjectsTeam->has('team') ? $this->Html->link($assocProjectsTeam->team->name, ['controller' => 'Teams', 'action' => 'view', $assocProjectsTeam->team->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $assocProjectsTeam->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $assocProjectsTeam->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $assocProjectsTeam->id], ['confirm' => __('Are you sure you want to delete # {0}?', $assocProjectsTeam->id)]) ?>
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
