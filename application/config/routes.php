<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
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


$route['default_controller'] = 'Home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
 

 /*Registration url*/
 
  
$route['registration'] = 'Registration';
$route['forgot-password'] = 'Registration/forgotpassword';
$route['login'] = 'Login'; 
$route['my-profile'] = 'Profile'; 
$route['user-profile'] = 'Profile/userprofile';
$route['rewards'] = 'Profile/rewards'; 
$route['downline'] = 'Profile/downline'; 
$route['my-team'] = 'Profile/myTeam';
$route['team-income'] = 'Profile/TeamIncome'; 
$route['change-password'] = 'Profile/changepassword'; 
$route['edit-profile'] = 'Profile/EditProfilePage';
$route['passbook'] = 'Profile/Passbook';
$route['upgrade-account'] = 'Profile/upgradeAccount';
$route['update-kyc'] = 'Profile/KycUpdatePage';
$route['get-city'] = 'Profile/getCity';
$route['logout'] = 'Login/logout'; 
$route['products'] = 'Product';
$route['repurchase-product'] = 'Product/repurchaseProduct';
$route['repurchase-product-list'] = 'Product/allRepurchase';
$route['rank-raward'] = 'Profile/rankReward'; 

/*===Group module url====*/
$route['genealogy'] = 'Group/genealogy'; 
$route['direct-group'] = 'Group/directGroup'; 
$route['downline-group'] = 'Group/downlineGroup'; 
$route['left-right-team'] = 'Group/leftRightTeam'; 



/*==user url===*/
$route['admin/show-users'] = 'admin/User'; 
$route['admin/edit-user/(:any)'] = 'admin/User/editUser/$1';
$route['admin/user-statement'] = 'admin/User/userStatement'; 
$route['admin/withdrawl-request'] = 'admin/User/withdrawlRequest'; 
$route['admin/show-turnover'] = 'admin/User/showTurnover'; 
$route['admin/user-balancesheet/(:any)'] = 'admin/User/userBalanceSheet/$1'; 
$route['admin/silverclub-users'] = 'admin/User/silverClub'; 
$route['admin/starclub-users'] = 'admin/User/starClub'; 
$route['admin/emerldclub-users'] = 'admin/User/emerldClub'; 
$route['admin/reward-user-list'] = 'admin/User/rewardList'; 


/*==information url===*/
$route['about-us'] = 'Informations/aboutUs';
$route['contact-us'] = 'Informations/contact_us';
$route['legal-document'] = 'Informations/legalDocument';
$route['gallery'] = 'Informations/gallery';
$route['rajasthan-tour'] = 'Informations/rajasthanTour';
$route['national-tour'] = 'Informations/nationalTour';
$route['international-tour'] = 'Informations/internationalTour';
$route['world-tour'] = 'Informations/worldTour'; 


/*==Epin url===*/
$route['e-pin-all'] = 'Epin/allPin'; 
$route['e-pin-used'] = 'Epin/usedEpin'; 
$route['e-pin-unused'] = 'Epin/unusedEpin'; 

/*===Profit url====*/
$route['previous-profit'] = 'Profit/previousProfit'; 
$route['current-profit'] = 'Profit/currentProfit'; 
$route['result-previous-profit'] = 'Profit/getPreviousProfit'; 
$route['result-current-profit'] = 'Profit/getCurrentProfit'; 
$route['reward'] = 'Profit/reward'; 

//start  Admin site URL

$route['admin'] = 'admin/Login';  
$route['admin/dashboard'] = 'admin/Home';  
$route['admin/change_username'] = 'admin/Login/changeusername'; 
$route['admin/change-password'] = 'admin/Login/changepassword'; 
$route['admin/logout'] = 'admin/Login/logout'; 


/*==PIN url===*/
$route['admin/create-pin'] = 'admin/Pin'; 
$route['admin/all-pin'] = 'admin/Pin/allPin'; 
$route['admin/assign-pin-to-user'] = 'admin/Pin/allPin'; 
$route['admin/check-unique-id'] = 'admin/Pin/checkUniqueId';  

/*==Kyc Url==*/
$route['admin/show-kyc'] = 'admin/Kyc';
$route['admin/single-kyc/(:any)'] = 'admin/Kyc/singleKyc/$1';


/*==Product Url==*/
$route['admin/add-product'] = 'admin/Product';
$route['admin/add-product/(:any)'] = 'admin/Product/index/$1';
$route['admin/show-product'] = 'admin/Product/showProduct';
$route['admin/show-repurchase-product'] = 'admin/Product/showRepuProduct';
$route['admin/repurchase-bonus'] = 'admin/Product/repurchaseBonus';

/*==Latest Url==*/
$route['admin/add-latest-news'] = 'admin/News';
$route['admin/add-latest-news/(:any)'] = 'admin/News/index/$1';
$route['admin/show-latest-news'] = 'admin/News/showNews';

/*==Achiver Url==*/
$route['admin/add-achiver'] = 'admin/Achiver';
$route['admin/add-achiver/(:any)'] = 'admin/Achiver/index/$1';
$route['admin/show-achiver'] = 'admin/Achiver/showAchiver';

$route['admin/show-bonanza'] = 'admin/Home/bonanzaOffer';

//end  Admin site URL

/*==travels url===*/ 
 

$route['travel_logout'] = 'travels/logout';
$route['travel_dashboard'] = 'travels/travel_dashboard';




