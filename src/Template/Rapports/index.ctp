<div class="row-fluid">
    <div class="col-md-12">
        <legend>
            <?= __('Rapports list') ?>
            <div class="pull-right">
                <?= $this->Html->link(__('<span class="glyphicon glyphicon-plus-sign"></span>'), ['action' => 'add'], ['escape' => false]) ?>
            </div>
        </legend>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                    <th scope="col" class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rapports as $rapport): ?>
                <tr>
                    <td><?= $this->Number->format($rapport->id) ?></td>
                    <td><?= h($rapport->name) ?></td>
                    <td><?= $rapport->has('user') ? $this->Html->link($rapport->user->name, ['controller' => 'Users', 'action' => 'view', $rapport->user->id]) : '' ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('<i class="fa fa-eye" aria-hidden="true"></i> Consulter'), ['action' => 'view', $rapport->id], ['class' => 'btn btn-primary', 'escape' => false]) ?>
                        <?= $this->Html->link(__('<i class="fa fa-pencil" aria-hidden="true"></i> Modifier'), ['action' => 'edit', $rapport->id], ['class' => 'btn btn-warning', 'escape' => false]) ?>
                        <?= $this->Form->postLink(__('<i class="fa fa-minus-circle" aria-hidden="true"></i> Supprimer'), ['action' => 'delete', $rapport->id], ['class' => 'btn btn-danger', 'escape' => false], ['confirm' => __('Are you sure you want to delete # {0}?', $rapport->id)]) ?>
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
