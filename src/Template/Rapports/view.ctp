<div class="row-fluid">
    <div class="col-md-12">
        <legend>
            <?= h($rapport->name) ?>
            <div class="pull-right">
                <?= $this->Html->link(__('<i class="fa fa-list-ul" aria-hidden="true"></i>'), ['action' => 'index'], ['escape' => false]) ?>
            </div>
        </legend>
        <div class="rapports view large-9 medium-8 columns content">
            <table class="table table-striped table-hover">
                <tr>
                    <th scope="row"><?= __('Name') ?></th>
                    <td><?= h($rapport->name) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('User') ?></th>
                    <td><?= $rapport->has('user') ? $this->Html->link($rapport->user->name, ['controller' => 'Users', 'action' => 'view', $rapport->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Id') ?></th>
                    <td><?= $this->Number->format($rapport->id) ?></td>
                </tr>
            </table>
            <div class="row">
                <h4><?= __('Rapport') ?></h4>
                <?= $this->Text->autoParagraph(h($rapport->rapport)); ?>
            </div>
        </div>
    </div>
</div>
