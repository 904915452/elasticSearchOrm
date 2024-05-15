<?php
/*
 * @Author: 904915452 904915452@qq.com
 * @Date: 2024-05-08 10:43:45
 * @LastEditors: 904915452 904915452@qq.com
 * @LastEditTime: 2024-05-08 11:49:31
 * @FilePath: \elasticSearchOrm\test\primordial.php
 * @Description: 这是默认设置,请设置`customMade`, 打开koroFileHeader查看配置 进行设置: https://github.com/OBKoro1/koro1FileHeader/wiki/%E9%85%8D%E7%BD%AE
 */

use ElasticSearchOrm\ElasticSearchOrm\ElasticSearch;

require __DIR__ . '/../vendor/autoload.php';

$es = new ElasticSearch(['hosts' => ['http://192.168.102.91:9200']]);


/**
 * 获取客户端 可进行ElasticSearch操作
 */
$client = $es->getClient();


// 判断索引是否存在 （判断表是否存在）
// $results = $client->indices()->exists(["index" => "test"]);


// 创建索引（创建表）
$params = [
    'index' => 'test',
];
$results = $client->indices()->create($params);


// 添加 （添加数据）
// $params = [
//     'index' => 'my_index',
//     'id' => 3,
//     'body'  => ['id' => 3, 'username' => 13603679083, 'password' => '123456', 'name' => "zqy"]
// ];
// $results = $client->index($params);


// 修改（修改数据）
// $params = [
//     'index' => 'my_index',
//     'id'    => 'zqy_1',
//     'body'  => [
//         'doc' => [
//             'name' => 'dy2',
//             'password' => '789456'
//         ]
//     ]
// ];
// $results = $client->update($params);


// 删除（删除一条数据）
// $params = [
//     'index' => 'my_index',
//     'id'    => 10
// ];
// $results = $client->delete($params);


// 查询单条
// $params = [
//     'index' => 'my_index',
//     'id'    => 10
// ];
// $results = $client->get($params);


// 查询多条
// $params = [
//     'index' => 'my_index',
//     'body'  => [
//         'query' => [
//             'match' => [
//                 'name' => 'zqy'
//             ]
//         ]
//     ]
// ];
// $results = $client->search($params);


// 删除索引（删除表）
// $params = ['index' => 'my_index'];
// $results = $client->indices()->delete($params);


print_r($results->getStatusCode());
var_dump($results->asArray());
// print_r($results->getReasonPhrase());
// var_dump($results->getBody());