<div class="row-fluid">
    <div class="col-md-12">
        <?= $this->Form->create($member, ['enctype' => 'multipart/form-data']) ?>
        <fieldset>
            <legend>
                <?= __('Edit Member') ?>
                <div class="pull-right">
                    <?= $this->Html->link(__('<i class="fa fa-list-ul" aria-hidden="true"></i>'), ['action' => 'index'], ['escape' => false]) ?>
                </div>
            </legend>
            <?php
                echo $this->Form->input('name', ['label' => __('name'), 'class' => 'form-control']);
                echo $this->Form->input('lastName', ['label' => __('lastName'), 'class' => 'form-control']);
                echo $this->Form->input('password', ['label' => __('Password'), 'placeholder' => __('Your Password'), 'class' => 'form-control']);
                echo $this->Form->input('authentification.email', ['label' => __('Email'), 'class' => 'form-control']);
                echo $this->Form->input('authentification.type', ['type' => 'hidden', 'value' => 'member']);
                echo $this->Form->input('description', ['label' => __('description'), 'class' => 'form-control']);
                echo $this->Form->input('path_image');
            ?>
        </fieldset>
        <?= $this->Form->button(__('Submit')) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
