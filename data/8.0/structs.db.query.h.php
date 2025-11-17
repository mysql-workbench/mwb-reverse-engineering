<?php

return [
	'db_query_LiveDBObject' => [
		'extends' => 'GrtObject',
		'properties' => [
			'grt::StringRef' => '_schemaName',
			'grt::StringRef' => '_type',
		],
	],
	'db_query_ResultsetColumn' => [
		'extends' => 'GrtObject',
		'properties' => [
			'grt::StringRef' => '_columnType',
		],
	],
	'db_query_Resultset' => [
		'extends' => 'GrtObject',
		'properties' => [
			'grt::ListRef<db_query_ResultsetColumn>' => '_columns',
		],
	],
	'db_query_EditableResultset' => [
		'extends' => 'db_query_Resultset',
		'properties' => [
			'grt::StringRef' => '_schema',
			'grt::StringRef' => '_table',
		],
	],
	'db_query_ResultPanel' => [
		'extends' => 'GrtObject',
		'properties' => [
			'mforms_ObjectReferenceRef' => '_dockingPoint',
			'db_query_ResultsetRef' => '_resultset',
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
			'db_query_ResultPanelRef' => '_activeResultPanel',
			'mforms_ObjectReferenceRef' => '_resultDockingPoint',
			'grt::ListRef<db_query_ResultPanel>' => '_resultPanels',
		],
	],
	'db_query_Editor' => [
		'extends' => 'GrtObject',
		'properties' => [
			'db_query_QueryEditorRef' => '_activeQueryEditor',
			'grt::DictRef' => '_customData',
			'mforms_ObjectReferenceRef' => '_dockingPoint',
			'grt::ListRef<db_query_QueryEditor>' => '_queryEditors',
			'GrtVersionRef' => '_serverVersion',
			'mforms_ObjectReferenceRef' => '_sidebar',
		],
	],
];
