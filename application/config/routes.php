<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'Dashboard';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;



$route['api/login'] = 'Api/login';
$route['api/register'] = 'Api/register';
$route['api/get-app'] = 'Api/get_app';
$route['api/get-all-cerita'] = 'Api/get_cerita_all';
$route['api/tambah-soal-praktek'] = 'Api/tambah_soal_praktek';
$route['api/get-profile'] = 'Api/get_profile';
$route['api/change-password'] = 'Api/change_password';
$route['api/change-profile'] = 'Api/change_profile';
$route['api/update-image'] = 'Api/update_image';
$route['api/get-all-praktek']  = 'Api/get_praktek_all';


$route['login'] = 'Auth';
$route['logout'] = 'Auth/logout';
$route['post_login'] = 'Auth/login';

$route['kode-list']  = 'dashboard/user_list';
$route['kode']  = 'dashboard/user';
$route['add-kode']  = 'dashboard/add_kode';
$route['kode/(:any)']  = 'dashboard/kode_kode/$1';
$route['kode-kode/(:any)']  = 'dashboard/kode_kode_nilai/$1';
$route['update-nilai']  = 'dashboard/update_nilai';
$route['edit-kode']  = 'dashboard/edit_kode';
$route['delete-kode']  = 'dashboard/delete_kode';
$route['api/get-soal-all'] = 'Api/get_soal_all';



// $route['api/get-home'] = 'Api/get_home';
// $route['api/get-how'] = 'Api/get_how';
// $route['api/get-product'] = 'Api/get_product';
// $route['api/get-product-all'] = 'Api/get_product_all';
// $route['api/get-product-detail'] = 'Api/get_product_detail';
// $route['api/get-event'] = 'Api/get_event';
// $route['api/get-event-detail'] = 'Api/get_event_detail';
// $route['api/get-event-all'] = 'Api/get_event_all';

// $route['api/create-farm'] = 'Api/create_farm';
// $route['api/get-all-farm'] = 'Api/get_farm_all';
// $route['api/delete-farm'] = 'Api/delete_farm';
// $route['api/delete-task'] = 'Api/delete_task';
// $route['api/get-all-task'] = 'Api/get_task_all';
// $route['api/update-task'] = 'Api/update_task';
// $route['api/get-farm'] = 'Api/get_farm';
// $route['api/get-task'] = 'Api/get_task';
// $route['api/create-task'] = 'Api/create_task';
// $route['api/update-farm'] = 'Api/update_farm';
// $route['api/get-task-home'] = 'Api/get_task_home';
// $route['api/create-document'] = 'Api/create_document';
// $route['api/get-about'] = 'Api/get_about';
// $route['api/get-farm-type'] = 'Api/get_farm_type';
// $route['api/get-all-document'] = 'Api/get_all_document';









$route['home-page']  = 'dashboard/home_page';
$route['update-home-page']  = 'dashboard/update_home_page';
$route['update-slider1-page']  = 'dashboard/update_slider1_page';
$route['update-slider2-page']  = 'dashboard/update_slider2_page';
$route['update-slider3-page']  = 'dashboard/update_slider3_page';

$route['how-page']  = 'dashboard/how_page';
$route['update-how-page']  = 'dashboard/update_how_page';
$route['update-how-page-related']  = 'dashboard/update_how_page_related';

$route['get-list-step']  = 'dashboard/get_list_step';
$route['add-new-step']  = 'dashboard/add_new_step';
$route['step/add']  = 'dashboard/add_step';
$route['delete-step']  = 'dashboard/delete_step';
$route['step/edit/(:any)']  = 'dashboard/edit_step/$1';
$route['edit-step']  = 'dashboard/post_edit_step';

$route['get-list-youtube']  = 'dashboard/get_list_youtube';
$route['add-new-youtube']  = 'dashboard/add_new_youtube';
$route['delete-youtube']  = 'dashboard/delete_youtube';
$route['edit-youtube']  = 'dashboard/post_edit_youtube';


$route['product-page']  = 'dashboard/product_page';
$route['update-product-page']  = 'dashboard/update_product_page';
$route['product-list']  = 'dashboard/product_list';
$route['delete-product']  = 'dashboard/delete_product';

$route['add-new-product']  = 'dashboard/add_new_product';
$route['product/add']  = 'dashboard/add_product';
$route['edit-product']  = 'dashboard/post_edit_product';
$route['product/edit/(:any)']  = 'dashboard/edit_product/$1';
$route['product/photos/(:any)']  = 'dashboard/product_photos/$1';
$route['product-photos-list/(:any)']  = 'dashboard/product_photos_list/$1';
$route['delete-product-photos']  = 'dashboard/remove_product_foto';
$route['add-product-photo']  = 'dashboard/add_product_foto';

$route['event/page']  = 'dashboard/event_page';
$route['event/categories']  = 'dashboard/categories';
$route['get-categories']  = 'dashboard/get_categories';

