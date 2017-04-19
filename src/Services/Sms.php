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
namespace Services;

use Services\Library\Argument;
use Services\Library\Helper;
use Services\Library\Requester;

/**
 * Aliyun short message service software development kit.
 *
 * The launcher instance is used to manage configuration options and manage model instances.
 * We recommend that the global create only one instance of the launcher.
 */
class Sms
{
    /**
     * This package version.
     */
    const VERSION = '2.0.0';

    /**
     * Your access key.
     *
     * @var  string
     */
    protected $key;

    /**
     * Your access secret.
     *
     * @var  string
     */
    protected $secret;

    /**
     * Set access key.
     *
     * @param   string  $key  Your access key.
     * @return  void
     */
    public function __construct(string $key, string $secret)
    {
        $this->key    = $key;
        $this->secret = $secret;
    }

    /**
     * Send short message to the specified phone number.
     *
     * @param   string  $sign       The short message signature name.
     * @param   string  $template   The short message template code.
     * @param   string  $mobile     Send target phone number.
     * @param   array   $variables  Short message template variables.
     * @return  Services\Library\Response
     */
    public function send(string $sign, string $template, string $mobile, array $variables = [])
    {
        // Each a certain template variables must be a string.
        // At the same time, the short message service interface requires that the template variable
        // be packaged into a JSON data.
        $json = json_encode(array_map('strval', $variables));

        // This is the parameter manager instance for this request.
        // Some fixed parameters have been set up successfully.
        $argument = new Argument();

        $argument->set('AccessKeyId', $this->key);
        $argument->set('ParamString', $json);
        $argument->set('RecNum', $mobile);
        $argument->set('SignName', $sign);
        $argument->set('SignatureNonce', Helper::createSignatureNonce());
        $argument->set('TemplateCode', $template);
        $argument->set('Timestamp', Helper::createTimestamp());
        $argument->set('Signature', Helper::createSignature($argument, $this->secret));

        // Send short message and return the result.
        return Requester::fire($argument);
    }
}
