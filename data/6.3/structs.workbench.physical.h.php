<?php

return [
	'workbench_physical_Layer' => [
		'extends' => 'model_Layer',
		'properties' => [
		],
	],
	'workbench_physical_Connection' => [
		'extends' => 'model_Connection',
		'properties' => [
			'_caption' => 'grt::StringRef',
			'_captionXOffs' => 'grt::DoubleRef',
			'_captionYOffs' => 'grt::DoubleRef',
			'_comment' => 'grt::StringRef',
			'_endCaptionXOffs' => 'grt::DoubleRef',
			'_endCaptionYOffs' => 'grt::DoubleRef',
			'_extraCaption' => 'grt::StringRef',
			'_extraCaptionXOffs' => 'grt::DoubleRef',
			'_extraCaptionYOffs' => 'grt::DoubleRef',
			'_foreignKey' => 'db_ForeignKeyRef',
			'_middleSegmentOffset' => 'grt::DoubleRef',
			'_startCaptionXOffs' => 'grt::DoubleRef',
			'_startCaptionYOffs' => 'grt::DoubleRef',
		],
	],
	'workbench_physical_RoutineGroupFigure' => [
		'extends' => 'model_Figure',
		'properties' => [
			'_routineGroup' => 'db_RoutineGroupRef',
		],
	],
	'workbench_physical_ViewFigure' => [
		'extends' => 'model_Figure',
		'properties' => [
			'_view' => 'db_ViewRef',
		],
	],
	'workbench_physical_TableFigure' => [
		'extends' => 'model_Figure',
		'properties' => [
			'_columnsExpanded' => 'grt::IntegerRef',
			'_foreignKeysExpanded' => 'grt::IntegerRef',
			'_indicesExpanded' => 'grt::IntegerRef',
			'_summarizeDisplay' => 'grt::IntegerRef',
			'_table' => 'db_TableRef',
			'_triggersExpanded' => 'grt::IntegerRef',
		],
	],
	'workbench_physical_Diagram' => [
		'extends' => 'model_Diagram',
		'properties' => [
		],
	],
	'workbench_physical_Model' => [
		'extends' => 'model_Model',
		'properties' => [
			'_catalog' => 'db_CatalogRef',
			'_connectionNotation' => 'grt::StringRef',
			'_connections' => 'grt::ListRef<db_mgmt_Connection>',
			'_currentConnection' => 'db_mgmt_ConnectionRef',
			'_figureNotation' => 'grt::StringRef',
			'_notes' => 'grt::ListRef<GrtStoredNote>',
			'_rdbms' => 'db_mgmt_RdbmsRef',
			'_scripts' => 'grt::ListRef<db_Script>',
			'_syncProfiles' => 'grt::DictRef',
			'_tagCategories' => 'grt::ListRef<GrtObject>',
			'_tags' => 'grt::ListRef<meta_Tag>',
		],
	],
];
