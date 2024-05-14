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

class Builder extends BaseBuilder
{
    public function table($name)
    {
        $this->query->table($name);
        return $this;
    }
}
