<?php

namespace ElasticSearchOrm\ElasticSearchOrm\exception;

class TableNotExists extends Exception
{
    public function __construct(string $message = 'Table Not Exists', array $config = [], int $code = 10002)
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
