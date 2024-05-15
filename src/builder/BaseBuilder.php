<?php
/*
 * @Author: 904915452 904915452@qq.com
 * @Date: 2024-05-07 17:17:42
 * @LastEditors: 904915452 904915452@qq.com
 * @LastEditTime: 2024-05-13 16:27:03
 * @FilePath: \elasticSearchOrm\src\builder\BaseBuilder.php
 * @Description: 链式操作生成
 */

namespace ElasticSearchOrm\ElasticSearchOrm\builder;

use ElasticSearchOrm\ElasticSearchOrm\connection\Connection;
use ElasticSearchOrm\ElasticSearchOrm\Query;

abstract class BaseBuilder
{
    /**
     * Connection对象
     * @var ConnectionInterface
     */
    protected $connection;

    /**
     * Query对象
     * @var Query
     */
    protected $query;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
        $this->query = new Query;
    }

    /**
     * 获取当前的连接对象实例.
     * @return Connection
     */
    public function getConnection()
    {
        return $this->connection;
    }

    /**
     * 重置Query
     */
    protected function resetQuery()
    {
        $this->query = new Query;
    }
}
