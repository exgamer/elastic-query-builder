<?php
namespace Citizenzet\ElasticQueryBuilder\Aggregation;

/**
 * Class Aggregation
 * @package Erichard\ElasticQueryBuilder\Aggregation
 * @author Olzhas Kulzhambekov <exgamer@live.ru>
 */
abstract class Aggregation
{
    /** @var string */
    private $name;

    /** @var array */
    private $aggregations = [];

    abstract public function build(): array;

    public function buildRecursivly(): array
    {
        $build = $this->build();

        if (!empty($this->aggregations)) {
            $build['aggs'] = [];

            foreach($this->aggregations as $aggregation) {
                $build['aggs'][$aggregation->getName()] = $aggregation->buildRecursivly();
            }
        }

        return $build;
    }

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function addAggregation(Aggregation $aggregation)
    {
        $this->aggregations[$aggregation->getName()] = $aggregation;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public static function terms(string $name): TermsAggregation
    {
        return new TermsAggregation($name);
    }

    public static function dateHistogram(string $name): DateHistogramAggregation
    {
        return new DateHistogramAggregation($name);
    }

    public static function nested(string $name): NestedAggregation
    {
        return new NestedAggregation($name);
    }

    public static function reverseNested(string $name): ReverseNestedAggregation
    {
        return new ReverseNestedAggregation($name);
    }

    public static function filter(string $name): FilterAggregation
    {
        return new FilterAggregation($name);
    }

    public static function cardinality(string $name): CardinalityAggregation
    {
        return new CardinalityAggregation($name);
    }

    public static function max(string $name): MaxAggregation
    {
        return new MaxAggregation($name);
    }

    public static function min(string $name): MinAggregation
    {
        return new MinAggregation($name);
    }

    public static function sum(string $name): SumAggregation
    {
        return new SumAggregation($name);
    }

    public static function topHits(string $name): TopHitsAggregation
    {
        return new TopHitsAggregation($name);
    }
}