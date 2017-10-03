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

                        <?= $this->element('pagedata/projectinfo', ['project' => $project, 'files' => $files, 'images' => $images, 'projectManager' => $projectManager]) ?>

                  </div>


      <!-- **********************************************************************************************************************************************************
      RIGHT SIDEBAR CONTENT
      *********************************************************************************************************************************************************** -->
                    <!--?= $this->element('sidebar/notification') ?-->

              </div><!--/row -->
          </div>
      </section>

<?php
    //$this->Html->css('../dashgumfree/assets/css/zabuto_calendar.css', ['block' => true]);
    $this->Html->css('../dashgumfree/assets/js/fancybox/jquery.fancybox.css', ['block' => true]);
    $this->Html->script('../dashgumfree/assets/js/fancybox/jquery.fancybox.js', ['block' => true]);
    //$this->Html->script('../dashgumfree/assets/js/zabuto_calendar.js', ['block' => true]);
    //$this->Html->script('../dashgumfree/assets/js/morris-conf.js', ['block' => true]);

    $this->Html->scriptStart(['block' => true]);
        //echo "initializeConsultViewProjectInfoPage();";
        echo "jQuery('.fancybox').fancybox();";
    $this->Html->scriptEnd();
?>
