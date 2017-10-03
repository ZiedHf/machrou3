      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <section id="main-content">
        <div class="container">
              <div class="row">
                  <div class="col s12">
                        <div class="row">
                          <div class="col s12 m6 offset-m3">
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

              </div><!--/row -->
          </div>
      </section>

<?php
    $this->Html->css('../js/datatables/datatables.min.css', ['block' => true]);
    $this->Html->script('datatables/datatables.min', ['block' => true]);
    $this->Html->scriptStart(['block' => true]);
        echo "initializeConsultViewTeamPage();";
    $this->Html->scriptEnd();
?>
