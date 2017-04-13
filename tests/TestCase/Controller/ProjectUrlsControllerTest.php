<?php
namespace App\Test\TestCase\Controller;

use App\Controller\ProjectUrlsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\ProjectUrlsController Test Case
 */
class ProjectUrlsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.project_urls',
        'app.projects',
        'app.teams',
        'app.departements',
        'app.criterions',
        'app.assoc_projects_criterions',
        'app.users',
        'app.assoc_teams_users',
        'app.actiondisciplinaires',
        'app.assoc_users_actiondisciplinaires',
        'app.assoc_users_projects',
        'app.rapports',
        'app.assoc_users_criterions',
        'app.assoc_departements_criterions',
        'app.assoc_projects_teams',
        'app.assoc_teams_criterions',
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
