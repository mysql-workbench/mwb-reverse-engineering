<?php

return [
	'meta_TaggedObject' => [
		'extends' => 'GrtObject',
		'properties' => [
			'_description' => 'grt::StringRef',
			'_object' => 'db_DatabaseObjectRef',
		],
	],
	'meta_Tag' => [
		'extends' => 'GrtObject',
		'properties' => [
			'_category' => 'GrtObjectRef',
			'_color' => 'grt::StringRef',
			'_description' => 'grt::StringRef',
			'_label' => 'grt::StringRef',
			'_objects' => 'grt::ListRef<meta_TaggedObject>',
		],
	],
];
