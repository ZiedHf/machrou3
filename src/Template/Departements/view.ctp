<div class="row-fluid">
    <div class="col-md-12">
        <legend>
            <?= h($departement->name) ?>
            <div class="pull-right">
                <?= $this->Html->link(__('<i class="fa fa-file-text" aria-hidden="true"></i>'), ['controller' => 'Consult', 'action' => 'viewDepartement', $departement->id], ['escape' => false]) ?>
                <?= $this->Html->link(__('<i class="fa fa-list-ul" aria-hidden="true"></i>'), ['action' => 'index'], ['escape' => false]) ?>
            </div>
        </legend>
        <div class="departements view large-9 medium-8 columns content">
            <table class="table table-striped table-hover">
                <tr>
                    <th scope="row"><?= __('Name') ?></th>
                    <td><?= h($departement->name) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Companies') ?></th>
                    <td><?= $departement->has('company') ? $this->Html->link($departement->company->name, ['controller' => 'Companies', 'action' => 'view', $departement->company->id]) : '' ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Created') ?></th>
                    <td><?= h($departement->created) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Modified') ?></th>
                    <td><?= h($departement->modified) ?></td>
                </tr>
            </table>
            <div class="row">
                <h4><?= __('Description') ?></h4>
                <?= (strlen($departement->description) > 0) ? $this->Text->autoParagraph(h($departement->description)) : __('No .. associated to this', ['e', 'description', 'ce '.__('departement')]); ?>
            </div>
            <div class="row">
                <h4><?= __('Teams') ?></h4>
                <?php if (!empty($departement->teams)): ?>
                <table class="table table-striped table-hover">
                    <tr>
                        <th scope="col"><?= __('Name') ?></th>
                        <th scope="col"><?= __('Description') ?></th>
                        <th scope="col" class="actions"><?= __('Actions') ?></th>
                    </tr>
                    <?php foreach ($departement->teams as $teams): ?>
                    <tr>
                        <td><?= h($teams->name) ?></td>
                        <td><?= h($teams->description) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('<i class="fa fa-eye" aria-hidden="true"></i> '.__('View')), ['controller' => 'Teams', 'action' => 'view', $teams->id], ['class' => 'btn btn-primary', 'escape' => false]) ?>
                            <?= $this->Html->link(__('<i class="fa fa-pencil" aria-hidden="true"></i> '.__('Edit')), ['controller' => 'Teams', 'action' => 'edit', $teams->id], ['class' => 'btn btn-warning', 'escape' => false]) ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </table>
                <?php
                    else:
                ?>
                        <div class="col-md-8 col-md-offset-2 col-sm-12 col-xs-12 alert alert-info margintop10px" role="alert">
                            <i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                            <span class="sr-only"><?=__('Info');?> :</span>
                            <?= __('No .. associated to this', ['e', __('team'), 'ce '.__('departement')]) ?>
                        </div>
                <?php
                    endif;
                ?>
            </div>


            <div class="row">
                <h4><?= __('Criterions') ?></h4>
                <?php if (!empty($departement->criterions)): ?>
                <table class="table table-striped table-hover">
                    <tr>
                        <th scope="col"><?= __('Name') ?></th>
                        <th scope="col"><?= __('Content') ?></th>
                        <th scope="col"><?= __('Note') ?></th>
                        <th scope="col" class="actions"><?= __('Actions') ?></th>
                    </tr>
                    <?php foreach ($departement->criterions as $criterion): ?>
                    <tr>
                        <td><?= h($criterion->name) ?></td>
                        <td><?= (isset($criterion->_joinData['content'])) ? h($criterion->_joinData['content']) : '-' ?></td>
                        <td><?= (isset($criterion->_joinData['percent'])) ? h($criterion->_joinData['percent']).'%' : '-' ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('<i class="fa fa-eye" aria-hidden="true"></i> '.__('View')), ['controller' => 'Criterions', 'action' => 'view', $criterion->id], ['class' => 'btn btn-primary', 'escape' => false]) ?>
                            <?= $this->Html->link(__('<i class="fa fa-pencil" aria-hidden="true"></i> '.__('Edit')), ['controller' => 'Criterions', 'action' => 'edit', $criterion->id], ['class' => 'btn btn-warning', 'escape' => false]) ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </table>
                <?php
                    else:
                ?>
                        <div class="col-md-8 col-md-offset-2 col-sm-12 col-xs-12 alert alert-info margintop10px" role="alert">
                            <i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                            <span class="sr-only"><?=__('Info');?> :</span>
                            <?= __('No .. associated to this', ['', __('criterion'), 'ce '.__('departement')]) ?>
                        </div>
                <?php
                    endif;
                ?>
            </div>
        </div>
    </div>
</div>
