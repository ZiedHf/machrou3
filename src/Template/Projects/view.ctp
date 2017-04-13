<div class="row-fluid">
    <div class="col-md-12">
        <legend>
            <?= h($project->name) ?>
            <div class="pull-right">
                <?= $this->Html->link(__('<i class="fa fa-link" aria-hidden="true"></i>'), ['controller' => 'ProjectUrls', 'action' => 'add', $project->id], ['escape' => false]) ?>
                <?= $this->Html->link(__('<i class="fa fa-file-text" aria-hidden="true"></i>'), ['controller' => 'Consult', 'action' => 'viewProjectInfo', 0, $project->id], ['escape' => false]) ?>
                <?= $this->Html->link(__('<i class="fa fa-list-ul" aria-hidden="true"></i>'), ['action' => 'index'], ['escape' => false]) ?>
            </div>
        </legend>
        <div class="projects view large-9 medium-8 columns content">
            <table class="table table-striped table-hover">
                <tr>
                    <th scope="row"><?= __('Name') ?></th>
                    <td><?= h($project->name) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('ProjectManager') ?></th>
                    <td><?= (empty($projectManager)) ? '-' :  $this->Html->link(h($projectManager->name.' '.$projectManager->lastName), ['controller' => 'Users', 'action' => 'view', $projectManager->id]) ?>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Accomplishment') ?></th>
                    <td><?= $this->Number->format($project->accomplishment) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Priorities') ?></th>
                    <td><?= (empty($project->priority)) ? '-' : h($project->priority->name) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Stages') ?></th>
                    <td><?= (empty($project->project_stage)) ? '-' : h($project->project_stage->name) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Date Begin') ?></th>
                    <td><?= (isset($project->dateBegin)) ? h($project->dateBegin) : '-' ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Date End') ?></th>
                    <td><?= (isset($project->dateEnd)) ? h($project->dateEnd) : '-' ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Created') ?></th>
                    <td><?= h($project->created) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Modified') ?></th>
                    <td><?= h($project->modified) ?></td>
                </tr>
            </table>
            <div class="row">
                <h4><?= __('Description') ?></h4>
                <?= (strlen($project->description) > 0) ? $this->Text->autoParagraph(h($project->description)) : __('No .. associated to this', ['e', __('description'), 'ce '.__('project')]); ?>
            </div>
            <div class="row">
                <h4><?= __('Objective') ?></h4>
                <?= (strlen($project->objective) > 0) ? $this->Text->autoParagraph(h($project->objective)) : __('No .. associated to this', ['e', __('objective'), 'ce '.__('project')]); ?>
            </div>
            <div class="row">
                <h4><?= __('Teams') ?></h4>
                <?php if (!empty($project->teams)): ?>
                <table class="table table-striped table-hover">
                    <tr>
                        <th scope="col"><?= __('Name') ?></th>
                        <th scope="col" class="actions"><?= __('Actions') ?></th>
                    </tr>
                    <?php foreach ($project->teams as $team): ?>
                    <tr>
                        <td><?= h($team->name) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('<i class="fa fa-eye" aria-hidden="true"></i> '.__('View')), ['controller' => 'Teams', 'action' => 'view', $team->id], ['class' => 'btn btn-primary', 'escape' => false]) ?>
                            <?= $this->Html->link(__('<i class="fa fa-pencil" aria-hidden="true"></i> '.__('Edit')), ['controller' => 'Teams', 'action' => 'edit', $team->id], ['class' => 'btn btn-warning', 'escape' => false]) ?>
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
                            <?= __('No .. associated to this', ['e', __('team'), 'ce '.__('project')]) ?>
                        </div> 
                <?php
                    endif;
                ?>
            </div>

            <div class="row">
                <h4><?= __('Users') ?></h4>
                <?php if (!empty($project->users)): ?>
                <table class="table table-striped table-hover">
                    <tr>
                        <th scope="col"><?= __('Name') ?></th>
                        <th scope="col"><?= __('Time dedicated') ?></th>
                        <th scope="col" class="actions"><?= __('Actions') ?></th>
                    </tr>
                    <?php foreach ($project->users as $user): ?>
                    <tr>
                        <td><?= h($user->name) ?></td>
                        <td><?= (isset($user->_joinData['time_dedicated'])) ? h($user->_joinData['time_dedicated']).'%' : '-' ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('<i class="fa fa-eye" aria-hidden="true"></i> '.__('View')), ['controller' => 'Users', 'action' => 'view', $user->id], ['class' => 'btn btn-primary', 'escape' => false]) ?>
                            <?= $this->Html->link(__('<i class="fa fa-pencil" aria-hidden="true"></i> '.__('Edit')), ['controller' => 'Users', 'action' => 'edit', $user->id], ['class' => 'btn btn-warning', 'escape' => false]) ?>
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
                            <?= __('No .. associated to this', ['', __('employé'), 'ce '.__('project')]) ?>
                        </div> 
                <?php
                    endif;
                ?>
            </div>

            <div class="row">
                <h4><?= __('Clients') ?></h4>
                <?php if (!empty($project->clients)): ?>
                <table class="table table-striped table-hover">
                    <tr>
                        <th scope="col"><?= __('Name') ?></th>
                        <th scope="col" class="actions"><?= __('Actions') ?></th>
                    </tr>
                    <?php foreach ($project->clients as $client): ?>
                    <tr>
                        <td><?= h($client->name.' '.$client->lastName) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('<i class="fa fa-eye" aria-hidden="true"></i> '.__('View')), ['controller' => 'Clients', 'action' => 'view', $client->id], ['class' => 'btn btn-primary', 'escape' => false]) ?>
                            <?= $this->Html->link(__('<i class="fa fa-pencil" aria-hidden="true"></i> '.__('Edit')), ['controller' => 'Clients', 'action' => 'edit', $client->id], ['class' => 'btn btn-warning', 'escape' => false]) ?>
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
                            <?= __('No .. associated to this', ['', __('client'), 'ce '.__('project')]) ?>
                        </div> 
                <?php
                    endif;
                ?>
            </div>

            <div class="row">
                <h4><?= __('Urls') ?></h4>
                <?php if (!empty($project->project_urls)): ?>
                <table class="table table-striped table-hover">
                    <tr>
                        <th scope="col"><?= __('Name') ?></th>
                        <th scope="col"><?= __('Url') ?></th>
                        <th scope="col" class="actions"><?= __('Actions') ?></th>
                    </tr>
                    <?php foreach ($project->project_urls as $url): ?>
                    <tr>
                        <td><?= h($url->name) ?></td>
                        <td><?= $this->Html->link(h($url->url), $url->url, ['target' => '_blank']) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('<i class="fa fa-eye" aria-hidden="true"></i> '.__('View')), ['controller' => 'ProjectUrls', 'action' => 'view', $url->id], ['class' => 'btn btn-primary', 'escape' => false]) ?>
                            <?= $this->Html->link(__('<i class="fa fa-pencil" aria-hidden="true"></i> '.__('Edit')), ['controller' => 'ProjectUrls', 'action' => 'edit', $url->id], ['class' => 'btn btn-warning', 'escape' => false]) ?>
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
                            <?= __('No .. associated to this', ['', __('url'), 'ce '.__('project')]) ?>
                        </div> 
                <?php
                    endif;
                ?>
            </div>

            <div class="row">
                <h4><?= __('Criterions') ?></h4>
                <?php if (!empty($project->criterions)): ?>
                <table class="table table-striped table-hover">
                    <tr>
                        <th scope="col"><?= __('Name') ?></th>
                        <th scope="col"><?= __('Content') ?></th>
                        <th scope="col"><?= __('Note') ?></th>
                        <th scope="col" class="actions"><?= __('Actions') ?></th>
                    </tr>
                    <?php foreach ($project->criterions as $criterion): ?>
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
                            <?= __('No .. associated to this', ['', __('criterion'), 'ce '.__('project')]) ?>
                        </div> 
                <?php
                    endif;
                ?>
            </div>
        </div>
    </div>
</div>
