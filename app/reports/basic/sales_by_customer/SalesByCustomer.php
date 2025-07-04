<?php



use \koolreport\processes\Group;
use \koolreport\processes\Sort;
use \koolreport\processes\Limit;


class SalesByCustomer extends \koolreport\KoolReport
{
    use \koolreport\codeigniter4\Friendship;
  
  function settings()
  {
    return array(
      "dataSources"=>array(
        "sales"=>array(
            "class"=>'\koolreport\datasources\CSVDataSource',
            "filePath"=>__DIR__ . "/../../../databases/customer_product_dollarsales2.csv",
            "fieldSeparator"=>";"
        ),        
      )
    );
  }
  
  function setup()
  {
        $this->src('sales')
        ->pipe(new Group(array(
            "by"=>"customerName",
            "sum"=>"dollar_sales"
        )))
        ->pipe(new Sort(array(
            "dollar_sales"=>"desc"
        )))
        ->pipe(new Limit(array(10)))
        ->pipe($this->dataStore('sales_by_customer'));
  }
}
