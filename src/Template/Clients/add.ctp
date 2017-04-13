<div class="row-fluid">
    <div class="col-md-12">
        <?= $this->Form->create($client) ?>
        <fieldset>
            <legend>
                <?= __('Add Client') ?>
                <div class="pull-right">
                    <?= $this->Html->link(__('<i class="fa fa-list-ul" aria-hidden="true"></i>'), ['action' => 'index'], ['escape' => false]) ?>
                </div>
            </legend>
            <?php
                echo $this->Form->input('name', ['label' => __('name'), 'class' => 'form-control']);
                echo $this->Form->input('lastName', ['label' => __('Name'), 'class' => 'form-control']);
                echo $this->Form->input('password', ['label' => __('Password'), 'class' => 'form-control']);
                echo $this->Form->input('email', ['label' => __('Email'), 'class' => 'form-control']);
                echo $this->Form->input('description', ['label' => __('Description'), 'class' => 'form-control']);
                echo $this->Form->input('projects._ids', ['label' => __('Projects'), 'options' => $projects, 'multiple' => 'multiple', 'class' => 'form-control']);
                echo $this->Form->input('path_image', ['label' => __('Image'), 'id' => 'filer_input', 'type' => 'file', 'class' => 'form-control']);
            ?>
        </fieldset>
        <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary marginbottom10px']) ?>
        <?= $this->Form->end() ?>

        <?php
            $this->Html->css('../js/jQuery.filer-1.3.0/css/jquery.filer.css', ['block' => true]);
            $this->Html->css('../js/jQuery.filer-1.3.0/css/themes/jquery.filer-dragdropbox-theme.css', ['block' => true]);
            $this->Html->script('jQuery.filer-1.3.0/js/jquery.filer.min.js', ['block' => true]);
            $this->Html->scriptStart(['block' => true]);
                echo "initializeAddClientPage();";
            $this->Html->scriptEnd();
        ?>
    </div>
</div>

