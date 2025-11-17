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
			'grt::StringRef' => '_caption',
			'grt::DoubleRef' => '_captionXOffs',
			'grt::DoubleRef' => '_captionYOffs',
			'grt::StringRef' => '_comment',
			'grt::DoubleRef' => '_endCaptionXOffs',
			'grt::DoubleRef' => '_endCaptionYOffs',
			'grt::StringRef' => '_extraCaption',
			'grt::DoubleRef' => '_extraCaptionXOffs',
			'grt::DoubleRef' => '_extraCaptionYOffs',
			'db_ForeignKeyRef' => '_foreignKey',
			'grt::DoubleRef' => '_middleSegmentOffset',
			'grt::DoubleRef' => '_startCaptionXOffs',
			'grt::DoubleRef' => '_startCaptionYOffs',
		],
	],
	'workbench_physical_RoutineGroupFigure' => [
		'extends' => 'model_Figure',
		'properties' => [
			'db_RoutineGroupRef' => '_routineGroup',
		],
	],
	'workbench_physical_ViewFigure' => [
		'extends' => 'model_Figure',
		'properties' => [
			'db_ViewRef' => '_view',
		],
	],
	'workbench_physical_TableFigure' => [
		'extends' => 'model_Figure',
		'properties' => [
			'grt::IntegerRef' => '_columnsExpanded',
			'grt::IntegerRef' => '_foreignKeysExpanded',
			'grt::IntegerRef' => '_indicesExpanded',
			'grt::IntegerRef' => '_summarizeDisplay',
			'db_TableRef' => '_table',
			'grt::IntegerRef' => '_triggersExpanded',
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
			'db_CatalogRef' => '_catalog',
			'grt::StringRef' => '_connectionNotation',
			'grt::ListRef<db_mgmt_Connection>' => '_connections',
			'db_mgmt_ConnectionRef' => '_currentConnection',
			'grt::StringRef' => '_figureNotation',
			'grt::ListRef<GrtStoredNote>' => '_notes',
			'db_mgmt_RdbmsRef' => '_rdbms',
			'grt::ListRef<db_Script>' => '_scripts',
			'grt::DictRef' => '_syncProfiles',
			'grt::ListRef<GrtObject>' => '_tagCategories',
			'grt::ListRef<meta_Tag>' => '_tags',
		],
	],
];
