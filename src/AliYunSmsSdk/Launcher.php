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
namespace AliYunSmsSdk;

use AliYunSmsSdk\Contracts\LauncherInterface;
use AliYunSmsSdk\Library\Mould;

/**
 * AliYun short message service software development kit launcher class.
 *
 * The launcher instance is used to manage configuration options and manage model instances.
 * We recommend that the global create only one instance of the launcher.
 */
class Launcher implements LauncherInterface
{
    /**
     * AliYun SMS SDK version string.
     */
    const VERSION = '1.0.0-beta2';

    /**
     * The access key ID.
     *
     * @var string
     */
    private $accessKeyId;

    /**
     * The access secret.
     *
     * @var string
     */
    private $accessSecret;

    /**
     * The short message sending model instances.
     *
     * @var array
     */
    private static $moulds = [];

    /**
     * Initialize launcher instance.
     *
     * @param string  $accessKeyId   The access key ID.
     * @param string  $accessSecret  The access secret.
     */
    public function __construct($accessKeyId, $accessSecret)
    {
        $this->accessKeyId  = $accessKeyId;
        $this->accessSecret = $accessSecret;
    }

    /**
     * Creates and returns a short message sending model instance.
     *
     * @param  string  $sign      The short message signature name.
     * @param  string  $template  The short message template code.
     * @return MouldInterface
     */
    public function mould($sign, $template)
    {
        $id = md5($sign . $template);

        if (!isset(self::$moulds[$id])) {
            self::$moulds[$id] = new Mould($this, $sign, $template);
        }

        return self::$moulds[$id];
    }

    /**
     * Gets access key ID.
     *
     * @return string
     */
    public function getAccessKeyId()
    {
        return $this->accessKeyId;
    }

    /**
     * Gets access secret.
     *
     * @return string
     */
    public function getAccessSecret()
    {
        return $this->accessSecret;
    }
}
