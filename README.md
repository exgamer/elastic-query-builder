# elastic-query-builder

```php
        $client = ClientBuilder::create()->setHosts(['localhost:9200'])->build();
        $query = new QueryBuilder();
        $query->setIndex("_my_index");
        $query->setSize(10);
        $query->setFrom(0);
        $query->setSource(['title', "categories", 'features_values.Материал рамы']);
        $query->setQuery((new MultiMatchQuery())->setQuery("Oko Plus")->setFields(['title'])->setFuzziness(1));
        $query->addFilter(
            (new NestedQuery())->setNestedPath("features_values")
                ->should()
                ->addQuery((new TermsQuery())->setField("features_values.Материал рамы")->setValues(["сталь"]))
                ->addQuery((new TermsQuery())->setField("features_values.Сиденье")->setValues(["без спинки", "со спинкой"]))
        );
        $query->addFilter((new TermsQuery())->setField("features_values.Внутренний материал")->setValues(["байка"]));
        $query->addFilter((new TermsQuery())->setField("categories")->setValues([2879]));
        $query->addSorting("_id", "desc");
        $query->addAggregation((new SumAggregation("test_sum"))->setField('count'));
        $response = $client->search($query->build());
```