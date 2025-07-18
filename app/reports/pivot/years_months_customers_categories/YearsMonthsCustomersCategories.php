<?php

use \koolreport\processes\Filter;
use \koolreport\processes\ColumnMeta;
use \koolreport\pivot\processes\Pivot;

class YearsMonthsCustomersCategories extends \koolreport\KoolReport
{
    use \koolreport\codeigniter4\Friendship;
    protected function settings()
    {
        return array(
            "dataSources" => array(
                "dollarsales"=>array(
                    'filePath' => __DIR__ . '/../../../databases/customer_product_dollarsales2.csv',
                    'fieldSeparator' => ';',
                    'class' => "\koolreport\datasources\CSVDataSource"      
                ), 
            )
        );
    }
    function setup()
    {
        $node = $this->src('dollarsales');
        
        $node->pipe(new Filter(array(
            array('customerName', '<', 'Am'),
            array('orderYear', '>', 2003)
        )))
        ->pipe(new ColumnMeta(array(
            "dollar_sales"=>array(
                'type' => 'number',
                "prefix" => "$",
            ),
        )))
        ->pipe(new Pivot(array(
            "dimensions"=>array(
                "column"=>"orderYear, orderMonth",
                "row"=>"customerName, productLine"
            ),
            "aggregates"=>array(
                "sum"=>"dollar_sales",
                "count"=>"dollar_sales"
            )
        )))
        ->pipe($this->dataStore('sales'));  
    }
}
