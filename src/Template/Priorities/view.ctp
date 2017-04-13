<div class="row-fluid">
    <div class="col-md-12">
        <legend>
            <?= h($priority->name) ?>
            <div class="pull-right">
                <?= $this->Html->link('<i class="fa fa-list-ul" aria-hidden="true"></i>', ['action' => 'index'], ['escape' => false]) ?>
            </div>
        </legend>
        <div class="priorities view large-9 medium-8 columns content">
            <h3><?= h($priority->name) ?></h3>
            <table class="table table-striped table-hover">
                <tr>
                    <th scope="row"><?= __('Name') ?></th>
                    <td><?= h($priority->name) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Order') ?></th>
                    <td><?= $this->Number->format($priority->order_priority) ?></td>
                </tr>
            </table>
            <div class="row">
                <h4><?= __('Projects') ?></h4>
                <?php if (!empty($priority->projects)): ?>
                <table class="table table-striped table-hover">
                    <tr>
                        <th scope="col"><?= __('Name') ?></th>
                        <th scope="col"><?= __('Accomplishment') ?></th>
                        <th scope="col"><?= __('DateBegin') ?></th>
                        <th scope="col"><?= __('DateEnd') ?></th>
                        <th scope="col" class="actions"><?= __('Actions') ?></th>
                    </tr>
                    <?php foreach ($priority->projects as $projects): ?>
                    <tr>
                        <td><?= h($projects->name) ?></td>
                        <td><?= h($projects->accomplishment) ?></td>
                        <td><?= h($projects->dateBegin) ?></td>
                        <td><?= h($projects->dateEnd) ?></td>
                        <td class="actions">
                            <?= $this->Html->link('<i class="fa fa-eye" aria-hidden="true"></i> '.__('View'), ['controller' => 'Projects', 'action' => 'view', $projects->id], ['class' => 'btn btn-primary', 'escape' => false]) ?>
                            <?= $this->Html->link('<i class="fa fa-pencil" aria-hidden="true"></i> '.__('Edit'), ['controller' => 'Projects', 'action' => 'edit', $projects->id], ['class' => 'btn btn-warning', 'escape' => false]) ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </table>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
