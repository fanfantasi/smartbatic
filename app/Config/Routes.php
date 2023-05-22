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
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Auth::index',['filter'=>'noauth']);
$routes->get('/', 'Admin::index',['filter'=>'auth']);
$routes->get('/admin', 'Admin::index',['filter'=>'auth']);
$routes->get('/admin/users', 'Admin::users',['filter'=>'auth']);
$routes->get('/admin/getUsers', 'Admin::getUsers',['filter'=>'auth']);
$routes->get('/admin/newUser', 'Admin::newUser',['filter'=>'auth']);
$routes->get('/admin/saveUsers', 'Admin::saveUsers',['filter'=>'auth']);
$routes->get('/admin/updateUser', 'Admin::updateUser',['filter'=>'auth']);
$routes->get('/admin/destroyuser', 'Admin::destroyuser',['filter'=>'auth']);
$routes->get('/admin/activeusers', 'Admin::activeusers',['filter'=>'auth']);
$routes->get('/admin/sekolah', 'Admin::sekolah',['filter'=>'auth']);
$routes->get('/admin/getsekolah', 'Admin::getsekolah',['filter'=>'auth']);
$routes->get('/admin/combosekolah', 'Admin::combosekolah',['filter'=>'auth']);
$routes->get('/admin/saveSekolah', 'Admin::saveSekolah',['filter'=>'auth']);
$routes->get('/admin/destroysekolah', 'Admin::destroysekolah',['filter'=>'auth']);
$routes->get('/admin/updatesekolah', 'Admin::updatesekolah',['filter'=>'auth']);
$routes->get('/admin/peserta', 'Admin::peserta',['filter'=>'auth']);
$routes->get('/admin/getpeserta', 'Admin::getpeserta',['filter'=>'auth']);
$routes->get('/admin/aktivasipeserta', 'Admin::aktivasipeserta',['filter'=>'auth']);
$routes->get('/admin/module', 'Admin::module',['filter'=>'auth']);
$routes->get('/admin/getmodule', 'Admin::getmodule',['filter'=>'auth']);
$routes->get('/admin/downloadmodule', 'Admin::downloadmodule',['filter'=>'auth']);
$routes->get('/admin/destroymodule', 'Admin::destroymodule',['filter'=>'auth']);
$routes->get('/admin/videos', 'Admin::videos',['filter'=>'auth']);
$routes->get('/admin/getvideos', 'Admin::getvideos',['filter'=>'auth']);
$routes->get('/admin/savevideos', 'Admin::savevideos',['filter'=>'auth']);
$routes->get('/admin/updatevideos', 'Admin::updatevideos',['filter'=>'auth']);
$routes->get('/admin/destroyvideos', 'Admin::destroyvideos',['filter'=>'auth']);
$routes->get('/admin/banners', 'Admin::banners',['filter'=>'auth']);
$routes->get('/admin/getbanners', 'Admin::getbanners',['filter'=>'auth']);
$routes->get('/admin/destroybanners', 'Admin::destroybanners',['filter'=>'auth']);
$routes->get('/admin/topik', 'Admin::topik',['filter'=>'auth']);
$routes->get('/admin/gettopik', 'Admin::gettopik',['filter'=>'auth']);
$routes->get('/admin/combotopik', 'Admin::combotopik',['filter'=>'auth']);
$routes->get('/admin/savetopik', 'Admin::savetopik',['filter'=>'auth']);
$routes->get('/admin/updatetopik', 'Admin::updatetopik',['filter'=>'auth']);
$routes->get('/admin/destroytopik', 'Admin::destroytopik',['filter'=>'auth']);
$routes->get('/admin/mulaiquiz', 'Admin::mulaiquiz',['filter'=>'auth']);
$routes->get('/admin/selesaiquiz', 'Admin::selesaiquiz',['filter'=>'auth']);
$routes->get('/admin/quiz', 'Admin::quiz',['filter'=>'auth']);
$routes->get('/admin/getquiz', 'Admin::getquiz',['filter'=>'auth']);
$routes->get('/admin/savequiz', 'Admin::savequiz',['filter'=>'auth']);
$routes->get('/admin/gallery', 'Admin::gallery',['filter'=>'auth']);
$routes->get('/admin/getgallery', 'Admin::getgallery',['filter'=>'auth']);
$routes->get('/admin/sertifikat', 'Admin::sertifikat',['filter'=>'auth']);
$routes->get('/admin/getsertifikat', 'Admin::getsertifikat',['filter'=>'auth']);
$routes->get('/admin/destroysertifikat', 'Admin::destroysertifikat',['filter'=>'auth']);
$routes->get('/admin/laporanpdf', 'Admin::laporanpdf',['filter'=>'auth']);


/**
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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
