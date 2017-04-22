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

use DateTime;
use DateTimeZone;

/**
 * The helper library.
 */
class Helper
{
    /**
     * Get the current timestamp. The default time zone is 'GMT'.
     *
     * @return  string
     */
    public static function createTimestamp()
    {

        return (new DateTime('now', new DateTimeZone('GMT')))->format('Y-m-d\TH:i:s\Z');
    }

    /**
     * Generates a random string for preventing network replay attacks. We the default returns a
     * random string contains 32 characters.
     *
     * @return  string
     */
    public static function createSignatureNonce()
    {
        static $pool = 'abcdefghijklmnopqrstuvwxyz1234567890';

        $characters = [];

        for ($i = 0; $i < 32; $i++) {
            $characters[] = $pool{random_int(0, 35)};
        }

        return implode($characters);
    }

    /**
     * To create the signature of the request parameter.
     *
     * @param   Argument  $argument  The request parameters manager instance.
     * @param   string    $secret    The access secret.
     * @return  string
     */
    public static function createSignature(Argument $argument, string $secret)
    {
        $queries = $argument->getAll();

        ksort($queries);
        foreach ($queries as $key => &$value) {
            $value = $key . '=' . static::encode($value);
        }

        return base64_encode(
            hash_hmac(
                'sha1',
                'POST&%2F&' . static::encode(implode('&', $queries)),
                $secret . '&',
                true
            )
        );
    }

    /**
     * Encoding the request parameter unit.
     *
     * @param   string  $value  To be encoded string.
     * @return  string
     */
    protected static function encode(string $value)
    {
        $value = urlencode($value);
        $value = preg_replace('/\+/', '%20', $value);
        $value = preg_replace('/\*/', '%2A', $value);
        $value = preg_replace('/%7E/', '~', $value);

        return $value;
    }
}
