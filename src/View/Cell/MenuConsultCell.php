<?php
namespace App\View\Cell;

use Cake\View\Cell;

/**
 * MenuConsult cell
 */
class MenuConsultCell extends Cell
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
    public function display($pageName)
    {
        $this->loadModel('ProjectStages');
        $menu_stages = $this->ProjectStages->getCountProjectsByStages(0); //have more than 0 project

        $this->set(compact('menu_stages', 'pageName', 'name'));
    }
}
