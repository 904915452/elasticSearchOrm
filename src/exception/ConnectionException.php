<?php
/*
 * @Author: 904915452 904915452@qq.com
 * @Date: 2024-05-08 11:23:40
 * @LastEditors: 904915452 904915452@qq.com
 * @LastEditTime: 2024-05-08 11:24:34
 * @FilePath: \elasticSearchOrm\src\exception\ConnectionException.php
 * @Description: 数据连接异常类
 */

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