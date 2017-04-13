<div class="row-fluid">
    <div class="col-md-12">
        <legend>
            <?= h($user->name) ?>
            <div class="pull-right">
                <?= $this->Html->link(__('<i class="fa fa-file-text" aria-hidden="true"></i>'), ['controller' => 'Consult', 'action' => 'viewUserInfo', $user->id], ['escape' => false]) ?>
                <?= $this->Html->link('<i class="fa fa-list-ul" aria-hidden="true"></i>', ['action' => 'index'], ['escape' => false]) ?>
            </div>
        </legend>
        <div class="users view large-9 medium-8 columns content">
            <table class="table table-striped table-hover">
                <tr>
                    <th scope="row"><?= __('name') ?></th>
                    <td><?= h($user->name) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('lastName') ?></th>
                    <td><?= h($user->lastName) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Email') ?></th>
                    <td><?= (!empty($user->authentification->email)) ? h($user->authentification->email) : '-' ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Created') ?></th>
                    <td><?= h($user->created) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Modified') ?></th>
                    <td><?= h($user->modified) ?></td>
                </tr>
            </table>
            <div class="row">
                <h4><?= __('Description') ?></h4>
                <?= (strlen($user->description) > 0) ? $this->Text->autoParagraph(h($user->description)) : __('No .. associated to this', ['e', 'description', 'ce '.__('employee')]); ?>
            </div>
            <div class="row">
                <h4><?= __('Teams') ?></h4>
                <?php if (!empty($user->teams)): ?>
                <table class="table table-striped table-hover">
                    <tr>
                        <th scope="col"><?= __('Name') ?></th>
                        <th scope="col"><?= __('Description') ?></th>
                        <th scope="col" class="actions"><?= __('Actions') ?></th>
                    </tr>
                    <?php foreach ($user->teams as $teams): ?>
                    <tr>
                        <td><?= h($teams->name) ?></td>
                        <td><?= (strlen($teams->description) > 0) ? h($teams->description) : '-' ?></td>
                        <td class="actions">
                            <?= $this->Html->link('<i class="fa fa-eye" aria-hidden="true"></i>'.__('View'), ['controller' => 'Teams', 'action' => 'view', $teams->id], ['class' => 'btn btn-primary', 'escape' => false]) ?>
                            <?= $this->Html->link('<i class="fa fa-pencil" aria-hidden="true"></i>'.__('Edit'), ['controller' => 'Teams', 'action' => 'edit', $teams->id], ['class' => 'btn btn-warning', 'escape' => false]) ?>
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
                            <?= __('No .. associated to this', ['e', __('team'), 'ce '.__('employee')]) ?>
                        </div>
                        
                <?php
                    endif;
                ?>
            </div>
            <div class="row">
                <h4><?= __('Disciplinary actions') ?></h4>
                <?php if (!empty($user->actiondisciplinaires)): ?>
                <table class="table table-striped table-hover">
                    <tr>
                        <th scope="col"><?= __('Id') ?></th>
                        <th scope="col"><?= __('Disciplinary actions') ?></th>
                        <th scope="col" class="actions"><?= __('Actions') ?></th>
                    </tr>
                    <?php foreach ($user->actiondisciplinaires as $actiondisciplinaire): ?>
                    <tr>
                        <td><?= h($actiondisciplinaire->id) ?></td>
                        <td><?= h($actiondisciplinaire->name) ?></td>
                        <td class="actions">
                            <?= $this->Html->link('<i class="fa fa-eye" aria-hidden="true"></i>'.__('View'), ['controller' => 'Actiondisciplinaires', 'action' => 'view', $actiondisciplinaire->id], ['class' => 'btn btn-primary', 'escape' => false]) ?>
                            <?= $this->Html->link('<i class="fa fa-pencil" aria-hidden="true"></i>'.__('Edit'), ['controller' => 'Actiondisciplinaires', 'action' => 'edit', $actiondisciplinaire->id], ['class' => 'btn btn-warning', 'escape' => false]) ?>
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
                            <?= __('No .. associated to this', ['e', __('disciplinary action'), 'ce '.__('employee')]) ?>
                        </div> 
                <?php
                    endif;
                ?>
            </div>
            <div class="row">
                <h4><?= __('Projects') ?></h4>
                <?php if (!empty($user->projects)): ?>
                <table class="table table-striped table-hover">
                    <tr>
                        <th scope="col"><?= __('Id') ?></th>
                        <th scope="col"><?= __('Name') ?></th>
                        <th scope="col" class="actions"><?= __('Actions') ?></th>
                    </tr>
                    <?php foreach ($user->projects as $projects): ?>
                    <tr>
                        <td><?= h($projects->id) ?></td>
                        <td><?= h($projects->name) ?></td>
                        <td class="actions">
                            <?= $this->Html->link('<i class="fa fa-eye" aria-hidden="true"></i>'.__('View'), ['controller' => 'Projects', 'action' => 'view', $projects->id], ['class' => 'btn btn-primary', 'escape' => false]) ?>
                            <?= $this->Html->link('<i class="fa fa-pencil" aria-hidden="true"></i>'.__('Edit'), ['controller' => 'Projects', 'action' => 'edit', $projects->id], ['class' => 'btn btn-warning', 'escape' => false]) ?>
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
                            <?= __('No .. associated to this', ['', __('project'), 'ce '.__('employee')]) ?>
                        </div>
                        
                <?php
                    endif;
                ?>
            </div>
            <div class="row">
                <h4><?= __('Urls') ?></h4>
                <?php if (!empty($user->user_urls)): ?>
                <table class="table table-striped table-hover">
                    <tr>
                        <th scope="col"><?= __('Name') ?></th>
                        <th scope="col"><?= __('Url') ?></th>
                        <th scope="col" class="actions"><?= __('Actions') ?></th>
                    </tr>
                    <?php foreach ($user->user_urls as $url): ?>
                    <tr>
                        <td><?= h($url->name) ?></td>
                        <td><?= $this->Html->link(h($url->url), $url->url, ['target' => '_blank']) ?></td>
                        <td class="actions">
                            <?= $this->Html->link('<i class="fa fa-eye" aria-hidden="true"></i> '.__('View'), ['controller' => 'UserUrls', 'action' => 'view', $url->id], ['class' => 'btn btn-primary', 'escape' => false]) ?>
                            <?= $this->Html->link('<i class="fa fa-pencil" aria-hidden="true"></i> '.__('Edit'), ['controller' => 'UserUrls', 'action' => 'edit', $url->id], ['class' => 'btn btn-warning', 'escape' => false]) ?>
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
                            <?= __('No .. associated to this', ['', __('criterion'), 'ce '.__('employee')]) ?>
                        </div>
                        
                <?php
                    endif;
                ?>
            </div>
            <div class="row">
                <h4><?= __('Reports') ?></h4>
                <?php if (!empty($user->rapports)): ?>
                <table class="table table-striped table-hover">
                    <tr>
                        <th scope="col"><?= __('Id') ?></th>
                        <th scope="col"><?= __('Name') ?></th>
                        <th scope="col"><?= __('Rapport') ?></th>
                        <th scope="col"><?= __('User Id') ?></th>
                        <th scope="col" class="actions"><?= __('Actions') ?></th>
                    </tr>
                    <?php foreach ($user->rapports as $rapports): ?>
                    <tr>
                        <td><?= h($rapports->id) ?></td>
                        <td><?= h($rapports->name) ?></td>
                        <td><?= h($rapports->rapport) ?></td>
                        <td><?= h($rapports->user_id) ?></td>
                        <td class="actions">
                            <?= $this->Html->link('<i class="fa fa-eye" aria-hidden="true"></i> '.__('View'), ['controller' => 'Rapports', 'action' => 'view', $rapports->id], ['class' => 'btn btn-primary', 'escape' => false]) ?>
                            <?= $this->Html->link('<i class="fa fa-pencil" aria-hidden="true"></i> '.__('Edit'), ['controller' => 'Rapports', 'action' => 'edit', $rapports->id], ['class' => 'btn btn-warning', 'escape' => false]) ?>
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
                            <?= __('No .. associated to this', ['', __('report'), 'ce '.__('employee')]) ?>
                        </div>
                        
                <?php
                    endif;
                ?>
            </div>

            <div class="row">
                <h4><?= __('Criterions') ?></h4>
                <?php if (!empty($user->criterions)): ?>
                <table class="table table-striped table-hover">
                    <tr>
                        <th scope="col"><?= __('Name') ?></th>
                        <th scope="col"><?= __('Content') ?></th>
                        <th scope="col"><?= __('Percent') ?></th>
                        <th scope="col" class="actions"><?= __('Actions') ?></th>
                    </tr>
                    <?php foreach ($user->criterions as $criterion): ?>
                    <tr>
                        <td><?= h($criterion->name) ?></td>
                        <td><?= (isset($criterion->_joinData['content'])) ? h($criterion->_joinData['content']) : '-' ?></td>
                        <td><?= (isset($criterion->_joinData['percent'])) ? h($criterion->_joinData['percent']).'%' : '-' ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('<i class="fa fa-eye" aria-hidden="true"></i> '.__('View')), ['controller' => 'Criterions', 'action' => 'view', $criterion->id], ['class' => 'btn btn-primary', 'escape' => false]) ?>
                            <?= $this->Html->link(__('<i class="fa fa-pencil" aria-hidden="true"></i> '.__('Edit')), ['controller' => 'Criterions', 'action' => 'edit', $criterion->id], ['class' => 'btn btn-warning', 'escape' => false]) ?>
                            <?= $this->Form->postLink(__('<i class="fa fa-pencil" aria-hidden="true"></i> '.__('Delete')), ['controller' => 'AssocUsersCriterions', 'action' => 'delete', $criterion->_joinData->id], ['class' => 'btn btn-danger', 'escape' => false], ['confirm' => __('Are you sure you want to delete # {0}?', $criterion->_joinData->id)]) ?>
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
                            <?= __('No .. associated to this', ['', __('criterion'), 'ce '.__('user')]) ?>
                        </div>
                        
                <?php  
                    endif;
                ?>
            </div>
        </div>
    </div>
</div>
