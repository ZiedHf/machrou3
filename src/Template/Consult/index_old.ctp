      <section id="main-content">
          <section class="wrapper">
              <div class="row">
                  <div class="col-lg-9 main-chart">
                        <div class="row">
                            <div class="col-xs-12">
                                  <?= $this->Flash->render('auth') ?>
                                  <?= $this->Flash->render() ?>
                            </div>
                        </div>
                        <h1 class="text-center"><?=Name_app?></h1>
                  	<div class="row mtbox">
                            <div class="col-md-2 col-sm-4 col-md-offset-1 box0">
                                <div class="box1">
                                    <?=$this->Html->link('<span class="li_fa_building"></span><h5>'.$arrayNumber['numberDeps'].' '.__('Departements').'</h5>', ['controller' => 'consult', 'action' => 'departements'], ['escape' => false]);?>
                                </div>
                                <p><?=__('x x are available', $arrayNumber['numberDeps'], __('departements'))?>.</p>
                            </div>
                            <div class="col-md-2 col-sm-4 box0">
                                <div class="box1">
                                    <?=$this->Html->link('<span class="li_fa_cogs"></span><h5>'.$arrayNumber['numberTeams']. ' '.__('Teams').'</h5>', ['controller' => 'consult', 'action' => 'teamsList'], ['escape' => false]);?>
                                </div>
                                <p><?=__('x x are available', $arrayNumber['numberTeams'], __('teams'))?>.</p>
                            </div>
                            <div class="col-md-2 col-sm-4 box0">
                                <div class="box1">
                                    <?=$this->Html->link('<span class="li_fa_users"></span><h5>'.$arrayNumber['numberEmp'].' '.__('Employees').'</h5>', ['controller' => 'consult', 'action' => 'employeesList'], ['escape' => false]);?>
                                </div>
                                <p><?=__('We are x employees', $arrayNumber['numberEmp'], __('employees'))?>.</p>
                            </div>
                            <div class="col-md-2 col-sm-4 box0">
                                <div class="box1">
                                    <?=$this->Html->link('<span class="li_fa_wrench"></span><h5>'.$arrayNumber['numberProjects'].' '.__('Projects').'</h5>', ['controller' => 'consult', 'action' => 'projectsList'], ['escape' => false]);?>
                                </div>
                                <p><?=__('Our teams work on x projects', __('teams'), $arrayNumber['numberProjects'], __('projects'))?>.</p>
                            </div>
                            <div class="col-md-2 col-sm-4 box0">
                                <div class="box1">
                                    <?=$this->Html->link('<span class="li_fa_clients"></span><h5>'.$arrayNumber['numberClients'].' '.__('Clients').'</h5>', ['controller' => 'consult', 'action' => 'clientsList'], ['escape' => false]);?>
                                </div>
                                <p><?=__('We are working with x clients', $arrayNumber['numberClients'], __('clients'))?>.</p>
                            </div>
                  	</div>


                        <div class="row">
                            <?php
                                foreach ($projectStages as $key => $stage) {
                            ?>
                                        <div class="col-lg-3 col-xs-6">
                                            <div class="small-box bg-green">
                                                <div class="inner">
                                                    <h3><?=$stage->total_projects?><sup style="font-size: 20px"><?=($stage->total_projects > 1) ? __('Projects') : __('Project') ?></sup></h3>

                                                    <p><?=$stage->name?></p>
                                                </div>
                                                <div class="icon">
                                                    <i class="ion ion-stats-bars"></i>
                                                </div>
                                                <?=$this->Html->link(__('More info').' <i class="fa fa-arrow-circle-right"></i>', ['controller' => 'Consult', 'action' => 'projectsList', $stage->id], ['class' => 'small-box-footer', 'escape' => false])?>
                                            </div>
                                        </div>
                            <?php
                                }
                            ?>

                        </div>
                  </div>
                    <?= $this->cell('Slider') ?>

              </div>
          </section>
      </section>
<?php

    $this->Html->css('//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css', ['block' => true]);

    $this->Html->script('../dashgumfree/assets/js/sparkline-chart.js', ['block' => true]);

    $this->Html->script('http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js', ['block' => true]);
    $this->Html->script('http://cdn.oesmith.co.uk/morris-0.4.3.min.js', ['block' => true]);
    $this->Html->script('../dashgumfree/assets/js/common-scripts.js', ['block' => true]);

    $this->Html->scriptStart(['block' => true]);
        echo "info_charts = ".  json_encode($info_charts).";";
        echo "initializeConsultPage();";
    $this->Html->scriptEnd();
?>
