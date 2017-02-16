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

use AliYunSmsSdk\Contracts\LauncherInterface;
use AliYunSmsSdk\Contracts\SignerInterface;

/**
 * The request parameters signer class.
 */
class Signer implements SignerInterface
{
    /**
     * The launcher instance.
     *
     * @var LauncherInterface
     */
    private $launcher;

    /**
     * Initialize HTTP request sender instance.
     *
     * @param LauncherInterface  $launcher  The launcher instance.
     */
    public function __construct(LauncherInterface $launcher)
    {
        $this->launcher = $launcher;
    }

    /**
     * Calculate and return the signature value.
     *
     * @param  string  $source  The source string.
     * @return string
     */
    public function sign($source)
    {
        return base64_encode(
            hash_hmac('sha1', $source, $this->launcher->getOption('accessSecret') . '&', true)
        );
    }

    /**
     * Gets signature method name.
     *
     * @return string
     */
    public function method()
    {
        return 'HMAC-SHA1';
    }

    /**
     * Gets signature algorithm version.
     *
     * @return string
     */
    public function version()
    {
        return '1.0';
    }
}
