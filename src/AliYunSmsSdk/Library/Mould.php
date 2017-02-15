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
use AliYunSmsSdk\Contracts\SenderInterface;
use AliYunSmsSdk\Exceptions\LauncherException;
use AliYunSmsSdk\Launcher;

/**
 *
 */
class Mould implements MouldInterface
{
    /**
     * [$signer description]
     * @var null
     */
    private static $signer = null;

    /**
     * [$launcher description]
     * @var [type]
     */
    private $launcher;

    /**
     * [$sender description]
     * @var [type]
     */
    private $sender;

    /**
     * [$sign description]
     * @var [type]
     */
    private $sign;

    /**
     * [$template description]
     * @var [type]
     */
    private $template;

    /**
     * [__construct description]
     * @param LauncherInterface $launcher [description]
     * @param SenderInterface   $sender   [description]
     * @param [type]            $sign     [description]
     * @param [type]            $template [description]
     */
    public function __construct(LauncherInterface $launcher, SenderInterface $sender, $sign, $template)
    {
        $this->launcher = $launcher;
        $this->sender   = $sender;
        $this->sign     = $sign;
        $this->template = $template;

        if (!self::$signer) {
            self::$signer = new Signer($launcher);
        }
    }

    /**
     * [send description]
     * @param  [type] $mobile     [description]
     * @param  array  $parameters [description]
     * @return [type]             [description]
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
            'AccessKeyId'      => $this->launcher->getOption('accessKeyId'),
            'Timestamp'        => date('Y-m-d\TH:i:s\Z'),
            'SignatureNonce'   => $this->uuid(),
            'SignatureMethod'  => self::$signer->method(),
            'SignatureVersion' => self::$signer->version(),
        ];
        date_default_timezone_set($timezone);

        ksort($queries);

        $queries['Signature'] = $this->signature($queries);

        return $this->sender->request($queries);
    }

    /**
     * [uuid description]
     * @return [type] [description]
     */
    private function uuid()
    {
        return md5(implode([mt_rand(), mt_rand(), mt_rand(), mt_rand(), mt_rand(), uniqid()]));
    }

    /**
     * [signature description]
     * @param  array  $queries [description]
     * @return [type]          [description]
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
     * [encode description]
     * @param  [type] $value [description]
     * @return [type]        [description]
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
