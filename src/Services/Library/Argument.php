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
 * The request parameters manager.
 */
class Argument
{
    /**
     * The request parameters.
     *
     * @var  array
     */
    protected $arguments;

    /**
     * Initialize this request parameters manager instance.
     *
     * @return  void
     */
    public function __construct()
    {
        // These are request parameters that are usually not changed.
        // See https://help.aliyun.com/document_detail/44364.html
        $this->arguments = [
            'Action'           => 'SingleSendSms',
            'Format'           => 'JSON',
            'SignatureMethod'  => 'HMAC-SHA1',
            'SignatureVersion' => '1.0',
            'Version'          => '2016-09-27',
        ];
    }

    /**
     * Determines whether a request parameter exists.
     *
     * @param   string  $name  The request parameter name.
     * @return  boolean
     */
    public function exists(string $name)
    {

        return array_key_exists($name, $this->arguments);
    }

    /**
     * Get a request parameter by name.
     *
     * @param   string  $name     The request parameter name.
     * @param   mixed   $default  The default value.
     * @return  mixed
     */
    public function get(string $name, $default = null)
    {
        if ($this->exists($name)) {
            return $this->arguments[$name];
        }

        return $default;
    }

    /**
     * Get all the request parameters.
     *
     * @return  array
     */
    public function getAll()
    {

        return $this->arguments;
    }

    /**
     * Adds or updates a request parameter.
     *
     * @param   string   $name       The request parameter name.
     * @param   mixed    $value      The request parameter value.
     * @param   boolean  $overwrite  Whether to overwrite the parameters of the same name.
     * @return  boolean
     */
    public function set(string $name, $value, bool $overwrite = true)
    {
        if ($overwrite || !$this->exists($name)) {
            $this->arguments[$name] = $value;
            return true;
        }

        return false;
    }

    /**
     * Forget a request parameter.
     * If the parameter does not exist, don't do anything.
     *
     * @param   string  $name  The request parameter name.
     * @return  self
     */
    public function forget($name)
    {
        if ($this->exists($name)) {
            unset($this->arguments[$name]);
        }

        return $this;
    }
}
