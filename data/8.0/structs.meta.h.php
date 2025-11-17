<?php

return [
	'meta_TaggedObject' => [
		'extends' => 'GrtObject',
		'properties' => [
			'grt::StringRef' => '_description',
			'db_DatabaseObjectRef' => '_object',
		],
	],
	'meta_Tag' => [
		'extends' => 'GrtObject',
		'properties' => [
			'GrtObjectRef' => '_category',
			'grt::StringRef' => '_color',
			'grt::StringRef' => '_description',
			'grt::StringRef' => '_label',
			'grt::ListRef<meta_TaggedObject>' => '_objects',
		],
	],
];
