<?php

return [
	'db_query_LiveDBObject' => [
		'extends' => 'GrtObject',
		'properties' => [
			'_schemaName' => 'grt::StringRef',
			'_type' => 'grt::StringRef',
		],
	],
	'db_query_ResultsetColumn' => [
		'extends' => 'GrtObject',
		'properties' => [
			'_columnType' => 'grt::StringRef',
		],
	],
	'db_query_Resultset' => [
		'extends' => 'GrtObject',
		'properties' => [
			'_columns' => 'grt::ListRef<db_query_ResultsetColumn>',
		],
	],
	'db_query_EditableResultset' => [
		'extends' => 'db_query_Resultset',
		'properties' => [
			'_schema' => 'grt::StringRef',
			'_table' => 'grt::StringRef',
		],
	],
	'db_query_ResultPanel' => [
		'extends' => 'GrtObject',
		'properties' => [
			'_dockingPoint' => 'mforms_ObjectReferenceRef',
			'_resultset' => 'db_query_ResultsetRef',
		],
	],
	'db_query_QueryBuffer' => [
		'extends' => 'GrtObject',
		'properties' => [
		],
	],
	'db_query_QueryEditor' => [
		'extends' => 'db_query_QueryBuffer',
		'properties' => [
			'_activeResultPanel' => 'db_query_ResultPanelRef',
			'_resultDockingPoint' => 'mforms_ObjectReferenceRef',
			'_resultPanels' => 'grt::ListRef<db_query_ResultPanel>',
		],
	],
	'db_query_Editor' => [
		'extends' => 'GrtObject',
		'properties' => [
			'_activeQueryEditor' => 'db_query_QueryEditorRef',
			'_customData' => 'grt::DictRef',
			'_dockingPoint' => 'mforms_ObjectReferenceRef',
			'_queryEditors' => 'grt::ListRef<db_query_QueryEditor>',
			'_serverVersion' => 'GrtVersionRef',
			'_sidebar' => 'mforms_ObjectReferenceRef',
		],
	],
];
