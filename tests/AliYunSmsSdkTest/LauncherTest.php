<?php
/**
 *+------------------------------------------------------------------------------------------------+
 *| AliYun SMS SDK.                                                                                |
 *+------------------------------------------------------------------------------------------------+
 *| AliYun short message service software development kit.                                         |
 *+------------------------------------------------------------------------------------------------+
 *| @license   Apache License 2.0                                                                  |
 *| @link      https://github.com/edoger/aliyun-sms-sdk                                            |
 *| @copyright Copyright (c) 2017 Qingshan Luo                                                     |
 *+------------------------------------------------------------------------------------------------+
 *| @author    Qingshan Luo <shanshan.lqs@gmail.com>                                               |
 *+------------------------------------------------------------------------------------------------+
 */
namespace AliYunSmsSdkTest;

use AliYunSmsSdk\Launcher;
use PHPUnit\Framework\TestCase;

/**
 * AliYun short message service software development kit unit test class.
 */
class LauncherTest extends TestCase
{
    /**
     * Procedure Testing.
     *
     * @return void
     */
    public function testLauncher()
    {
        $launcher = new Launcher('ABCDEFGHIJKLMN', 'abcdefghijklmnopqrstuvwxyz');
        $mould    = $launcher->mould('TestName', 'SMS_11111111');
        $response = $mould->send('18888888888', ['code' => 100000]);

        $this->assertEquals(
            '{"Model":"105947770900^1108076917764","RequestId":"34613318-A122-49F8-995E-99995AE1FBEC"}',
            $response->body()
        );
        $this->assertEquals(
            [
                'Model'     => '105947770900^1108076917764',
                'RequestId' => '34613318-A122-49F8-995E-99995AE1FBEC',
            ],
            $response->result()
        );
        $this->assertEquals(200, $response->code());
        $this->assertEquals(true, $response->success());
        $this->assertEquals('34613318-A122-49F8-995E-99995AE1FBEC', $response->requestId());
    }
}
