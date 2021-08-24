<?php
namespace Citizenzet\ElasticQueryBuilder\Query;

use Citizenzet\ElasticQueryBuilder\Exceptions\QueryException;

/**
 * Nested query
 *
 * Class NestedQuery
 * @author Olzhas Kulzhambekov <exgamer@live.ru>
 */
class NestedQuery extends Query
{
    protected $path;
    protected $query;

    public function setNestedPath(string $path)
    {
        $this->path = $path;

        return $this;
    }

    public function addQuery(QueryInterface $query)
    {
        $this->query[] = $query;

        return $this;
    }

    public function build(): array
    {
        if (empty($this->query)) {
            throw new QueryException('Empty query user addQuery '.__CLASS__);
        }
        
        $q = [];
        foreach ($this->query as $query) {
            $q[] = $query->build();
        }

        return [
            'nested' => [
                'path' => $this->path,
                'query' => [
                    'bool' => [
                        $this->queryType => $q,
                    ],
                ]
            ],
        ];
    }
}