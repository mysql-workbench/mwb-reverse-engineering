<?php

return [
	'db_mgmt_SyncProfile' => [
		'extends' => 'GrtObject',
		'properties' => [
			'_lastKnownDBNames' => 'grt::DictRef',
			'_lastKnownViewDefinitions' => 'grt::DictRef',
			'_lastSyncDate' => 'grt::StringRef',
			'_targetHostIdentifier' => 'grt::StringRef',
			'_targetSchemaName' => 'grt::StringRef',
		],
	],
	'db_mgmt_ServerInstance' => [
		'extends' => 'GrtObject',
		'properties' => [
			'_connection' => 'db_mgmt_ConnectionRef',
			'_loginInfo' => 'grt::DictRef',
			'_serverInfo' => 'grt::DictRef',
		],
	],
	'db_mgmt_Connection' => [
		'extends' => 'GrtObject',
		'properties' => [
			'_driver' => 'db_mgmt_DriverRef',
			'_hostIdentifier' => 'grt::StringRef',
			'_isDefault' => 'grt::IntegerRef',
			'_modules' => 'grt::DictRef',
			'_parameterValues' => 'grt::DictRef',
		],
	],
	'db_mgmt_DriverParameter' => [
		'extends' => 'GrtObject',
		'properties' => [
			'_caption' => 'grt::StringRef',
			'_defaultValue' => 'grt::StringRef',
			'_description' => 'grt::StringRef',
			'_layoutAdvanced' => 'grt::IntegerRef',
			'_layoutRow' => 'grt::IntegerRef',
			'_layoutWidth' => 'grt::IntegerRef',
			'_lookupValueMethod' => 'grt::StringRef',
			'_lookupValueModule' => 'grt::StringRef',
			'_paramType' => 'grt::StringRef',
			'_paramTypeDetails' => 'grt::DictRef',
			'_required' => 'grt::IntegerRef',
		],
	],
	'db_mgmt_Driver' => [
		'extends' => 'GrtObject',
		'properties' => [
			'_caption' => 'grt::StringRef',
			'_description' => 'grt::StringRef',
			'_driverLibraryName' => 'grt::StringRef',
			'_files' => 'grt::StringListRef',
			'_filesTarget' => 'grt::StringRef',
			'_hostIdentifierTemplate' => 'grt::StringRef',
			'_parameters' => 'grt::ListRef<db_mgmt_DriverParameter>',
		],
	],
	'db_mgmt_PythonDBAPIDriver' => [
		'extends' => 'db_mgmt_Driver',
		'properties' => [
			'_connectionStringTemplate' => 'grt::StringRef',
		],
	],
	'db_mgmt_PrivilegeMapping' => [
		'extends' => 'GrtObject',
		'properties' => [
			'_privileges' => 'grt::StringListRef',
			'_structName' => 'grt::StringRef',
		],
	],
	'db_mgmt_Rdbms' => [
		'extends' => 'GrtObject',
		'properties' => [
			'_caption' => 'grt::StringRef',
			'_characterSets' => 'grt::ListRef<db_CharacterSet>',
			'_databaseObjectPackage' => 'grt::StringRef',
			'_defaultDriver' => 'db_mgmt_DriverRef',
			'_doesSupportCatalogs' => 'grt::IntegerRef',
			'_drivers' => 'grt::ListRef<db_mgmt_Driver>',
			'_maximumIdentifierLength' => 'grt::IntegerRef',
			'_privilegeNames' => 'grt::ListRef<db_mgmt_PrivilegeMapping>',
			'_simpleDatatypes' => 'grt::ListRef<db_SimpleDatatype>',
			'_version' => 'GrtVersionRef',
		],
	],
	'db_mgmt_Management' => [
		'extends' => 'GrtObject',
		'properties' => [
			'_datatypeGroups' => 'grt::ListRef<db_DatatypeGroup>',
			'_otherStoredConns' => 'grt::ListRef<db_mgmt_Connection>',
			'_rdbms' => 'grt::ListRef<db_mgmt_Rdbms>',
			'_storedConns' => 'grt::ListRef<db_mgmt_Connection>',
			'_storedInstances' => 'grt::ListRef<db_mgmt_ServerInstance>',
		],
	],
];
