
    <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <section id="main-content">
            <section class="wrapper">
                <div class="row">
                    <div class="row">
                        <div class="col-xs-12">
                              <?= $this->Flash->render('auth') ?>
                              <?= $this->Flash->render() ?>
                        </div>
                    </div>
                    <div class="col-lg-9 main-chart">
                        <div class="row mtbox2">
                            <div id='calendar'></div>
                        </div>
                    </div><!-- /col-lg-9 END SECTION MIDDLE -->


      <!-- **********************************************************************************************************************************************************
      RIGHT SIDEBAR CONTENT
      *********************************************************************************************************************************************************** -->                  

                    <!--Notifications-->
                    <?= $this->cell('Slider') ?>

                </div><!--/row -->
            </section>
      </section>
      <!--
        <link rel='stylesheet' href='../lib/cupertino/jquery-ui.min.css' />
        <link href='../fullcalendar.css' rel='stylesheet' />
        <link href='../fullcalendar.print.css' rel='stylesheet' media='print' />
      
        <script src='../lib/moment.min.js'></script>
        <script src='../lib/jquery.min.js'></script>
        <script src='../fullcalendar.min.js'></script>
      -->
<?php
    //Calendar
    $this->Html->css('../js/fullcalendar/lib/cupertino/jquery-ui.min.css', ['block' => true]);
    $this->Html->css('../js/fullcalendar/fullcalendar.min.css', ['block' => true]);
    $this->Html->css('../js/fullcalendar/fullcalendar.print.css', ['block' => true, 'media' => 'print']);
    
    $this->Html->script('fullcalendar/lib/moment.min.js', ['block' => true]);
    $this->Html->script('fullcalendar/fullcalendar.js', ['block' => true]);
    $this->Html->script('fullcalendar/locale/fr.js', ['block' => true]);

    $this->Html->scriptStart(['block' => true]);
        echo "projects =".json_encode($projects).";";
        echo "initializeConsultCalendar(projects);";
    $this->Html->scriptEnd();
?>      