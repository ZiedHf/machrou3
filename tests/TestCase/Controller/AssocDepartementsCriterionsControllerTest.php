<?php
namespace App\Test\TestCase\Controller;

use App\Controller\AssocDepartementsCriterionsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\AssocDepartementsCriterionsController Test Case
 */
class AssocDepartementsCriterionsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.assoc_departements_criterions',
        'app.departements',
        'app.teams',
        'app.projects',
        'app.assoc_projects_teams',
        'app.users',
        'app.assoc_teams_users',
        'app.actiondisciplinaires',
        'app.assoc_users_actiondisciplinaires',
        'app.assoc_users_projects',
        'app.rapports',
        'app.criterions',
        'app.assoc_projects_criterions',
        'app.assoc_users_criterions',
        'app.clients',
        'app.assoc_clients_projects',
        'app.priorities',
        'app.project_stages'
    ];

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
