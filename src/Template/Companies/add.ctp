<div class="row-fluid">
    <div class="col-md-12">
        <?= $this->Form->create($company) ?>
        <fieldset>
            <legend>
                <?= __('Add Company') ?>
                <div class="pull-right">
                    <?= $this->Html->link(__('<i class="fa fa-list-ul" aria-hidden="true"></i>'), ['action' => 'index'], ['escape' => false]) ?>
                </div>
            </legend>
            <?php
                echo $this->Form->input('name', ['label' => __('Name'), 'class' => 'form-control']);
                echo $this->Form->input('email', ['label' => __('Email'), 'class' => 'form-control']);
                echo $this->Form->input('adresse', ['label' => __('Adresse'), 'class' => 'form-control']);
                echo $this->Form->input('description', ['label' => __('Description'), 'class' => 'form-control']);
            ?>
        </fieldset>
        <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary marginbottom10px']) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
