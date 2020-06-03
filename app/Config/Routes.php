<?php namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Auth');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override('App\Controllers\MainController::error404');
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Auth::index');
$routes->add('login', 'Auth::login');
$routes->add('do_login', 'Auth::do_login');
$routes->add('logout', 'Auth::do_logout');
$routes->add('dashboard', 'MainController::index');

$routes->add('studenthome', 'MainController::studenthome');
$routes->add('studentdata', 'MainController::studentdata');
$routes->add('studentprofile', 'MainController::studentprofile');

$routes->add('teacherhome', 'MainController::teacherhome');
$routes->add('teacherdata', 'MainController::teacherdata');
$routes->add('teacherprofile', 'MainController::teacherprofile');

$routes->add('clearnotificationadmin', 'MainController::clearnotificationadmin');
$routes->add('clearnotificationteacher', 'MainController::clearnotificationteacher');
$routes->add('checksession', 'MainController::checksession');


//Admin Page
$routes->add('adminhome', 'MainController::adminhome');
$routes->add('adminclass', 'MainController::adminclass');
$routes->add('adminteacher', 'MainController::adminteacher');
$routes->add('adminstudent', 'MainController::adminstudent');
$routes->add('adminprofile', 'MainController::adminprofile');
$routes->add('adminuser', 'MainController::adminuser');
$routes->add('adminall', 'MainController::adminall');
$routes->add('admincourse', 'MainController::admincourse');
//Admin Add
$routes->add('adminadduser', 'AdminController::adminadduser');
$routes->add('adminaddclass', 'AdminController::adminaddclass');
$routes->add('adminaddallocation', 'AdminController::adminaddallocation');
$routes->add('adminaddcourse', 'AdminController::adminaddcourse');
//Admin Edit
$routes->add('admineditusermodal', 'AdminController::admineditusermodal');
$routes->add('admineditmuridmodal', 'AdminController::admineditmuridmodal');
$routes->add('admineditgurumodal', 'AdminController::admineditgurumodal');
$routes->add('admineditclassmodal', 'AdminController::admineditclassmodal');
$routes->add('admineditcoursemodal', 'AdminController::admineditcoursemodal');
//Admin Delete
$routes->add('admindeleteuser', 'AdminController::admindeleteuser');
$routes->add('admindeleteuserstudent', 'AdminController::admindeleteuserstudent');
$routes->add('admindeleteuserteacher', 'AdminController::admindeleteuserteacher');
$routes->add('admindeleteclass', 'AdminController::admindeleteclass');
$routes->add('admindeleteallocation', 'AdminController::admindeleteallocation');
$routes->add('admindeletecourse', 'AdminController::admindeletecourse');
//Admin Profile
$routes->add('adminupdateprofile', 'AdminController::adminupdateprofile');
$routes->add('admingrantpermissionprofileedit', 'AdminController::admingrantpermissionprofileedit');



//Guru Page
$routes->add('teacherhome', 'MainController::teacherhome');
$routes->add('teachereditnilaimodal', 'TeacherController::teachereditnilaimodal');
$routes->add('teacherupdateprofile', 'TeacherController::teacherupdateprofile');
$routes->add('teacheraskeditpermission', 'TeacherController::teacheraskeditpermission');

//Student Page
$routes->add('studentupdateprofile', 'StudentController::studentupdateprofile');
$routes->add('studentaskeditpermission', 'StudentController::studentaskeditpermission');
$routes->add('studentreviewscore', 'StudentController::studentreviewscore');

$routes->add('error404', 'MainController::error404');

$routes->add('cropplugin', 'MainController::cropplugin');


/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need to it be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
