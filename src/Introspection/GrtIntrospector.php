<?php

declare(strict_types=1);

namespace Mwb\ReverseEngineering\Introspection;

use Mwb\ReverseEngineering\Generation\GrtGenerator;
use Laminas\Code\Generator\FileGenerator;
use Laminas\Code\Generator\ClassGenerator;
use Laminas\Code\Generator\PropertyGenerator;
use Laminas\Code\Generator\TypeGenerator;

class GrtIntrospector extends \Mwb\ReverseEngineering\Inspection\GrtInspector
{

	private $generator = Null;
	public function __construct($data_dir) {
		parent::__construct($data_dir);
		$this->generator = new GrtGenerator();
	}

	protected $pathTypes = [];
	protected $qfnTypes = [];

	public $mapTypes = [];


	public function resolvingNames($db_DatabaseObject, $prefix='') {
		$names = explode('_', $db_DatabaseObject);
		$names = array_map('ucfirst', $names);
		return $names;
	}
	public function resolvingPath($db_DatabaseObject, $prefix='') {
		$names = explode('_', $db_DatabaseObject);
		$names = array_map('ucfirst', $names);
		return $names;
	}

	protected function generateAllTypes() {
		foreach ($this->mapTypes as $type => $mapType) {
			switch ($mapType->type) {
				case 'object':
					if ('\\'==substr($mapType->struct, 0, 1)) {
						$this->qfnTypes[$type] = ['php'=>$mapType->struct, 'annotation'=>$mapType->struct];
					} else {
						$php = '\\'.GrtGenerator::GRT_NAMESPACE .'\\'. implode('\\', $this->resolvingNames($mapType->struct));
						$this->qfnTypes[$type] = ['php'=>$php, 'annotation'=>$php];
						$this->pathTypes[$type] = str_replace('\\', '/', $php).'.php';
					}
					break;
				case 'array':
					if ('object'==$mapType->content_type) {
						$this->qfnTypes[$type] = ['php'=>'\\ArrayObject', 'annotation'=>'array<\\'.GrtGenerator::GRT_NAMESPACE .'\\'. implode('\\', $this->resolvingNames($mapType->content_struct)).'>'];
					} else {
						$this->qfnTypes[$type] = ['php'=>'\\ArrayObject', 'annotation'=>'array<'.$mapType->content_struct.'>'];
					}
					break;
				case 'float':
				case 'string':
				case 'int':
				default:
					$this->qfnTypes[$type] = ['php'=>$mapType->type, 'annotation'=>$mapType->type];
					break;
			}
		}
	}

	protected function introspectTypes($data, $objectGenerated) {
		foreach ($data as $key => $value) {
			//if (!in_array($key, $this->whiteList)) continue;
			$this->mapTypes[$key] = new GrtType($key);

			foreach ($value['properties'] as $name => $type) {
				$this->mapTypes[$type] = new GrtType($type);
			}
		}
	}
	public function introspectAllTypes($structFilenames) {
		foreach ($structFilenames as $structFilename) {
			$data = include $this->data_dir.'/'.$structFilename;
			$this->introspectTypes($data, Null);
		}

		unset($this->mapTypes["mforms_ObjectReferenceRef"]);
		unset($this->mapTypes["signals2::signal<>"]);
		$this->generateAllTypes();
	}


	protected $generationFiles=[];

