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
namespace AliYunSmsSdk\Foundation;

use AliYunSmsSdk\Launcher;

/**
 * The HTTP request sender abstract class.
 */
abstract class SenderAbstract
{
    /**
     * The user agent string.
     *
     * @var string
     */
    protected static $userAgent = null;

    /**
     * The request URL.
     *
     * @var string
     */
    protected static $url = 'https://sms.aliyuncs.com/';

    /**
     * Get request user agent string.
     *
     * @return string
     */
    protected static function getUserAgent()
    {
        if (is_null(static::$userAgent)) {
            $info = curl_version();
            $php  = PHP_VERSION;
            $curl = isset($info['version']) ? $info['version'] : 'unknown';
            $ssl  = isset($info['ssl_version']) ? $info['ssl_version'] : 'unknown';
            $sdk  = Launcher::VERSION;

            static::$userAgent = "PHP/{$php} curl/{$curl} (ssl/{$ssl}) Edoger_AliYun_SMS_SDK/{$sdk}";
        }

        return static::$userAgent;
    }
}
