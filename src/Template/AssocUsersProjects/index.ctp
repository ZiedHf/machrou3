<div class="row-fluid">
    <div class="col-md-12">
        <legend>
            <h3><?= __('Assoc Users Projects') ?></h3>
            <div class="pull-right">
                <?= $this->Html->link(__('<span class="glyphicon glyphicon-plus-sign"></span>'), ['action' => 'add'], ['escape' => false]) ?>
            </div>
        </legend>
        <div class="assocUsersProjects index large-9 medium-8 columns content">
            <table  class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('project_id') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('accessLevel') ?></th>
                        <th scope="col" class="actions"><?= __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($assocUsersProjects as $assocUsersProject): ?>
                    <tr>
                        <td><?= $this->Number->format($assocUsersProject->id) ?></td>
                        <td><?= $assocUsersProject->has('user') ? $this->Html->link($assocUsersProject->user->name, ['controller' => 'Users', 'action' => 'view', $assocUsersProject->user->id]) : '' ?></td>
                        <td><?= $assocUsersProject->has('project') ? $this->Html->link($assocUsersProject->project->name, ['controller' => 'Projects', 'action' => 'view', $assocUsersProject->project->id]) : '' ?></td>
                        <td><?= unserialize(ACCESSLEVEL)[$this->Number->format($assocUsersProject->accessLevel)] ?></td>
                        <td class="actions">
                            <?= $this->Html->link('<i class="fa fa-eye" aria-hidden="true"></i> '.__('View'), ['action' => 'view', $assocUsersProject->id], ['class' => 'btn btn-primary', 'escape' => false]) ?>
                            <?= $this->Html->link('<i class="fa fa-pencil" aria-hidden="true"></i> '.__('Edit'), ['action' => 'edit', $assocUsersProject->id], ['class' => 'btn btn-warning', 'escape' => false]) ?>
                            <?= $this->Form->postLink('<i class="fa fa-minus-circle" aria-hidden="true"></i> '.__('Delete'), ['action' => 'delete', $assocUsersProject->id], ['class' => 'btn btn-danger', 'escape' => false], ['confirm' => __('Are you sure you want to delete # {0}?', $assocUsersProject->id)]) ?>
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
    </div>
</div>
