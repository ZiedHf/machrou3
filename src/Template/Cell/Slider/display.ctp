<!--div class="col-lg-3 ds">
    <h3></?=__('Last projects')?></h3>
    </?php
        if(!empty($projects)){
            foreach ($projects as $key => $project) {
    ?>
                <div class="desc">
                    <div class="thumb">
                        <span class="yellow badge"><i class="fa fa-wrench"></i></span>
                    </div>
                    <div class="details">
                        <p>
                            </?=$this->Html->link($project->name, ['controller' => 'consult', 'action' => 'viewProjectInfo', 1, $project->id]);?>
                            <muted></?=$project->accomplishment?>%</muted>
                            <br/>
                        </p>
                        <p>
                            </?php $endClient = end($project->clients); foreach ($project->clients as $key => $client) { ?>
                                </?=($client !== $endClient) ? $client->name.', ' : $client->name.'.' ?>
                            </?php } ?>
                        </p>
                    </div>
                </div>
    </?php
            }
        }else{
    ?>
        <div class="desc">
            <div class="thumb">
                <span class="yellow badge"><i class="fa fa-wrench"></i></span>
            </div>
            <div class="details">
                <p></?=__('no x are available', ['', __('project')])?></p>
            </div>
        </div>
    </?php
        }
    ?>
</div-->
<nav id="second-nav">
  <div class="nav-wrapper blue lighten-1">
    <ul id="slide-last-project" class="side-nav">
      <li>
        <div class="row">
          <div class="col s12 blue center"><?=__('Last projects')?></div>
        </div>
      </li>
      <?php
          if(!empty($projects)){
              foreach ($projects as $key => $project) {
      ?>
                <li>
                    <?=$this->Html->link('<i class="material-icons">work</i> '.$project->name.' <span class="badge blue white-text">'.$project->accomplishment.'%</span>', ['controller' => 'consult', 'action' => 'viewProjectInfo', 1, $project->id], ['class' => 'waves-effect', 'escape' => false]);?>
                </li>
      <?php
              }
          }else{
      ?>
            <li>
              <a href="#!" class="waves-effect">
                <i class="material-icons">warning</i>
                <p><?=__('no x are available', ['', __('project')])?></p>
              </a>
            </li>
      <?php
          }
      ?>
    </ul>
    <div class="row">
      <div class="col s11 m9 offset-s1 l11">
        <a href="#!" class="breadcrumb">First</a>
        <a href="#!" class="breadcrumb">Second</a>
        <a href="#!" class="breadcrumb">Third</a>
      </div>
      <div class="col m3 l1 right-align hide-on-small-only">
        <a data-activates="slide-last-project" class="btn waves-effect waves-light blue lighten-1">
          <i class="material-icons" style="line-height: 38px;">history</i>
        </a>
      </div>
    </div>
  </div>
</nav>
