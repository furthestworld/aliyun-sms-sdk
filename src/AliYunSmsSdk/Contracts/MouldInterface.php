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
namespace AliYunSmsSdk\Contracts;

/**
 * The short message sending model interface.
 */
interface MouldInterface
{
    /**
     * Send short message to the specified phone number.
     * If you need to send a short message to multiple phone numbers at the same time,
     * you can pass an array containing a number of phone numbers.
     *
     * @param  array|string  $mobile      Send target phone number.
     * @param  array         $parameters  Short message template variables.
     * @return ResponseInterface
     */
    public function send($mobile, array $parameters = []);
}
