<?php

namespace app\Support;

class Curl extends \Curl\Curl
{
    const USER_AGENT = '1024TOOLS (+https://1024tools.com)';

    public function __construct()
    {
        if (!extension_loaded('curl')) {
            throw new \ErrorException('cURL library is not loaded');
        }

        $this->curl = curl_init();
        $this->setUserAgent(static::USER_AGENT);
        $this->setopt(CURLINFO_HEADER_OUT, true);
        $this->setopt(CURLOPT_HEADER, true);
        $this->setopt(CURLOPT_RETURNTRANSFER, true);
    }
}
