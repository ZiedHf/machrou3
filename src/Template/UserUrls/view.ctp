<div class="row-fluid">
    <div class="col-md-12">
        <legend>
            <?= h($userUrl->name) ?>
            <div class="pull-right">
                <?= $this->Html->link('<i class="fa fa-list-ul" aria-hidden="true"></i>', ['action' => 'index'], ['escape' => false]) ?>
            </div>
        </legend>
        <div class="userUrls view large-9 medium-8 columns content">
            <h3><?= h($userUrl->name) ?></h3>
            <table class="table table-striped table-hover">
                <tr>
                    <th scope="row"><?= __('Name') ?></th>
                    <td><?= h($userUrl->name) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('User') ?></th>
                    <td><?= $userUrl->has('user') ? $this->Html->link($userUrl->user->name, ['controller' => 'Users', 'action' => 'view', $userUrl->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Url') ?></th>
                    <td>
                    <?= $this->Html->link(h($userUrl->url), $userUrl->url, ['target' => '_blank']) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
