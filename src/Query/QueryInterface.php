<?php
namespace Citizenzet\ElasticQueryBuilder\Query;

/**
 * Interface QueryInterface
 * @package Citizenzet\ElasticQueryBuilder\Query
 */
interface QueryInterface
{
    public function build(): array;
}