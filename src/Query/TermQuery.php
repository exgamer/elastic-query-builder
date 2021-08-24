
<?php
namespace Citizenzet\ElasticQueryBuilder\Query;

use Citizenzet\ElasticQueryBuilder\Exceptions\QueryException;

/**
 * Class TermQuery
 * @author Olzhas Kulzhambekov <exgamer@live.ru>
 */
class TermQuery extends Query
{
    /** @var string */
    protected $field;

    /** @var array */
    protected $values = [];

    public function __construct(string $field = null, array $values = [])
    {
        $this->field = $field;
        $this->values = $values;
    }

    public function setField(string $field): self
    {
        $this->field = $field;

        return $this;
    }

    public function setValues(array $values): self
    {
        $this->values = $values;

        return $this;
    }

    public function build(): array
    {
        if (null === $this->field) {
            throw new QueryException('You need to call setField() on'.__CLASS__);
        }
        if (empty($this->values)) {
            throw new QueryException('You need to call setValues() on'.__CLASS__);
        }


        return [
            'term' => [
                $this->field => $this->values,
            ],
        ];
    }
}