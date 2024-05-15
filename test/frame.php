<?php
/*
 * @Author: 904915452 904915452@qq.com
 * @Date: 2024-05-14 17:10:57
 * @LastEditors: 904915452 904915452@qq.com
 * @LastEditTime: 2024-05-14 17:11:15
 * @FilePath: \elasticSearchOrm\test\frame.php
 * @Description: 这是默认设置,请设置`customMade`, 打开koroFileHeader查看配置 进行设置: https://github.com/OBKoro1/koro1FileHeader/wiki/%E9%85%8D%E7%BD%AE
 */

use ElasticSearchOrm\ElasticSearchOrm\ElasticSearch;

require __DIR__ . '/../vendor/autoload.php';

$es = new ElasticSearch([
    'hosts' => ['http://192.168.102.91:9200'],
    // 'username' => 'elastic', // 默认账号为 elastic
    // 'password' => '123456', // 默认密码为 123456
]);

/**
 * 添加|保存（根据主键进行覆盖）
 * 注：（根据主键进行覆盖数据 默认主键为id） save不会调用where方法 指定其他条件参考 update方法
 */
// $result = $es->table("test")->setPrimaryKey("test_id")->save(['test_id' => 1, 'username' => '13603679083', 'password' => '123456', 'name' => "zqy"]);
// $result = $es->table("test2")->save(['id' => 1, 'username' => '1360361321321', 'password' => '123456', 'name' => "zqy"]);
echo "<pre>";
var_dump($result);
echo "</pre>";

// $es->table("test")->save(['id' => 1, 'username' => '13603679083', 'password' => '123456', 'name' => "zqy"]);