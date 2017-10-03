      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <section id="main-content">
              <div class="row">
                  <div class="col s12 m12 l10 offset-l1">
                        <div class="row">
                            <div class="col s12 m6 offset-m3">
                                  <?= $this->Flash->render('auth') ?>
                                  <?= $this->Flash->render() ?>
                            </div>
                        </div>
                  	<div class="row">
                      <div class="col s12">
                        <h3 class="center"><?=__('Teams')?></h3>
                                <table id="teamsTable" class="table_sorter">
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
                                    <tr class="tablesorter-ignoreRow">
                                      <th colspan="4" class="ts-pager form-horizontal">
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


              </div><!--/row -->
          </section>
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
        echo "initializeConsultTeamsListPage();";
    $this->Html->scriptEnd();
?>
