<?php



use \koolreport\querybuilder\DB;

//Step 2: Creating Report class
class MyReport extends \koolreport\KoolReport
{
    use \koolreport\codeigniter4\Friendship;
    protected function settings()
    {
        //Get default connection from config.php
        $config = include __DIR__ . "/../../../config.php";

        return array(
            "dataSources"=>array(
                "automaker"=>$config["automaker"]
            )
        );
    }   
    protected function setup()
    {
        $this->src('automaker')
        ->query(
            DB::table("orders")
            ->join("orderdetails",'orders.orderNumber','=','orderdetails.orderNumber')
            ->join("products",'orderdetails.productCode','=','products.productCode')
            ->join("customers",'orders.customerNumber','=','customers.customerNumber')
            ->select(
                'orders.orderNumber',
                'customers.customerName',
                'products.productName',
                'orderdetails.quantityOrdered',
                'orderdetails.priceEach',
                'orders.orderDate'
            )
            ->take(100)
        )
        ->pipe($this->dataStore("orders"));
    } 

}