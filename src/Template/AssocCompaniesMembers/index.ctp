<div class="row-fluid">
    <div class="col-md-12">
        <legend>
            <h3><?= __('Assoc') ?> : <?= __('Members') ?> / <?= __('Companies') ?></h3>
            <div class="pull-right">
                <?= $this->Html->link(__('<span class="glyphicon glyphicon-plus-sign"></span>'), ['action' => 'add'], ['escape' => false]) ?>
            </div>
        </legend>
        <div class="assocCompaniesMembers index large-9 medium-8 columns content">
            <table  class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col"><?= $this->Paginator->sort('member_id') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('company_id') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('accessLevel') ?></th>
                        <th scope="col" class="actions"><?= __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($assocCompaniesMembers as $assocCompaniesMember): ?>
                    <tr>
                        <td><?= $assocCompaniesMember->has('member') ? $this->Html->link($assocCompaniesMember->member->name, ['controller' => 'Members', 'action' => 'view', $assocCompaniesMember->member->id]) : '' ?></td>
                        <td><?= $assocCompaniesMember->has('company') ? $this->Html->link($assocCompaniesMember->company->name, ['controller' => 'Companies', 'action' => 'view', $assocCompaniesMember->company->id]) : '' ?></td>
                        <td><?= unserialize(ACCESSLEVEL)[$this->Number->format($assocCompaniesMember->accessLevel)] ?></td>
                        <td class="actions">
                            <?= $this->Html->link('<i class="fa fa-eye" aria-hidden="true"></i> '.__('View'), ['action' => 'view', $assocCompaniesMember->id], ['class' => 'btn btn-primary', 'escape' => false]) ?>
                            <?= $this->Html->link('<i class="fa fa-pencil" aria-hidden="true"></i> '.__('Edit'), ['action' => 'edit', $assocCompaniesMember->id], ['class' => 'btn btn-warning', 'escape' => false]) ?>
                            <?= $this->Form->postLink('<i class="fa fa-minus-circle" aria-hidden="true"></i> '.__('Delete'), ['action' => 'delete', $assocCompaniesMember->id], ['class' => 'btn btn-danger', 'escape' => false], ['confirm' => __('Are you sure you want to delete # {0}?', $assocCompaniesMember->id)]) ?>
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
