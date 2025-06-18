<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

$routes->get('/', 'Home::index');

$routes->get('/customReport', 'Home::customReport');

$menu = json_decode(file_get_contents(FCPATH . "reports.json"), true);
// echo "<pre>" . json_encode($menu, JSON_PRETTY_PRINT) . "</pre>";
foreach ($menu as $section_name => $section) {
	foreach ($section as $group_name => $group) {
		foreach ($group as $sname => $surl) {
			if (is_string($surl)) {
				$surl = rtrim($surl, "/");
				// echo "surl=$surl<br>"; 
				$routes->get($surl, 'Home::report');
				$routes->post($surl, 'Home::report');
				$surlExport = "$surl/export";
				$routes->get($surlExport, 'Home::export');
				$routes->post($surlExport, 'Home::export');
				$surlExportPDF = "$surl/exportPDF";
                $routes->get($surlExportPDF, 'Home::exportPDF');
				$routes->post($surlExportPDF, 'Home::exportPDF');
				$surlExportExcel = "$surl/exportExcel";
                $routes->get($surlExportExcel, 'Home::exportExcel');
				$routes->post($surlExportExcel, 'Home::exportExcel');
			} else {
				foreach ($surl as $tname => $turl) {
					$turl = rtrim($turl, "/");
					$routes->get($turl, 'Home::report');
					$routes->post($turl, 'Home::report');
					$turlExport = "$turl/export";
					$routes->get($turlExport, 'Home::export');
					$routes->post($turlExport, 'Home::export');
                    $turlExportPDF = "$turl/exportPDF";
                    $routes->get($turlExportPDF, 'Home::exportPDF');
                    $routes->post($turlExportPDF, 'Home::exportPDF');
                    $turlExportExcel = "$turl/exportExcel";
                    $routes->get($turlExportExcel, 'Home::exportExcel');
                    $routes->post($turlExportExcel, 'Home::exportExcel');
				}
			}
		}
	}
}


/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
