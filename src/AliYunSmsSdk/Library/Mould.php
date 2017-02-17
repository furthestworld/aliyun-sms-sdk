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
use AliYunSmsSdk\Contracts\MouldInterface;
use AliYunSmsSdk\Exceptions\LauncherException;
use AliYunSmsSdk\Launcher;

/**
 * The short message sending model class.
 */
class Mould implements MouldInterface
{
    /**
     * The request parameters signer instance.
     *
     * @var SignerInterface
     */
    private static $signer = null;

    /**
     * The launcher instance.
     *
     * @var LauncherInterface
     */
    private $launcher;

    /**
     * The short message signature name.
     *
     * @var string
     */
    private $sign;

    /**
     * The short message template code.
     *
     * @var string
     */
    private $template;

    /**
     * Initialize short message sending model instance.
     *
     * @param LauncherInterface  $launcher  The launcher instance.
     * @param string             $sign      The short message signature name.
     * @param string             $template  The short message template code.
     */
    public function __construct(LauncherInterface $launcher, $sign, $template)
    {
        $this->launcher = $launcher;
        $this->sign     = $sign;
        $this->template = $template;

        if (!self::$signer) {
            self::$signer = new Signer($launcher);
        }
    }

    /**
     * Send short message to the specified phone number.
     * If you need to send a short message to multiple phone numbers at the same time,
     * you can pass an array containing a number of phone numbers.
     *
     * @param  array|string  $mobile      Send target phone number.
     * @param  array         $parameters  Short message template variables.
     * @return ResponseInterface
     */
    public function send($mobile, array $parameters = [])
    {
        if (is_array($mobile)) {
            $mobile = implode(',', $mobile);
        }

        $vars = json_encode(array_map('strval', $parameters));
        if (!is_string($vars)) {
            throw new LauncherException('Eecode JSON error: ' . json_last_error_msg(), Launcher::ERROR_JSON);
        }

        $timezone = date_default_timezone_get();

        date_default_timezone_set("GMT");
        $queries = [
            'Action'           => 'SingleSendSms',
            'SignName'         => $this->sign,
            'TemplateCode'     => $this->template,
            'RecNum'           => $mobile,
            'ParamString'      => $vars,
            'Format'           => 'JSON',
            'Version'          => '2016-09-27',
            'AccessKeyId'      => $this->launcher->getAccessKeyId(),
            'Timestamp'        => date('Y-m-d\TH:i:s\Z'),
            'SignatureNonce'   => $this->uuid(),
            'SignatureMethod'  => self::$signer->method(),
            'SignatureVersion' => self::$signer->version(),
        ];
        date_default_timezone_set($timezone);

        ksort($queries);

        $queries['Signature'] = $this->signature($queries);

        return Sender::request($queries);
    }

    /**
     * Create a universally unique identifier.
     *
     * @return string
     */
    private function uuid()
    {
        return md5(implode([mt_rand(), mt_rand(), mt_rand(), mt_rand(), mt_rand(), uniqid()]));
    }

    /**
     * Calculate the signature of the request parameters.
     *
     * @param  array  $queries  The HTTP request parameters.
     * @return string
     */
    private function signature(array $queries)
    {
        $canonicalizedQueries = [];
        foreach ($queries as $key => $value) {
            $canonicalizedQueries[] = $this->encode($key) . '=' . $this->encode($value);
        }

        return self::$signer->sign('POST&%2F&' . $this->encode(implode('&', $canonicalizedQueries)));
    }

    /**
     * Encodes a string and returns the encoded string.
     *
     * @param  string  $value  The target string.
     * @return string
     */
    private function encode($value)
    {
        $value = urlencode($value);
        $value = preg_replace('/\+/', '%20', $value);
        $value = preg_replace('/\*/', '%2A', $value);
        $value = preg_replace('/%7E/', '~', $value);

        return $value;
    }
}
