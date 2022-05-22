<?php
defined('BASEPATH') OR exit('No direct script access allowed');



$route['default_controller'] = 'Auth/index';
$route['404_override'] = 'Auth/get404';
$route['translate_uri_dashes'] = FALSE;


//login
$route['login'] = 'Auth/onSetLogin';
$route['chk_login'] = 'Auth/onCheckLogin';
$route['chklogin2fa'] = 'Auth/onCheck2FAuth';
$route['logout'] = 'Auth/onSetLogout';
$route['dashboard'] = 'Auth/onGetDashboard';
$route['send-password-recovery'] = 'Auth/onSendPasswordRecovery';

//user management
$route['users'] = 'Users/index';
$route['duplicate_check_un'] = 'Users/onCheckDuplicateUser';
$route['add-user'] = 'Users/onCreateUserView';
$route['createuser'] = 'Users/onCreateUser';
$route['profile'] = 'Users/onGetUserProfile/';
$route['profile/(:any)'] = 'Users/onGetUserProfile/$1';
$route['changeprofile'] = 'Users/onChangeUserProfile';
$route['deluser'] = 'Users/onDeleteUser';
$route['enable2fa'] = 'Users/onGetTwoFACode';
$route['set2fa'] = 'Users/onSet2FAuth';

//cnf entries management
$route['cnf/list'] = 'CNFEntry/index';
$route['cnf/duplicate_check'] = 'CNFEntry/onCheckDuplicate';
$route['cnf/add'] = 'CNFEntry/onCreateView';
$route['cnf/create'] = 'CNFEntry/onCreate';
$route['cnf/edit/(:any)'] = 'CNFEntry/onGetEdit/$1';
$route['cnf/change'] = 'CNFEntry/onChange';
$route['cnf/delete'] = 'CNFEntry/onDelete';

//cnf billing management
$route['cnfbilling/list'] = 'CNFBilling/index';
$route['cnfbilling/duplicate_check'] = 'CNFBilling/onCheckDuplicate';
$route['cnfbilling/add'] = 'CNFBilling/onCreateView';
$route['cnfbilling/create'] = 'CNFBilling/onCreate';
$route['cnfbilling/edit/(:any)'] = 'CNFBilling/onGetEdit/$1';
$route['cnfbilling/change'] = 'CNFBilling/onChange';
$route['cnfbilling/delete'] = 'CNFBilling/onDelete';
$route['cnfbilling/invoice/(:any)'] = 'CNFBilling/onGetInvoice/$1';

//dealer billing
$route['dealerbilling/list'] = 'DealerBilling/index';
$route['dealerbilling/add'] = 'DealerBilling/onCreateView';
$route['dealerbilling/create'] = 'DealerBilling/onCreate';
$route['dealerbilling/delete'] = 'DealerBilling/onDelete';
$route['dealerbilling/change-bill-type'] = 'DealerBilling/onChangeBillType';
