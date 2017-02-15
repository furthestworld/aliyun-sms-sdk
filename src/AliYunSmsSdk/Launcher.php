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
use AliYunSmsSdk\Library\Sender;

/**
 * AliYun short message service software development kit launcher class.
 */
class Launcher implements LauncherInterface
{
    /**
     * AliYun SMS SDK version string.
     */
    const VERSION = '1.0.0-alpha1';

    const ERROR_OPTION   = 600;
    const ERROR_HTTP     = 610;
    const ERROR_SERVER   = 620;
    const ERROR_ARGUMENT = 630;
    const ERROR_JSON     = 640;

    /**
     * [$options description]
     * @var array
     */
    private static $options = [
        'accessKeyId'  => '',
        'accessSecret' => '',
    ];

    /**
     * [$sender description]
     * @var [type]
     */
    private static $sender = null;

    /**
     * [$moulds description]
     * @var array
     */
    private static $moulds = [];

    /**
     * [__construct description]
     * @param array $options [description]
     */
    public function __construct(array $options = [])
    {
        if (!empty($options)) {
            foreach ($options as $option => $value) {
                $this->setOption($option, $value);
            }
        }

        if (!self::$sender) {
            self::$sender = new Sender($this);
        }
    }

    /**
     * [mould description]
     * @param  [type] $sign     [description]
     * @param  [type] $template [description]
     * @return [type]           [description]
     */
    public function mould($sign, $template)
    {
        $id = md5($sign . $template);

        if (!isset(self::$moulds[$id])) {
            self::$moulds[$id] = new Mould($this, self::$sender, $sign, $template);
        }

        return self::$moulds[$id];
    }

    /**
     * [setOption description]
     * @param [type] $option [description]
     * @param [type] $value  [description]
     */
    public function setOption($option, $value)
    {
        if (array_key_exists($option, self::$options)) {
            self::$options[$option] = $value;
            return true;
        } else {
            return false;
        }
    }

    /**
     * [getOption description]
     * @param  [type] $option [description]
     * @return [type]         [description]
     */
    public function getOption($option)
    {
        if (array_key_exists($option, self::$options)) {
            return self::$options[$option];
        } else {
            return null;
        }
    }
}
