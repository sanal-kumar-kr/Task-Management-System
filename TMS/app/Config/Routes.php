<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->match(['GET','POST'],'/Login-user', 'AuthController::Login');
$routes->post('/Logout', 'AuthController::Logout');


$routes->match(['GET','POST'],'/Add-designation', 'DesignationController::Add_designation');
$routes->get('/View-designations', 'DesignationController::View_designations');
$routes->post('/Delete-designation/(:num)', 'DesignationController::Delete_designation/$1');


$routes->match(['GET','POST'],'/Add-staff', 'StaffController::Add_staff');
$routes->get('/View-staffs', 'StaffController::View_staffs');
$routes->match(['GET','POST'],'/Edit-staff/(:num)', 'StaffController::Edit_staff/$1');


$routes->match(['GET','POST'],'/Add-team', 'TeamController::Add_team');
$routes->get('/View-teams', 'TeamController::View_teams');
$routes->match(['GET','POST'],'/Edit-team/(:num)', 'TeamController::Edit_team/$1');
$routes->post('/Delete-team/(:num)', 'TeamController::Delete_team/$1');




$routes->match(['GET','POST'],'/Add-project', 'ProjectController::Add_project');
$routes->get('/View-projects', 'ProjectController::View_projects');
$routes->match(['GET','POST'],'/Edit-project/(:num)', 'ProjectController::Edit_project/$1');
$routes->post('/Delete-project/(:num)', 'ProjectController::Delete_project/$1');


$routes->match(['GET','POST'],'/Add-category', 'CategoryController::Add_category');
$routes->get('/View-categories', 'CategoryController::View_categories');
$routes->post('/Delete-category/(:num)', 'CategoryController::Delete_category/$1');


$routes->match(['GET','POST'],'/Add-task/(:num)', 'TaskController::Add_task/$1');
$routes->get('/View-tasks/(:num)', 'TaskController::View_tasks/$1');

$routes->match(['GET','POST'],'/Edit-task/(:num)', 'TaskController::Edit_task/$1');
$routes->post('/Delete-task/(:num)', 'TaskController::Delete_task/$1');


$routes->match(['GET','POST'],'/Add-sub-task/(:num)', 'TaskController::Add_sub_task/$1');
$routes->get('/View-sub-tasks/(:num)', 'TaskController::View_sub_tasks/$1');