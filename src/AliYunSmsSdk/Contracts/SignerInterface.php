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
 * The request parameters signer interface.
 */
interface SignerInterface
{
    /**
     * Calculate and return the signature value.
     *
     * @param  string  $source  The source string.
     * @return string
     */
    public function sign($source);

    /**
     * Gets signature method name.
     *
     * @return string
     */
    public function method();

    /**
     * Gets signature algorithm version.
     *
     * @return string
     */
    public function version();
}
