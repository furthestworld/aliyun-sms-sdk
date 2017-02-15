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
 *
 */
class Response implements ResponseInterface
{
    /**
     * [$body description]
     * @var string
     */
    private $body = '';

    /**
     * [$result description]
     * @var array
     */
    private $result = [];

    /**
     * [$code description]
     * @var [type]
     */
    private $code;

    /**
     * [__construct description]
     * @param [type] $body [description]
     * @param [type] $code   [description]
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
     * [requestId description]
     * @return [type] [description]
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
     * [body description]
     * @return [type] [description]
     */
    public function body()
    {
        return $this->body;
    }

    /**
     * [result description]
     * @return [type] [description]
     */
    public function result()
    {
        return $this->result;
    }

    /**
     * [code description]
     * @return [type] [description]
     */
    public function code()
    {
        return $this->code;
    }

    /**
     * [success description]
     * @return [type] [description]
     */
    public function success()
    {
        return $this->code >= 200 && $this->code < 300;
    }
}
