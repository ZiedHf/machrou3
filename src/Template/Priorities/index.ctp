<div class="row-fluid">
    <div class="col-md-12">
        <legend>
            <?= __('Priorities') ?>
            <div class="pull-right">
                <?= $this->Html->link('<span class="glyphicon glyphicon-plus-sign"></span>', ['action' => 'add'], ['escape' => false]) ?>
            </div>
        </legend>
        
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('order') ?></th>
                    <th scope="col" class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($priorities as $priority): ?>
                <tr>
                    <td><?= h($priority->name) ?></td>
                    <td><?= $this->Number->format($priority->order_priority) ?></td>
                    <td class="actions">
                        <?= $this->Html->link('<i class="fa fa-eye" aria-hidden="true"></i> '.__('View'), ['action' => 'view', $priority->id], ['class' => 'btn btn-primary', 'escape' => false]) ?>
                        <?= $this->Html->link('<i class="fa fa-pencil" aria-hidden="true"></i> '.__('Edit'), ['action' => 'edit', $priority->id], ['class' => 'btn btn-warning', 'escape' => false]) ?>
                        <?= $this->Form->postLink('<i class="fa fa-minus-circle" aria-hidden="true"></i> '.__('Delete'), ['action' => 'delete', $priority->id], ['class' => 'btn btn-danger', 'escape' => false], ['confirm' => __('Are you sure you want to delete # {0}?', $priority->id)]) ?>
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
