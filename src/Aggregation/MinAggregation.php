<?php
namespace Citizenzet\ElasticQueryBuilder\Aggregation;

/**
 * Class MinAggregation
 * @package Citizenzet\ElasticQueryBuilder\Aggregation
 * @author Olzhas Kulzhambekov <exgamer@live.ru>
 */
class MinAggregation extends MetricAggregation
{
    public function getMetricName(): string
    {
        return 'min';
    }
}