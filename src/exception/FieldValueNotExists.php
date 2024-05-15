<?php

namespace ElasticSearchOrm\ElasticSearchOrm\exception;

class FieldValueNotExists extends Exception
{
    public function __construct(string $message = 'Field Value Not Exists', array $config = [], int $code = 10003)
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
