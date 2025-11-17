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
			'_objectStructName' => 'grt::StringRef',
		],
	],
	'app_PluginFileInput' => [
		'extends' => 'app_PluginInputDefinition',
		'properties' => [
			'_dialogTitle' => 'grt::StringRef',
			'_dialogType' => 'grt::StringRef',
			'_fileExtensions' => 'grt::StringRef',
		],
	],
	'app_PluginSelectionInput' => [
		'extends' => 'app_PluginInputDefinition',
		'properties' => [
			'_argumentCardinality' => 'grt::StringRef',
			'_objectStructNames' => 'grt::StringListRef',
		],
	],
	'app_Plugin' => [
		'extends' => 'GrtObject',
		'properties' => [
			'_attributes' => 'grt::DictRef',
			'_caption' => 'grt::StringRef',
			'_description' => 'grt::StringRef',
			'_documentStructNames' => 'grt::StringListRef',
			'_groups' => 'grt::StringListRef',
			'_inputValues' => 'grt::ListRef<app_PluginInputDefinition>',
			'_moduleFunctionName' => 'grt::StringRef',
			'_moduleName' => 'grt::StringRef',
			'_pluginType' => 'grt::StringRef',
			'_rating' => 'grt::IntegerRef',
			'_showProgress' => 'grt::IntegerRef',
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
			'_category' => 'grt::StringRef',
			'_plugins' => 'grt::ListRef<app_Plugin>',
		],
	],
	'app_Toolbar' => [
		'extends' => 'GrtObject',
		'properties' => [
			'_items' => 'grt::ListRef<app_ToolbarItem>',
		],
	],
	'app_CommandItem' => [
		'extends' => 'GrtObject',
		'properties' => [
			'_command' => 'grt::StringRef',
			'_context' => 'grt::StringRef',
			'_platform' => 'grt::StringRef',
		],
	],
	'app_ToolbarItem' => [
		'extends' => 'app_CommandItem',
		'properties' => [
			'_altIcon' => 'grt::StringRef',
			'_icon' => 'grt::StringRef',
			'_initialState' => 'grt::IntegerRef',
			'_itemType' => 'grt::StringRef',
			'_tooltip' => 'grt::StringRef',
		],
	],
	'app_ShortcutItem' => [
		'extends' => 'app_CommandItem',
		'properties' => [
			'_shortcut' => 'grt::StringRef',
		],
	],
	'app_MenuItem' => [
		'extends' => 'app_CommandItem',
		'properties' => [
			'_caption' => 'grt::StringRef',
			'_itemType' => 'grt::StringRef',
			'_shortcut' => 'grt::StringRef',
			'_subItems' => 'grt::ListRef<app_MenuItem>',
		],
	],
	'app_CustomDataField' => [
		'extends' => 'GrtObject',
		'properties' => [
			'_defaultValue' => 'grt::StringRef',
			'_description' => 'grt::StringRef',
			'_objectStruct' => 'grt::StringRef',
			'_type' => 'grt::StringRef',
		],
	],
	'app_PageSettings' => [
		'extends' => 'GrtObject',
		'properties' => [
			'_marginBottom' => 'grt::DoubleRef',
			'_marginLeft' => 'grt::DoubleRef',
			'_marginRight' => 'grt::DoubleRef',
			'_marginTop' => 'grt::DoubleRef',
			'_orientation' => 'grt::StringRef',
			'_paperType' => 'app_PaperTypeRef',
			'_scale' => 'grt::DoubleRef',
		],
	],
	'app_PaperType' => [
		'extends' => 'GrtObject',
		'properties' => [
			'_caption' => 'grt::StringRef',
			'_height' => 'grt::DoubleRef',
			'_marginBottom' => 'grt::DoubleRef',
			'_marginLeft' => 'grt::DoubleRef',
			'_marginRight' => 'grt::DoubleRef',
			'_marginTop' => 'grt::DoubleRef',
			'_marginsSet' => 'grt::IntegerRef',
			'_width' => 'grt::DoubleRef',
		],
	],
	'app_Registry' => [
		'extends' => 'GrtObject',
		'properties' => [
			'_appDataDirectory' => 'grt::StringRef',
			'_appExecutablePath' => 'grt::StringRef',
			'_customDataFields' => 'grt::ListRef<app_CustomDataField>',
			'_pluginGroups' => 'grt::ListRef<app_PluginGroup>',
			'_plugins' => 'grt::ListRef<app_Plugin>',
		],
	],
	'app_Starter' => [
		'extends' => 'GrtObject',
		'properties' => [
			'_authorHome' => 'grt::StringRef',
			'_command' => 'grt::StringRef',
			'_description' => 'grt::StringRef',
			'_edition' => 'grt::StringRef',
			'_introduction' => 'grt::StringRef',
			'_largeIcon' => 'grt::StringRef',
			'_publisher' => 'grt::StringRef',
			'_smallIcon' => 'grt::StringRef',
			'_title' => 'grt::StringRef',
			'_type' => 'grt::StringRef',
		],
	],
	'app_Starters' => [
		'extends' => 'GrtObject',
		'properties' => [
			'_custom' => 'grt::ListRef<app_Starter>',
			'_displayList' => 'grt::ListRef<app_Starter>',
			'_predefined' => 'grt::ListRef<app_Starter>',
		],
	],
	'app_Options' => [
		'extends' => 'GrtObject',
		'properties' => [
			'_commonOptions' => 'grt::DictRef',
			'_disabledPlugins' => 'grt::StringListRef',
			'_options' => 'grt::DictRef',
			'_paperTypes' => 'grt::ListRef<app_PaperType>',
			'_recentFiles' => 'grt::StringListRef',
		],
	],
	'app_DocumentInfo' => [
		'extends' => 'GrtObject',
		'properties' => [
			'_author' => 'grt::StringRef',
			'_caption' => 'grt::StringRef',
			'_dateChanged' => 'grt::StringRef',
			'_dateCreated' => 'grt::StringRef',
			'_description' => 'grt::StringRef',
			'_project' => 'grt::StringRef',
			'_version' => 'grt::StringRef',
		],
	],
	'app_Info' => [
		'extends' => 'GrtObject',
		'properties' => [
			'_caption' => 'grt::StringRef',
			'_copyright' => 'grt::StringRef',
			'_description' => 'grt::StringRef',
			'_edition' => 'grt::StringRef',
			'_license' => 'grt::StringRef',
			'_version' => 'GrtVersionRef',
		],
	],
	'app_Document' => [
		'extends' => 'GrtObject',
		'properties' => [
			'_customData' => 'grt::DictRef',
			'_info' => 'app_DocumentInfoRef',
			'_pageSettings' => 'app_PageSettingsRef',
		],
	],
	'app_Application' => [
		'extends' => 'GrtObject',
		'properties' => [
			'_customData' => 'grt::DictRef',
			'_doc' => 'app_DocumentRef',
			'_info' => 'app_InfoRef',
			'_options' => 'app_OptionsRef',
			'_registry' => 'app_RegistryRef',
			'_starters' => 'app_StartersRef',
			'_state' => 'grt::DictRef',
		],
	],
];
