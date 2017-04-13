    <?php //debug($projects); die(); ?>
    <!-- **********************************************************************************************************************************************************
    MAIN CONTENT
    *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">
            <div class="row">
                <div class="col-lg-12 main-chart page_white">
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
                            <?=__('Projects')?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <h2><?=__('Projects')?> <span class="badge"><?=$numberProjects?></span></h2>
                            <?php
                                echo $this->element('pagedata/projectsList', ['projects' => $projects, 'files' => $files, 'action' => $action]);
                            ?>

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
    $this->Html->css('../js/datatables/datatables.min.css', ['block' => true]);
    $this->Html->script('datatables/datatables.min', ['block' => true]);
    $this->Html->script('datatables/enum.js', ['block' => true]);
    
    $this->Html->scriptStart(['block' => true]);
        $priorities[] = '-';
        $stages[] = '-';
        $priorities_json = json_encode($priorities);
        $stages_json = json_encode($stages);
        echo "var priorities = ". $priorities_json . ";\n";
        echo "var stages = ". $stages_json . ";\n";
        echo "initializeConsultViewListProjectPage(priorities, stages);";
    $this->Html->scriptEnd();
?>      