<?php

return [
	'db_mysql_StorageEngine' => [
		'extends' => 'GrtNamedObject',
		'properties' => [
			'grt::StringRef' => '_caption',
			'grt::StringRef' => '_description',
			'grt::ListRef<db_mysql_StorageEngineOption>' => '_options',
			'grt::IntegerRef' => '_supportsForeignKeys',
		],
	],
	'db_mysql_StorageEngineOption' => [
		'extends' => 'GrtNamedObject',
		'properties' => [
			'grt::StringRef' => '_caption',
			'grt::StringRef' => '_description',
			'grt::StringRef' => '_type',
		],
	],
	'db_mysql_Sequence' => [
		'extends' => 'db_Sequence',
		'properties' => [
		],
	],
	'db_mysql_Synonym' => [
		'extends' => 'db_Synonym',
		'properties' => [
		],
	],
	'db_mysql_RoutineParam' => [
		'extends' => 'GrtObject',
		'properties' => [
			'grt::StringRef' => '_datatype',
			'grt::StringRef' => '_paramType',
		],
	],
	'db_mysql_Routine' => [
		'extends' => 'db_Routine',
		'properties' => [
			'grt::ListRef<db_mysql_RoutineParam>' => '_params',
			'grt::StringRef' => '_returnDatatype',
			'grt::StringRef' => '_security',
		],
	],
	'db_mysql_RoutineGroup' => [
		'extends' => 'db_RoutineGroup',
		'properties' => [
		],
	],
	'db_mysql_View' => [
		'extends' => 'db_View',
		'properties' => [
		],
	],
	'db_mysql_Event' => [
		'extends' => 'db_Event',
		'properties' => [
		],
	],
	'db_mysql_Trigger' => [
		'extends' => 'db_Trigger',
		'properties' => [
		],
	],
	'db_mysql_ForeignKey' => [
		'extends' => 'db_ForeignKey',
		'properties' => [
		],
	],
	'db_mysql_IndexColumn' => [
		'extends' => 'db_IndexColumn',
		'properties' => [
		],
	],
	'db_mysql_Index' => [
		'extends' => 'db_Index',
		'properties' => [
			'grt::StringRef' => '_algorithm',
			'grt::StringRef' => '_indexKind',
			'grt::IntegerRef' => '_keyBlockSize',
			'grt::StringRef' => '_lockOption',
			'grt::IntegerRef' => '_visible',
			'grt::StringRef' => '_withParser',
		],
	],
	'db_mysql_StructuredDatatype' => [
		'extends' => 'db_StructuredDatatype',
		'properties' => [
		],
	],
	'db_mysql_SimpleDatatype' => [
		'extends' => 'db_SimpleDatatype',
		'properties' => [
		],
	],
	'db_mysql_Column' => [
		'extends' => 'db_Column',
		'properties' => [
			'grt::IntegerRef' => '_autoIncrement',
			'grt::StringRef' => '_expression',
			'grt::IntegerRef' => '_generated',
			'grt::StringRef' => '_generatedStorage',
		],
	],
	'db_mysql_Table' => [
		'extends' => 'db_Table',
		'properties' => [
			'grt::StringRef' => '_avgRowLength',
			'grt::IntegerRef' => '_checksum',
			'db_ServerLinkRef' => '_connection',
			'grt::StringRef' => '_connectionString',
			'grt::StringRef' => '_defaultCharacterSetName',
			'grt::StringRef' => '_defaultCollationName',
			'grt::IntegerRef' => '_delayKeyWrite',
			'grt::StringRef' => '_keyBlockSize',
			'grt::StringRef' => '_maxRows',
			'grt::StringRef' => '_mergeInsert',
			'grt::StringRef' => '_mergeUnion',
			'grt::StringRef' => '_minRows',
			'grt::StringRef' => '_nextAutoInc',
			'grt::StringRef' => '_packKeys',
			'grt::IntegerRef' => '_partitionCount',
			'grt::ListRef<db_mysql_PartitionDefinition>' => '_partitionDefinitions',
			'grt::StringRef' => '_partitionExpression',
			'grt::IntegerRef' => '_partitionKeyAlgorithm',
			'grt::StringRef' => '_partitionType',
			'grt::StringRef' => '_password',
			'grt::StringRef' => '_raidChunkSize',
			'grt::StringRef' => '_raidChunks',
			'grt::StringRef' => '_raidType',
			'grt::StringRef' => '_rowFormat',
			'grt::StringRef' => '_statsAutoRecalc',
			'grt::StringRef' => '_statsPersistent',
			'grt::IntegerRef' => '_statsSamplePages',
			'grt::IntegerRef' => '_subpartitionCount',
			'grt::StringRef' => '_subpartitionExpression',
			'grt::IntegerRef' => '_subpartitionKeyAlgorithm',
			'grt::StringRef' => '_subpartitionType',
			'grt::StringRef' => '_tableDataDir',
			'grt::StringRef' => '_tableEngine',
			'grt::StringRef' => '_tableIndexDir',
			'grt::StringRef' => '_tableSpace',
		],
	],
	'db_mysql_PartitionDefinition' => [
		'extends' => 'GrtObject',
		'properties' => [
			'grt::StringRef' => '_comment',
			'grt::StringRef' => '_dataDirectory',
			'grt::StringRef' => '_engine',
			'grt::StringRef' => '_indexDirectory',
			'grt::StringRef' => '_maxRows',
			'grt::StringRef' => '_minRows',
			'grt::IntegerRef' => '_nodeGroupId',
			'grt::ListRef<db_mysql_PartitionDefinition>' => '_subpartitionDefinitions',
			'grt::StringRef' => '_tableSpace',
			'grt::StringRef' => '_value',
		],
	],
	'db_mysql_ServerLink' => [
		'extends' => 'db_ServerLink',
		'properties' => [
		],
	],
	'db_mysql_Tablespace' => [
		'extends' => 'db_Tablespace',
		'properties' => [
			'grt::IntegerRef' => '_nodeGroupId',
		],
	],
	'db_mysql_LogFileGroup' => [
		'extends' => 'db_LogFileGroup',
		'properties' => [
			'grt::IntegerRef' => '_nodeGroupId',
		],
	],
	'db_mysql_Schema' => [
		'extends' => 'db_Schema',
		'properties' => [
		],
	],
	'db_mysql_Catalog' => [
		'extends' => 'db_Catalog',
		'properties' => [
		],
	],
];
