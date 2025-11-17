<?php

return [
	'workbench_logical_Connection' => [
		'extends' => 'model_Connection',
		'properties' => [
			'_comment' => 'grt::StringRef',
			'_endCaption' => 'grt::StringRef',
			'_endCaptionXOffs' => 'grt::DoubleRef',
			'_endCaptionYOffs' => 'grt::DoubleRef',
			'_endMany' => 'grt::IntegerRef',
			'_startCaption' => 'grt::StringRef',
			'_startCaptionXOffs' => 'grt::DoubleRef',
			'_startCaptionYOffs' => 'grt::DoubleRef',
			'_startMany' => 'grt::IntegerRef',
		],
	],
	'workbench_logical_Relationship' => [
		'extends' => 'model_Figure',
		'properties' => [
			'_attributesExpanded' => 'grt::IntegerRef',
			'_relationship' => 'eer_RelationshipRef',
		],
	],
	'workbench_logical_Entity' => [
		'extends' => 'model_Figure',
		'properties' => [
			'_attributesExpanded' => 'grt::IntegerRef',
			'_entity' => 'eer_EntityRef',
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