$route['update-event-page']  = 'dashboard/update_event_page';
$route['event-list']  = 'dashboard/event_list';
$route['event-list-newest']  = 'dashboard/event_list_newest';
$route['add-newest-event']  = 'dashboard/add_newest_event';
$route['delete-newest-event']  = 'dashboard/delete_newest_event';

$route['delete-event']  = 'dashboard/delete_event';
$route['delete-category']  = 'dashboard/delete_category';
$route['edit-category']  = 'dashboard/edit_category';
$route['add-new-event']  = 'dashboard/add_new_event';
$route['add-category']  = 'dashboard/add_category';
$route['event/add']  = 'dashboard/add_event';
$route['edit-event']  = 'dashboard/post_edit_event';
$route['event/edit/(:any)']  = 'dashboard/edit_event/$1';
$route['event/photos/(:any)']  = 'dashboard/event_photos/$1';
$route['event-photos-list/(:any)']  = 'dashboard/event_photos_list/$1';
$route['delete-event-photos']  = 'dashboard/remove_event_foto';
$route['add-event-photo']  = 'dashboard/add_event_foto';

$route['appeal-page']  = 'dashboard/appeal_page';
$route['update-appeal-page']  = 'dashboard/update_appeal_page';
$route['appeal-list']  = 'dashboard/appeal_list';
$route['delete-appeal']  = 'dashboard/delete_appeal';
$route['add-new-appeal']  = 'dashboard/add_new_appeal';
$route['appeal/add']  = 'dashboard/add_appeal';
$route['edit-appeal']  = 'dashboard/post_edit_appeal';
$route['appeal/edit/(:any)']  = 'dashboard/edit_appeal/$1';
$route['appeal/photos/(:any)']  = 'dashboard/appeal_photos/$1';
$route['appeal-photos-list/(:any)']  = 'dashboard/appeal_photos_list/$1';
$route['delete-appeal-photos']  = 'dashboard/remove_appeal_foto';
$route['add-appeal-photo']  = 'dashboard/add_appeal_foto';

$route['analytic-list']  = 'dashboard/analytic_list';
$route['analytic']  = 'dashboard/analytic';
$route['export/(:any)/(:any)']  = 'dashboard/get_excel/$1/$2';











$route['footer']  = 'dashboard/footer';
$route['update-footer']  = 'dashboard/update_footer';

// $route['youtube']  = 'dashboard/youtube';
// $route['update_youtube']  = 'dashboard/update_youtube';

// $route['what']  = 'dashboard/what';
// $route['update_what']  = 'dashboard/update_what';

$route['top-page']  = 'dashboard/top_page';
$route['update-top-page']  = 'dashboard/update_top_page';

$route['activity']  = 'dashboard/activity';
$route['update-activity']  = 'dashboard/update_activity';

$route['news-page']  = 'dashboard/news_page';
$route['update-news-page']  = 'dashboard/update_news_page';

$route['product-page']  = 'dashboard/product_page';
$route['update-product-page']  = 'dashboard/update_product_page';

$route['video']  = 'dashboard/video';
$route['update-video']  = 'dashboard/update_video';

$route['short-desc']  = 'dashboard/short_desc';
$route['region-info']  = 'dashboard/region_info';
$route['photos']  = 'dashboard/photos';
$route['remove_foto']  = 'dashboard/remove_foto';
$route['add_foto']  = 'dashboard/add_foto';
$route['update-short-desc']  = 'dashboard/update_short_desc';
$route['update-region-info']  = 'dashboard/update_region_info';

$route['news']  = 'dashboard/news';
$route['news/add']  = 'dashboard/add_news';
$route['add-new-news']  = 'dashboard/add_new_news';
$route['delete-news']  = 'dashboard/delete_news';
$route['news/edit/(:any)']  = 'dashboard/edit_news/$1';
$route['edit-news']  = 'dashboard/post_edit_news';
$route['news/photos/(:any)']  = 'dashboard/news_photos/$1';
$route['remove-news-foto']  = 'dashboard/remove_news_foto';
$route['add-news-foto']  = 'dashboard/add_news_foto';

// $route['product']  = 'dashboard/product';




$route['activities']  = 'dashboard/activities';
$route['activities/add']  = 'dashboard/add_activities';
$route['edit-activities']  = 'dashboard/post_edit_activities';
$route['activities/edit/(:any)']  = 'dashboard/edit_activities/$1';
$route['delete-activities']  = 'dashboard/delete_activities';
$route['add-new-activities']  = 'dashboard/add_new_activities';
$route['activities/photos/(:any)']  = 'dashboard/activities_photos/$1';
$route['remove-activities-foto']  = 'dashboard/remove_activities_foto';
// $route['add-activities-foto']  = 'dashboard/index';






// $route['update-video']  = 'dashboard/update_video';
