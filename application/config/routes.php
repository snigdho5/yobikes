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

//Company management
$route['companies'] = 'Companies/index';
$route['duplicate_check_comp'] = 'Companies/onCheckDuplicateComp';
$route['add-company'] = 'Companies/onCreateCompView';
$route['createcompany'] = 'Companies/onCreateComp';
$route['edit-company/(:any)'] = 'Companies/onGetCompEdit/$1';
$route['changecompany'] = 'Companies/onChangeComp';
$route['delcompany'] = 'Companies/onDeleteComp';

//Segments management
$route['segments'] = 'Segments/index';
$route['duplicate_check_segment'] = 'Segments/onCheckDuplicateSegment';
$route['add-segment'] = 'Segments/onCreateSegmentView';
$route['createsegment'] = 'Segments/onCreateSegment';
$route['edit-segment/(:any)'] = 'Segments/onGetSegmentEdit/$1';
$route['changesegment'] = 'Segments/onChangeSegment';
$route['delsegment'] = 'Segments/onDeleteSegment';

//cycle management
$route['cycles'] = 'Cycles/index';
$route['duplicate_check_cycle'] = 'Cycles/onCheckDuplicateCycle';
$route['add-cycle'] = 'Cycles/onCreateCycleView';
$route['createcycle'] = 'Cycles/onCreateCycle';
$route['edit-cycle/(:any)'] = 'Cycles/onGetCycleEdit/$1';
$route['changecycle'] = 'Cycles/onChangeCycle';
$route['delcycle'] = 'Cycles/onDeleteCycle';


//checklist management
$route['checklists'] = 'Checklist/index';
$route['get_cycle'] = 'Checklist/getCycle';
$route['get_color'] = 'Checklist/getColor';
$route['duplicate_check_checklist'] = 'Checklist/onCheckDuplicateChecklist';
$route['add-checklist'] = 'Checklist/onCreateChecklistView';
$route['createchecklist'] = 'Checklist/onCreateChecklist';
$route['edit-checklist/(:any)'] = 'Checklist/onGetChecklistEdit/$1';
$route['changechecklist'] = 'Checklist/onChangeChecklist';
$route['delchecklist'] = 'Checklist/onDeleteChecklist';


//checklist2 management
$route['checklists2'] = 'Checklist2/index';
$route['get_cycle2'] = 'Checklist2/getCycle';
$route['get_color2'] = 'Checklist2/getColor';
$route['duplicate_check_checklist2'] = 'Checklist2/onCheckDuplicateChecklist';
$route['add-checklist2'] = 'Checklist2/onCreateChecklistView';
$route['createchecklist2'] = 'Checklist2/onCreateChecklist';
$route['edit-checklist2/(:any)'] = 'Checklist2/onGetChecklistEdit/$1';
$route['changechecklist2'] = 'Checklist2/onChangeChecklist';
$route['delchecklist2'] = 'Checklist2/onDeleteChecklist';

// Billing checklist

$route['checklist-billing'] = 'Checklist/onChecklistBilling';
$route['get_multipleof_qty'] = 'Checklist/getMultipleOfQty';
$route['save-checklist'] = 'Checklist/onSaveChecklist';
$route['checklist-bill-print/(:any)'] = 'Checklist/onPrintChecklistBill/$1';
$route['checklist-bills'] = 'Checklist/onGetChecklistBills';
$route['delchecklistbill'] = 'Checklist/onDeleteChecklistBill';

// Billing checklist2

$route['checklist2-billing'] = 'Checklist2/onChecklistBilling';
$route['get_multipleof_qty2'] = 'Checklist2/getMultipleOfQty';
$route['save-checklist2'] = 'Checklist2/onSaveChecklist';
$route['checklist2-bill-print/(:any)'] = 'Checklist2/onPrintChecklistBill/$1';
$route['checklist2-bills'] = 'Checklist2/onGetChecklistBills';
$route['delchecklist2bill'] = 'Checklist2/onDeleteChecklistBill';