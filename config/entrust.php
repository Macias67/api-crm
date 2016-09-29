<?php

/**
 * This file is part of Entrust,
 * a role & permission management solution for Laravel.
 *
 * @license MIT
 * @package Zizaco\Entrust
 */

return [
	
	/*
	|--------------------------------------------------------------------------
	| Entrust Role Model
	|--------------------------------------------------------------------------
	|
	| This is the Role model used by Entrust to create correct relations.  Update
	| the role if it is in a different namespace.
	|
	*/
	'role'                  => App\Http\Models\Roles::class,
	
	/*
	|--------------------------------------------------------------------------
	| Entrust Roles Table
	|--------------------------------------------------------------------------
	|
	| This is the roles table used by Entrust to save roles to the database.
	|
	*/
	'roles_table'           => 'ec_roles',
	
	/*
	|--------------------------------------------------------------------------
	| Entrust Permission Model
	|--------------------------------------------------------------------------
	|
	| This is the Permission model used by Entrust to create correct relations.
	| Update the permission if it is in a different namespace.
	|
	*/
	'permission'            => App\Http\Models\Permisos::class,
	
	/*
	|--------------------------------------------------------------------------
	| Entrust Permissions Table
	|--------------------------------------------------------------------------
	|
	| This is the permissions table used by Entrust to save permissions to the
	| database.
	|
	*/
	'permissions_table'     => 'ec_permisos',
	
	/*
	|--------------------------------------------------------------------------
	| Entrust permission_role Table
	|--------------------------------------------------------------------------
	|
	| This is the permission_role table used by Entrust to save relationship
	| between permissions and roles to the database.
	|
	*/
	'permission_role_table' => 'ec_permisos_roles',
	
	/*
	|--------------------------------------------------------------------------
	| Entrust role_user Table
	|--------------------------------------------------------------------------
	|
	| This is the role_user table used by Entrust to save assigned roles to the
	| database.
	|
	*/
	'role_user_table'       => 'ec_roles_ejecutivo',
	
	/*
	|--------------------------------------------------------------------------
	| User Foreign key on Entrust's role_user Table (Pivot)
	|--------------------------------------------------------------------------
	*/
	'user_foreign_key'      => 'user_id',
	
	/*
	|--------------------------------------------------------------------------
	| Role Foreign key on Entrust's role_user Table (Pivot)
	|--------------------------------------------------------------------------
	*/
	'role_foreign_key'      => 'role_id',

];