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
                                <?=__('Departements')?>
                            </div>
                        </div>
                  	<div class="row">
                            <div class="col-md-12 col-sm-12">
                                <h2><?=__('Departements')?> <span class="badge"><?=$numberDepartements?></span></h2>
                                <table id="departementsTable" class="table table-bordered display" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th><?=__('Departements')?></th>
                                            <th><?=__('Company')?></th>
                                            <th><?=__('Employees')?></th>
                                            <th><?=__('Teams number')?></th>
                                            <th><?=__('Employees number')?></th>
                                            <th><?=__('Projects number')?></th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th><?=__('Departements')?></th>
                                            <th><?=__('Company')?></th>
                                            <th><?=__('Employees')?></th>
                                            <th><?=__('Teams number')?></th>
                                            <th><?=__('Employees number')?></th>
                                            <th><?=__('Projects number')?></th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php foreach ($departements as $key => $departement) { ?>
                                            <tr>
                                                <td><?=$this->Html->link($departement->name, ['controller' => 'consult', 'action' => 'viewDepartement', $departement->id])?></td>
                                                <td><?=$departement->company->name?></td>
                                                <td>
                                                    <?php
                                                        if(!empty($departement->employees)){
                                                            $lastUser = end($departement->employees);
                                                            foreach ($departement->employees as $key => $employee){
                                                                if($lastUser == $employee){
                                                                    echo $this->Html->link($employee['name'], ['controller' => 'consult', 'action' => 'viewUser', $departement->id, $employee['id']]).'.';
                                                                }else{
                                                                    echo $this->Html->link($employee['name'], ['controller' => 'consult', 'action' => 'viewUser', $departement->id, $employee['id']]).', ';
                                                                }
                                                            }
                                                        }else{
                                                            echo '-';
                                                        }
                                                    ?>
                                                </td>
                                                <td><?=$departement->numberTeams?></td>
                                                <td><?=$departement->numberUsers?></td>
                                                <td><?=$departement->numberProjects?></td>
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
        echo "initializeDepartementsListPage();";
    $this->Html->scriptEnd();
?>      