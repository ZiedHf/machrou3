<?php
namespace App\Test\TestCase\Controller;

use App\Controller\AuthentificationsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\AuthentificationsController Test Case
 */
class AuthentificationsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.authentifications',
        'app.users',
        'app.teams',
        'app.departements',
        'app.criterions',
        'app.projects',
        'app.assoc_projects_teams',
        'app.assoc_users_projects',
        'app.clients',
        'app.assoc_clients_projects',
        'app.assoc_projects_criterions',
        'app.priorities',
        'app.project_stages',
        'app.project_urls',
        'app.assoc_users_criterions',
        'app.assoc_departements_criterions',
        'app.assoc_teams_users',
        'app.assoc_teams_criterions',
        'app.actiondisciplinaires',
        'app.assoc_users_actiondisciplinaires',
        'app.rapports',
        'app.user_urls',
        'app.members'
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
