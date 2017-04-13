<div class="row-fluid">
    <div class="col-md-12">
        <legend>
            <?= __('Projects list') ?>
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
                        echo $this->Form->input('q2', ['label' => false, 'id' => 'id_search2', 'class' => 'form-control marginbtn2px', 'placeholder' => __('Accomplishment less than ..')]);
                        echo $this->Form->input('q3', ['label' => false, 'id' => 'id_search3', 'class' => 'form-control marginbtn2px', 'placeholder' => __('Accomplishment more than ..')]);

                        echo $this->Form->input('user_id', ['label' => false, 'id' => 'id_select1', 'values' => $users, 'empty' =>  __('Employee list').' ..', 'class' => 'form-control marginbtn2px']);
                        echo $this->Form->input('client_id', ['label' => false, 'id' => 'id_select2', 'values' => $clients, 'empty' =>  __('Clients list').' ..', 'class' => 'form-control marginbtn2px']);
                        echo $this->Form->input('priority_id', ['label' => false, 'id' => 'id_select3', 'values' => $priorities, 'empty' =>  __('Priorities list').' ..', 'class' => 'form-control marginbtn2px']);
                        echo $this->Form->input('project_stage_id', ['label' => false, 'id' => 'id_select4', 'values' => $projectStages, 'empty' =>  __('Stages list').' ..', 'class' => 'form-control marginbtn2px']);
                        //echo $this->Form->input('project_stage_id', ['label' => false, 'id' => 'id_select4', 'values' => $stages, 'empty' =>  __('Stages list').' ..', 'class' => 'form-control marginbtn2px']);

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
                    <th scope="col"><?= $this->Paginator->sort('accomplishment') ?></th>
                    <!--th scope="col"></?= $this->Paginator->sort('path_doc') ?></th-->
                    <th scope="col" class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($projects as $project): ?>
                <tr>
                    <td><?= h($project->name) ?></td>
                    <td><?= $this->Number->format($project->accomplishment) ?></td>
                    <td><?= h($project->path_doc) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('<i class="fa fa-eye" aria-hidden="true"></i> '.__('View')), ['action' => 'view', $project->id], ['class' => 'btn btn-primary', 'escape' => false]) ?>
                        <?= $this->Html->link(__('<i class="fa fa-pencil" aria-hidden="true"></i> '.__('Edit')), ['action' => 'edit', $project->id], ['class' => 'btn btn-warning', 'escape' => false]) ?>
                        <?= $this->Form->postLink(__('<i class="fa fa-minus-circle" aria-hidden="true"></i> '.__('Delete')), ['action' => 'delete', $project->id], ['class' => 'btn btn-danger', 'escape' => false], ['confirm' => __('Are you sure you want to delete # {0}?', $project->id)]) ?>
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
        echo "initializeIndexProjectPage();";
    $this->Html->scriptEnd();
?>

