<div class="row-fluid">
    <div class="col-md-12">
        <legend>
            <?= h($criterion->name) ?>
            <div class="pull-right">
                <?= $this->Html->link(__('<i class="fa fa-list-ul" aria-hidden="true"></i>'), ['action' => 'index'], ['escape' => false]) ?>
            </div>
        </legend>
        <div class="criterions view large-9 medium-8 columns content">
            <table class="table table-striped table-hover">
                <tr>
                    <th scope="row"><?= __('Name') ?></th>
                    <td><?= h($criterion->name) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Type') ?></th>
                    <td><?= h($criterion->type) ?></td>
                </tr>
            </table>
            <div class="row">
                <h4><?= __('Related Assoc Projects Criterions') ?></h4>
                <?php if (!empty($criterion->assoc_projects_criterions)): ?>
                <table cellpadding="0" cellspacing="0">
                    <tr>
                        <th scope="col"><?= __('Id') ?></th>
                        <th scope="col"><?= __('Product Id') ?></th>
                        <th scope="col"><?= __('Criterion Id') ?></th>
                        <th scope="col"><?= __('Content') ?></th>
                        <th scope="col" class="actions"><?= __('Actions') ?></th>
                    </tr>
                    <?php foreach ($criterion->assoc_projects_criterions as $assocProjectsCriterions): ?>
                    <tr>
                        <td><?= h($assocProjectsCriterions->id) ?></td>
                        <td><?= h($assocProjectsCriterions->project_id) ?></td>
                        <td><?= h($assocProjectsCriterions->criterion_id) ?></td>
                        <td><?= h($assocProjectsCriterions->content) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['controller' => 'AssocProjectsCriterions', 'action' => 'view', $assocProjectsCriterions->id]) ?>
                            <?= $this->Html->link(__('Edit'), ['controller' => 'AssocProjectsCriterions', 'action' => 'edit', $assocProjectsCriterions->id]) ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </table>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
