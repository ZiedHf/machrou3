<div class="row-fluid">
    <div class="col-md-12">
        <legend>
            <?= __('Members list') ?>
            <div class="pull-right">
                <?= $this->Html->link('<span class="glyphicon glyphicon-plus-sign"></span>', ['action' => 'add'], ['escape' => false]) ?>
            </div>
        </legend>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col"><?= $this->Paginator->sort('name', __('name')) ?></th>
                    <th scope="col"><?= $this->Paginator->sort('lastName', __('lastName')) ?></th>
                    <th scope="col"><?= $this->Paginator->sort('Authentifications.email', __('Email')) ?></th>
                    <th scope="col" class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($members as $member): ?>
                <tr>
                    <td><?= h($member->name) ?></td>
                    <td><?= h($member->lastName) ?></td>
                    <td><?= (isset($member->authentification->email)) ? h($member->authentification->email) : '-' ?></td>
                    <td class="actions">
                        <?= $this->Html->link('<i class="fa fa-eye" aria-hidden="true"></i> '.__('View'), ['action' => 'view', $member->id], ['class' => 'btn btn-primary', 'escape' => false]) ?>
                        <?= $this->Html->link('<i class="fa fa-pencil" aria-hidden="true"></i> '.__('Edit'), ['action' => 'edit', $member->id], ['class' => 'btn btn-warning', 'escape' => false]) ?>
                        <?= $this->Form->postLink('<i class="fa fa-minus-circle" aria-hidden="true"></i> '.__('Delete'), ['action' => 'delete', $member->id], ['class' => 'btn btn-danger', 'escape' => false], ['confirm' => __('Are you sure you want to delete # {0}?', $member->id)]) ?>
                        <?= $this->Html->link('<i class="fa fa-cog" aria-hidden="true"></i> '.__('Access Rights'), ['action' => 'editAccessRights', $member->id], ['class' => 'btn btn-default', 'escape' => false]) ?>
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
