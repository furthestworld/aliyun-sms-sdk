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
namespace AliYunSmsSdk\Library;

use AliYunSmsSdk\Contracts\SenderInterface;
use AliYunSmsSdk\Foundation\SenderAbstract;

/**
 * The HTTP request sender class.
 */
class Sender extends SenderAbstract implements SenderInterface
{
    /**
     * Send the HTTP request and return the response object.
     * For unit test.
     *
     * @param  array  $queries  The HTTP request parameters.
     * @return ResponseInterface
     */
    public static function request(array $queries = [])
    {
        return new Response(
            '{"Model":"105947770900^1108076917764","RequestId":"34613318-A122-49F8-995E-99995AE1FBEC"}',
            200
        );
    }
}
