<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MessageTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MessageTable Test Case
 */
class MessageTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\MessageTable
     */
    public $Message;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.message',
        'app.messages',
        'app.senders',
        'app.receivers',
        'app.media',
        'app.media_genres',
        'app.genres',
        'app.users',
        'app.media_types',
        'app.types'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Message') ? [] : ['className' => MessageTable::class];
        $this->Message = TableRegistry::get('Message', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Message);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
