<div class="row-fluid">
    <div class="col-md-12">
        <legend>
            <?= h($member->name) ?>
            <div class="pull-right">
                <?= $this->Html->link('<i class="fa fa-list-ul" aria-hidden="true"></i>', ['action' => 'index'], ['escape' => false]) ?>
            </div>
        </legend>
    </div>
</div>
<div class="members view large-9 medium-8 columns content">
    <h3><?= h($member->name) ?></h3>
    <table class="table table-striped table-hover">
        <tr>
            <th scope="row"><?= __('name') ?></th>
            <td><?= h($member->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('LastName') ?></th>
            <td><?= h($member->lastName) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= (!empty($member->authentification)) ? h($member->authentification->email) : '-' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($member->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($member->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($member->description)); ?>
    </div>
</div>
