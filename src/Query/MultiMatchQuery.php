<?php
namespace Citizenzet\ElasticQueryBuilder\Query;

use Citizenzet\ElasticQueryBuilder\Exceptions\QueryException;

/**
 * Multimatch query for elastic search
 *
 * Class MultiMatchQuery
 * @author Olzhas Kulzhambekov <exgamer@live.ru>
 */
class MultiMatchQuery extends Query
{
    /**
     * search fields array
     *
     * @var array
     */
    protected $fields;

    /**
     * query
     *
     * @var string
     */
    protected $query;

    /**
     * fuzziness value
     *
     * @var integer
     */
    protected $fuzziness;

    public function setFields(array $fields)
    {
        $this->fields = $fields;

        return $this;
    }

    public function setQuery(string $query)
    {
        $this->query = $query;

        return $this;
    }

    public function setFuzziness(string $fuzziness)
    {
        $this->fuzziness = $fuzziness;

        return $this;
    }

    public function build(): array
    {
        if (null === $this->fields) {
            throw new QueryException('You need to call setFields() on'.__CLASS__);
        }

        if (null === $this->query) {
            throw new QueryException('You need to call setQuery() on'.__CLASS__);
        }

        $query = [
            'multi_match' => [
                'query' => $this->query,
                'fields' => $this->fields,
            ],
        ];

        if (null !== $this->fuzziness) {
            $query['multi_match']['fuzziness'] = $this->fuzziness;
        }

        return $query;
    }
}