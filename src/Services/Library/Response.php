<?php
/**
 *+------------------------------------------------------------------------------------------------+
 *| Aliyun short message service software development kit.                                         |
 *+------------------------------------------------------------------------------------------------+
 *| @license   Apache License 2.0                                                                  |
 *| @link      https://github.com/edoger/aliyun-sms-sdk                                            |
 *| @copyright Copyright (c) 2017 Qingshan Luo                                                     |
 *+------------------------------------------------------------------------------------------------+
 *| @author    Qingshan Luo <shanshan.lqs@gmail.com>                                               |
 *+------------------------------------------------------------------------------------------------+
 */
namespace Services\Library;

/**
 * The HTTP response manager.
 */
class Response
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
     * The HTTP status code.
     *
     * @var integer
     */
    private $status = 0;

    /**
     * Initialize short message response instance.
     *
     * @param   string   $body    The response body.
     * @param   integer  $status  The HTTP status code.
     * @return  void
     */
    public function __construct(string $body, int $status)
    {
        $this->body   = $body;
        $this->status = $status;
        $this->result = json_decode($body, true);
    }

    /**
     * Get the response body.
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
     * Get the HTTP status code.
     *
     * @return integer
     */
    public function status()
    {

        return $this->status;
    }

    /**
     * Check whether the message is sent successfully.
     *
     * @return boolean
     */
    public function success()
    {

        return $this->status >= 200 && $this->status < 300;
    }

    /**
     * Determines whether a result data exists.
     *
     * @param   string  $name  The result data name.
     * @return  boolean
     */
    public function exists(string $name)
    {

        return isset($this->result[$name]);
    }

    /**
     * Get a result data by name.
     *
     * @param   string  $name     The result data name.
     * @param   mixed   $default  The default value.
     * @return  mixed
     */
    public function get(string $name, $default = null)
    {

        return $this->result[$name] ?? $default;
    }
}
