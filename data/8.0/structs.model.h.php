<?php

return [
	'model_Marker' => [
		'extends' => 'GrtObject',
		'properties' => [
			'GrtObjectRef' => '_diagram',
			'grt::DoubleRef' => '_x',
			'grt::DoubleRef' => '_y',
			'grt::DoubleRef' => '_zoom',
		],
	],
	'model_Group' => [
		'extends' => 'GrtObject',
		'properties' => [
			'grt::StringRef' => '_description',
			'grt::ListRef<model_Figure>' => '_figures',
			'grt::ListRef<model_Group>' => '_subGroups',
		],
	],
	'model_Object' => [
		'extends' => 'GrtObject',
		'properties' => [
			'grt::IntegerRef' => '_visible',
		],
	],
	'model_Layer' => [
		'extends' => 'model_Object',
		'properties' => [
			'grt::StringRef' => '_color',
			'grt::StringRef' => '_description',
			'grt::ListRef<model_Figure>' => '_figures',
			'grt::ListRef<model_Group>' => '_groups',
			'grt::DoubleRef' => '_height',
			'grt::DoubleRef' => '_left',
			'grt::ListRef<model_Layer>' => '_subLayers',
			'grt::DoubleRef' => '_top',
			'grt::DoubleRef' => '_width',
		],
	],
	'model_Connection' => [
		'extends' => 'model_Object',
		'properties' => [
			'grt::IntegerRef' => '_drawSplit',
			'model_FigureRef' => '_endFigure',
			'model_FigureRef' => '_startFigure',
		],
	],
	'model_Figure' => [
		'extends' => 'model_Object',
		'properties' => [
			'grt::StringRef' => '_color',
			'grt::IntegerRef' => '_expanded',
			'model_GroupRef' => '_group',
			'grt::DoubleRef' => '_height',
			'model_LayerRef' => '_layer',
			'grt::DoubleRef' => '_left',
			'grt::IntegerRef' => '_locked',
			'grt::IntegerRef' => '_manualSizing',
			'grt::DoubleRef' => '_top',
			'grt::DoubleRef' => '_width',
		],
	],
	'model_Diagram' => [
		'extends' => 'GrtObject',
		'properties' => [
			'signals2::signal<>' => '_signal_objectActivated',
			'signals2::signal<>' => '_signal_refreshDisplay',
			'grt::IntegerRef' => '_closed',
			'grt::ListRef<model_Connection>' => '_connections',
			'grt::StringRef' => '_description',
			'grt::ListRef<model_Figure>' => '_figures',
			'grt::DoubleRef' => '_height',
			'grt::ListRef<model_Layer>' => '_layers',
			'grt::DictRef' => '_options',
			'model_LayerRef' => '_rootLayer',
			'grt::ListRef<model_Object>' => '_selection',
			'grt::IntegerRef' => '_updateBlocked',
			'grt::DoubleRef' => '_width',
			'grt::DoubleRef' => '_x',
			'grt::DoubleRef' => '_y',
			'grt::DoubleRef' => '_zoom',
		],
	],
	'model_Model' => [
		'extends' => 'GrtObject',
		'properties' => [
			'model_DiagramRef' => '_currentDiagram',
			'grt::DictRef' => '_customData',
			'grt::ListRef<model_Diagram>' => '_diagrams',
			'grt::ListRef<model_Marker>' => '_markers',
			'grt::DictRef' => '_options',
		],
	],
];
