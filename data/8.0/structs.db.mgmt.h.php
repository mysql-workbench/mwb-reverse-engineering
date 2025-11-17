<?php

return [
	'db_mgmt_SyncProfile' => [
		'extends' => 'GrtObject',
		'properties' => [
			'grt::DictRef' => '_lastKnownDBNames',
			'grt::DictRef' => '_lastKnownViewDefinitions',
			'grt::StringRef' => '_lastSyncDate',
			'grt::StringRef' => '_targetHostIdentifier',
			'grt::StringRef' => '_targetSchemaName',
		],
	],
	'db_mgmt_ServerInstance' => [
		'extends' => 'GrtObject',
		'properties' => [
			'db_mgmt_ConnectionRef' => '_connection',
			'grt::DictRef' => '_loginInfo',
			'grt::DictRef' => '_serverInfo',
		],
	],
	'db_mgmt_SSHFile' => [
		'extends' => 'GrtObject',
		'properties' => [
		],
	],
	'db_mgmt_SSHConnection' => [
		'extends' => 'GrtObject',
		'properties' => [
		],
	],
	'db_mgmt_Connection' => [
		'extends' => 'GrtObject',
		'properties' => [
			'db_mgmt_DriverRef' => '_driver',
			'grt::StringRef' => '_hostIdentifier',
			'grt::IntegerRef' => '_isDefault',
			'grt::DictRef' => '_modules',
			'grt::DictRef' => '_parameterValues',
		],
	],
	'db_mgmt_DriverParameter' => [
		'extends' => 'GrtObject',
		'properties' => [
			'grt::StringRef' => '_accessibilityName',
			'grt::StringRef' => '_caption',
			'grt::StringRef' => '_defaultValue',
			'grt::StringRef' => '_description',
			'grt::IntegerRef' => '_layoutAdvanced',
			'grt::IntegerRef' => '_layoutRow',
			'grt::IntegerRef' => '_layoutWidth',
			'grt::StringRef' => '_lookupValueMethod',
			'grt::StringRef' => '_lookupValueModule',
			'grt::StringRef' => '_paramType',
			'grt::DictRef' => '_paramTypeDetails',
			'grt::IntegerRef' => '_required',
		],
	],
	'db_mgmt_Driver' => [
		'extends' => 'GrtObject',
		'properties' => [
			'grt::StringRef' => '_caption',
			'grt::StringRef' => '_description',
			'grt::StringRef' => '_driverLibraryName',
			'grt::StringListRef' => '_files',
			'grt::StringRef' => '_filesTarget',
			'grt::StringRef' => '_hostIdentifierTemplate',
			'grt::ListRef<db_mgmt_DriverParameter>' => '_parameters',
		],
	],
	'db_mgmt_PythonDBAPIDriver' => [
		'extends' => 'db_mgmt_Driver',
		'properties' => [
			'grt::StringRef' => '_connectionStringTemplate',
		],
	],
	'db_mgmt_PrivilegeMapping' => [
		'extends' => 'GrtObject',
		'properties' => [
			'grt::StringListRef' => '_privileges',
			'grt::StringRef' => '_structName',
		],
	],
	'db_mgmt_Rdbms' => [
		'extends' => 'GrtObject',
		'properties' => [
			'grt::StringRef' => '_caption',
			'grt::ListRef<db_CharacterSet>' => '_characterSets',
			'grt::StringRef' => '_databaseObjectPackage',
			'db_mgmt_DriverRef' => '_defaultDriver',
			'grt::IntegerRef' => '_doesSupportCatalogs',
			'grt::ListRef<db_mgmt_Driver>' => '_drivers',
			'grt::IntegerRef' => '_maximumIdentifierLength',
			'grt::ListRef<db_mgmt_PrivilegeMapping>' => '_privilegeNames',
			'grt::ListRef<db_SimpleDatatype>' => '_simpleDatatypes',
			'GrtVersionRef' => '_version',
		],
	],
	'db_mgmt_Management' => [
		'extends' => 'GrtObject',
		'properties' => [
			'grt::ListRef<db_DatatypeGroup>' => '_datatypeGroups',
			'grt::ListRef<db_mgmt_Connection>' => '_otherStoredConns',
			'grt::ListRef<db_mgmt_Rdbms>' => '_rdbms',
			'grt::ListRef<db_mgmt_Connection>' => '_storedConns',
			'grt::ListRef<db_mgmt_ServerInstance>' => '_storedInstances',
		],
	],
];
