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
                                <?=$this->Html->link(__('Departement'), ['controller' => 'consult', 'action' => 'departements'])?>
                                >
                                <?=$departement->name?>
                            </div>
                        </div>
                  	<div class="row">
                            <div class="col-md-12 col-sm-12">
                                <h2><?=__('Departement')?> : <?=$departement->name?></h2>
                                <hr>
                                
                                <h3><?=__('Teams')?> :</h3>
                                <div class="col-lg-offset-1">
                                    <?php
                                        if(!empty($departement->teams)){
                                            foreach ($departement->teams as $key => $team) { 
                                    ?>
                                                <!--Afficher le nom de l'équipe-->
                                                <div class="alert alert-info" role="alert">
                                                    <h4>
                                                        <?=$this->Html->link($team->name, ['controller' => 'consult', 'action' => 'viewTeam', $departement->id, $team->id])?> :
                                                        <!--Afficher les nom des emp-->
                                                        <span>
                                                            <?php $lastElement = end($team->users); $users = ""; foreach ($team->users as $key => $user) { ?>
                                                                <?=$this->Html->link($user->name, ['controller' => 'consult', 'action' => 'viewUser', $departement->id, $user->id])?><?=($lastElement == $user) ? '. ' : ', '?> 
                                                            <?php } ?>
                                                        </span>
                                                    </h4>
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
                      
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <h3><?=__('Criterions')?></h3>
                                <hr>
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
                                    <div class="col-lg-offset-1">
                                        <?=__('No .. associated to this', ['', __('criterion'), 'ce '.__('departement')])?>
                                    </div>
                                <?php } ?>
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
    $this->Html->css('../js/datatables/datatables.min', ['block' => true]);
    $this->Html->script('datatables/datatables.min', ['block' => true]);
    $this->Html->script('datatables/enum.js', ['block' => true]);
    
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