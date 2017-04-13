<!--
you can substitue the span of reauth email for a input with the email and
include the remember me checkbox
-->

<div class="container">
    <div class="row main">
        <div class="col-sm-6 col-sm-offset-3">
            <div class="panel-heading">
                <div class="panel-title text-center">
                    <h1 class="title"><?=Name_app?></h1>
                    <hr />
                </div>
            </div> 
            <div class="row">
                <?= $this->Flash->render('auth') ?>
                <?= $this->Flash->render() ?>
            </div>
            <div class="main-login main-center">
                <form class="form-horizontal" method="post" action="#">
                <?= $this->Form->create('auth', ['class' => 'form-horizontal']); ?>
                        <div class="form-group">
                                <label for="name" class="cols-sm-2 control-label"><?=__('Email')?></label>
                                <div class="cols-sm-10">
                                        <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
                                                <?= $this->Form->input('email', ['type' => 'email', 'label' => false, 'class' => 'form-control', 'placeholder' => __('Mail Adresse'), 'required' => true, 'autofocus' => true]) ?>
                                        </div>
                                </div>
                        </div>

                        <div class="form-group">
                                <label for="password" class="cols-sm-2 control-label"><?=__('Password')?></label>
                                <div class="cols-sm-10">
                                        <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                                                <?= $this->Form->input('password', ['type' => 'password', 'label' => false, 'class' => 'form-control', 'placeholder' => __('Password')]) ?>
                                        </div>
                                </div>
                        </div>

                        <div class="form-group ">
                                <?= $this->Form->button(__('Register'), ['class' => 'btn btn-primary btn-lg btn-block login-button']); ?>
                        </div>
                        <!--div class="login-register">
                            <a href="index.php">Login</a>
                        </div-->
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>
<!--div class="container">
    
    <div class="col-sm-6 col-sm-offset-3">
        <div class="row">
            </?= $this->Flash->render('auth') ?>
            </?= $this->Flash->render() ?>
        </div>
        </?= $this->Form->create() ?>
            <div class="input-group">
                <span class="input-group-addon" id="sizing-addon2">@</span>
                </?= $this->Form->input('email', ['type' => 'email', 'label' => false, 'class' => 'form-control', 'placeholder' => __('Mail Adresse'), 'required' => true, 'autofocus' => true]) ?>
            </div>
            <div class="input-group">
                <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-user"></span></span>
                </?= $this->Form->input('password', ['type' => 'password', 'label' => false, 'class' => 'form-control', 'placeholder' => __('Password')]) ?>
            </div>
            <br>
            </?= $this->Form->button(__('Login'), ['class' => 'btn btn-lg btn-primary btn-block btn-signin']); ?>
        </?= $this->Form->end() ?>
    </div>
</div-->