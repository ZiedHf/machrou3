<div class="row">
    <div class="col s12">
        <h4><?=__('Employee')?> : <?php echo "$user->name $user->lastName"; ?></h4>
        <hr>
        <div class="col m11 offset-m1">
            <table class="bordered highlight">
                <tr>
                    <th><?=__('Name')?> :</th>
                    <td><?php echo "$user->name $user->lastName"; ?></td>
                </tr>
                <tr>
                    <th><?=__('Email')?> :</th>
                    <td><?=(!empty($user->authentification->email)) ? $user->authentification->email : '-' ?></td>
                </tr>
                <?php if(!empty($user->teams)){ ?>
                <tr>
                    <th><?=__('Teams')?> :</th>
                    <td>
                        <?php
                            $lastElement = end($user->teams);
                            foreach ($user->teams as $key => $team){
                                if($team === $lastElement){
                                    echo $this->Html->link($team->name, ['controller' => 'Consult', 'action' => 'viewTeamInfo', $team->id]).'.';
                                }else{
                                    echo $this->Html->link($team->name, ['controller' => 'Consult', 'action' => 'viewTeamInfo', $team->id]).', ';
                                }
                            }
                        ?>
                    </td>
                </tr>
                <?php } ?>
                <tr>
                    <th><?=__('Description')?> :</th>
                    <td><?=(($user->description != Null) && ($user->description !='')) ? $user->description : '-'?></td>
                </tr>
            </table>
        </div>



      <div class="row">
        <div class="col m11 offset-m1">
          <hr>
            <h4><?=__('Project')?> :</h4>
            <?php if(!empty($user->projects)){ ?>

                <table id="projectsTable" class="table_sorter table table-bordered display" cellspacing="0">
                    <thead>
                        <tr>
                            <th><?=__('Project')?></th>
                            <th><?=__('Time dedicated')?></th>
                            <th><?=__('Accomplishment')?></th>
                            <th><?=__('ProjectManager')?></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th><?=__('Project')?></th>
                            <th><?=__('Time dedicated')?></th>
                            <th><?=__('Accomplishment')?></th>
                            <th><?=__('ProjectManager')?></th>
                        </tr>
                        <tr class="tablesorter-ignoreRow">
                          <th colspan="4" class="ts-pager form-horizontal">
                            <button type="button" class="btn first"><i class="small material-icons">first_page</i></button>
                            <button type="button" class="btn prev"><i class="small material-icons">navigate_before</i></button>
                            <span class="pagedisplay"></span>
                            <!-- this can be any element, including an input -->
                            <button type="button" class="btn next"><i class="small material-icons">navigate_next</i></button>
                            <button type="button" class="btn last"><i class="small material-icons">last_page</i></button>
                            <select class="pagesize browser-default" title="Select page size">
                              <option selected="selected" value="10">10</option>
                              <option value="20">20</option>
                              <option value="30">30</option>
                              <option value="40">40</option>
                            </select>
                            <select class="pagenum browser-default" title="Select page number"></select>
                          </th>
                        </tr>
                    </tfoot>
                    <tbody>
                    <?php
                        foreach($user->projects as $key => $project){
                            $time_dedicated = $project['_joinData']->time_dedicated;
                    ?>
                    <tr>
                        <td><?= (!empty($user->team)) ? $this->Html->link($project->name,['controller' => 'Consult', 'action' => 'viewProjectInfo', $team->departement->id, $project->id]) : $this->Html->link($project->name,['controller' => 'Consult', 'action' => 'viewProjectInfo', 0, $project->id]) ?></td>
                        <td>
                            <?php if((isset($time_dedicated))&&($time_dedicated !== '')){ ?>
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" aria-valuenow="<?=($time_dedicated > 10) ? $time_dedicated : 10?>" aria-valuemin="0" aria-valuemax="<?=($time_dedicated > 10) ? $time_dedicated : 10?>" style="min-width: 10%; width: <?=$time_dedicated?>%;">
                                  <?=$time_dedicated?>%
                                </div>
                            </div>
                            <?php }else{ ?>
                            -
                            <?php } ?>
                        </td>
                        <td>
                          <div class="progress">
                            <div class="determinate" style="width: <?=$project->accomplishment?>%"></div>
                          </div>
                        </td>
                        <td>
                            <?php if($project['_joinData']->projectManager === 1){ ?>
                                <i class="fa fa-check-circle green" aria-hidden="true"></i>
                            <?php }else{ ?>
                                -
                            <?php } ?>
                        </td>
                    </tr>
                    <?php } ?>
                    </tbody>
                </table>

            <?php }else{ ?>
                <div class="card-alert card grey lighten-5 z-depth-2">
                    <div class="card-content grey-text">
                        <p><?=__('No .. associated to this', ['', __('projet'), 'ce '.__('employee')])?></p>
                    </div>
                </div>
            <?php } ?>
        </div>
      </div>



      <div class="row">
        <div class="col m11 offset-m1">
          <hr>
                <h4><?=__('Urls')?></h4>

                <?php if(!empty($user->user_urls)){ ?>
                <div class="col-lg-offset-1">
                    <table class="bordered highlight">
                        <tr>
                            <th><?=__('Name')?></th>
                            <th><?=__('Url')?></th>
                        </tr>
                        <?php
                            foreach ($user->user_urls as $key => $url) {
                        ?>
                        <tr>
                            <td><?=h($url->name);?></td>
                            <td><?= $this->Html->link(h($url->url), $url->url, ['target' => '_blank']) ?></td>
                        </tr>
                        <?php } ?>
                    </table>
                </div>
                <?php }else{ ?>
                    <div class="card-alert card grey lighten-5 z-depth-2">
                        <div class="card-content grey-text">
                            <p><?=__('No .. associated to this', ['', __('url'), 'ce '.__('employee')])?></p>
                        </div>
                    </div>
                <?php } ?>
            </div>
      </div>

      <div class="row">
        <div class="col m11 offset-m1">
          <hr>
                <h4><?=__('Criterions')?></h4>

                <?php if(!empty($user->criterions)){ ?>
                <div class="col-lg-offset-1">
                    <table class="bordered highlight">
                        <tr>
                            <th><?=__('Name')?></th>
                            <th><?=__('Content')?></th>
                            <th><?=__('Percent')?></th>
                        </tr>
                        <?php
                            foreach ($user->criterions as $key => $criterion) {
                        ?>
                        <tr>
                            <td><?=h($criterion->name);?></td>
                            <td><?=h($criterion['_joinData']->content);?></td>
                            <td><?=(isset($criterion['_joinData']->percent)) ? h($criterion['_joinData']->percent).'%' : '-';?></td>
                        </tr>
                        <?php } ?>
                    </table>
                </div>
                <?php }else{ ?>
                    <div class="card-alert card grey lighten-5 z-depth-2">
                        <div class="card-content grey-text">
                            <p><?=__('No .. associated to this', ['', __('criterion'), 'ce '.__('employee')])?></p>
                        </div>
                    </div>
                <?php } ?>
            </div>
      </div>

    </div>
</div>
