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
use AliYunSmsSdk\Exceptions\LauncherException;
use AliYunSmsSdk\Foundation\SenderAbstract;

/**
 * The HTTP request sender class.
 */
class Sender extends SenderAbstract implements SenderInterface
{
    /**
     * Send the HTTP request and return the response object.
     *
     * @param  array  $queries  The HTTP request parameters.
     * @return ResponseInterface
     */
    public static function request(array $queries = [])
    {
        $ch = curl_init(static::$url);
        if (!$ch) {
            throw new LauncherException(
                'Failed to create CURL handle.',
                ExceptionCodes::ERROR_HTTP_INIT
            );
        }

        $options = [
            CURLOPT_POST           => true,
            CURLOPT_TIMEOUT        => 60,
            CURLOPT_CONNECTTIMEOUT => 30,
            CURLOPT_USERAGENT      => static::getUserAgent(),
            CURLOPT_PORT           => 443,
            CURLOPT_FAILONERROR    => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS     => http_build_query($queries, '', '&', PHP_QUERY_RFC3986),
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => 0,
        ];

        if (!curl_setopt_array($ch, $options)) {
            $message = curl_error($ch);
            curl_close($ch);

            throw new LauncherException(
                'Failed to set CURL handle options: ' . $message,
                ExceptionCodes::ERROR_HTTP_SETOPT
            );
        }

        $body = curl_exec($ch);
        if ($body === false) {
            $message = curl_error($ch);
            curl_close($ch);

            throw new LauncherException(
                'Failed to execute CURL session: ' . $message,
                ExceptionCodes::ERROR_HTTP_EXEC
            );
        }

        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        return new Response($body, $code);
    }
}
