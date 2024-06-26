<?php

namespace ElasticSearchOrm\ElasticSearchOrm\exception;

class ConnectionException extends Exception
{
    public function __construct(string $message = 'ElasticSearch connection error', array $config = [], int $code = 10001)
    {
        $this->message = $message;
        $this->code = $code;
        $this->setData('ElasticSearch Status', [
            'Error Code'    => $code,
            'Error Message' => $message,
        ]);
        $this->setData('ElasticSearch Config', $config);
    }
}
