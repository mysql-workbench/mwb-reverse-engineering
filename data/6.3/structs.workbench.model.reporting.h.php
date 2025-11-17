<?php

return [
	'workbench_model_reporting_TemplateStyleInfo' => [
		'extends' => 'GrtObject',
		'properties' => [
			'_canUseHTMLMarkup' => 'grt::IntegerRef',
			'_description' => 'grt::StringRef',
			'_previewImageFileName' => 'grt::StringRef',
			'_styleTagValue' => 'grt::StringRef',
		],
	],
	'workbench_model_reporting_TemplateInfo' => [
		'extends' => 'GrtObject',
		'properties' => [
			'_description' => 'grt::StringRef',
			'_mainFileName' => 'grt::StringRef',
			'_styles' => 'grt::ListRef<workbench_model_reporting_TemplateStyleInfo>',
		],
	],
];
