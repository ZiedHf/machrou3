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
                                <?=$this->Html->link('Département', ['controller' => 'consult', 'action' => 'departements'])?>
                                >
                                <?=$this->Html->link($departement->name, ['controller' => 'consult', 'action' => 'viewDepartement', $departement->id])?>
                                >
                                <?=$project->name?>
                            </div>
                        </div>
                  	
                        <?= $this->element('pagedata/projectinfo', ['project' => $project, 'files' => $files, 'images' => $images, 'projectManager' => $projectManager]) ?>
                      
                            
				
                            
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

    $this->Html->css('../dashgumfree/assets/js/fancybox/jquery.fancybox.css', ['block' => true]);
    $this->Html->script('../dashgumfree/assets/js/fancybox/jquery.fancybox.js', ['block' => true]);
    
    $this->Html->scriptStart(['block' => true]);
        echo "initializeConsultViewProjectPage();";
    $this->Html->scriptEnd();
?>      