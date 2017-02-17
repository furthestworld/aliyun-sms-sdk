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

/**
 * AliYun short message service software development kit exception codes class.
 */
class ExceptionCodes
{
    /**
     * The JSON parse exception codes.
     */
    const ERROR_JSON_ENCODE = 501;
    const ERROR_JSON_DECODE = 502;

    /**
     * Send HTTP request exception codes.
     */
    const ERROR_HTTP_INIT   = 601;
    const ERROR_HTTP_SETOPT = 602;
    const ERROR_HTTP_EXEC   = 603;
}
