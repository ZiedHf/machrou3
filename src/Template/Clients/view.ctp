<div class="row-fluid">
    <div class="col-md-12">
        <legend>
            <?= h($client->name) ?>
            <div class="pull-right">
                <?= $this->Html->link(__('<i class="fa fa-file-text" aria-hidden="true"></i>'), ['controller' => 'Consult', 'action' => 'viewClientInfo', $client->id], ['escape' => false]) ?>
                <?= $this->Html->link(__('<i class="fa fa-list-ul" aria-hidden="true"></i>'), ['action' => 'index'], ['escape' => false]) ?>
            </div>
        </legend>
        <div class="clients view large-9 medium-8 columns content">
            <table class="table table-striped table-hover">
                <tr>
                    <th scope="row"><?= __('Name') ?></th>
                    <td><?= h($client->name) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('lastName') ?></th>
                    <td><?= h($client->lastName) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Email') ?></th>
                    <td><?= (!empty($client->authentification)) ? h($client->authentification->email) : '-' ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Created') ?></th>
                    <td><?= h($client->created) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Modified') ?></th>
                    <td><?= h($client->modified) ?></td>
                </tr>
            </table>
            <div class="row">
                <h4><?= __('Description') ?></h4>
                <?= (strlen($client->description) > 0) ? $this->Text->autoParagraph(h($client->description)) : __('No .. associated to this', ['e', 'description', 'ce '.__('client')]); ?>
            </div>
            <div class="row">
                <h4><?= __('Projects') ?></h4>
                <?php if (!empty($client->projects)): ?>
                <table class="table table-striped table-hover">
                    <tr>
                        <th scope="col"><?= __('Name') ?></th>
                        <th scope="col" class="actions"><?= __('Actions') ?></th>
                    </tr>
                    <?php foreach ($client->projects as $projects): ?>
                    <tr>
                        <td><?= h($projects->name) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('<i class="fa fa-eye" aria-hidden="true"></i> '.__('View')), ['controller' => 'Projects', 'action' => 'view', $projects->id], ['class' => 'btn btn-primary', 'escape' => false]) ?>
                            <?= $this->Html->link(__('<i class="fa fa-pencil" aria-hidden="true"></i> '.__('Edit')), ['controller' => 'Projects', 'action' => 'edit', $projects->id], ['class' => 'btn btn-warning', 'escape' => false]) ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </table>
                <?php 
                    else:
                ?>
                        <div class="col-md-8 col-md-offset-2 col-sm-12 col-xs-12 alert alert-info margintop10px" role="alert">
                            <i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                            <span class="sr-only"><?= __('Info') ?> :</span>
                            <?= __('No .. associated to this', ['', __('project'), 'ce '.__('client')]) ?>
                        </div> 
                <?php
                    endif;
                ?>
            </div>
        </div>
    </div>
</div>
