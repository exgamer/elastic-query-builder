<?php
namespace Citizenzet\ElasticQueryBuilder\Query;

/**
 * base query
 *
 * Class Query
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

    public function must()
    {
        $this->queryType = self::MUST_TYPE;

        return $this;
    }

    public function should()
    {
        $this->queryType = self::SHOULD_TYPE;

        return $this;
    }

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