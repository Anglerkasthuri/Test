<?php

return [

'user_type' => [
	1 => 'Staff',
	2 => 'Student',
],

'user_type_id' => [ // for middle wher check 
	'staff' => 1,
	'student' => 2,
],

'academic_component_category' => [
	'internal' => 1,
	'external' => 2,
],

'active_field' => [
	1 => 'Active',
	0 => 'Inactive',
],

'form_dropdown_type' => [
	'system_model' => 1,
	'master_category' => 2,
],

'form_fields' => [
	'not_validated' => [
		"heading", "label"
	],
],
'active_field_options' => [
	1 => ['label' => 'Active', 'class' => 'badge bg-success', 'display' => 'Active',],
	0 => ['label' => 'Inactive', 'class' => 'badge bg-danger', 'display' => 'Inactive',],
],

'boolean_field_options' => [
	1 => ['label' => 'Yes', 'class' => 'badge bg-success', 'display' => 'Yes',],
	0 => ['label' => 'No', 'class' => 'badge bg-warning', 'display' => 'No',],
],

'boolean' => [
	1 => 'Yes',
	0 => 'No',
],

'per_page_options' => [
		1 => 1, 
		2 => 2, 
		5 => 5, 
		10 => 10, 
		25 => 25,
		50 => 50, 
		100 => 100,
		200 => 200,
		500 => 500,
],

'perPage' => 10,

'orgTimezone' => 'Asia/Kolkata',
'date_format' => 'd/m/Y',
'date_time_format' => 'd/m/Y g:i A',
'time_format' => 'g:i a',
'date_dp_format' => 'd/m/Y',
'date_time_dp_format' => 'd/m/Y H:i',
'time_dp_format' => 'h:i a',
'date_dp_format_js' => 'DD/MM/YYYY',
'date_time_dp_format_js' => 'DD/MM/YYYY HH:mm',
'time_dp_format_js' => 'hh:mm a',
'file_export_format' => 'd-m-Y g:i:s A',
'db_date_time_format' => 'Y-m-d H:i:s',

// 'dt' => [
// 	'timezone_view' => 'Asia/Kolkata',
// 	'date_format' => 'd-M-Y',
// 	'date_time_format' => 'd-M-Y h:i A',
// 	'time_format' => 'h:i A',
// 	'time_format1' => 'g:i A',
// ],

 
];