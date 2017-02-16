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
 * AliYun short message service software development kit launcher interface.
 */
interface LauncherInterface
{
    /**
     * Creates and returns a short message sending model instance.
     *
     * @param  string  $sign      The short message signature name.
     * @param  string  $template  The short message template code.
     * @return MouldInterface
     */
    public function mould($sign, $template);

    /**
     * Gets access key ID.
     *
     * @return string
     */
    public function getAccessKeyId();

    /**
     * Gets access secret.
     *
     * @return string
     */
    public function getAccessSecret();
}
