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
use Services\Library\Helper;

/**
 * The SDK helper unit test.
 */
class HelperTest extends TestCase
{
    /**
     * Test Helper::createTimestamp().
     *
     * @return void
     */
    public function testHelperCreateTimestamp()
    {
        $timestamp = Helper::createTimestamp();

        $this->assertTrue(is_string($timestamp));
        $this->assertTrue(!!preg_match('/^\d{4}\-\d{2}\-\d{2}T\d{2}\:\d{2}\:\d{2}Z$/', $timestamp));
    }

    /**
     * Test Helper::createSignatureNonce().
     *
     * @return void
     */
    public function testHelperCreateSignatureNonce()
    {
        $signatureNonce = Helper::createSignatureNonce();

        $this->assertTrue(is_string($signatureNonce));
        $this->assertTrue(!!preg_match('/^[a-z\d]{32}$/', $signatureNonce));
    }

    /**
     * Test Helper::createSignature(Argument $argument, string $secret).
     *
     * @return void
     */
    public function testHelperCreateSignature()
    {
        $signature = Helper::createSignature(new Argument(), 'ThisIsTestSecret');

        $this->assertEquals($signature, 'PcVbOdhG984jKAdLA1IMCb/q8gw=');
    }
}
