<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		// echo "uri_string=" . uri_string() . "<br>";
		// return view('welcome_message');
		include FCPATH . "index_reports.php";
	}

	public function customReport()
	{
		$report = new \App\reports\MyReport();
		$report_content = $report->run()->render(true);
		// echo $report_content;
		// return;
		// return $report_content;
		return view("customReport", ["report_content" => $report_content]);
	}

	public function report()
	{
		// echo "Home controller -> report()<br>";
		// FCPATH   -> 'path/to/myCodeIgniter/public/'
		// APPPATH  -> 'path/to/myCodeIgniter/app/'
		// echo "uri_string=" . uri_string() . "<br>";
		// echo "root_url: $root_url<br>";
		$uri_string = uri_string();
		$uri_string = rtrim($uri_string, "/");
		$report_path = APPPATH . $uri_string . "/";
		ob_start();
		include $report_path . "run.php";
		$report_content = ob_get_clean();
		// echo $report_content;
		return view("report", ["report_content" => $report_content]);
	}

	public function export()
	{
		$uri_string = uri_string();
		$uri_string = rtrim($uri_string, "/");
		$uri_string = substr($uri_string, 0, strrpos($uri_string, "/"));
		// echo "uri_string=$uri_string<br>";
		$report_path = APPPATH . $uri_string . "/";
		if (file_exists($report_path . "export.php")) {
			include $report_path . "export.php";
		} else if (file_exists($report_path . "exportPDF.php")) {
			include $report_path . "exportPDF.php";
		} else if (file_exists($report_path . "exportExcel.php")) {
			include $report_path . "exportExcel.php";
		};
	}

	public function exportPDF()
	{
		$uri_string = uri_string();
		$uri_string = rtrim($uri_string, "/");
		$uri_string = substr($uri_string, 0, strrpos($uri_string, "/"));
		// echo "uri_string=$uri_string<br>";
		$report_path = APPPATH . $uri_string . "/";
		if (file_exists($report_path . "exportPDF.php")) {
			include $report_path . "exportPDF.php";
		} 
	}

	public function exportExcel()
	{
		$uri_string = uri_string();
		$uri_string = rtrim($uri_string, "/");
		$uri_string = substr($uri_string, 0, strrpos($uri_string, "/"));
		// echo "uri_string=$uri_string<br>";
		$report_path = APPPATH . $uri_string . "/";
		if (file_exists($report_path . "exportExcel.php")) {
			include $report_path . "exportExcel.php";
		} 
	}
}
