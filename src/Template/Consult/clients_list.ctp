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
                                Clients
                            </div>
                        </div>
                  	<div class="row">
                            <div class="col-md-12 col-sm-12">
                                <h2>Clients <span class="badge"><?=$numberClients?></span></h2>
                                <table id="clientsTable" class="table table-bordered row-border hover order-column">
                                    <thead>
                                        <tr>
                                            <th>Nom</th>
                                            <th>Email</th>
                                            <th>Description</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Nom</th>
                                            <th>Email</th>
                                            <th>Description</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php foreach ($clients as $key => $client) { ?>
                                        <tr>
                                            <td><?=$this->Html->link($client->name, ['controller' => 'consult', 'action' => 'viewClientInfo', $client->id])?></td>
                                            <td><?= (!empty($client->authentification->email)) ? $client->authentification->email : '-' ?></td>
                                            <td><?=(empty($client->description)) ? '-' : $client->description ?></td>
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
        echo "initializeConsultClientsListPage();";
    $this->Html->scriptEnd();
?>      