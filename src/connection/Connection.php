<?php
/*
 * @Author: 904915452 904915452@qq.com
 * @Date: 2024-05-08 11:10:54
 * @LastEditors: 904915452 904915452@qq.com
 * @LastEditTime: 2024-05-13 15:18:52
 * @FilePath: \elasticSearchOrm\src\connection\Connection.php
 * @Description: ElasticSearchOrm 连接类
 */

namespace ElasticSearchOrm\ElasticSearchOrm\connection;

use Elastic\Elasticsearch\ClientBuilder;
use ElasticSearchOrm\ElasticSearchOrm\builder\Builder;
use ElasticSearchOrm\ElasticSearchOrm\ElasticSearch;
use ElasticSearchOrm\ElasticSearchOrm\exception\ConnectionException;

class Connection implements ConnectionInterface
{
    /**
     * ES对象
     * @var ElasticSearch
     */
    protected ElasticSearch $es;

    protected $client;

    public function __construct(array $config)
    {
        $this->initClient($config);
    }

    /**
     * 设置当前的ES对象
     * @param ElasticSearch $es
     * @return void
     */
    public function setConnect(ElasticSearch $es)
    {
        $this->es = $es;
    }

    /**
     * @description: ES客户端初始化
     * @param {array} $config
     * @return {*}
     */
    protected function initClient(array $config)
    {
        try {
            $client = ClientBuilder::create()->setHosts($config['hosts'])->setBasicAuthentication($config['username'], $config['password'])->build();
            $response = $client->cluster()->health();
        } catch (\Exception $e) {
            throw new ConnectionException("Elasticsearch cluster is not available");
        }

        $this->client = $client;
    }

    /**
     * 获取客户端
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * 创建查询对象
     */
    public function newBuilder()
    {
        $query = new Builder($this);
        return $query;
    }

    /**
     * 指定表名开始查询.
     * @param $table
     * @return BaseQuery
     */
    public function table(string $table)
    {
        return $this->newBuilder()->table($table);
    }
}
