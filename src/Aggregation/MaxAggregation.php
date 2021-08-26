<?php
namespace Citizenzet\ElasticQueryBuilder\Aggregation;

/**
 * Class MaxAggregation
 * @package Citizenzet\ElasticQueryBuilder\Aggregation
 * @author Olzhas Kulzhambekov <exgamer@live.ru>
 */
class MaxAggregation extends MetricAggregation
{
    public function getMetricName(): string
    {
        return 'max';
    }
}