<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $assocDepartementsCriterion->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $assocDepartementsCriterion->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Assoc Departements Criterions'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Departements'), ['controller' => 'Departements', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Departement'), ['controller' => 'Departements', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Criterions'), ['controller' => 'Criterions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Criterion'), ['controller' => 'Criterions', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="assocDepartementsCriterions form large-9 medium-8 columns content">
    <?= $this->Form->create($assocDepartementsCriterion) ?>
    <fieldset>
        <legend><?= __('Edit Assoc Departements Criterion') ?></legend>
        <?php
            echo $this->Form->input('departement_id', ['options' => $departements]);
            echo $this->Form->input('criterion_id', ['options' => $criterions]);
            echo $this->Form->input('content');
            echo $this->Form->input('percent');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary marginbottom10px']) ?>
    <?= $this->Form->end() ?>
</div>
