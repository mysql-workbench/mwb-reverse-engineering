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
			'_customData' => 'grt::DictRef',
			'_dockingPoint' => 'mforms_ObjectReferenceRef',
			'_object' => 'GrtObjectRef',
		],
	],
	'ui_ModelPanel' => [
		'extends' => 'TransientObject',
		'properties' => [
			'_commonSidebar' => 'mforms_ObjectReferenceRef',
			'_customData' => 'grt::DictRef',
			'_model' => 'model_ModelRef',
		],
	],
];
