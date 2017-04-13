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
                            <div class="col-xs-12">
                                  <?= $this->Flash->render('auth') ?>
                                  <?= $this->Flash->render() ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <?=$this->Html->link('Accueil', ['controller' => 'consult', 'action' => 'index'])?>
                                >
                                <?=__('Teams')?>
                            </div>
                        </div>
                  	<div class="row">
                            <div class="col-md-12 col-sm-12">
                                <h2>Équipe <span class="badge"><?=$numberteams?></span></h2>
                                <table id="teamsTable" class="table table-bordered display" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th><?=__('Team')?></th>
                                        <th><?=__('Departement')?></th>
                                        <th><?=__('Projects number')?></th>
                                        <th><?=__('Employees number')?></th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                        <th><?=__('Team')?></th>
                                        <th><?=__('Departement')?></th>
                                        <th><?=__('Projects number')?></th>
                                        <th><?=__('Employees number')?></th>
                                    </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php foreach ($teams as $key => $team) { ?>
                                            <tr>
                                                <td><?=$this->Html->link($team->name, ['controller' => 'consult', 'action' => 'viewTeamInfo', $team->id])?></td>
                                                <td><?=(!empty($team->departement)) ? $this->Html->link($team->departement->name, ['controller' => 'consult', 'action' => 'viewDepartement', $team->departement->id]) : '-' ?></td>
                                                <td><?=$team->numberProjects?></td>
                                                <td><?=$team->numberUsers?></td>
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
        echo "initializeConsultTeamsListPage();";
    $this->Html->scriptEnd();
?>      