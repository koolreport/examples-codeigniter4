<?php

use \koolreport\processes\CalculatedColumn;
use \koolreport\processes\ColumnMeta;

class SalesByCountry extends \koolreport\KoolReport
{
    use \koolreport\codeigniter4\Friendship;
    protected function settings()
    {
        $config = include __DIR__ . "/../../../config.php";

        return array(
            "dataSources"=>array(
                "automaker"=>$config["automaker"]
            )
        );
    }

    public function setup()
    {
        $this->src('automaker')
        ->query("
            select customers.country,sum(orderdetails.quantityOrdered*orderdetails.priceEach) as amount 
            from orders
            join orderdetails on orderdetails.orderNumber = orders.orderNumber
            join customers on customers.customerNumber = orders.customerNumber
            group by customers.country
        ")
        ->pipe(new CalculatedColumn(array(
            "tooltip"=>"'{country} : $'.number_format({amount})",
        )))
        ->pipe(new ColumnMeta(array(
            "tooltip"=>array(
                "type"=>"string",
            )
        )))
        ->pipe($this->dataStore("sales"));
    }
}