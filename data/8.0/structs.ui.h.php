<?php

return [
	'ui_db_ConnectPanel' => [
		'extends' => 'TransientObject',
		'properties' => [
		],
	],
	'ui_ObjectEditor' => [
		'extends' => 'TransientObject',
		'properties' => [
			'grt::DictRef' => '_customData',
			'mforms_ObjectReferenceRef' => '_dockingPoint',
			'GrtObjectRef' => '_object',
		],
	],
	'ui_ModelPanel' => [
		'extends' => 'TransientObject',
		'properties' => [
			'mforms_ObjectReferenceRef' => '_commonSidebar',
			'grt::DictRef' => '_customData',
			'model_ModelRef' => '_model',
		],
	],
];
