<?php
namespace Citizenzet\ElasticQueryBuilder\Query;

/**
 * base query
 *
 * Class Query
 * @package Citizenzet\ElasticQueryBuilder\Query
 * @author Olzhas Kulzhambekov <exgamer@live.ru>
 */
abstract class Query implements QueryInterface
{
    const MUST_TYPE = "must";
    const SHOULD_TYPE = "should";

    /**
     * query
     *
     * @var string
     */
    protected $queryType = self::MUST_TYPE;

    /**
     * @param string $queryType
     * @return Query
     */
    public function setQueryType($queryType)
    {
        $this->queryType = $queryType;

        return $this;
    }

    /**
     * @return string
     */
    public function getQueryType()
    {
        return $this->queryType;
    }


}