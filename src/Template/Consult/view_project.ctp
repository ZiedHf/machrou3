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

              </div><!--/row -->
          </div>
      </section>

<?php

    $this->Html->css('../dashgumfree/assets/js/fancybox/jquery.fancybox.css', ['block' => true]);
    $this->Html->script('../dashgumfree/assets/js/fancybox/jquery.fancybox.js', ['block' => true]);

    $this->Html->scriptStart(['block' => true]);
        //echo "initializeConsultViewProjectPage();";
        echo "$(function() {jQuery('.fancybox').fancybox();});";
    $this->Html->scriptEnd();
?>
