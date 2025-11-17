<?php

return [
	'app_PluginInputDefinition' => [
		'extends' => 'GrtObject',
		'properties' => [
		],
	],
	'app_PluginObjectInput' => [
		'extends' => 'app_PluginInputDefinition',
		'properties' => [
			'grt::StringRef' => '_objectStructName',
		],
	],
	'app_PluginFileInput' => [
		'extends' => 'app_PluginInputDefinition',
		'properties' => [
			'grt::StringRef' => '_dialogTitle',
			'grt::StringRef' => '_dialogType',
			'grt::StringRef' => '_fileExtensions',
		],
	],
	'app_PluginSelectionInput' => [
		'extends' => 'app_PluginInputDefinition',
		'properties' => [
			'grt::StringRef' => '_argumentCardinality',
			'grt::StringListRef' => '_objectStructNames',
		],
	],
	'app_Plugin' => [
		'extends' => 'GrtObject',
		'properties' => [
			'grt::StringRef' => '_accessibilityName',
			'grt::DictRef' => '_attributes',
			'grt::StringRef' => '_caption',
			'grt::StringRef' => '_description',
			'grt::StringListRef' => '_documentStructNames',
			'grt::StringListRef' => '_groups',
			'grt::ListRef<app_PluginInputDefinition>' => '_inputValues',
			'grt::StringRef' => '_moduleFunctionName',
			'grt::StringRef' => '_moduleName',
			'grt::StringRef' => '_pluginType',
			'grt::IntegerRef' => '_rating',
			'grt::IntegerRef' => '_showProgress',
		],
	],
	'app_DocumentPlugin' => [
		'extends' => 'app_Plugin',
		'properties' => [
		],
	],
	'app_PluginGroup' => [
		'extends' => 'GrtObject',
		'properties' => [
			'grt::StringRef' => '_accessibilityName',
			'grt::StringRef' => '_category',
			'grt::ListRef<app_Plugin>' => '_plugins',
		],
	],
	'app_Toolbar' => [
		'extends' => 'GrtObject',
		'properties' => [
			'grt::StringRef' => '_accessibilityName',
			'grt::ListRef<app_ToolbarItem>' => '_items',
		],
	],
	'app_CommandItem' => [
		'extends' => 'GrtObject',
		'properties' => [
			'grt::StringRef' => '_command',
			'grt::StringRef' => '_context',
			'grt::StringRef' => '_platform',
		],
	],
	'app_ToolbarItem' => [
		'extends' => 'app_CommandItem',
		'properties' => [
			'grt::StringRef' => '_accessibilityName',
			'grt::StringRef' => '_altIcon',
			'grt::StringRef' => '_darkIcon',
			'grt::StringRef' => '_icon',
			'grt::IntegerRef' => '_initialState',
			'grt::StringRef' => '_itemType',
			'grt::StringRef' => '_tooltip',
		],
	],
	'app_ShortcutItem' => [
		'extends' => 'app_CommandItem',
		'properties' => [
			'grt::StringRef' => '_shortcut',
		],
	],
	'app_MenuItem' => [
		'extends' => 'app_CommandItem',
		'properties' => [
			'grt::StringRef' => '_accessibilityName',
			'grt::StringRef' => '_caption',
			'grt::StringRef' => '_itemType',
			'grt::StringRef' => '_shortcut',
			'grt::ListRef<app_MenuItem>' => '_subItems',
		],
	],
	'app_CustomDataField' => [
		'extends' => 'GrtObject',
		'properties' => [
			'grt::StringRef' => '_defaultValue',
			'grt::StringRef' => '_description',
			'grt::StringRef' => '_objectStruct',
			'grt::StringRef' => '_type',
		],
	],
	'app_PageSettings' => [
		'extends' => 'GrtObject',
		'properties' => [
			'grt::DoubleRef' => '_marginBottom',
			'grt::DoubleRef' => '_marginLeft',
			'grt::DoubleRef' => '_marginRight',
			'grt::DoubleRef' => '_marginTop',
			'grt::StringRef' => '_orientation',
			'app_PaperTypeRef' => '_paperType',
			'grt::DoubleRef' => '_scale',
		],
	],
	'app_PaperType' => [
		'extends' => 'GrtObject',
		'properties' => [
			'grt::StringRef' => '_caption',
			'grt::DoubleRef' => '_height',
			'grt::DoubleRef' => '_marginBottom',
			'grt::DoubleRef' => '_marginLeft',
			'grt::DoubleRef' => '_marginRight',
			'grt::DoubleRef' => '_marginTop',
			'grt::IntegerRef' => '_marginsSet',
			'grt::DoubleRef' => '_width',
		],
	],
	'app_Registry' => [
		'extends' => 'GrtObject',
		'properties' => [
			'grt::StringRef' => '_appDataDirectory',
			'grt::StringRef' => '_appExecutablePath',
			'grt::ListRef<app_CustomDataField>' => '_customDataFields',
			'grt::ListRef<app_PluginGroup>' => '_pluginGroups',
			'grt::ListRef<app_Plugin>' => '_plugins',
		],
	],
	'app_Starter' => [
		'extends' => 'GrtObject',
		'properties' => [
			'grt::StringRef' => '_authorHome',
			'grt::StringRef' => '_command',
			'grt::StringRef' => '_description',
			'grt::StringRef' => '_edition',
			'grt::StringRef' => '_introduction',
			'grt::StringRef' => '_largeIcon',
			'grt::StringRef' => '_publisher',
			'grt::StringRef' => '_smallIcon',
			'grt::StringRef' => '_title',
			'grt::StringRef' => '_type',
		],
	],
	'app_Starters' => [
		'extends' => 'GrtObject',
		'properties' => [
			'grt::ListRef<app_Starter>' => '_custom',
			'grt::ListRef<app_Starter>' => '_displayList',
			'grt::ListRef<app_Starter>' => '_predefined',
		],
	],
	'app_Options' => [
		'extends' => 'GrtObject',
		'properties' => [
			'grt::DictRef' => '_commonOptions',
			'grt::StringListRef' => '_disabledPlugins',
			'grt::DictRef' => '_options',
			'grt::ListRef<app_PaperType>' => '_paperTypes',
			'grt::StringListRef' => '_recentFiles',
		],
	],
	'app_DocumentInfo' => [
		'extends' => 'GrtObject',
		'properties' => [
			'grt::StringRef' => '_author',
			'grt::StringRef' => '_caption',
			'grt::StringRef' => '_dateChanged',
			'grt::StringRef' => '_dateCreated',
			'grt::StringRef' => '_description',
			'grt::StringRef' => '_project',
			'grt::StringRef' => '_version',
		],
	],
	'app_Info' => [
		'extends' => 'GrtObject',
		'properties' => [
			'grt::StringRef' => '_caption',
			'grt::StringRef' => '_copyright',
			'grt::StringRef' => '_description',
			'grt::StringRef' => '_edition',
			'grt::StringRef' => '_license',
			'GrtVersionRef' => '_version',
		],
	],
	'app_Document' => [
		'extends' => 'GrtObject',
		'properties' => [
			'grt::DictRef' => '_customData',
			'app_DocumentInfoRef' => '_info',
			'app_PageSettingsRef' => '_pageSettings',
		],
	],
	'app_Application' => [
		'extends' => 'GrtObject',
		'properties' => [
			'grt::DictRef' => '_customData',
			'app_DocumentRef' => '_doc',
			'app_InfoRef' => '_info',
			'app_OptionsRef' => '_options',
			'app_RegistryRef' => '_registry',
			'app_StartersRef' => '_starters',
			'grt::DictRef' => '_state',
		],
	],
];
