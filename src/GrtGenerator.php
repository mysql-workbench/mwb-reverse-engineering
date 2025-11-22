<?php

declare(strict_types=1);

namespace Mwb\ReverseEngineering;

use Laminas\Code\Generator\FileGenerator;
use Laminas\Code\Generator\ClassGenerator;
use Laminas\Code\Generator\PropertyGenerator;
use Laminas\Code\Generator\MethodGenerator;
use Laminas\Code\Generator\TypeGenerator;
use Laminas\Code\Generator\TypeGenerator\AtomicType;
use Laminas\Code\Generator\DocBlockGenerator;
use Laminas\Code\Generator\DocBlock\Tag\GenericTag;

class GrtGenerator
{

	const VENDOR_DIR = 'mysql-workbench';
	const PACKAGE_DIR = 'mwb-dom';
	const SRC_DIR = 'src';
	const MWB_DIR = self::VENDOR_DIR.DIRECTORY_SEPARATOR.self::PACKAGE_DIR.DIRECTORY_SEPARATOR.self::SRC_DIR;
	const GRT_DIR = self::VENDOR_DIR.DIRECTORY_SEPARATOR.self::PACKAGE_DIR.DIRECTORY_SEPARATOR.self::SRC_DIR.DIRECTORY_SEPARATOR.'Grt';

	const VENDOR_NAMESPACE = '';//'MySQLWorkbench';
	const MWB_NAMESPACE = 'Mwb';
	const GRT_NAMESPACE = self::MWB_NAMESPACE.'\\Grt';

	const ARRAY_OBJECT_CLASS = 'ArrayObject';
	//const ARRAY_OBJECT_CLASS = '\\Laminas\\Stdlib\\ArrayObject';



	// ====================================================================
	public $whiteList = [
		'GrtLogObject',
		'workbench_Workbench',
	];

	protected $pathTypes = [];
	protected $qfnTypes = [];

	public $mapTypes = [];
	public function reflectionTypes($data, $objectGenerated) {
		//$this->reflectionFiles
		foreach ($data as $key => $value) {
			//if (!in_array($key, $this->whiteList)) continue;
			$this->mapTypes[$key] = new Inspection\Type($key);

			foreach ($value['properties'] as $name => $type) {
				$this->mapTypes[$type] = new Inspection\Type($type);
			}
		}
	}
	public function reflectionAllTypes($data_dir, $structFilenames) {
		foreach ($structFilenames as $structFilename) {
			$data = include $data_dir.'/'.$structFilename;
			$this->reflectionTypes($data, Null);
		}

		unset($this->mapTypes["mforms_ObjectReferenceRef"]);
		unset($this->mapTypes["signals2::signal<>"]);
		unset($this->mapTypes[""]);

		$this->introspectionAllTypes();
	}

