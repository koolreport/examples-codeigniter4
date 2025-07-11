<?php


use \koolreport\processes\Map;
use \koolreport\processes\Limit;
use \koolreport\processes\Filter;
use \koolreport\cube\processes\Cube;
use \koolreport\pivot\processes\Pivot;

class MyReport extends \koolreport\KoolReport
{
    use \koolreport\codeigniter4\Friendship;
    use \koolreport\export\Exportable;
    use \koolreport\excel\ExcelExportable;

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
    }    function setup()
    {
        $node = $this->src('dollarsales')
        //->query('select *, dollar_sales as dollar_sales2 from customer_product_dollarsales2')
        ->pipe(new Map([
            '{value}' => function($row, $meta) {
                $row['orderQuarter'] = 'Q' . $row['orderQuarter'];
                return $row;
            },
            '{meta}' => function($meta) {
                $meta['columns']['orderDate']['type'] = 'datetime';
                $meta['columns']['orderQuarter']['type'] = 'string';
                return $meta;
            }
        ]))
        ;

        $node
        ->pipe(new Limit(array(
            50, 0
        )))
        ->pipe($this->dataStore('orders'));

        $node->pipe(new Cube(array(
            "rows" => "customerName",
            "column" => "orderQuarter",
            "sum" => "dollar_sales",
        )))
        ->pipe(new Limit(array(
            5, 0
        )))
        ->pipe($this->dataStore('salesQuarterCustomer'));

        $node->pipe(new Cube(array(
            "rows" => "productName",
            "column" => "orderQuarter",
            "sum" => "dollar_sales",
        )))
        ->pipe(new Limit(array(
            5, 0
        )))
        ->pipe($this->dataStore('salesQuarterProduct'));

        $node
        ->pipe(new Filter(array(
            array('customerName', '<', 'Au'),
            array('orderYear', '>', 2003),
        )))
        ->pipe(new Pivot(array(
            "dimensions" => array(
                "column" => "orderYear, orderQuarter",
                "row" => "customerName, productLine",
            ),
            "aggregates" => array(
                "sum" => "dollar_sales",
            ),
        )))
        ->pipe($this->dataStore('salesPivot'));
    }
}
