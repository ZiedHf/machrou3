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
                                <h2><?=__('Departements')?> <span class="badge"><?=$numberCompanies?></span></h2>
                                <table id="companiesTable" class="table table-bordered display" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th><?=__('Company')?></th>
                                            <th><?=__('Email')?></th>
                                            <th><?=__('Adresse')?></th>
                                            <th><?=__('Departements')?></th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th><?=__('Company')?></th>
                                            <th><?=__('Email')?></th>
                                            <th><?=__('Adresse')?></th>
                                            <th><?=__('Departements')?></th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php foreach ($companies as $key => $company) { ?>
                                            <tr>
                                                <td><?=$company->name?></td>
                                                <td><?=$company->email?></td>
                                                <td><?=$company->adresse?></td>
                                                <td>
                                                    <?php
                                                        if(!empty($company->departements)){
                                                            $lastDep = end($company->departements);
                                                            foreach ($company->departements as $key => $departement){
                                                                if($lastDep == $departement){
                                                                    echo $this->Html->link($departement['name'], ['controller' => 'consult', 'action' => 'viewDepartement', $departement->id]).'.';
                                                                }else{
                                                                    echo $this->Html->link($departement['name'], ['controller' => 'consult', 'action' => 'viewDepartement', $departement->id]).', ';
                                                                }
                                                            }
                                                        }else{
                                                            echo '-';
                                                        }
                                                    ?>
                                                </td>
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
        echo "initializeCompaniesListPage();";
    $this->Html->scriptEnd();
?>      
