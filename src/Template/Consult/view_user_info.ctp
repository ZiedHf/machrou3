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

                          <?php
                              echo $this->element('pagedata/userinfo', ['user' => $user]);
                          ?>
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
        //echo "pageName = 'ViewUserInfo';";
        //echo "initializeConsultViewUserPage(pageName);";
        echo "tableSorterMaster();";
    $this->Html->scriptEnd();
?>
