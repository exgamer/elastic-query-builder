<?php
namespace Citizenzet\ElasticQueryBuilder\Query;

interface QueryInterface
{
    public function build(): array;
}