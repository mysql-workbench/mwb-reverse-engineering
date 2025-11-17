<?php

return [
	'db_sybase_Sequence' => [
		'extends' => 'db_Sequence',
		'properties' => [
		],
	],
	'db_sybase_Synonym' => [
		'extends' => 'db_Synonym',
		'properties' => [
		],
	],
	'db_sybase_Routine' => [
		'extends' => 'db_Routine',
		'properties' => [
		],
	],
	'db_sybase_RoutineGroup' => [
		'extends' => 'db_RoutineGroup',
		'properties' => [
		],
	],
	'db_sybase_View' => [
		'extends' => 'db_View',
		'properties' => [
		],
	],
	'db_sybase_Trigger' => [
		'extends' => 'db_Trigger',
		'properties' => [
		],
	],
	'db_sybase_ForeignKey' => [
		'extends' => 'db_ForeignKey',
		'properties' => [
		],
	],
	'db_sybase_IndexColumn' => [
		'extends' => 'db_IndexColumn',
		'properties' => [
		],
	],
	'db_sybase_Index' => [
		'extends' => 'db_Index',
		'properties' => [
			'grt::IntegerRef' => '_clustered',
			'grt::StringRef' => '_filterDefinition',
			'grt::IntegerRef' => '_hasFilter',
			'grt::IntegerRef' => '_ignoreDuplicateRows',
		],
	],
	'db_sybase_UserDatatype' => [
		'extends' => 'db_UserDatatype',
		'properties' => [
			'grt::IntegerRef' => '_characterMaximumLength',
			'grt::IntegerRef' => '_isNullable',
			'grt::IntegerRef' => '_numericPrecision',
			'grt::IntegerRef' => '_numericScale',
		],
	],
	'db_sybase_StructuredDatatype' => [
		'extends' => 'db_StructuredDatatype',
		'properties' => [
		],
	],
	'db_sybase_SimpleDatatype' => [
		'extends' => 'db_SimpleDatatype',
		'properties' => [
		],
	],
	'db_sybase_Column' => [
		'extends' => 'db_Column',
		'properties' => [
			'grt::IntegerRef' => '_computed',
			'grt::IntegerRef' => '_identity',
		],
	],
	'db_sybase_Table' => [
		'extends' => 'db_Table',
		'properties' => [
			'grt::StringRef' => '_createdDatetime',
		],
	],
	'db_sybase_Schema' => [
		'extends' => 'db_Schema',
		'properties' => [
		],
	],
	'db_sybase_Catalog' => [
		'extends' => 'db_Catalog',
		'properties' => [
		],
	],
];
