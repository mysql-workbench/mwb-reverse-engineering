<?php

return [
	'workbench_OverviewPanel' => [
		'extends' => 'GrtObject',
		'properties' => [
			'grt::StringRef' => '_caption',
			'grt::IntegerRef' => '_expanded',
			'grt::IntegerRef' => '_expandedHeight',
			'grt::IntegerRef' => '_hasTabSelection',
			'grt::StringRef' => '_implModule',
			'grt::StringRef' => '_itemActivationFunction',
			'grt::StringRef' => '_itemCountFunction',
			'grt::IntegerRef' => '_itemDisplayMode',
			'grt::StringRef' => '_itemInfoFunction',
			'grt::StringRef' => '_nodeId',
			'grt::IntegerListRef' => '_selectedItems',
			'grt::StringRef' => '_tabActivationFunction',
			'grt::StringRef' => '_tabCountFunction',
			'grt::StringRef' => '_tabInfoFunction',
		],
	],
	'workbench_Document' => [
		'extends' => 'app_Document',
		'properties' => [
			'workbench_logical_ModelRef' => '_logicalModel',
			'model_ModelRef' => '_overviewCurrentModelType',
			'grt::ListRef<workbench_OverviewPanel>' => '_overviewPanels',
			'grt::ListRef<workbench_physical_Model>' => '_physicalModels',
		],
	],
	'workbench_Workbench' => [
		'extends' => 'app_Application',
		'properties' => [
			'grt::StringRef' => '_docPath',
			'db_migration_MigrationRef' => '_migration',
			'db_mgmt_ManagementRef' => '_rdbmsMgmt',
			'grt::ListRef<db_query_Editor>' => '_sqlEditors',
		],
	],
];
