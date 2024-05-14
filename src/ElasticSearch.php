<?php
/*
 * @Author: 904915452 904915452@qq.com
 * @Date: 2024-05-08 10:38:00
 * @LastEditors: 904915452 904915452@qq.com
 * @LastEditTime: 2024-05-08 10:39:58
 * @FilePath: \elasticSearchOrm\src\ElasticSearch.php
 * @Description: ElasticSearchOrm操作
 */

namespace ElasticSearchOrm\ElasticSearchOrm;

use ElasticSearchOrm\ElasticSearchOrm\connection\ConnectionInterface;
use ElasticSearchOrm\ElasticSearchOrm\connection\Connection;
use ElasticSearchOrm\ElasticSearchOrm\exception\ConnectionException;

class ElasticSearch
{
    /**
     * 默认ES连接地址
     * @var string
     */
    private const DEFAULT_HOSTS = ['127.0.0.1:9200'];

    /**
     * 默认连接用户名
     * @var string
     */
    private const DEFAULT_USERNAME = 'elastic';

    /**
     * 默认连接密码
     * @var string
     */
    private const DEFAULT_PASSWORD = '123456';

    /**
     * ES连接实例.
     * @var Connection
     */
    protected Connection $instance;

    /**
     * 配置信息
     * @var array
     */
    protected array $config;

    public function __construct(array $config = [])
    {
        $this->initConfig($config);
    }

    /**
     * 数据库连接.
     * @param bool $force 强制重新连接
     *
     * @return ConnectionInterface
     */
    public function connect(bool $force = false)
    {
        return $this->instance($force);
    }

    /**
     * @description: 配置初始化
     * @param {*} $config
     * @return void
     */
    public function initConfig(array $config)
    {
        $this->config['connections']['hosts'] = $config['hosts'] ?? self::DEFAULT_HOSTS;
        $this->config['connections']['username'] = $config['username'] ?? self::DEFAULT_USERNAME;
        $this->config['connections']['password'] = $config['password'] ?? self::DEFAULT_PASSWORD;
    }

    /**
     * 获取配置参数.
     * @param string $name    配置参数
     * @param mixed  $default 默认值
     * @return mixed
     */
    public function getConfig(string $name = '', $default = null)
    {
        if ('' === $name) {
            return $this->config;
        }

        return $this->config[$name] ?? $default;
    }

    /**
     * 创建数据库连接实例.
     *
     * @param string|null $name  连接标识
     * @param bool        $force 强制重新连接
     *
     * @return ConnectionInterface
     */
    protected function instance(bool $force = false): ConnectionInterface
    {
        if ($force || !isset($this->instance)) {
            $this->instance = $this->createConnection();
        }

        return $this->instance;
    }

    /**
     * 创建连接.
     * @return ConnectionInterface
     */
    protected function createConnection(): ConnectionInterface
    {
        $config = $this->getConnectionConfig();

        /** @var Connection $connection */
        $connection = new Connection($config);
        $connection->setConnect($this);

        return $connection;
    }

    /**
     * 获取连接配置.
     *
     * @param string $name
     *
     * @return array
     */
    protected function getConnectionConfig(): array
    {
        $connections = $this->getConfig('connections');
        if (!isset($connections)) {
            throw new ConnectionException();
        }

        return $connections;
    }

    public function __call($method, $args)
    {
        return call_user_func_array([$this->connect(), $method], $args);
    }
}
