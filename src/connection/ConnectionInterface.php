<?php

namespace ElasticSearchOrm\ElasticSearchOrm\connection;

use ElasticSearchOrm\ElasticSearchOrm\ElasticSearch;

interface ConnectionInterface
{
    public function setConnect(ElasticSearch $es);
}
