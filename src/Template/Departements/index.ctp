<div class="row-fluid">
    <div class="col-md-12">
        <legend>
            <?= __('Departements list') ?>
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
                    <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                    <th scope="col" class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($departements as $departement): ?>
                <tr>
                    <td><?= h($departement->name) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('<i class="fa fa-eye" aria-hidden="true"></i> '.__('View')), ['action' => 'view', $departement->id], ['class' => 'btn btn-primary', 'escape' => false]) ?>
                        <?= $this->Html->link(__('<i class="fa fa-pencil" aria-hidden="true"></i> '.__('Edit')), ['action' => 'edit', $departement->id], ['class' => 'btn btn-warning', 'escape' => false]) ?>
                        <?= $this->Form->postLink(__('<i class="fa fa-minus-circle" aria-hidden="true"></i> '.__('Delete')), ['action' => 'delete', $departement->id], ['class' => 'btn btn-danger', 'escape' => false], ['confirm' => __('Are you sure you want to delete # {0}?', $departement->id)]) ?>
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
        echo "initializeIndexDepartementPage();";
    $this->Html->scriptEnd();
?>
