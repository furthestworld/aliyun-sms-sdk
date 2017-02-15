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
 *
 */
class Signer implements SignerInterface
{
    /**
     * [$launcher description]
     * @var [type]
     */
    private $launcher;

    /**
     * [__construct description]
     * @param LauncherInterface $launcher [description]
     */
    public function __construct(LauncherInterface $launcher)
    {
        $this->launcher = $launcher;
    }

    /**
     * [sign description]
     * @param  [type] $source       [description]
     * @return string
     */
    public function sign($source)
    {
        return base64_encode(
            hash_hmac('sha1', $source, $this->launcher->getOption('accessSecret') . '&', true)
        );
    }

    /**
     * [method description]
     * @return [type] [description]
     */
    public function method()
    {
        return 'HMAC-SHA1';
    }

    /**
     * [version description]
     * @return [type] [description]
     */
    public function version()
    {
        return '1.0';
    }
}
