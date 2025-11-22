<?php

declare(strict_types=1);

namespace Mwb\ReverseEngineering\Introspection;

class GrtType extends \Mwb\ReverseEngineering\Inspection\GrtType
{
	static public $map = [
		'grt::Integer' => 'int',
		'grt::Double' => 'float',
		'grt::String' => 'string',

		'grt::' => 'mixed',
		'grt::Dict' => 'array',
		'grt::List' => 'array',

		//'grt::StringDict'  => 'object',
		//'grt::IntegerDict' => 'object',
		//'grt::DoubleDict'  => 'object',
		//'grt::ObjectDict'  => 'object',

		'grt::StringList'  => 'array',
		'grt::IntegerList' => 'array',
		'grt::DoubleList'  => 'array',
		'grt::ObjectList'  => 'array',

		// else            => 'object'
		//'grt::Object' => 'object',
		// GrtVersionRef
		// GrtObjectRef
		// GrtNamedObjectRef
		//'app_DocumentInfoRef' => 'object',
	];
	static public $mapStruct = [
		'grt::Dict' => '\\ArrayObject',
		'grt::List' => '\\ArrayObject',

		'grt::StringList'  => '\\ArrayObject',
		'grt::IntegerList' => '\\ArrayObject',
		'grt::DoubleList'  => '\\ArrayObject',
		'grt::ObjectList'  => '\\ArrayObject',

		//'grt::StringDict'  => '\\ArrayObject',
	];
	static public $mapContent = [
		//'Object' => 'object',
	];


	public $type = "";
	public $struct = null;
	public $content_type = null;
	public $content_struct = null;

	public function __construct($type_name) {
		//['type'=>'object', 'struct'=>'\ArrayObject', 'content-type'=>'object', 'content-struct'=>'app_PluginInputDefinition']
		$typeUntemplate = $type_name;
		$typeUnref      = $type_name;
		$typeUnlist     = $type_name;
		$type           = $type_name;// 'grt::'

		$templateType = Null;
		$refType      = Null;
		$listType     = Null;
		$pos = strpos($type_name, '<');
		if ($pos!==False) {
			$templateType = substr($type_name, $pos+1, -1);
			$typeUntemplate = substr($type_name, 0, $pos);

			$typeUnref      = $typeUntemplate;
			$typeUnlist     = $typeUntemplate;
			$type           = $typeUntemplate;
		}

		$tmp = substr($typeUntemplate, 0, -strlen('Ref'));
		if ( $typeUntemplate !== $tmp ) {
			$refType = 'Ref';
			$typeUnref  = $tmp;

			$typeUnlist = $typeUnref;
			$type       = $typeUnref;
		}

		$tmp = substr($typeUnref, 0, -strlen('List'));
		if ( $typeUnref === $tmp.'List' ) {
			$listType = 'List';
			$typeUnlist  = $tmp;

			$type       = $typeUnlist;
		} else {
			$tmp = substr($typeUnref, 0, -strlen('Dict'));
			if ( $typeUnref === $tmp.'Dict' ) {
				$listType = 'Dict';
				$typeUnlist  = $tmp;

				$type       = $typeUnlist;// grt:: <=> grt::Dict
			}
		}

		if ($templateType) {
			// grt::ListRef<app_PluginInputDefinition>
			$this->type = isset(self::$map[$typeUnref]) ? self::$map[$typeUnref] : 'mixed';
			$this->struct = isset(self::$mapStruct[$typeUnref]) ? self::$mapStruct[$typeUnref] : 'mixed';
			$this->content_type = 'object';
			$this->content_struct = $templateType;
//echo 'grt::ListRef<meta_Tag>' . $type_name . PHP_EOL;
//throw new \Exception('');
		} else {

			if (in_array($listType, ['List', 'Dict'])) {
				$this->type = 'array';
				$this->struct = '\ArrayObject';
				if ( isset(self::$map[$typeUnlist]) ) {
					// grt::IntegerListRef => grt::IntegerList
					$this->content_type = isset(self::$map[$typeUnlist]) ? self::$map[$typeUnlist] : 'mixed';
					if (in_array($this->content_type, ['array', 'mixed']))  {
						$this->content_struct = $templateType;
//echo 'grt::DictRef' . $type_name . PHP_EOL;
//throw new \Exception('');
					} else {
//echo 'grt::StringListRef' . $type_name . PHP_EOL;
//throw new \Exception('');
					}
				} else {
//echo ' [?] Uncheaded' . $type_name . PHP_EOL;
				}
			} else {
				// grt::StringRef
				// grt::DoubleRef
				// grt::DictRef
				// db_ViewRef
				$this->type = isset(self::$map[$typeUnref]) ? self::$map[$typeUnref] : 'object';
				if ('object'==$this->type) {
					$this->struct = $typeUnref;
//echo 'model_FigureRef' . $type_name . PHP_EOL;
//throw new \Exception('');
				} else {
//echo 'grt::IntegerRef' . $type_name . PHP_EOL;
//throw new \Exception('');
				}
			}
		}
	}
}