	public function introspectionAllTypes() {
		foreach ($this->mapTypes as $type => $mapType) {
			switch ($mapType->type) {
				case 'object':
					if ('\\'==substr($mapType->struct, 0, 1)) {
						$this->qfnTypes[$type] = ['php'=>$mapType->struct, 'annotation'=>$mapType->struct];
					} else {
						$php = '\\'.self::GRT_NAMESPACE .'\\'. implode('\\', $this->resolvingNames($mapType->struct));
						$this->qfnTypes[$type] = ['php'=>$php, 'annotation'=>$php];
						$this->pathTypes[$type] = str_replace('\\', '/', $php).'.php';
					}
					break;
				case 'array':
					if ('object'==$mapType->content_type) {
						$this->qfnTypes[$type] = ['php'=>'\\ArrayObject', 'annotation'=>'array<\\'.self::GRT_NAMESPACE .'\\'. implode('\\', $this->resolvingNames($mapType->content_struct)).'>'];
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

	public function reflectionObjectProperties($data, $objectGenerated) {
	}

	protected $reflectionFiles=[];
	public function reflectionObjects($data, $prefix) {
		foreach ($data as $key => $value) {
			$db_DatabaseObject = $key;
			// self::GRT_NAMESPACE
			//$className = substr($db_DatabaseObject, strlen($prefix));

			$names = $this->resolvingNames($db_DatabaseObject);
			$className = array_pop($names);
			$namespace = implode('\\', $names);

			$names = $this->resolvingNames($value['extends']);
			$qName = implode('\\', $names);

			$classGenerator = new ClassGenerator();
			$classGenerator->setName($className);
			$classGenerator->setExtendedClass(self::GRT_NAMESPACE.'\\'.$qName);

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
				$qfnClass = '\\'.self::GRT_NAMESPACE.'\\'.$namespace.'\\'.$className;
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

			$names = $this->resolvingNames(str_replace('\\', '_', self::GRT_NAMESPACE).'_'.$db_DatabaseObject);
			$fileName = ucfirst(array_pop($names));
			//$path = implode('/', $names);
			//$path = self::GRT_DIR . ;
			$parts = $this->resolvingPath($db_DatabaseObject);
			/*$fileName =*/ array_pop($parts);
			$path = implode(DIRECTORY_SEPARATOR, $parts);

			//array_walk($names, 'ucfirst');
			//$parts = explode('_', $db_DatabaseObject);


			$fileGenerator = new FileGenerator();
			$ns = [self::GRT_NAMESPACE];
			if (!empty($namespace))
				$ns[]=$namespace;
			$fileGenerator->setNamespace(implode('\\', $ns));
			foreach($usesage as $use=>$unused) {
				$fileGenerator->setUse($use);
			}
			//$fileGenerator->setUse('\\'.self::GRT_NAMESPACE . '\\' . $qName);
			$fileGenerator->setFilename($path . DIRECTORY_SEPARATOR . $fileName.'.php');
			$fileGenerator->setClass($classGenerator);

			//echo "+ $key".count($this->reflectionFiles)."\n";
			$this->reflectionFiles[$key] = $fileGenerator;
		}
	}
	public function reflectionAllObjects($data_dir, $structFilenames) {
		foreach ($structFilenames as $structFilename) {
			$data = include $data_dir.'/'.$structFilename;
			$this->reflectionObjects($data, Null);
		}
	}

	public function reflectionGrt() {

		$fileGenerator = new FileGenerator();
		$fileGenerator->setFilename('GrtDocument.php');
		//$fileGenerator->setNamespace(self::GRT_NAMESPACE);

		$classGenerator = new ClassGenerator();
		$classGenerator->setName('GrtDocument');
		$classGenerator->setDocblock(
			(new DocBlockGenerator())
				->setShortDescription('Sample generated class')
				->setLongDescription('This is a class generated with Laminas\Code\Generator.')
				->setTags([
					new GenericTag('version', '$Rev:$'),
					new GenericTag('license', 'New BSD'),
			])
		);
		$classGenerator->addUse('\\'.self::GRT_NAMESPACE.'\\Workbench\\Document');
		$typeGenerator = TypeGenerator::fromTypeString('?'.self::GRT_NAMESPACE.'\\Workbench\\Document');
		//$typeGenerator = TypeGenerator::fromTypeString('?Document');
		$docProperty = new PropertyRelativeGenerator('documentElement', null, PropertyGenerator::FLAG_PUBLIC, $fileGenerator, 'Document', $typeGenerator);
		$docDocBlock = new DocBlockGenerator();
		$docDocBlock->setTags([new GenericTag('var', $typeGenerator->generate().' $documentElement')]);
		$docProperty->setDocBlock($docDocBlock);
		$classGenerator->addProperties([
			new PropertyGenerator('format', '', PropertyGenerator::FLAG_PUBLIC),
			new PropertyGenerator('version', '', PropertyGenerator::FLAG_PUBLIC),
			//(new PropertyGenerator('documentElement', null, PropertyGenerator::FLAG_PUBLIC, TypeGenerator::fromTypeString('?Document')) ),
			$docProperty,
			new PropertyGenerator('notes', array('1'=>'My note'), PropertyGenerator::FLAG_PUBLIC, TypeGenerator::fromTypeString('array')),
			new PropertyGenerator('db', array('data.db'), PropertyGenerator::FLAG_PUBLIC, TypeGenerator::fromTypeString('array')),
		]);
		$classGenerator->setNamespaceName(self::GRT_NAMESPACE);

		$fileGenerator->setClass($classGenerator);
		return $fileGenerator;
	}

	public function reflectionMwb() {
		$classGenerator = (new ClassGenerator())
			->setName('MwbDocument')
			->setDocblock(
				(new DocBlockGenerator())
					->setShortDescription('Allow to parse a MySQL Workbench file (*.mwb)')
					->setLongDescription(     'This class is the entry point to a faithful representation of the MySQL Workbench model.'
							.PHP_EOL .'The main purpose of this class is to easily and accurately export database model.'
							.PHP_EOL .'This class unzip a .mwb file on the fly.'
							.PHP_EOL .'And expose the document.mwb.xml as a GrtDocument Model.'
							.PHP_EOL .'This class improve/fix MySQL Workbench EER Diagram to obtain a hierarchy of layers imbricate.'
					)
					->setTags([
						new GenericTag('usage', '`MwbDocument::load(file.mwb)->doc->version;`'),
						new GenericTag('todo', 'Allow to use the embeded data.db'),
						new GenericTag('todo', 'Allow to use the embeded notes'),
						new GenericTag('todo', 'Allow to use the embeded images'),
						new GenericTag('FIXME', 'Check ZipArchive extension loaded'),
						new GenericTag('version', '$Rev:$'),
						new GenericTag('license', 'New BSD'),
				])
			)
			->addProperties([
				(new PropertyGenerator('doc', Null, PropertyGenerator::FLAG_PUBLIC, TypeGenerator::fromTypeString('?\\'.self::GRT_NAMESPACE.'\\GrtDocument')) ),
				new PropertyGenerator('db', Null, PropertyGenerator::FLAG_PUBLIC, TypeGenerator::fromTypeString('?array')),
				new PropertyGenerator('images', Null, PropertyGenerator::FLAG_PUBLIC, TypeGenerator::fromTypeString('?array')),
				new PropertyGenerator('notes', Null, PropertyGenerator::FLAG_PUBLIC, TypeGenerator::fromTypeString('?array')),
		]);
		$classGenerator->setNamespaceName(self::VENDOR_NAMESPACE);
		$classGenerator->addUse('\\'.self::GRT_NAMESPACE.'\\Document', 'GrtDocument');

		$constructBody  = '$this->db = [];'.PHP_EOL;
		$constructBody .= '$this->images = [];'.PHP_EOL;
		$constructBody .= '$this->notes = [];'.PHP_EOL;
		$constructMethod = new MethodGenerator('__construct', [], MethodGenerator::FLAG_PUBLIC, $constructBody);


		$loadBody  = '$zip = new \ZipArchive();'.PHP_EOL;
		$loadBody .= 'if (true !== $zip->open($filepath)) {'.PHP_EOL;
		$loadBody .= '	throw new \\RuntimeException("Impossible to open file \'$filename\'");'.PHP_EOL;
		$loadBody .= '}'.PHP_EOL;
		$loadBody .= '$mwbDocument = new self();'.PHP_EOL;
		$loadBody .= ''.PHP_EOL;
		$loadBody .= '$mwbDocument->db[self::DATA_DB] = Null;'.PHP_EOL;
		$loadBody .= '$mwbDocument->images[\'icon-service.png\'] = Null;'.PHP_EOL;
		$loadBody .= '$mwbDocument->notes[\'1\'] = \'My note\';'.PHP_EOL;
		$loadBody .= ''.PHP_EOL;
		$loadBody .= '$content = $zip->getFromName(self::DOCUMENT_MWB_XML);'.PHP_EOL;
		$loadBody .= '$zip->close();'.PHP_EOL;
		$loadBody .= ''.PHP_EOL;
		$loadBody .= 'if (false === $content) {'.PHP_EOL;
		$loadBody .= '	throw new \RuntimeException(\'File "document.mwb.xml" not found in *.mwb\');'.PHP_EOL;
		$loadBody .= '}'.PHP_EOL;
		$loadBody .= ''.PHP_EOL;
		$loadBody .= '$mwbDocument->doc = GrtDocument::loadXml($content);'.PHP_EOL;
		$loadBody .= '// TODO: try{}'.PHP_EOL;
		$loadBody .= ''.PHP_EOL;
		$loadBody .= '// TODO: $mwbDocument->db, $mwbDocument->images, $mwbDocument->notes'.PHP_EOL;
		$loadBody .= '$mwbDocument->db[self::DATA_DB] = Null;'.PHP_EOL;
		$loadBody .= '$mwbDocument->images[\'icon-service.png\'] = Null;'.PHP_EOL;
		$loadBody .= '$mwbDocument->notes[\'1\'] = \'My note\';'.PHP_EOL;
		$loadBody .= ''.PHP_EOL;
		$loadBody .= 'return $mwbDocument;'.PHP_EOL;
		$loadMethod = new MethodGenerator('load', ['filepath'], MethodGenerator::FLAG_STATIC|MethodGenerator::FLAG_PUBLIC, $loadBody);

		$classGenerator->addMethods([$constructMethod, $loadMethod]);
		$classGenerator->addConstant('DOCUMENT_MWB_XML', 'document.mwb.xml');
		$classGenerator->addConstant('DATA_DB', 'data.db');

		$fileGenerator = new FileGenerator();
		$fileGenerator->setFilename('MwbDocument.php');
		$fileGenerator->setNamespace(self::VENDOR_NAMESPACE);
		$fileGenerator->setClass($classGenerator);

		
		return $fileGenerator;
	}
}

