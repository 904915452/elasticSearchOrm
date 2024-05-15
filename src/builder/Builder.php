<?php
/*
 * @Author: 904915452 904915452@qq.com
 * @Date: 2024-05-13 16:37:01
 * @LastEditors: 904915452 904915452@qq.com
 * @LastEditTime: 2024-05-13 16:37:08
 * @FilePath: \elasticSearchOrm\src\builder\Builder.php
 * @Description: 链式操作生成
 */

namespace ElasticSearchOrm\ElasticSearchOrm\builder;

use BadMethodCallException;
use ElasticSearchOrm\ElasticSearchOrm\exception\FieldValueNotExists;
use ElasticSearchOrm\ElasticSearchOrm\exception\TableNotExists;

class Builder extends BaseBuilder
{
    /**
     * @description: 添加|编辑
     * @param {array} $data
     * @return {*}
     */
    public function save(array $data)
    {
        /**
         * 获取索引名（表名）
         */
        $indexName = $this->getOption('indexName');
        if (empty($indexName)) {
            throw new TableNotExists("table name is empty");
        }


        /**
         * 判断索引是否存在（判断表是否存在，不存在创建）
         */
        if (!$this->indexExists($indexName)) $this->indexCreate($indexName);


        /**
         * 组装数据
         */
        $params = ['index' => $indexName, 'body'  => $data];

        /**
         * 获取主键 （主键默认id）
         */
        $primaryKey = $this->query->getOption('primaryKey') ?? $this->query::DEFAULT_PRIMARY_KEY;
        if (!empty($data[$primaryKey])) {
            $params['id'] = $data[$primaryKey];
        }


        return in_array($this->runQuery($params, 'index')->getStatusCode(), [200, 201]) ? true : false; // 201创建 200修改
    }

    /**
     * @description: 创建索引（创建表）
     * @param {string} $indexName
     * @return void
     */
    public function indexCreate(string $indexName)
    {
        $this->runIndicesQuery(["index" => $indexName], "create");
    }

    /**
     * @description: 索引是否存在
     * @param {string} $indexName
     * @return bool
     */
    public function indexExists(string $indexName)
    {
        return $this->runIndicesQuery(["index" => $indexName], "exists")->getStatusCode() == 200 ? true : false;
    }

    /**
     * @description: 运行索引相关（表相关）
     * @param {array} $params
     * @param {string} $method
     * @return {*}
     */
    protected function runIndicesQuery(array $params, string $method)
    {
        if (empty($method)) {
            throw new BadMethodCallException("Method not found");
        }

        return call_user_func([$this->connection->getClient()->indices(), $method], $params);
    }

    /**
     * @description: 运行文档相关（数据相关）
     * @param {array} $params
     * @param {string} $method
     * @return {*}
     */
    protected function runQuery(array $params, string $method)
    {
        if (empty($method)) {
            throw new BadMethodCallException("Method not found");
        }

        $this->resetQuery();
        return call_user_func([$this->connection->getClient(), $method], $params);
    }

    /**
     * 部分方法映射到Query类
     */
    public function __call($name, $arguments)
    {
        if (method_exists($this->query, $name)) {
            $query = call_user_func_array([$this->query, $name], $arguments);

            if ($query instanceof $this->query) {
                return $this;
            }

            return $query;
        }

        throw new BadMethodCallException(sprintf('The method[%s] not found', $name));
    }
}
