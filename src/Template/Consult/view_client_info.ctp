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
                                <?=$this->Html->link(__('Clients list'), ['controller' => 'consult', 'action' => 'clientsList'])?>
                                >
                                <?php echo "$client->name $client->lastName"; ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <h2><?=__('Client')?> : <?php echo "$client->name $client->lastName"; ?></h2>
                                <hr>
                                <div class="col-lg-offset-1">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th><?=__('Name')?> :</th>
                                            <td><?php echo "$client->name $client->lastName"; ?></td>
                                        </tr>
                                        <tr>
                                            <th><?=__('Email')?> :</th>
                                            <td><?= (!empty($client->authentification->email)) ? $client->authentification->email : '-' ?></td>
                                        </tr>
                                        <tr>
                                            <th><?=__('Description')?> :</th>
                                            <td><?=(($client->description != Null) && ($client->description !='')) ? $client->description : '-'?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <h2>Projets :</h2>
                                <hr>
                                <div class="col-lg-offset-1">
                                    <?php if(!empty($client->projects)){ ?>
                                            <table id="projectsTable" class="table table-bordered row-border hover order-column">
                                                <thead>
                                                    <tr>
                                                        <th><?=__('Name')?></th>
                                                        <th><?=__('Accomplishment')?></th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th><?=__('Name')?></th>
                                                        <th><?=__('Accomplishment')?></th>
                                                    </tr>
                                                </tfoot>
                                                <tbody>
                                                    <?php 
                                                        foreach ($client->projects as $key => $project) { 
                                                    ?>
                                                    <tr>
                                                        <td><?=$project->name?></td>
                                                        <td>
                                                            <div class="progress">
                                                                <div class="progress-bar" role="progressbar" aria-valuenow="<?=($project->accomplishment > 10) ? $project->accomplishment : 10?>" aria-valuemin="0" aria-valuemax="<?=($project->accomplishment > 10) ? $project->accomplishment : 10?>" style="min-width: 10%; width: <?=$project->accomplishment?>%;">
                                                                  <?=$project->accomplishment?>%
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                    <?php }else{ ?>
                                    <?=__('No .. associated to this', ['', 'projet', 'ce client'])?>
                                    <?php } ?>
                                </div>
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
        echo "initializeConsultViewClientPage();";
    $this->Html->scriptEnd();
?>      