<div class="row-fluid">
    <div class="col-md-12">
        <legend>
            <?= h($team->name) ?>
            <div class="pull-right">
                <?= $this->Html->link(__('<i class="fa fa-file-text" aria-hidden="true"></i>'), ['controller' => 'Consult', 'action' => 'viewTeamInfo', $team->id], ['escape' => false]) ?>
                <?= $this->Html->link(__('<i class="fa fa-list-ul" aria-hidden="true"></i>'), ['action' => 'index'], ['escape' => false]) ?>
            </div>
        </legend>
        <div class="teams view large-9 medium-8 columns content">
            <table class="table table-striped table-hover">
                <tr>
                    <th scope="row"><?= __('Name') ?></th>
                    <td><?= h($team->name) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Departement') ?></th>
                    <td><?= $team->has('departement') ? $this->Html->link($team->departement->name, ['controller' => 'Departements', 'action' => 'view', $team->departement->id]) : '' ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Company') ?></th>
                    <td><?= $team->departement->has('company') ? $this->Html->link($team->departement->company->name, ['controller' => 'Comapnies', 'action' => 'view', $team->departement->company->id]) : '' ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Created') ?></th>
                    <td><?= h($team->created) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Modified') ?></th>
                    <td><?= h($team->modified) ?></td>
                </tr>
            </table>
            <div class="row">
                <h4><?= __('Description') ?></h4>
                <?= (strlen($team->description) > 0) ? $this->Text->autoParagraph(h($team->description)) : __('No .. associated to this', ['e', 'description', 'cette '.__('team')]); ?>
            </div>
            <div class="row">
                <h4><?= __('Projects') ?></h4>
                <?php if (!empty($team->projects)): ?>
                <table class="table table-striped table-hover">
                    <tr>
                        <th scope="col"><?= __('Name') ?></th>
                        <th scope="col" class="actions"><?= __('Actions') ?></th>
                    </tr>
                    <?php foreach ($team->projects as $project): ?>
                    <tr>
                        <td><?= h($project->name) ?></td>
                        <td class="actions">
                            <?= $this->Html->link('<i class="fa fa-eye" aria-hidden="true"></i> '.__('View'), ['controller' => 'Projects', 'action' => 'view', $project->id], ['class' => 'btn btn-primary', 'escape' => false]) ?>
                            <?= $this->Html->link('<i class="fa fa-pencil" aria-hidden="true"></i> '.__('Edit'), ['controller' => 'Projects', 'action' => 'edit', $project->id], ['class' => 'btn btn-warning', 'escape' => false]) ?>
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
                            <?= __('No .. associated to this', ['', __('project'), 'cette '.__('team')]) ?>
                        </div>
                        
                <?php  
                    endif;
                ?>
            </div>
            <div class="row">
                <h4><?= __('Users') ?></h4>
                <?php if (!empty($team->users)): ?>
                <table class="table table-striped table-hover">
                    <tr>
                        <th scope="col"><?= __('Name') ?></th>
                        <th scope="col" class="actions"><?= __('Actions') ?></th>
                    </tr>
                    <?php foreach ($team->users as $user): ?>
                    <tr>
                        <td><?= h($user->name) ?></td>
                        <td class="actions">
                            <?= $this->Html->link('<i class="fa fa-eye" aria-hidden="true"></i> '.__('View'), ['controller' => 'Users', 'action' => 'view', $user->id], ['class' => 'btn btn-primary', 'escape' => false]) ?>
                            <?= $this->Html->link('<i class="fa fa-pencil" aria-hidden="true"></i> '.__('Edit'), ['controller' => 'Users', 'action' => 'edit', $user->id], ['class' => 'btn btn-warning', 'escape' => false]) ?>
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
                            <?= __('No .. associated to this', ['e', __('employee'), 'cette '.__('team')]) ?>
                        </div>
                        
                <?php    
                    endif;
                ?>
            </div>

            <div class="row">
                <h4><?= __('Criterions') ?></h4>
                <?php if (!empty($team->criterions)): ?>
                <table class="table table-striped table-hover">
                    <tr>
                        <th scope="col"><?= __('Name') ?></th>
                        <th scope="col"><?= __('Content') ?></th>
                        <th scope="col"><?= __('Note') ?></th>
                        <th scope="col" class="actions"><?= __('Actions') ?></th>
                    </tr>
                    <?php foreach ($team->criterions as $criterion): ?>
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
                            <?= __('No .. associated to this', ['', __('criterion'), 'cette '.__('team')]) ?>
                        </div>
                        
                <?php    
                    endif;
                ?>
            </div>
        </div>
    </div>
</div>
