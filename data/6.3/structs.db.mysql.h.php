<?php

return [
	'db_mysql_StorageEngine' => [
		'extends' => 'GrtNamedObject',
		'properties' => [
			'_caption' => 'grt::StringRef',
			'_description' => 'grt::StringRef',
			'_options' => 'grt::ListRef<db_mysql_StorageEngineOption>',
			'_supportsForeignKeys' => 'grt::IntegerRef',
		],
	],
	'db_mysql_StorageEngineOption' => [
		'extends' => 'GrtNamedObject',
		'properties' => [
			'_caption' => 'grt::StringRef',
			'_description' => 'grt::StringRef',
			'_type' => 'grt::StringRef',
		],
	],
	'db_mysql_RoutineParam' => [
		'extends' => 'GrtObject',
		'properties' => [
			'_datatype' => 'grt::StringRef',
			'_paramType' => 'grt::StringRef',
		],
	],
	'db_mysql_PartitionDefinition' => [
		'extends' => 'GrtObject',
		'properties' => [
			'_comment' => 'grt::StringRef',
			'_dataDirectory' => 'grt::StringRef',
			'_engine' => 'grt::StringRef',
			'_indexDirectory' => 'grt::StringRef',
			'_maxRows' => 'grt::StringRef',
			'_minRows' => 'grt::StringRef',
			'_nodeGroupId' => 'grt::IntegerRef',
			'_subpartitionDefinitions' => 'grt::ListRef<db_mysql_PartitionDefinition>',
			'_tableSpace' => 'grt::StringRef',
			'_value' => 'grt::StringRef',
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
	'db_mysql_SimpleDatatype' => [
		'extends' => 'db_SimpleDatatype',
		'properties' => [
		],
	],
	'db_mysql_Column' => [
		'extends' => 'db_Column',
		'properties' => [
			'_autoIncrement' => 'grt::IntegerRef',
			'_expression' => 'grt::StringRef',
			'_generated' => 'grt::IntegerRef',
			'_generatedStorage' => 'grt::StringRef',
		],
	],
	'db_mysql_Catalog' => [
		'extends' => 'db_Catalog',
		'properties' => [
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
	'db_mysql_RoutineGroup' => [
		'extends' => 'db_RoutineGroup',
		'properties' => [
		],
	],
	'db_mysql_Index' => [
		'extends' => 'db_Index',
		'properties' => [
			'_algorithm' => 'grt::StringRef',
			'_indexKind' => 'grt::StringRef',
			'_keyBlockSize' => 'grt::IntegerRef',
			'_lockOption' => 'grt::StringRef',
			'_withParser' => 'grt::StringRef',
		],
	],
	'db_mysql_StructuredDatatype' => [
		'extends' => 'db_StructuredDatatype',
		'properties' => [
		],
	],
	'db_mysql_Table' => [
		'extends' => 'db_Table',
		'properties' => [
			'_avgRowLength' => 'grt::StringRef',
			'_checksum' => 'grt::IntegerRef',
			'_connection' => 'db_ServerLinkRef',
			'_connectionString' => 'grt::StringRef',
			'_defaultCharacterSetName' => 'grt::StringRef',
			'_defaultCollationName' => 'grt::StringRef',
			'_delayKeyWrite' => 'grt::IntegerRef',
			'_keyBlockSize' => 'grt::StringRef',
			'_maxRows' => 'grt::StringRef',
			'_mergeInsert' => 'grt::StringRef',
			'_mergeUnion' => 'grt::StringRef',
			'_minRows' => 'grt::StringRef',
			'_nextAutoInc' => 'grt::StringRef',
			'_packKeys' => 'grt::StringRef',
			'_partitionCount' => 'grt::IntegerRef',
			'_partitionDefinitions' => 'grt::ListRef<db_mysql_PartitionDefinition>',
			'_partitionExpression' => 'grt::StringRef',
			'_partitionKeyAlgorithm' => 'grt::IntegerRef',
			'_partitionType' => 'grt::StringRef',
			'_password' => 'grt::StringRef',
			'_raidChunkSize' => 'grt::StringRef',
			'_raidChunks' => 'grt::StringRef',
			'_raidType' => 'grt::StringRef',
			'_rowFormat' => 'grt::StringRef',
			'_statsAutoRecalc' => 'grt::StringRef',
			'_statsPersistent' => 'grt::StringRef',
			'_statsSamplePages' => 'grt::IntegerRef',
			'_subpartitionCount' => 'grt::IntegerRef',
			'_subpartitionExpression' => 'grt::StringRef',
			'_subpartitionKeyAlgorithm' => 'grt::IntegerRef',
			'_subpartitionType' => 'grt::StringRef',
			'_tableDataDir' => 'grt::StringRef',
			'_tableEngine' => 'grt::StringRef',
			'_tableIndexDir' => 'grt::StringRef',
			'_tableSpace' => 'grt::StringRef',
		],
	],
	'db_mysql_ServerLink' => [
		'extends' => 'db_ServerLink',
		'properties' => [
		],
	],
	'db_mysql_Schema' => [
		'extends' => 'db_Schema',
		'properties' => [
		],
	],
	'db_mysql_Tablespace' => [
		'extends' => 'db_Tablespace',
		'properties' => [
			'_engine' => 'grt::StringRef',
			'_nodeGroupId' => 'grt::IntegerRef',
			'_wait' => 'grt::IntegerRef',
		],
	],
	'db_mysql_LogFileGroup' => [
		'extends' => 'db_LogFileGroup',
		'properties' => [
			'_engine' => 'grt::StringRef',
			'_nodeGroupId' => 'grt::IntegerRef',
			'_wait' => 'grt::IntegerRef',
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
	'db_mysql_Routine' => [
		'extends' => 'db_Routine',
		'properties' => [
			'_params' => 'grt::ListRef<db_mysql_RoutineParam>',
			'_returnDatatype' => 'grt::StringRef',
			'_security' => 'grt::StringRef',
		],
	],
	'db_mysql_View' => [
		'extends' => 'db_View',
		'properties' => [
		],
	],
];
