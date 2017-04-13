<?php
namespace App\Test\TestCase\Controller;

use App\Controller\AssocTeamsMembersController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\AssocTeamsMembersController Test Case
 */
class AssocTeamsMembersControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.assoc_teams_members',
        'app.teams',
        'app.departements',
        'app.companies',
        'app.assoc_companies_members',
        'app.members',
        'app.authentifications',
        'app.users',
        'app.assoc_teams_users',
        'app.actiondisciplinaires',
        'app.assoc_users_actiondisciplinaires',
        'app.projects',
        'app.assoc_projects_teams',
        'app.assoc_users_projects',
        'app.clients',
        'app.assoc_clients_projects',
        'app.criterions',
        'app.assoc_projects_criterions',
        'app.assoc_users_criterions',
        'app.priorities',
        'app.project_stages',
        'app.project_urls',
        'app.rapports',
        'app.user_urls',
        'app.assoc_companies_users',
        'app.assoc_departements_criterions',
        'app.assoc_teams_criterions'
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
