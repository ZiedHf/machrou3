      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <section id="main-content">
          <div class="container">
                <div class="row">
                    <div class="col s12">
                        <div class="row">
                            <div class="col s12">
                                  <?= $this->Flash->render() ?>
                            </div>
                        </div>

<hr>

                        <div class="row">
                            <div class="col s12">
                                <h3><?=__('Client')?> : <?php echo "$client->name $client->lastName"; ?></h3>

                                <div class="col m11 offset-m1">
                                    <table class="bordered highlight">
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

                        <hr>

                        <div class="row">
                            <div class="col s12">
                                <h4>Projets :</h4>

                                <div class="col m11 offset-m1">
                                    <?php if(!empty($client->projects)){ ?>
                                            <table id="projectsTable" class="table_sorter bordered highlight">
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
                                                    <tr class="tablesorter-ignoreRow">
                                                      <th colspan="2" class="ts-pager form-horizontal">
                                                        <button type="button" class="btn first"><i class="small material-icons">first_page</i></button>
                                                        <button type="button" class="btn prev"><i class="small material-icons">navigate_before</i></button>
                                                        <span class="pagedisplay"></span>
                                                        <!-- this can be any element, including an input -->
                                                        <button type="button" class="btn next"><i class="small material-icons">navigate_next</i></button>
                                                        <button type="button" class="btn last"><i class="small material-icons">last_page</i></button>
                                                        <select class="pagesize browser-default" title="Select page size">
                                                          <option selected="selected" value="10">10</option>
                                                          <option value="20">20</option>
                                                          <option value="30">30</option>
                                                          <option value="40">40</option>
                                                        </select>
                                                        <select class="pagenum browser-default" title="Select page number"></select>
                                                      </th>
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
                                                            <div class="determinate" style="width: <?=$project->accomplishment?>%"></div>
                                                          </div>
                                                        </td>
                                                    </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                    <?php }else{ ?>
                                      <div class="card-alert card grey lighten-5 z-depth-2">
                                          <div class="card-content grey-text">
                                              <p><?=__('No .. associated to this', ['', 'projet', 'ce client'])?></p>
                                          </div>
                                      </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>

      <!-- **********************************************************************************************************************************************************
      RIGHT SIDEBAR CONTENT
      *********************************************************************************************************************************************************** -->

                </div><!--/row -->
          </div>
      </section>

<?php
    //$this->Html->css('../js/datatables/datatables.min.css', ['block' => true]);
    //$this->Html->script('datatables/datatables.min', ['block' => true]);
    $this->Html->css('../js/tablesorter-master/css/theme.materialize.css', ['block' => true]);
    $this->Html->script('../js/tablesorter-master/js/jquery.tablesorter.js', ['block' => true]);
    $this->Html->script('../js/tablesorter-master/js/jquery.tablesorter.widgets.js', ['block' => true]);
    $this->Html->css('../js/tablesorter-master/dist/css/jquery.tablesorter.pager.min.css', ['block' => true]);
    $this->Html->script('../js/tablesorter-master/dist/js/extras/jquery.tablesorter.pager.min.js', ['block' => true]);

    $this->Html->scriptStart(['block' => true]);
        //echo "initializeConsultViewClientPage();";
        echo "tableSorterMaster();";
    $this->Html->scriptEnd();
?>
