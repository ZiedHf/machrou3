    <?php //debug($projects); die(); ?>
    <!-- **********************************************************************************************************************************************************
    MAIN CONTENT
    *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
            <div class="row">
                <div class="col s12 m12 l10 offset-l1">
                    <div class="row">
                        <div class="col s12 m6 offset-m3">
                              <?= $this->Flash->render() ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12">
                            <h3 class="center"><?=__('Projects')?></h3>
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
    //$this->Html->css('../js/datatables/datatables.min.css', ['block' => true]);
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
        //echo "initializeConsultViewListProjectPage(priorities, stages);";
        echo "initializeConsultViewListProjectPage(priorities, stages);";
    $this->Html->scriptEnd();
?>
