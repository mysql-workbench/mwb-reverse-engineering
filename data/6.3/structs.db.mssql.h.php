<?php

return [
	'db_mssql_Sequence' => [
		'extends' => 'db_Sequence',
		'properties' => [
		],
	],
	'db_mssql_Synonym' => [
		'extends' => 'db_Synonym',
		'properties' => [
		],
	],
	'db_mssql_Routine' => [
		'extends' => 'db_Routine',
		'properties' => [
		],
	],
	'db_mssql_RoutineGroup' => [
		'extends' => 'db_RoutineGroup',
		'properties' => [
		],
	],
	'db_mssql_View' => [
		'extends' => 'db_View',
		'properties' => [
		],
	],
	'db_mssql_Trigger' => [
		'extends' => 'db_Trigger',
		'properties' => [
		],
	],
	'db_mssql_ForeignKey' => [
		'extends' => 'db_ForeignKey',
		'properties' => [
		],
	],
	'db_mssql_IndexColumn' => [
		'extends' => 'db_IndexColumn',
		'properties' => [
		],
	],
	'db_mssql_Index' => [
		'extends' => 'db_Index',
		'properties' => [
			'_clustered' => 'grt::IntegerRef',
			'_filterDefinition' => 'grt::StringRef',
			'_hasFilter' => 'grt::IntegerRef',
			'_ignoreDuplicateRows' => 'grt::IntegerRef',
		],
	],
	'db_mssql_StructuredDatatype' => [
		'extends' => 'db_StructuredDatatype',
		'properties' => [
		],
	],
	'db_mssql_UserDatatype' => [
		'extends' => 'db_UserDatatype',
		'properties' => [
			'_characterMaximumLength' => 'grt::IntegerRef',
			'_isNullable' => 'grt::IntegerRef',
			'_numericPrecision' => 'grt::IntegerRef',
			'_numericScale' => 'grt::IntegerRef',
		],
	],
	'db_mssql_SimpleDatatype' => [
		'extends' => 'db_SimpleDatatype',
		'properties' => [
		],
	],
	'db_mssql_Column' => [
		'extends' => 'db_Column',
		'properties' => [
			'_computed' => 'grt::IntegerRef',
			'_identity' => 'grt::IntegerRef',
		],
	],
	'db_mssql_Table' => [
		'extends' => 'db_Table',
		'properties' => [
			'_createdDatetime' => 'grt::StringRef',
		],
	],
	'db_mssql_Schema' => [
		'extends' => 'db_Schema',
		'properties' => [
		],
	],
	'db_mssql_Catalog' => [
		'extends' => 'db_Catalog',
		'properties' => [
		],
	],
];
