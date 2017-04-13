      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">
              <div class="row">
                    <div class="col-lg-9 main-chart page_white">
                        <div class="row">
                            <div class="col-xs-12">
                                  <?= $this->Flash->render('auth') ?>
                                  <?= $this->Flash->render() ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <?=$this->Html->link(__('Home'), ['controller' => 'consult', 'action' => 'index'])?>
                                >
                                <?=$this->Html->link(__('Employees list'), ['controller' => 'consult', 'action' => 'employeesList'])?>
                                >
                                <?php echo "$user->name $user->lastName"; ?>
                            </div>
                        </div>

                          <?php
                              echo $this->element('pagedata/userinfo', ['user' => $user]);
                          ?>
                    </div>
                  
                  
      <!-- **********************************************************************************************************************************************************
      RIGHT SIDEBAR CONTENT
      *********************************************************************************************************************************************************** -->                  
                  
                    <!--Notifications-->
                    <?= $this->cell('Slider') ?>
                  
              </div><!--/row -->
          </section>
      </section>

<link rel="stylesheet" type="text/css" href=""/>
 
<script type="text/javascript" src=""></script>      
<?php
    $this->Html->css('../js/datatables/datatables.min.css', ['block' => true]);
    $this->Html->script('datatables/datatables.min', ['block' => true]);
        
    $this->Html->scriptStart(['block' => true]);
        echo "pageName = 'ViewUserInfo';";
        echo "initializeConsultViewUserPage(pageName);";
    $this->Html->scriptEnd();
?>      