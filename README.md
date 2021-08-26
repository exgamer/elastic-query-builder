# elastic-query-builder

```php
<?php
        $client = ClientBuilder::create()->setHosts(['localhost:9200'])->build();
        $query = new QueryBuilder();
        $query->setIndex("_my_index");
        $query->setSize(10);
        $query->setFrom(0);
        
        //Выбор полей
        $query->setSource(['title', "categories", 'features_values.Материал рамы']);  
        
        //Запрос
        // поиск по строке
        $query->setQuery((new MultiMatchQuery())->setQuery("Oko Plus")->setFields(['title'])->setFuzziness(1)); 
        
        //ФИльтрация
        $query->addFilter(
            (new NestedQuery())->setNestedPath("features_values")
                ->should()
                ->addQuery((new TermsQuery())->setField("features_values.Материал рамы")->setValues(["сталь"]))
                ->addQuery((new TermsQuery())->setField("features_values.Сиденье")->setValues(["без спинки", "со спинкой"]))
        );
        $query->addFilter((new TermsQuery())->setField("features_values.Внутренний материал")->setValues(["байка"]));
        $query->addFilter((new TermsQuery())->setField("categories")->setValues([2879]));
        //Сортировка
        $query->addSorting("_id", "desc");
        
        //Агрегации
        // сумма
        $query->addAggregation((new SumAggregation("test_sum"))->setField('count')); 
        // максимальное значение
        $query->addAggregation((new MaxAggregation("max_price"))->setField('price')); 
         // минимальное значение
        $query->addAggregation((new MinAggregation("max_price"))->setField('price')); 
        
        
        $response = $client->search($query->build());
```