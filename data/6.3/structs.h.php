<?php

return [
	'GrtObject' => [
		'extends' => 'Object',
		'properties' => [
			'_name' => 'grt::StringRef',
			'_owner' => 'GrtObjectRef',
		],
	],
	'GrtVersion' => [
		'extends' => 'GrtObject',
		'properties' => [
			'_buildNumber' => 'grt::IntegerRef',
			'_majorNumber' => 'grt::IntegerRef',
			'_minorNumber' => 'grt::IntegerRef',
			'_releaseNumber' => 'grt::IntegerRef',
			'_status' => 'grt::IntegerRef',
		],
	],
	'GrtMessage' => [
		'extends' => 'GrtObject',
		'properties' => [
			'_details' => 'grt::StringListRef',
			'_msg' => 'grt::StringRef',
			'_msgType' => 'grt::IntegerRef',
		],
	],
	'GrtLogEntry' => [
		'extends' => 'GrtObject',
		'properties' => [
			'_customData' => 'grt::DictRef',
			'_entryType' => 'grt::IntegerRef',
		],
	],
	'GrtLogObject' => [
		'extends' => 'GrtObject',
		'properties' => [
			'_entries' => 'grt::ListRef<GrtLogEntry>',
			'_logObject' => 'GrtObjectRef',
			'_refObject' => 'GrtObjectRef',
		],
	],
	'GrtNamedObject' => [
		'extends' => 'GrtObject',
		'properties' => [
			'_comment' => 'grt::StringRef',
			'_oldName' => 'grt::StringRef',
		],
	],
	'GrtStoredNote' => [
		'extends' => 'GrtNamedObject',
		'properties' => [
			'_createDate' => 'grt::StringRef',
			'_filename' => 'grt::StringRef',
			'_lastChangeDate' => 'grt::StringRef',
		],
	],
];
