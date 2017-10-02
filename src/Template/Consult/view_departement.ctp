      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <section id="main-content">
        <div class="container">
            <div class="col s12 m12 l10 offset-l1">
              <div class="row">
                <div class="col s12 m6 offset-m3">
                  <?= $this->Flash->render() ?>
                </div>
              </div>
              <div class="row">
                  <div class="col-md-12 col-sm-12">
                      <?=$this->Html->link(__('Home'), ['controller' => 'consult', 'action' => 'index'])?>
                      >
                      <?=$this->Html->link(__('Departement'), ['controller' => 'consult', 'action' => 'departements'])?>
                      >
                      <?=$departement->name?>
                  </div>
              </div>
                  	<div class="row">
                      <div class="col s12">
                        <h3 class="center"><?=__('Departement')?> : <?=$departement->name?></h3>
                                <hr>
                                <h4><?=__('Teams')?> :</h4>
                                <div class="col-lg-offset-1">
                                    <?php
                                        if(!empty($departement->teams)){
                                            foreach ($departement->teams as $key => $team) {
                                    ?>
                                                <!--Afficher le nom de l'équipe-->
                                                <div class="card-alert card blue lighten-4 z-depth-2">
                                                    <div class="card-content blue-text">
                                                      <?=$this->Html->link($team->name, ['controller' => 'consult', 'action' => 'viewTeam', $departement->id, $team->id])?> :
                                                      <!--Afficher les nom des emp-->
                                                      <span>
                                                          <?php $lastElement = end($team->users); $users = ""; foreach ($team->users as $key => $user) { ?>
                                                              <?=$this->Html->link($user->name, ['controller' => 'consult', 'action' => 'viewUser', $departement->id, $user->id])?><?=($lastElement == $user) ? '. ' : ', '?>
                                                          <?php } ?>
                                                      </span>
                                                    </div>
                                                </div>
                                                <!--Afficher les projets Pour chaque team-->
                                                <?php
                                                    //$projects = $team->projects;
                                                    echo $this->element('pagedata/projectsList', ['projects' => $team->projects, 'files' => $files, 'action' => $action, 'departement_id' => $departement->id]);
                                                ?>
                                    <?php
                                            }
                                        }else{
                                    ?>
                                            <div class="col-lg-offset-1">
                                                <?=__('No .. associated to this', ['e', __('team'), 'ce '.__('departement')])?>
                                            </div>
                                    <?php
                                        }
                                    ?>
                                </div>
                            </div>
                  	</div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <h4><?=__('Criterions')?></h4>
                            <?php if(!empty($departement->criterions)){ ?>
                            <div class="col-lg-offset-1">
                                <table class="table table-bordered">
                                    <tr>
                                        <td><?=__('Name')?></td>
                                        <td><?=__('Content')?></td>
                                        <td><?=__('Percent')?></td>
                                    </tr>
                                    <?php
                                        foreach ($departement->criterions as $key => $criterion) {
                                    ?>
                                    <tr>
                                        <td><?=h($criterion->name);?></td>
                                        <td><?=h($criterion['_joinData']->content);?></td>
                                        <td><?=(isset($criterion['_joinData']->percent)) ? h($criterion['_joinData']->percent).'%' : '-';?></td>
                                    </tr>
                                    <?php } ?>
                                </table>
                            </div>
                            <?php }else{ ?>
                              <div class="card-alert card grey lighten-5 z-depth-2">
                                  <div class="card-content grey-text">
                                      <p><?=__('No .. associated to this', ['', __('criterion'), 'ce '.__('departement')])?></p>
                                  </div>
                              </div>
                            <?php } ?>
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
    //$this->Html->css('../js/datatables/datatables.min', ['block' => true]);
    //$this->Html->script('datatables/datatables.min', ['block' => true]);
    //$this->Html->script('datatables/enum.js', ['block' => true]);

    $this->Html->css('../js/tablesorter-master/css/theme.materialize.css', ['block' => true]);
    $this->Html->script('../js/tablesorter-master/js/jquery.tablesorter.js', ['block' => true]);
    $this->Html->script('../js/tablesorter-master/js/jquery.tablesorter.widgets.js', ['block' => true]);
    $this->Html->css('../js/tablesorter-master/dist/css/jquery.tablesorter.pager.min.css', ['block' => true]);
    $this->Html->script('../js/tablesorter-master/dist/js/extras/jquery.tablesorter.pager.min.js', ['block' => true]);

    $this->Html->scriptStart(['block' => true]);
        $priorities[] = '-';
        $stages[] = '-';
        $priorities_json = json_encode($priorities);
        $stages_json = json_encode($stages);
        echo "var priorities = ". $priorities_json . ";\n";
        echo "var stages = ". $stages_json . ";\n";
        echo "initializeConsultViewDepartementPage(priorities, stages);";
    $this->Html->scriptEnd();
?>
