<?php
namespace Citizenzet\ElasticQueryBuilder\Query;

/**
 * Nested query
 *
 * Class NestedQuery
 * @package Jmart\Core\Elastic\Query
 * @author Olzhas Kulzhambekov <exgamer@live.ru>
 */
class NestedQuery implements QueryInterface
{
    protected $path;
    protected $query;
    protected $type = "must";

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

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
        $q = [];
        foreach ($this->query as $query) {
            $q[] = $query->build();
        }

        return [
            'nested' => [
                'path' => $this->path,
                'query' => [
                    'bool' => [
                        $this->type => $q,
                    ],
                ]
            ],
        ];
    }
}