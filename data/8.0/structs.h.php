<?php

return [
	'GrtObject' => [
		'extends' => 'Object',
		'properties' => [
			'grt::StringRef' => '_name',
			'GrtObjectRef' => '_owner',
		],
	],
	'GrtVersion' => [
		'extends' => 'GrtObject',
		'properties' => [
			'grt::IntegerRef' => '_buildNumber',
			'grt::IntegerRef' => '_majorNumber',
			'grt::IntegerRef' => '_minorNumber',
			'grt::IntegerRef' => '_releaseNumber',
			'grt::IntegerRef' => '_status',
		],
	],
	'GrtMessage' => [
		'extends' => 'GrtObject',
		'properties' => [
			'grt::StringListRef' => '_details',
			'grt::StringRef' => '_msg',
			'grt::IntegerRef' => '_msgType',
		],
	],
	'GrtLogEntry' => [
		'extends' => 'GrtObject',
		'properties' => [
			'grt::DictRef' => '_customData',
			'grt::IntegerRef' => '_entryType',
		],
	],
	'GrtLogObject' => [
		'extends' => 'GrtObject',
		'properties' => [
			'grt::ListRef<GrtLogEntry>' => '_entries',
			'GrtObjectRef' => '_logObject',
			'GrtObjectRef' => '_refObject',
		],
	],
	'GrtNamedObject' => [
		'extends' => 'GrtObject',
		'properties' => [
			'grt::StringRef' => '_comment',
			'grt::StringRef' => '_oldName',
		],
	],
	'GrtStoredNote' => [
		'extends' => 'GrtNamedObject',
		'properties' => [
			'grt::StringRef' => '_createDate',
			'grt::StringRef' => '_filename',
			'grt::StringRef' => '_lastChangeDate',
		],
	],
];
