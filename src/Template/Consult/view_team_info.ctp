      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <section id="main-content">
          <div class="container">
                        <div class="row">
                            <div class="col s12">
                                  <?= $this->Flash->render('auth') ?>
                                  <?= $this->Flash->render() ?>
                            </div>
                        </div>

                        <?php
                            echo $this->element('pagedata/teaminfo', ['team' => $team]);
                        ?>

                  </div>


      <!-- **********************************************************************************************************************************************************
      RIGHT SIDEBAR CONTENT
      *********************************************************************************************************************************************************** -->
      </section>

<?php
    //$this->Html->css('../js/datatables/datatables.min.css', ['block' => true]);
    //$this->Html->script('datatables/datatables.min', ['block' => true]);
    $this->Html->scriptStart(['block' => true]);
        //echo "initializeConsultViewTeamInfoPage();";
    $this->Html->scriptEnd();
?>
