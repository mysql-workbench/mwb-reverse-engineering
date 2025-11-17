<?php

return [
	'eer_Datatype' => [
		'extends' => 'GrtObject',
		'properties' => [
			'grt::StringRef' => '_caption',
			'grt::StringRef' => '_description',
		],
	],
	'eer_DatatypeGroup' => [
		'extends' => 'GrtObject',
		'properties' => [
			'grt::StringRef' => '_caption',
			'grt::StringRef' => '_description',
		],
	],
	'eer_Catalog' => [
		'extends' => 'GrtNamedObject',
		'properties' => [
			'grt::DictRef' => '_customData',
			'grt::ListRef<eer_Datatype>' => '_datatypes',
			'grt::ListRef<eer_Schema>' => '_schemata',
			'grt::ListRef<eer_Datatype>' => '_userDatatypes',
		],
	],
	'eer_Object' => [
		'extends' => 'GrtNamedObject',
		'properties' => [
			'grt::IntegerRef' => '_commentedOut',
			'grt::DictRef' => '_customData',
		],
	],
	'eer_Relationship' => [
		'extends' => 'eer_Object',
		'properties' => [
			'grt::ListRef<eer_Attribute>' => '_attribute',
			'grt::IntegerRef' => '_endMandatory',
			'grt::IntegerRef' => '_startMandatory',
		],
	],
	'eer_Attribute' => [
		'extends' => 'eer_Object',
		'properties' => [
			'eer_DatatypeRef' => '_datatype',
			'grt::IntegerRef' => '_isIdentifying',
		],
	],
	'eer_Entity' => [
		'extends' => 'eer_Object',
		'properties' => [
			'grt::ListRef<eer_Attribute>' => '_attribute',
		],
	],
	'eer_Schema' => [
		'extends' => 'eer_Object',
		'properties' => [
			'grt::ListRef<eer_Entity>' => '_entities',
			'grt::ListRef<eer_Relationship>' => '_relationships',
		],
	],
];
