<?php
/*
 * @Author: 904915452 904915452@qq.com
 * @Date: 2024-05-13 16:12:33
 * @LastEditors: 904915452 904915452@qq.com
 * @LastEditTime: 2024-05-13 16:21:17
 * @FilePath: \elasticSearchOrm\src\Query.php
 * @Description: 直接操作数据库查询的接口或对象
 */

namespace ElasticSearchOrm\ElasticSearchOrm;

class Query
{
    /**
     * 默认主键
     * @var string
     */
    public const DEFAULT_PRIMARY_KEY = 'id';

    /**
     * option信息
     * @var array
     */
    protected array $options;

    /**
     * @description: 获取option信息
     * @param {string} $name
     * @return {*}
     */
    public function getOption(string $name)
    {
        return $this->options[$name] ?? null;
    }

    /**
     * @description: 设置索引名称（设置表名称）
     * @param {string} $name
     * @return {*}
     */
    public function table(string $name)
    {
        $this->options['indexName'] = $name;
        return $this;
    }

    /**
     * @description: 设置主键
     * @param {string} $pk 
     * @return {*}
     */
    public function setPrimaryKey(string $pk)
    {
        $this->options['primaryKey'] = $pk;
        return $this;
    }
}
