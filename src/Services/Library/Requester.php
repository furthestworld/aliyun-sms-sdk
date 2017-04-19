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
namespace Services\Library;

use Services\Exception\SmsException;
use Services\Sms;

/**
 * The HTTP requester.
 */
class Requester
{
    /**
     * The request server host.
     *
     * @var  string
     */
    protected static $host = 'https://sms.aliyuncs.com/';

    /**
     * Send short message and return the result.
     *
     * @param   Services\Library\Argument  $argument  The request parameters manager instanse.
     * @return  Services\Library\Response
     *
     * @throws  Services\Exception\SmsException
     */
    public static function fire(Argument $argument)
    {
        $curl  = curl_init(static::$host);
        $query = http_build_query($argument->getAll(), '', '&', PHP_QUERY_RFC3986);

        curl_setopt_array($curl, [
            CURLOPT_POST           => true,
            CURLOPT_TIMEOUT        => 60,
            CURLOPT_CONNECTTIMEOUT => 30,
            CURLOPT_USERAGENT      => static::getUserAgent(),
            CURLOPT_PORT           => 443,
            CURLOPT_FAILONERROR    => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS     => $query,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => 0,
        ]);

        $body = curl_exec($curl);

        if ($body === false) {
            $code    = curl_errno($curl);
            $message = curl_error($curl);

            curl_close($curl);

            throw new SmsException("Failed to execute CURL session: {$message}.", $code);
        }

        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        curl_close($curl);

        return new Response($body, $status);
    }

    /**
     * Get User-Agent string.
     *
     * @return  string
     */
    protected static function getUserAgent()
    {
        static $userAgent = null;

        if (is_null($userAgent)) {
            $info = curl_version();

            $php  = PHP_VERSION;
            $curl = $info['version'] ?? 'NA';
            $ssl  = $info['ssl_version'] ?? 'NA';
            $sdk  = Sms::VERSION;

            $userAgent = "PHP/{$php} CURL/{$curl} (SSL/{$ssl}) Edoger-PHP-SDK/{$sdk}";
        }

        return $userAgent;
    }
}
