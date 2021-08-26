<?php
namespace Citizenzet\ElasticQueryBuilder\Aggregation;

/**
 * Class SumAggregation
 * @package Citizenzet\ElasticQueryBuilder\Aggregation
 * @author Olzhas Kulzhambekov <exgamer@live.ru>
 */
class SumAggregation extends MetricAggregation
{
    public function getMetricName(): string
    {
        return 'sum';
    }
}