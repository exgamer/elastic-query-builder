<?php
namespace Citizenzet\ElasticQueryBuilder;

/**
 * elastic response
 * 
 * Class Response
 * @package Citizenzet\ElasticQueryBuilder
 * @author Olzhas Kulzhambekov <exgamer@live.ru>
 */
class Response
{
    /**
     * total hits count
     * 
     * @var integer
     */
    protected $total;

    /**
     * max score
     * 
     * @var double
     */
    protected $maxScore;

    /**
     * response hits
     * 
     * @var array 
     */
    protected $hits = [];

    /**
     * @param array $response
     * @return Response
     */
    public static function instance($response)
    {
        $instance = new static();
        if (isset($response['hits']['total']['value'])) {
            $instance->setTotal($response['hits']['total']['value']);
        }

        if (isset($response['hits']['max_score'])) {
            $instance->setMaxScore($response['hits']['max_score']);
        }

        if (isset($response['hits']['hits'])) {
            $instance->setHits($response['hits']['hits']);
        }

        return $instance;
    }


    /**
     * Returns array of result ids
     *
     * @param $name
     * @return array
     */
    public function getIds()
    {
        $result = [];
        foreach ($this->hits as $value) {
            $result[] = $value['_id'];
        }

        return $result;
    }
    
    /**
     * Returns array of source by key
     *
     * @param $name
     * @return array
     */
    public function getSourceKeyAsArray($name)
    {
        $result = [];
        foreach ($this->hits as $value) {
            if (isset($value["_source"][$name])) {
                $result[] = $value["_source"][$name];
            }
        }

        return $result;
    }

    /**
     * @return int
     */
    public function getTotal(): int
    {
        return $this->total;
    }

    /**
     * @param int $total
     */
    public function setTotal(int $total): void
    {
        $this->total = $total;
    }

    /**
     * @return float
     */
    public function getMaxScore(): float
    {
        return $this->maxScore;
    }

    /**
     * @param float $maxScore
     */
    public function setMaxScore(float $maxScore): void
    {
        $this->maxScore = $maxScore;
    }

    /**
     * @return array
     */
    public function getHits(): array
    {
        return $this->hits;
    }

    /**
     * @param array $hits
     */
    public function setHits(array $hits): void
    {
        $this->hits = $hits;
    }
}