	public function introspectObjects($data, $prefix) {
		//TODO: Use generateObjects
		foreach ($data as $key => $value) {
			$db_DatabaseObject = $key;
			// GrtGenerator::GRT_NAMESPACE
			//$className = substr($db_DatabaseObject, strlen($prefix));

			$names = $this->resolvingNames($db_DatabaseObject);
			$className = array_pop($names);
			$namespace = implode('\\', $names);

			$names = $this->resolvingNames($value['extends']);
			$qName = implode('\\', $names);

			$classGenerator = new ClassGenerator();
			$classGenerator->setName($className);
			$classGenerator->setExtendedClass(GrtGenerator::GRT_NAMESPACE.'\\'.$qName);

			/*
			$docBlockGenerator = new DocBlockGenerator();
			{
				$docBlockGenerator->setShortDescription('Sample generated class');
				$docBlockGenerator->setLongDescription('This is a class generated with Laminas\Code\Generator.');
				$docBlockGenerator->setTags([
					new GenericTag('category', 'MySQL Workbench'),
					new GenericTag('version', '6.3'),
					new GenericTag('license', 'New BSD'),
				]);
			}
			$classGenerator->setDocblock($docBlockGenerator);
			*/
			if ('\\'===substr($className, 0, 1)) {
				$qfnClass = $className;
			} else {
				$qfnClass = '\\'.GrtGenerator::GRT_NAMESPACE.'\\'.$namespace.'\\'.$className;
			}

			$usesage = [];
			$properties = [];
			foreach($value['properties'] as $name => $type) {
				if (!empty($type)) {
					if (!empty($this->qfnTypes[$type])) {
						$properties[] = new PropertyGenerator(trim($name, '_'), Null, PropertyGenerator::FLAG_PUBLIC, TypeGenerator::fromTypeString('?'.$this->qfnTypes[$type]['php']));
						if (!in_array($this->qfnTypes[$type]['php'], ['int', 'float', 'string', 'array', 'object', 'mixed', 'true', 'false', 'null'])) {
							if ($qfnClass != $this->qfnTypes[$type]['php']) {
								$usesage[$this->qfnTypes[$type]['php']] = 1;
							} else {
								/*
								echo '[DEBUG] ' . $this->qfnTypes[$type]['php'] . PHP_EOL;
								echo '        ' . $qfnClass . PHP_EOL;
								*/
							}
							/*if ('GrtObject'==$className) {
								echo '[XDEBUG] ' . $qfnClass . PHP_EOL;
								echo '         ' . $namespace.','.$className . PHP_EOL;
							}*/
						}
					} else {
						//echo ' [OK] Skip property : ' . $key . '::' . $name .'('. $type .')'. PHP_EOL;
						//print_r($value);
					}
				} else {
					//var_dump($value);
				}
				 
			}
			$classGenerator->addProperties($properties);
					//new PropertyGenerator('format', (string)$xml['grt_format'], PropertyGenerator::FLAG_PROTECTED),
					//new PropertyGenerator('version', (string)$xml['version'], PropertyGenerator::FLAG_PUBLIC),
					//new PropertyGenerator('document', null, PropertyGenerator::FLAG_PUBLIC, TypeGenerator::fromTypeString('Workbench\\Document')),
					//new PropertyGenerator('notes', array('1'=>'My note'), PropertyGenerator::FLAG_PUBLIC, TypeGenerator::fromTypeString('string')),
					//new PropertyGenerator('db', array('data.db'), PropertyGenerator::FLAG_PUBLIC, TypeGenerator::fromTypeString('array')),

			//$classGenerator->addMethods($methods);

			//$__toString = $this->generator->generateToString($classGenerator);
			//$classGenerator->addMethods([$__toString]);



			$names = $this->resolvingNames(str_replace('\\', '_', GrtGenerator::GRT_NAMESPACE).'_'.$db_DatabaseObject);
			$fileName = ucfirst(array_pop($names));
			//$path = implode('/', $names);
			//$path = GrtGenerator::GRT_DIR . ;
			$parts = $this->resolvingPath($db_DatabaseObject);
			/*$fileName =*/ array_pop($parts);
			$path = implode(DIRECTORY_SEPARATOR, $parts);

			//array_walk($names, 'ucfirst');
			//$parts = explode('_', $db_DatabaseObject);


			$fileGenerator = new FileGenerator();
			$ns = [GrtGenerator::GRT_NAMESPACE];
			if (!empty($namespace))
				$ns[]=$namespace;
			$fileGenerator->setNamespace(implode('\\', $ns));
			foreach($usesage as $use=>$unused) {
				$fileGenerator->setUse($use);
			}
			//$fileGenerator->setUse('\\'.GrtGenerator::GRT_NAMESPACE . '\\' . $qName);
			$fileGenerator->setFilename($path . DIRECTORY_SEPARATOR . $fileName.'.php');
			$fileGenerator->setClass($classGenerator);

			//echo "+ $key".count($this->generationFiles)."\n";
			$this->generationFiles[$key] = $fileGenerator;
		}
	}

	public function introspectAllObjects($structFilenames) {
		foreach ($structFilenames as $structFilename) {
			$data = include $this->data_dir.'/'.$structFilename;
			$this->introspectObjects($data, Null);
		}
	}

	//public function generate($out_dir, $enable=False)
	public function introspect($structFilenames)
	{
		$this->introspectAllTypes($structFilenames);
		$this->introspectAllObjects($structFilenames);
	}
	public function generate($out_dir)
	{

		$blackList = ['GrtLogEntry', 'GrtLogObject', 'GrtMessage', 'GrtNamedObject', 'GrtObject', 'GrtStoredNote', 'GrtVersion'];
		foreach($this->generationFiles as $key => $generationFile) {

			if (!empty($blackList) && in_array($key, $blackList)) continue;

			$filepath = $out_dir.'/'.$generationFile->getFilename();
			$path = dirname($filepath);
			`mkdir -pv $path`;
			`touch $filepath`;
			//echo " + \e[31m".$filepath."\e[0m".PHP_EOL;
			file_put_contents($filepath, $generationFile->generate());
		}
	}
}

