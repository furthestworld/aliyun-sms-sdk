<?php
/**
 *+------------------------------------------------------------------------------------------------+
 *| Aliyun short message service software development kit.                                         |
 *+------------------------------------------------------------------------------------------------+
 *| @license   Apache License 2.0                                                                  |
 *| @link      https://github.com/edoger/aliyun-sms-sdk                                            |
 *| @copyright Copyright (c) 2017 Qingshan Luo                                                     |
 *+------------------------------------------------------------------------------------------------+
 *| @author    Qingshan Luo <shanshan.lqs@gmail.com>                                               |
 *+------------------------------------------------------------------------------------------------+
 */
namespace ServicesTest;

use PHPUnit\Framework\TestCase;
use Services\Library\Argument;

/**
 * The request parameters manager unit test.
 */
class ArgumentTest extends TestCase
{
    /**
     * The request parameters manager instanse.
     *
     * @var Services\Library\Argument
     */
    protected $argument;

    /**
     * PHPUnit setUp().
     *
     * @return void
     */
    public function setUp()
    {

        $this->argument = new Argument();
    }

    /**
     * PHPUnit tearDown().
     *
     * @return void
     */
    public function tearDown()
    {

        $this->argument = null;
    }

    /**
     * Test Argument::exists(string $name).
     *
     * @return void
     */
    public function testArgumentExists()
    {
        $this->assertTrue($this->argument->exists('Action'));
        $this->assertTrue($this->argument->exists('Format'));
        $this->assertTrue($this->argument->exists('SignatureMethod'));
        $this->assertTrue($this->argument->exists('SignatureVersion'));
        $this->assertTrue($this->argument->exists('Version'));

        $this->assertFalse($this->argument->exists('Inexistence'));
    }

    /**
     * Test Argument::get(string $name, $default = null).
     *
     * @return void
     */
    public function testArgumentGet()
    {
        $this->assertEquals($this->argument->get('Action'), 'SingleSendSms');
        $this->assertEquals($this->argument->get('Format'), 'JSON');
        $this->assertEquals($this->argument->get('SignatureMethod'), 'HMAC-SHA1');
        $this->assertEquals($this->argument->get('SignatureVersion'), '1.0');
        $this->assertEquals($this->argument->get('Version'), '2016-09-27');

        $this->assertEquals($this->argument->get('Inexistence'), null);
        $this->assertEquals($this->argument->get('Inexistence', 'Inexistence'), 'Inexistence');
    }

    /**
     * Test Argument::getAll().
     *
     * @return void
     */
    public function testArgumentGetAll()
    {
        $this->assertEquals($this->argument->getAll(), [
            'Action'           => 'SingleSendSms',
            'Format'           => 'JSON',
            'SignatureMethod'  => 'HMAC-SHA1',
            'SignatureVersion' => '1.0',
            'Version'          => '2016-09-27',
        ]);
    }

    /**
     * Test Argument::set(string $name, $value, bool $overwrite = true).
     *
     * @return void
     */
    public function testArgumentSet()
    {
        $this->assertTrue($this->argument->set('Test', 'Test'));
        $this->assertEquals($this->argument->get('Test'), 'Test');
        $this->assertFalse($this->argument->set('Test', 'TestTest', false));
        $this->assertEquals($this->argument->get('Test'), 'Test');
        $this->assertTrue($this->argument->set('Test', 'TestTest'));
        $this->assertEquals($this->argument->get('Test'), 'TestTest');
    }

    /**
     * Test Argument::forget($name).
     *
     * @return void
     */
    public function testArgumentForget()
    {
        $this->argument->forget('Action');

        $this->assertFalse($this->argument->exists('Action'));
    }
}
