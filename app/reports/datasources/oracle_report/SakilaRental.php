<?php



use \koolreport\KoolReport;
use \koolreport\processes\Filter;
use \koolreport\processes\TimeBucket;
use \koolreport\processes\Group;
use \koolreport\processes\Limit;

class SakilaRental extends \koolreport\KoolReport
{
    use \koolreport\codeigniter4\Friendship;
    protected function settings()
    {
        return array(
            "dataSources"=>array(
                "sakila_rental"=>array(
                    "connectionString"=>"oci:dbname=127.0.0.1/sakila;charset=UTF8",
                    "username"=>"username",
                    "password"=>"password",
                ),
            )
        ); 
    }    
    protected function setup()
    {
        $this->src('sakila_rental')
        ->query("SELECT payment_date,amount FROM payment")
        ->pipe(new TimeBucket(array(
            "payment_date"=>"month"
        )))
        ->pipe(new Group(array(
            "by"=>"payment_date",
            "sum"=>"amount"
        )))
        ->pipe($this->dataStore('sale_by_month'));
    } 
}