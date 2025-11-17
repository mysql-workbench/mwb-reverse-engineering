<?php

return [
	'workbench_model_ImageFigure' => [
		'extends' => 'model_Figure',
		'properties' => [
			'_filename' => 'grt::StringRef',
			'_keepAspectRatio' => 'grt::IntegerRef',
		],
	],
	'workbench_model_NoteFigure' => [
		'extends' => 'model_Figure',
		'properties' => [
			'_font' => 'grt::StringRef',
			'_text' => 'grt::StringRef',
			'_textColor' => 'grt::StringRef',
		],
	],
];
