<?php

return [
	'model_Marker' => [
		'extends' => 'GrtObject',
		'properties' => [
			'_diagram' => 'GrtObjectRef',
			'_x' => 'grt::DoubleRef',
			'_y' => 'grt::DoubleRef',
			'_zoom' => 'grt::DoubleRef',
		],
	],
	'model_Group' => [
		'extends' => 'GrtObject',
		'properties' => [
			'_description' => 'grt::StringRef',
			'_figures' => 'grt::ListRef<model_Figure>',
			'_subGroups' => 'grt::ListRef<model_Group>',
		],
	],
	'model_Object' => [
		'extends' => 'GrtObject',
		'properties' => [
			'_visible' => 'grt::IntegerRef',
		],
	],
	'model_Layer' => [
		'extends' => 'model_Object',
		'properties' => [
			'_color' => 'grt::StringRef',
			'_description' => 'grt::StringRef',
			'_figures' => 'grt::ListRef<model_Figure>',
			'_groups' => 'grt::ListRef<model_Group>',
			'_height' => 'grt::DoubleRef',
			'_left' => 'grt::DoubleRef',
			'_subLayers' => 'grt::ListRef<model_Layer>',
			'_top' => 'grt::DoubleRef',
			'_width' => 'grt::DoubleRef',
		],
	],
	'model_Connection' => [
		'extends' => 'model_Object',
		'properties' => [
			'_drawSplit' => 'grt::IntegerRef',
			'_endFigure' => 'model_FigureRef',
			'_startFigure' => 'model_FigureRef',
		],
	],
	'model_Figure' => [
		'extends' => 'model_Object',
		'properties' => [
			'_color' => 'grt::StringRef',
			'_expanded' => 'grt::IntegerRef',
			'_group' => 'model_GroupRef',
			'_height' => 'grt::DoubleRef',
			'_layer' => 'model_LayerRef',
			'_left' => 'grt::DoubleRef',
			'_locked' => 'grt::IntegerRef',
			'_manualSizing' => 'grt::IntegerRef',
			'_top' => 'grt::DoubleRef',
			'_width' => 'grt::DoubleRef',
		],
	],
	'model_Diagram' => [
		'extends' => 'GrtObject',
		'properties' => [
			'_signal_objectActivated' => 'signals2::signal<>',
			'_signal_refreshDisplay' => 'signals2::signal<>',
			'_closed' => 'grt::IntegerRef',
			'_connections' => 'grt::ListRef<model_Connection>',
			'_description' => 'grt::StringRef',
			'_figures' => 'grt::ListRef<model_Figure>',
			'_height' => 'grt::DoubleRef',
			'_layers' => 'grt::ListRef<model_Layer>',
			'_options' => 'grt::DictRef',
			'_rootLayer' => 'model_LayerRef',
			'_selection' => 'grt::ListRef<model_Object>',
			'_updateBlocked' => 'grt::IntegerRef',
			'_width' => 'grt::DoubleRef',
			'_x' => 'grt::DoubleRef',
			'_y' => 'grt::DoubleRef',
			'_zoom' => 'grt::DoubleRef',
		],
	],
	'model_Model' => [
		'extends' => 'GrtObject',
		'properties' => [
			'_currentDiagram' => 'model_DiagramRef',
			'_customData' => 'grt::DictRef',
			'_diagrams' => 'grt::ListRef<model_Diagram>',
			'_markers' => 'grt::ListRef<model_Marker>',
			'_options' => 'grt::DictRef',
		],
	],
];
