# KoolReport in CodeIgniter

CodeIgniter is a PHP full-stack web framework that is light, fast, flexible and secure.
More information can be found at the [official site](https://codeigniter.com).

KoolReport is reporting framework and can be integrated into Laravel or any other MVC framework. KoolReport help you to create data report faster and easier.

In this repository, we would like to demonstrate how KoolReport can be used in Laravel.

# Installation

Run `composer` command in your Laravel directory to install `koolreport/core` and `koolreport/codeigniter4`

```
composer require koolreport/core
composer require koolreport/codeigniter4
```
or install `koolreport/pro` if you have a license for it

```
composer require koolreport/pro
```

# Create reports using friendship trait for setting up assets and datasources

1. Inside `app` directory, create `reports` subdirectory to hold your reports.
2. Create `MyReport.php` and `MyReport.view.php` inside `reports` directory. Assign `App\reports` namespace for the report if you want it can be autoloaded. Otherwise, you could load the report directly in your controller when using it. Please see the contents of two files in our repository.
3. Add \koolreport\laravel\Friendship trait to your report like following:

```
class MyReport extends \koolreport\KoolReport
{
    use \koolreport\codeigniter4\Friendship;
    ...
```
This trait would help the report to publish js, css assets to Laravel's `public` directory in a subdirectory called `asset/koolreport_assets` as well as allow using Laravel's database settings in the report.

## Create route and action

In `app/Config/routes.php`, create a route to your report and its action with a controller:

```
$routes->get('/customReport', 'Home::customReport');
```

In the `Home` controller (`app/Controllers/Home.php`), create the action method:

```
	public function customReport()
	{
		$report = new \App\reports\MyReport();
		$report_content = $report->run()->render(true);
		return view("customReport", ["report_content" => $report_content]);
	}
```
Create the report view `app/views/customReport.php` and put your report content anywhere you like:

```
<html>
...
<?php echo $report_content; ?>
</html>
```

All done!

## View result

Put your CodeIgniter app on your server/localhost. Then you can access after running

```
http://locahost/examples-codeigniter4/public/customReport
```

![combochart](combochart.png)


## CSRF field/token in form submissions and xhr requests

In case you enable csrf security for your app, in reports with form submission or xhr request users need to add csrf field/token to the form and request for server response to work.

For example, adding csrf field to form:

```
    <form method="post">
        <?php echo csrf_field(); ?>
```
or add csrf token to request:

```
    <script>
        subReport.update("SaleByCountriesReport", {
            <?php echo csrf_token(); ?>: '<?php echo csrf_token(); ?>'
        });
```

# Summary

KoolReport is a great php reporting framework. You can use KoolReport alone with pure php or inside any modern MVC frameworks like Laravel, CakePHP, CodeIgniter, Yii2. If you have any questions regarding KoolReport, free free to contact us at [our forum](https://www.koolreport.com/forum/topics) or email to [support@koolreport.com](mailto:support@koolreport.com).

__Happy Reporting!__