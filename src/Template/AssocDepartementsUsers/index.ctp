<div class="row-fluid">
    <div class="col-md-12">
        <legend>
            <h3><?= __('Assoc Departements Users') ?></h3>
            <div class="pull-right">
                <?= $this->Html->link(__('<span class="glyphicon glyphicon-plus-sign"></span>'), ['action' => 'add'], ['escape' => false]) ?>
            </div>
        </legend>
        <div class="assocDepartementsUsers index large-9 medium-8 columns content">
            <table  class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('departement_id') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('accessLevel') ?></th>
                        <th scope="col" class="actions"><?= __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($assocDepartementsUsers as $assocDepartementsUser): ?>
                    <tr>
                        <td><?= $this->Number->format($assocDepartementsUser->id) ?></td>
                        <td><?= $assocDepartementsUser->has('departement') ? $this->Html->link($assocDepartementsUser->departement->name, ['controller' => 'Departements', 'action' => 'view', $assocDepartementsUser->departement->id]) : '' ?></td>
                        <td><?= $assocDepartementsUser->has('user') ? $this->Html->link($assocDepartementsUser->user->name, ['controller' => 'Users', 'action' => 'view', $assocDepartementsUser->user->id]) : '' ?></td>
                        <td><?= unserialize(ACCESSLEVEL)[$this->Number->format($assocDepartementsUser->accessLevel)] ?></td>
                        <td class="actions">
                            <?= $this->Html->link('<i class="fa fa-eye" aria-hidden="true"></i> '.__('View'), ['action' => 'view', $assocDepartementsUser->id], ['class' => 'btn btn-primary', 'escape' => false]) ?>
                            <?= $this->Html->link('<i class="fa fa-pencil" aria-hidden="true"></i> '.__('Edit'), ['action' => 'edit', $assocDepartementsUser->id], ['class' => 'btn btn-warning', 'escape' => false]) ?>
                            <?= $this->Form->postLink('<i class="fa fa-minus-circle" aria-hidden="true"></i> '.__('Delete'), ['action' => 'delete', $assocDepartementsUser->id], ['class' => 'btn btn-danger', 'escape' => false], ['confirm' => __('Are you sure you want to delete # {0}?', $assocDepartementsUser->id)]) ?>
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
