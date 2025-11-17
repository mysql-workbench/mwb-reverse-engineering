<?php

return [
	'workbench_model_ImageFigure' => [
		'extends' => 'model_Figure',
		'properties' => [
			'grt::StringRef' => '_filename',
			'grt::IntegerRef' => '_keepAspectRatio',
		],
	],
	'workbench_model_NoteFigure' => [
		'extends' => 'model_Figure',
		'properties' => [
			'grt::StringRef' => '_font',
			'grt::StringRef' => '_text',
			'grt::StringRef' => '_textColor',
		],
	],
];
