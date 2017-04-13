<div class="row-fluid">
    <div class="col-md-12">
        <?= $this->Form->create($client) ?>
        <fieldset>
            <legend><?= __('Edit Client') ?></legend>
            <?php
                echo $this->Form->input('name', ['label' => __('name'), 'class' => 'form-control']);
                echo $this->Form->input('lastName', ['label' => __('Nom'), 'class' => 'form-control']);
                echo $this->Form->input('password', ['label' => __('Password'), 'class' => 'form-control']);
                echo $this->Form->input('email', ['label' => __('Email'), 'value' => (!empty($client->authentification->email)) ? $client->authentification->email : '', 'class' => 'form-control']);
                echo $this->Form->input('description', ['label' => __('Description'), 'class' => 'form-control']);
                echo $this->Form->input('path_image', ['label' => __('Image'), 'id' => 'filer_input', 'type' => 'file', 'class' => 'form-control']);
            ?>
        </fieldset>
        <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary margintop10px marginbottom10px']) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
<?php
    $this->Html->css('../js/jQuery.filer-1.3.0/css/jquery.filer.css', ['block' => true]);
    $this->Html->css('../js/jQuery.filer-1.3.0/css/themes/jquery.filer-dragdropbox-theme.css', ['block' => true]);
    $this->Html->script('jQuery.filer-1.3.0/js/jquery.filer.min.js', ['block' => true]);
    $this->Html->scriptStart(['block' => true]);
        echo "initializeEditClientPage();";
    $this->Html->scriptEnd();
?>