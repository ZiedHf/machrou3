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
                                <?=$this->Html->link('Accueil', ['controller' => 'consult', 'action' => 'index'])?>
                                >
                                <?=__('Employees')?>
                            </div>
                        </div>
                  	<div class="row">
                            <div class="col-md-12 col-sm-12">
                                <h2><?=__('Employees')?> <span class="badge"><?=$numberEmp?></span></h2>
                                <table id="employeesTable" class="table table-bordered row-border hover order-column">
                                    <thead>
                                        <tr>
                                            <th><?=__('Name')?></th>
                                            <th><?=__('Email')?></th>
                                            <th><?=__('Description')?></th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th><?=__('Name')?></th>
                                            <th><?=__('Email')?></th>
                                            <th><?=__('Description')?></th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php foreach ($employees as $key => $employee) { ?>
                                        <tr>
                                            <td><?=$this->Html->link($employee->name.' '.$employee->lastName, ['controller' => 'consult', 'action' => 'viewUserInfo', $employee->id])?></td>
                                            <td><?= (!empty($employee->authentification->email)) ? $employee->authentification->email : '-' ?></td>
                                            <td><?=(empty($employee->description)) ? '-' : $employee->description ?></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                  	</div>	
                  </div>
                  
                  
      <!-- **********************************************************************************************************************************************************
      RIGHT SIDEBAR CONTENT
      *********************************************************************************************************************************************************** -->                  
                  
                  <!--Notifications-->
                    <?= $this->cell('Slider') ?>
                  
              </div><!--/row -->
          </section>
      </section>
      
<?php
    $this->Html->css('../js/datatables/datatables.min.css', ['block' => true]);
    $this->Html->script('datatables/datatables.min', ['block' => true]);
    $this->Html->scriptStart(['block' => true]);
        echo "initializeConsultEmployeesListPage();";
    $this->Html->scriptEnd();
?>      