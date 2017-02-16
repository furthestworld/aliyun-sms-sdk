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
 * Send short message response interface.
 */
interface ResponseInterface
{
    /**
     * Gets the request ID.
     *
     * @return string
     */
    public function requestId();

    /**
     * Gets the response body.
     *
     * @return string
     */
    public function body();

    /**
     * Gets the decoded response result.
     *
     * @return array
     */
    public function result();

    /**
     * Gets the HTTP response status code.
     *
     * @return integer
     */
    public function code();

    /**
     * Gets the successful state of sending.
     *
     * @return boolean
     */
    public function success();
}
