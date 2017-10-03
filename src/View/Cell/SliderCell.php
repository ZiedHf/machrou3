<?php
namespace App\View\Cell;

use Cake\View\Cell;

/**
 * Slider cell
 */
class SliderCell extends Cell
{

    /**
     * List of valid options that can be passed into this
     * cell's constructor.
     *
     * @var array
     */
    protected $_validCellOptions = [];

    /**
     * Default display method.
     *
     * @return void
     */
    public function display($breadcrumbs)
    {
        $session = $this->request->session()->read();
        $user = $session['Auth']['User'];
        $user_id = ($user['user_id'] !== null) ? $user['user_id'] : $user['member_id'];
        //debug($user);die();
        $this->loadModel('Projects');
        $projects = $this->Projects->getLastProjectsDataByUser(10, $user['type'], $user_id, $user['group_manager']);
        $this->set(compact('projects', 'breadcrumbs'));
    }
}
