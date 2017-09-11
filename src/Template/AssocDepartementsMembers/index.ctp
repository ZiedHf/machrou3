<div class="row-fluid">
    <div class="col-md-12">
        <legend>
            <h3><?= __('Assoc') ?> : <?= __('Members') ?> / <?= __('Departements') ?></h3>
            <div class="pull-right">
                <?= $this->Html->link(__('<span class="glyphicon glyphicon-plus-sign"></span>'), ['action' => 'add'], ['escape' => false]) ?>
            </div>
        </legend>
        <div class="assocDepartementsMembers index large-9 medium-8 columns content">
            <table  class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col"><?= $this->Paginator->sort('member_id') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('departement_id') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('accessLevel') ?></th>
                        <th scope="col" class="actions"><?= __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($assocDepartementsMembers as $assocDepartementsMember): ?>
                    <tr>
                        <td><?= $assocDepartementsMember->has('member') ? $this->Html->link($assocDepartementsMember->member->name, ['controller' => 'Members', 'action' => 'view', $assocDepartementsMember->member->id]) : '' ?></td>
                        <td><?= $assocDepartementsMember->has('departement') ? $this->Html->link($assocDepartementsMember->departement->name, ['controller' => 'Departements', 'action' => 'view', $assocDepartementsMember->departement->id]) : '' ?></td>
                        <td><?= unserialize(ACCESSLEVEL)[$this->Number->format($assocDepartementsMember->accessLevel)] ?></td>
                        <td class="actions">
                            <?= $this->Html->link('<i class="fa fa-eye" aria-hidden="true"></i> '.__('View'), ['action' => 'view', $assocDepartementsMember->id], ['class' => 'btn btn-primary', 'escape' => false]) ?>
                            <?= $this->Html->link('<i class="fa fa-pencil" aria-hidden="true"></i> '.__('Edit'), ['action' => 'edit', $assocDepartementsMember->id], ['class' => 'btn btn-warning', 'escape' => false]) ?>
                            <?= $this->Form->postLink('<i class="fa fa-minus-circle" aria-hidden="true"></i> '.__('Delete'), ['action' => 'delete', $assocDepartementsMember->id], ['class' => 'btn btn-danger', 'escape' => false], ['confirm' => __('Are you sure you want to delete # {0}?', $assocDepartementsMember->id)]) ?>
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
