<div class="row-fluid">
    <div class="col-md-12">
        <legend>
            <?= h($projectUrl->name) ?>
            <div class="pull-right">
                <?= $this->Html->link('<i class="fa fa-list-ul" aria-hidden="true"></i>', ['action' => 'index'], ['escape' => false]) ?>
            </div>
        </legend>
        <div class="projectUrls view large-9 medium-8 columns content">
            <h3><?= h($projectUrl->name) ?></h3>
            <table class="table table-striped table-hover">
                <tr>
                    <th scope="row"><?= __('Name') ?></th>
                    <td><?= h($projectUrl->name) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Project') ?></th>
                    <td><?= $projectUrl->has('project') ? $this->Html->link($projectUrl->project->name, ['controller' => 'Projects', 'action' => 'view', $projectUrl->project->id]) : '' ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Url') ?></th>
                    <td>
                    <?= $this->Html->link(h($projectUrl->url), $projectUrl->url, ['target' => '_blank']) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
