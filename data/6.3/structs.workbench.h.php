<?php

return [
	'workbench_OverviewPanel' => [
		'extends' => 'GrtObject',
		'properties' => [
			'_caption' => 'grt::StringRef',
			'_expanded' => 'grt::IntegerRef',
			'_expandedHeight' => 'grt::IntegerRef',
			'_hasTabSelection' => 'grt::IntegerRef',
			'_implModule' => 'grt::StringRef',
			'_itemActivationFunction' => 'grt::StringRef',
			'_itemCountFunction' => 'grt::StringRef',
			'_itemDisplayMode' => 'grt::IntegerRef',
			'_itemInfoFunction' => 'grt::StringRef',
			'_nodeId' => 'grt::StringRef',
			'_selectedItems' => 'grt::IntegerListRef',
			'_tabActivationFunction' => 'grt::StringRef',
			'_tabCountFunction' => 'grt::StringRef',
			'_tabInfoFunction' => 'grt::StringRef',
		],
	],
	'workbench_Document' => [
		'extends' => 'app_Document',
		'properties' => [
			'_logicalModel' => 'workbench_logical_ModelRef',
			'_overviewCurrentModelType' => 'model_ModelRef',
			'_overviewPanels' => 'grt::ListRef<workbench_OverviewPanel>',
			'_physicalModels' => 'grt::ListRef<workbench_physical_Model>',
		],
	],
	'workbench_Workbench' => [
		'extends' => 'app_Application',
		'properties' => [
			'_docPath' => 'grt::StringRef',
			'_migration' => 'db_migration_MigrationRef',
			'_rdbmsMgmt' => 'db_mgmt_ManagementRef',
			'_sqlEditors' => 'grt::ListRef<db_query_Editor>',
		],
	],
];
