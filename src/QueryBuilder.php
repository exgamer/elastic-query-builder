<?php
namespace Citizenzet\ElasticQueryBuilder;

use Citizenzet\ElasticQueryBuilder\Query\QueryInterface;

/**
 * Query Builder for elastic
 *
 * Class QueryBuilder
 * @author Olzhas Kulzhambekov <exgamer@live.ru>
 */
class QueryBuilder
{
    /**
     * index name
     *
     * @var string
     */
    private $index;

    /**
     * from value
     *
     * @var integer
     */
    private $from;

    /**
     * elements size
     *
     * @var integer
     */
    private $size;

    /**
     * source fields
     *
     * @var array
     */
    private $source;

    /**
     * queries array
     *
     * @var QueryInterface
     */
    private $query;

    /**
     * filters array
     *
     * @var array
     */
    private $filters = [];

    /**
     * sorting array
     *
     * @var array
     */
    private $sorting = [];
    
    /**
     * @return string|null
     */
    public function getIndex(): ?string
    {
        return $this->index;
    }

    /**
     * @param string|null $index
     */
    public function setIndex(?string $index): void
    {
        $this->index = $index;
    }

    /**
     * @return int|null
     */
    public function getFrom(): ?int
    {
        return $this->from;
    }

    /**
     * @param int|null $from
     */
    public function setFrom(?int $from): void
    {
        $this->from = $from;
    }

    /**
     * @return int|null
     */
    public function getSize(): ?int
    {
        return $this->size;
    }

    /**
     * @param int|null $size
     */
    public function setSize(?int $size): void
    {
        $this->size = $size;
    }

    /**
     * add query
     *
     * @param QueryInterface $query
     * @return QueryBuilder
     */
    public function setQuery(QueryInterface $query): self
    {
        $this->query = $query;

        return $this;
    }

    /**
     * set source fields
     *
     * @param array $source
     * @return QueryBuilder
     */
    public function setSource(array $source)
    {
        $this->source = $source;

        return $this;
    }

    /**
     * add filter
     *
     * @param QueryInterface $filter
     * @return QueryBuilder
     */
    public function addFilter(QueryInterface $filter): self
    {
        $this->filters[] = $filter;

        return $this;
    }

    /**
     * add sorting
     *
     * @param $key
     * @param string $sort
     * @return QueryBuilder
     */
    public function addSorting($key, $sort= "asc"): self
    {
        $this->sorting[$key] = $sort;

        return $this;
    }

    public function build(): array
    {
        $result = [];
        if (null !== $this->index) {
            $result['index'] = $this->index;
        }

        if (null !== $this->from) {
            $result['from'] = $this->from;
        }

        if (null !== $this->size) {
            $result['size'] = $this->size;
        }

        if (null !== $this->source && is_array($this->source)) {
            $result['_source'] = $this->source;
        }

        $query = null;
        $filters = [];
        if (null !== $this->query) {
            $query = $this->query->build();
        }

        if (null !== $this->filters) {
            foreach ($this->filters as $filter) {
                $filters[] = $filter->build();
            }
        }

        if ($query) {
            $result['body']['query']['bool'][$this->query->getQueryType()]= $query;
        }

        if ($filters) {
            $result['body']['query']['bool']['filter'] = $filters;
        }

        if ($this->sorting) {
            foreach ($this->sorting as $k => $v) {
                $result['body']['sort'][$k] = $v;
            }
        }

        return $result;
    }
}