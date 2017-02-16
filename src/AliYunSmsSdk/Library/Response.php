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

use AliYunSmsSdk\Contracts\ResponseInterface;
use AliYunSmsSdk\Exceptions\LauncherException;
use AliYunSmsSdk\Launcher;

/**
 * Send short message response class.
 */
class Response implements ResponseInterface
{
    /**
     * The response body.
     *
     * @var string
     */
    private $body = '';

    /**
     * The decoded response result.
     *
     * @var array
     */
    private $result = [];

    /**
     * The HTTP response status code.
     *
     * @var integer
     */
    private $code;

    /**
     * Initialize short message response instance.
     *
     * @param string   $body  The response body.
     * @param integer  $code  The HTTP response status code.
     */
    public function __construct($body, $code)
    {
        $this->body = $body;
        $this->code = $code;

        if ($this->success()) {
            $result = json_decode($body, true);
            if (!is_array($result)) {
                throw new LauncherException('Decode JSON error: ' . json_last_error_msg(), Launcher::ERROR_JSON);
            }

            $this->result = $result;
        }
    }

    /**
     * Gets the request ID.
     *
     * @return string
     */
    public function requestId()
    {
        if (isset($this->result['RequestId'])) {
            return $this->result['RequestId'];
        } else {
            return null;
        }
    }

    /**
     * Gets the response body.
     *
     * @return string
     */
    public function body()
    {
        return $this->body;
    }

    /**
     * Gets the decoded response result.
     *
     * @return array
     */
    public function result()
    {
        return $this->result;
    }

    /**
     * Gets the HTTP response status code.
     *
     * @return integer
     */
    public function code()
    {
        return $this->code;
    }

    /**
     * Gets the successful state of sending.
     *
     * @return boolean
     */
    public function success()
    {
        return $this->code >= 200 && $this->code < 300;
    }
}
