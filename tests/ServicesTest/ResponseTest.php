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
use Services\Library\Response;

/**
 * The SDK response unit test.
 */
class ResponseTest extends TestCase
{
    /**
     * The response instanse.
     *
     * @var Services\Library\Response
     */
    protected $response;

    /**
     * The test response body.
     *
     * @var  string
     */
    protected $body = '{"Model":"105947770900","RequestId":"34613318"}';

    /**
     * The test response HTTP status code.
     *
     * @var  integer
     */
    protected $status = 200;

    /**
     * PHPUnit setUp().
     *
     * @return void
     */
    public function setUp()
    {

        $this->response = new Response($this->body, $this->status);
    }

    /**
     * PHPUnit tearDown().
     *
     * @return void
     */
    public function tearDown()
    {

        $this->response = null;
    }

    /**
     * Test Response::body().
     *
     * @return void
     */
    public function testResponseBody()
    {

        $this->assertEquals($this->response->body(), $this->body);
    }

    /**
     * Test Response::result().
     *
     * @return void
     */
    public function testResponseResult()
    {

        $this->assertEquals($this->response->result(), json_decode($this->body, true));
    }

    /**
     * Test Response::status().
     *
     * @return void
     */
    public function testResponseStatus()
    {

        $this->assertEquals($this->response->status(), $this->status);
    }

    /**
     * Test Response::success().
     *
     * @return void
     */
    public function testResponseSuccess()
    {
        $response = new Response($this->body, 500);

        $this->assertTrue($this->response->success());
        $this->assertFalse($response->success());
    }

    /**
     * Test Response::exists(string $name).
     *
     * @return void
     */
    public function testResponseExists()
    {
        $this->assertTrue($this->response->exists('Model'));
        $this->assertTrue($this->response->exists('RequestId'));

        $this->assertFalse($this->response->exists('Inexistence'));
    }

    /**
     * Test Response::get(string $name, $default = null).
     *
     * @return void
     */
    public function testResponseGet()
    {
        $result = json_decode($this->body, true);

        $this->assertEquals($this->response->get('Model'), $result['Model']);
        $this->assertEquals($this->response->get('RequestId'), $result['RequestId']);
        $this->assertEquals($this->response->get('Inexistence'), null);
        $this->assertEquals($this->response->get('Inexistence', 'Inexistence'), 'Inexistence');
    }
}
