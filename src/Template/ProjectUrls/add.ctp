<div class="row-fluid">
    <div class="col-md-12">
        <?= $this->Form->create($projectUrl) ?>
        <fieldset>
            <legend><?= __('Add Url') ?></legend>
            <?php
                echo $this->Form->input('name', ['class' => 'form-control']);
                echo $this->Form->input('url', ['type' => 'text', 'class' => 'form-control']);
                if(!isset($project_id)){
                    echo $this->Form->input('project_id', ['label' => __('Project'), 'options' => $projects, 'class' => 'form-control']);
                }else{
                    echo $this->Form->input('project_id', ['label' => __('Project'), 'options' => $projects, 'value' => $project_id, 'readonly' => true, 'class' => 'form-control']);
                }
            ?>
        </fieldset>
        <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary marginbottom10px']) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
