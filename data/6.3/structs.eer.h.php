<?php

return [
	'eer_Datatype' => [
		'extends' => 'GrtObject',
		'properties' => [
			'_caption' => 'grt::StringRef',
			'_description' => 'grt::StringRef',
		],
	],
	'eer_DatatypeGroup' => [
		'extends' => 'GrtObject',
		'properties' => [
			'_caption' => 'grt::StringRef',
			'_description' => 'grt::StringRef',
		],
	],
	'eer_Catalog' => [
		'extends' => 'GrtNamedObject',
		'properties' => [
			'_customData' => 'grt::DictRef',
			'_datatypes' => 'grt::ListRef<eer_Datatype>',
			'_schemata' => 'grt::ListRef<eer_Schema>',
			'_userDatatypes' => 'grt::ListRef<eer_Datatype>',
		],
	],
	'eer_Object' => [
		'extends' => 'GrtNamedObject',
		'properties' => [
			'_commentedOut' => 'grt::IntegerRef',
			'_customData' => 'grt::DictRef',
		],
	],
	'eer_Relationship' => [
		'extends' => 'eer_Object',
		'properties' => [
			'_attribute' => 'grt::ListRef<eer_Attribute>',
			'_endMandatory' => 'grt::IntegerRef',
			'_startMandatory' => 'grt::IntegerRef',
		],
	],
	'eer_Attribute' => [
		'extends' => 'eer_Object',
		'properties' => [
			'_datatype' => 'eer_DatatypeRef',
			'_isIdentifying' => 'grt::IntegerRef',
		],
	],
	'eer_Entity' => [
		'extends' => 'eer_Object',
		'properties' => [
			'_attribute' => 'grt::ListRef<eer_Attribute>',
		],
	],
	'eer_Schema' => [
		'extends' => 'eer_Object',
		'properties' => [
			'_entities' => 'grt::ListRef<eer_Entity>',
			'_relationships' => 'grt::ListRef<eer_Relationship>',
		],
	],
];
