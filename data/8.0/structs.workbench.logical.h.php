<?php

return [
	'workbench_logical_Connection' => [
		'extends' => 'model_Connection',
		'properties' => [
			'grt::StringRef' => '_comment',
			'grt::StringRef' => '_endCaption',
			'grt::DoubleRef' => '_endCaptionXOffs',
			'grt::DoubleRef' => '_endCaptionYOffs',
			'grt::IntegerRef' => '_endMany',
			'grt::StringRef' => '_startCaption',
			'grt::DoubleRef' => '_startCaptionXOffs',
			'grt::DoubleRef' => '_startCaptionYOffs',
			'grt::IntegerRef' => '_startMany',
		],
	],
	'workbench_logical_Relationship' => [
		'extends' => 'model_Figure',
		'properties' => [
			'grt::IntegerRef' => '_attributesExpanded',
			'eer_RelationshipRef' => '_relationship',
		],
	],
	'workbench_logical_Entity' => [
		'extends' => 'model_Figure',
		'properties' => [
			'grt::IntegerRef' => '_attributesExpanded',
			'eer_EntityRef' => '_entity',
		],
	],
	'workbench_logical_Diagram' => [
		'extends' => 'model_Diagram',
		'properties' => [
		],
	],
	'workbench_logical_Model' => [
		'extends' => 'model_Model',
		'properties' => [
		],
	],
];
