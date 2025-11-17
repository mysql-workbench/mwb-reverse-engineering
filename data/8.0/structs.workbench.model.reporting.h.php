<?php

return [
	'workbench_model_reporting_TemplateStyleInfo' => [
		'extends' => 'GrtObject',
		'properties' => [
			'grt::IntegerRef' => '_canUseHTMLMarkup',
			'grt::StringRef' => '_description',
			'grt::StringRef' => '_previewImageFileName',
			'grt::StringRef' => '_styleTagValue',
		],
	],
	'workbench_model_reporting_TemplateInfo' => [
		'extends' => 'GrtObject',
		'properties' => [
			'grt::StringRef' => '_description',
			'grt::StringRef' => '_mainFileName',
			'grt::ListRef<workbench_model_reporting_TemplateStyleInfo>' => '_styles',
		],
	],
];
