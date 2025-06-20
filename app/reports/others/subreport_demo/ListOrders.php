<?php

class ListOrders extends \koolreport\KoolReport
{
    use \koolreport\codeigniter4\Friendship;
    protected function settings()
    {
        $config = include __DIR__ . "/../../../config.php";
        return array(
            "dataSources"=>array(
                "automaker"=>$config["automaker"],
            ),
        );
    }

    function setup()
    {
        if(isset($this->params["customerNumber"]))
        {
            $this->src("automaker")
            ->query("
                SELECT orderNumber,orderDate,status FROM orders
                WHERE
                customerNumber = :customerNumber
            ")
            ->params(array(
                ":customerNumber"=>$this->params["customerNumber"],
            ))
            ->pipe($this->dataStore("orders"));
        }
    }
}