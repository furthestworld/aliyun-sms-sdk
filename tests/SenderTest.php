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

use AliYunSmsSdk\Contracts\LauncherInterface;
use AliYunSmsSdk\Contracts\SenderInterface;
use AliYunSmsSdk\Exceptions\LauncherException;
use AliYunSmsSdk\Launcher;

/**
 * The HTTP request sender class.
 */
class Sender implements SenderInterface
{
    /**
     * The launcher instance.
     *
     * @var LauncherInterface
     */
    private $launcher;

    /**
     * The user agent string.
     *
     * @var string
     */
    private $userAgent;

    /**
     * The request URL.
     *
     * @var string
     */
    protected $url = 'https://sms.aliyuncs.com/';

    /**
     * Initialize HTTP request sender instance.
     *
     * @param LauncherInterface  $launcher  The launcher instance.
     */
    public function __construct(LauncherInterface $launcher)
    {
        $this->launcher = $launcher;

        /* Create user agent string. */
        $info = curl_version();
        $php  = PHP_VERSION;
        $curl = isset($info['version']) ? $info['version'] : 'unknown';
        $ssl  = isset($info['ssl_version']) ? $info['ssl_version'] : 'unknown';
        $sdk  = Launcher::VERSION;

        $this->userAgent = "PHP/{$php} curl/{$curl} (ssl/{$ssl}) Edoger_AliYun_SMS_SDK/{$sdk}";
    }

    /**
     * Send the HTTP request and return the response object.
     *
     * @param  array  $queries  The HTTP request parameters.
     * @return ResponseInterface
     */
    public function request(array $queries = [])
    {
        // For unit test.
        return new Response(
            '{"Model":"105947770900^1108076917764","RequestId":"34613318-A122-49F8-995E-99995AE1FBEC"}',
            200
        );
    }

    /**
     * Throw an 'LauncherException' instanse.
     *
     * @param  string  $message  The exception information.
     * @return void
     */
    private function triggerException($message)
    {
        throw new LauncherException($message, Launcher::ERROR_HTTP);
    }
}
