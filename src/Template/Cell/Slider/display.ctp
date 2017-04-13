<div class="col-lg-3 ds">
    <!--COMPLETED ACTIONS DONUTS CHART-->
    <h3><?=__('Last projects')?></h3>
    <?php
        if(!empty($projects)){
            foreach ($projects as $key => $project) { 
    ?>
                <div class="desc">
                    <div class="thumb">
                        <span class="yellow badge"><i class="fa fa-wrench"></i></span>
                    </div>
                    <div class="details">
                        <p>
                            <?=$this->Html->link($project->name, ['controller' => 'consult', 'action' => 'viewProjectInfo', 1, $project->id]);?>
                            <muted><?=$project->accomplishment?>%</muted>
                            <br/>
                        </p>
                        <p>
                            <?php $endClient = end($project->clients); foreach ($project->clients as $key => $client) { ?>
                                <?=($client !== $endClient) ? $client->name.', ' : $client->name.'.' ?>
                            <?php } ?>
                        </p>
                    </div>
                </div>
    <?php 
            }
        }else{
    ?>
        <div class="desc">
            <div class="thumb">
                <span class="yellow badge"><i class="fa fa-wrench"></i></span>
            </div>
            <div class="details">
                <p><?=__('no x are available', ['', __('project')])?></p>
            </div>
        </div>  
    <?php
        }
    ?>
    
  <!-- First Action -->
  <!--div class="desc">
    <div class="thumb">
            <span class="badge bg-theme"><i class="fa fa-clock-o"></i></span>
    </div>
    <div class="details">
            <p><muted>2 Minutes Ago</muted><br/>
               <a href="#">James Brown</a> subscribed to your newsletter.<br/>
            </p>
    </div>
  </div>
  <!-- Second Action -->
  <!--div class="desc">
    <div class="thumb">
            <span class="badge bg-theme"><i class="fa fa-clock-o"></i></span>
    </div>
    <div class="details">
            <p><muted>3 Hours Ago</muted><br/>
               <a href="#">Diana Kennedy</a> purchased a year subscription.<br/>
            </p>
    </div>
  </div>
  <!-- Third Action -->
  <!--div class="desc">
    <div class="thumb">
            <span class="badge bg-theme"><i class="fa fa-clock-o"></i></span>
    </div>
    <div class="details">
            <p><muted>7 Hours Ago</muted><br/>
               <a href="#">Brandon Page</a> purchased a year subscription.<br/>
            </p>
    </div>
  </div>
  <!-- Fourth Action -->
  <!--div class="desc">
    <div class="thumb">
            <span class="badge bg-theme"><i class="fa fa-clock-o"></i></span>
    </div>
    <div class="details">
            <p><muted>11 Hours Ago</muted><br/>
               <a href="#">Mark Twain</a> commented your post.<br/>
            </p>
    </div>
  </div>
  <!-- Fifth Action -->
  <!--div class="desc">
    <div class="thumb">
            <span class="badge bg-theme"><i class="fa fa-clock-o"></i></span>
    </div>
    <div class="details">
        <p><muted>18 Hours Ago</muted><br/>
           <a href="#">Daniel Pratt</a> purchased a wallet in your store.<br/>
        </p>
    </div>
  </div>

   <!-- USERS ONLINE SECTION -->
    <!--h3>Les derniers projets</h3>
  <!-- First Member -->
  <!--div class="desc">
    <div class="thumb">
        </?php echo $this->Html->image('../webroot/dashgumfree/assets/img/ui-divya.jpg', ['class' => 'img-circle', 'height' => '35px', 'width' => '35px']); ?>
    </div>
    <div class="details">
            <p><a href="#">DIVYA MANIAN</a><br/>
               <muted>Available</muted>
            </p>
    </div>
  </div>
  <!-- Second Member -->
  <!--div class="desc">
    <div class="thumb">
        </?php echo $this->Html->image('../webroot/dashgumfree/assets/img/ui-sherman.jpg', ['class' => 'img-circle', 'height' => '35px', 'width' => '35px']); ?>
    </div>
    <div class="details">
            <p><a href="#">DJ SHERMAN</a><br/>
               <muted>I am Busy</muted>
            </p>
    </div>
  </div>
  <!-- Third Member -->
  <!--div class="desc">
    <div class="thumb">
        </?php echo $this->Html->image('../webroot/dashgumfree/assets/img/ui-danro.jpg', ['class' => 'img-circle', 'height' => '35px', 'width' => '35px']); ?>
    </div>
    <div class="details">
            <p><a href="#">DAN ROGERS</a><br/>
               <muted>Available</muted>
            </p>
    </div>
  </div>
  <!-- Fourth Member -->
  <!--div class="desc">
    <div class="thumb">
            </?php echo $this->Html->image('../webroot/dashgumfree/assets/img/ui-zac.jpg', ['class' => 'img-circle', 'height' => '35px', 'width' => '35px']); ?>
    </div>
    <div class="details">
            <p><a href="#">Zac Sniders</a><br/>
               <muted>Available</muted>
            </p>
    </div>
  </div>
  <!-- Fifth Member -->
  <!--div class="desc">
    <div class="thumb">
        </?php echo $this->Html->image('../webroot/dashgumfree/assets/img/ui-sam.jpg', ['class' => 'img-circle', 'height' => '35px', 'width' => '35px']); ?>
    </div>
    <div class="details">
            <p><a href="#">Marcel Newman</a><br/>
               <muted>Available</muted>
            </p>
    </div>
  </div-->

    <!-- CALENDAR-->
    <!--div id="calendar" class="mb">
        <div class="panel green-panel no-margin">
            <div class="panel-body">
                <div id="date-popover" class="popover top" style="cursor: pointer; disadding: block; margin-left: 33%; margin-top: -50px; width: 175px;">
                    <div class="arrow"></div>
                    <h3 class="popover-title" style="disadding: none;"></h3>
                    <div id="date-popover-content" class="popover-content"></div>
                </div>
                <div id="my-calendar"></div>
            </div>
        </div>
    </div--><!-- / calendar -->

</div><!-- /col-lg-3 -->