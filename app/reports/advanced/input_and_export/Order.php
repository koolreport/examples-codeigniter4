<?php


use \koolreport\processes\CalculatedColumn;

class Order extends \koolreport\KoolReport
{
    use \koolreport\codeigniter4\Friendship;
    use \koolreport\inputs\Bindable;

    use \koolreport\inputs\POSTBinding;
    use \koolreport\export\Exportable;


    function defaultParamValues()
    {
        return array(
            "customerNumber"=>0,
        );
    }

    function bindParamsToInputs()
    {
        return array(
            "customerNumber",
        );
    }

    protected function settings()
    {
        $config = include __DIR__ . "/../../../config.php";
        return array(
            "dataSources"=>array(
                "automaker"=>$config["automaker"]
            )
        );

    }

    function setup()
    {

        $this->src('automaker')
        ->query("
            SELECT *
            FROM customers
            ORDER BY customerName
        ")
        ->pipe($this->dataStore("customers"));

        $this->src('automaker')
        ->query("
            SELECT products.productName,orderdetails.priceEach,orderdetails.quantityOrdered
            FROM orders
            JOIN orderdetails
            ON
                orders.orderNumber = orderdetails.orderNumber
            JOIN products
            ON
                products.productCode = orderdetails.productCode
            WHERE customerNumber = :customerNumber
        ")->params(array(
            ":customerNumber"=>$this->params["customerNumber"]
        ))
        ->pipe(new CalculatedColumn(array(
            "amount"=>"{priceEach}*{quantityOrdered}"
        )))
        ->pipe($this->dataStore("orders"));
    }
}