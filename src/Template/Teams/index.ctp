<div class="row-fluid">
    <div class="col-md-12">
        <legend>
            <?= __('Teams list') ?>
            <div class="pull-right">
                <?= $this->Html->link(__('<span class="glyphicon glyphicon-plus-sign"></span>'), ['action' => 'add'], ['escape' => false]) ?>
            </div>
        </legend>

        <div class="col-sm-offset-6 col-md-offset-8 col-lg-offset-9">
            <div class="col-xs-12 margin-bottom">
                <button type="button" class="btn btn-info pull-right" data-toggle="collapse" data-target="#search">
                    <i class="fa fa-plus-square" aria-hidden="true"></i>
                    <?=__('search')?>
                </button>
            </div>
            <div class="col-xs-12">
                <div id="search" class="collapse">
                    <?php
                        echo $this->Form->create();
                        //echo $this->Form->input('name', ['label' => 'Prénom', 'class' => 'form-control']);
                        echo $this->Form->input('q', ['label' => false, 'id' => 'id_search', 'class' => 'form-control marginbtn2px', 'placeholder' => __('search')]);
                        echo $this->Form->button(__('search'), ['type' => 'submit', 'class' => 'btn btn-primary']);
                        if ($isSearch) {
                            echo $this->Html->link(__('cancel'), ['action' => 'index'], ['class' => 'btn btn-danger marginleft2px']);
                        }
                        echo $this->Form->end();
                    ?>
                </div>
            </div>
        </div>

        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col"><?= $this->Paginator->sort('name', __('Name')) ?></th>
                    <th scope="col"><?= $this->Paginator->sort('departement_id', __('Departement')) ?></th>
                    <th scope="col"><?= $this->Paginator->sort('description', __('Description')) ?></th>
                    <th scope="col" class="actions"><?= __('Actions', __('Action')) ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($teams as $team): ?>
                <tr>
                    <td><?= h($team->name) ?></td>
                    <td><?= $team->has('departement') ? $this->Html->link($team->departement->name, ['controller' => 'Departements', 'action' => 'view', $team->departement->id]) : '' ?></td>
                    <td><?= h($team->description) ?></td>
                    <td class="actions">
                        <?= $this->Html->link('<i class="fa fa-eye" aria-hidden="true"></i> '.__('View'), ['action' => 'view', $team->id], ['class' => 'btn btn-primary', 'escape' => false]) ?>
                        <?= $this->Html->link('<i class="fa fa-pencil" aria-hidden="true"></i> '.__('Edit'), ['action' => 'edit', $team->id], ['class' => 'btn btn-warning', 'escape' => false]) ?>
                        <?= $this->Form->postLink('<i class="fa fa-minus-circle" aria-hidden="true"></i> '.__('Delete'), ['action' => 'delete', $team->id], ['class' => 'btn btn-danger', 'escape' => false], ['confirm' => __('Are you sure you want to delete # {0}?', $team->id)]) ?>
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
<?php
    $this->Html->scriptStart(['block' => true]);
        echo "initializeIndexTeamPage();";
    $this->Html->scriptEnd();
?>
