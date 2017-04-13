<div class="row-fluid">
    <div class="col-md-12">
        <legend>
            <?= h($company->name) ?>
            <div class="pull-right">
                <!--?= $this->Html->link(__('<i class="fa fa-file-text" aria-hidden="true"></i>'), ['controller' => 'Consult', 'action' => 'viewClientInfo', $client->id], ['escape' => false]) ?-->
                <?= $this->Html->link(__('<i class="fa fa-list-ul" aria-hidden="true"></i>'), ['action' => 'index'], ['escape' => false]) ?>
            </div>
        </legend>
        <div class="companies view large-9 medium-8 columns content">
            <table class="table table-striped table-hover">
                <tr>
                    <th scope="row"><?= __('Name') ?></th>
                    <td><?= h($company->name) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Email') ?></th>
                    <td><?= h($company->email) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Adresse') ?></th>
                    <td><?= h($company->adresse) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Created By') ?></th>
                    <td><?= $this->Number->format($company->created_by) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Modified By') ?></th>
                    <td><?= $this->Number->format($company->modified_by) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Created') ?></th>
                    <td><?= h($company->created) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Modified') ?></th>
                    <td><?= h($company->modified) ?></td>
                </tr>
            </table>
            <div class="row">
                <h4><?= __('Description') ?></h4>
                <?= $this->Text->autoParagraph(h($company->description)); ?>
            </div>
            
            <div class="related">
                <h4><?= __('Departements') ?></h4>
                <?php if (!empty($company->departements)): ?>
                <table class="table table-striped table-hover">
                    <tr>
                        <th scope="col"><?= __('Name') ?></th>
                        <th scope="col"><?= __('Created') ?></th>
                        <th scope="col" class="actions"><?= __('Actions') ?></th>
                    </tr>
                    <?php foreach ($company->departements as $departements): ?>
                    <tr>
                        <td><?= h($departements->name) ?></td>
                        <td><?= h($departements->created) ?></td>
                        <td class="actions">
                            <?= $this->Html->link('<i class="fa fa-eye" aria-hidden="true"></i> '.__('View'), ['controller' => 'Departements', 'action' => 'view', $departements->id], ['class' => 'btn btn-primary', 'escape' => false]) ?>
                            <?= $this->Html->link('<i class="fa fa-pencil" aria-hidden="true"></i> '.__('Edit'), ['controller' => 'Departements', 'action' => 'edit', $departements->id], ['class' => 'btn btn-warning', 'escape' => false]) ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </table>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
