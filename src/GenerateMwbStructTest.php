<?php

declare(strict_types=1);


// see: /media/dev/f469ac5d-3835-410f-8d8d-de22f0960e301/dev/Téléchargements/mysql-workbench-8.0/generated/grts/structs.db.mysql.h
// grep "class  db_mysql_"

// /media/dev/f469ac5d-3835-410f-8d8d-de22f0960e301/dev/Téléchargements/mysql-workbench-8.0/generated/grts/structs.db.h
// grep "class GRT_STRUCTS_DB_PUBLIC"

// ex : "class GRT_STRUCTS_DB_PUBLIC db_ForeignKey : public GrtNamedObject {"

/**


vendor/
  laminas/
    laminas-form/
      src/
        Element.php , namespace Laminas\Form;


vendor/
  + mysql-workbench/
      + mwb-skeleton/
      + mwb-automatos/
      + mwb-automatos-laminas/
      + mwb-automatos-synfony/
      + mwb-automatos-laravel/
      + mwb-strategist/
      + mwb-strategist-doctrine/
      + mwb-strategist-gateway/
      + mwb-dom/
      + src/
        + Document.php , namespace Mwb\Dom;
          use Mwb\Dom\Document as MwbDocument;

        + GrtObject.php , namespace Mwb\Dom;
        + GrtVersion.php
        + GrtNamedObject.php
        + GrtLogObject.php
        + GrtLogEntry.php
        + GrtMessage.php
        + Grt/
           + App/
           + Eer/
           + Meta/
           + Model/
           + Ui/
           + Db/
              + Sybase/
              + Mssql/
              + Mysql/
                 + Table.php , namespace Mwb\Dom\Grt\Db\Mysql;

*/


namespace ClassTest;


use Laminas\Code\Generator\FileGenerator;
use Laminas\Code\Generator\ClassGenerator;
use Laminas\Code\Generator\PropertyGenerator;
use Laminas\Code\Generator\MethodGenerator;
use Laminas\Code\Generator\TypeGenerator;
use Laminas\Code\Generator\TypeGenerator\AtomicType;
use Laminas\Code\Generator\DocBlockGenerator;
use Laminas\Code\Generator\DocBlock\Tag\GenericTag;

use Laminas\Stdlib\ArrayUtils;

use PHPUnit\Framework\TestCase;


class PropertyRelativeGenerator extends PropertyGenerator
{
    protected $fileGenerator;
    protected $hack_type;

    /**
     * @param  PropertyValueGenerator|string|array|null  $defaultValue
     * @param  int|int[]                                 $flags
     */
    public function __construct(
        string $name,
        $defaultValue,
        $flags,
        fileGenerator $fileGenerator,
        string $hack_type,
        TypeGenerator $type,
    ) {
        parent::__construct($name, $defaultValue, $flags, $type);
	$this->fileGenerator = $fileGenerator;
	$this->hack_type = $hack_type;
    }


    /**
     * @return string
     * @psalm-return non-empty-string
     * @throws Exception\RuntimeException
     */
    public function generate()
    {
        $name         = $this->getName();
        $defaultValue = $this->getDefaultValue();

        $output = '';

        if (($docBlock = $this->getDocBlock()) !== null) {
            $docBlock->setIndentation('    ');
            $output .= $docBlock->generate();
        }

        if ($this->isConst()) {
            if ($defaultValue !== null && ! $defaultValue->isValidConstantType()) {
                throw new Exception\RuntimeException(sprintf(
                    'The property %s is said to be '
                    . 'constant but does not have a valid constant value.',
                    $this->name
                ));
            }

            return $output
                   . $this->indentation
                   . ($this->isFinal() ? 'final ' : '')
                   . $this->getVisibility()
                   . ' const '
                   . $name . ' = '
                   . ($defaultValue !== null ? $defaultValue->generate() : 'null;');
        }

        $hack_type    = $this->type->generate();
	$type = $this->type;
	$namespace = $this->fileGenerator->getClass()->getNamespaceName();//getClass();
	$uses = $this->fileGenerator->getClass()->getUses();
	foreach ($uses as $use) {
		if ('\\' == substr($use, 0, 1))  {
		} else {
			$str_type = ''.$type;// no '?'
			$nullable_type = '?' == substr($hack_type, 0, 1) ? '?' : '';
			$FQN = $namespace . '\\' . $use;
			if ($FQN == $str_type) {
				//echo $namespace . '\\' . $use . ' == ' . $str_type . PHP_EOL;
				$hack_type = $nullable_type . $this->hack_type;
			}
		}
	}

        $output .= $this->indentation
                   . $this->getVisibility()
                   . ($this->isReadonly() ? ' readonly' : '')
                   . ($this->isStatic() ? ' static' : '')
                   . ($hack_type ? ' ' . $hack_type : '')
                   . ' $' . $name;

        /*if ($this->omitDefaultValue) {
            return $output . ';';
        }*/

        return $output . ' = ' . ($defaultValue !== null ? $defaultValue->generate() : 'null;');
    }
}


class ReflectionType {
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
class GenerateMwbStructTest extends TestCase {

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
			$this->mapTypes[$key] = new ReflectionType($key);

			foreach ($value['properties'] as $name => $type) {
				$this->mapTypes[$type] = new ReflectionType($type);
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

	public function testGenerate(): void
	{
		$structFilenames = [
			'structs.app.h.php',
			'structs.db.h.php',
			'structs.db.mgmt.h.php',
			'structs.db.migration.h.php',
			'structs.db.mssql.h.php',
			'structs.db.mysql.h.php',
			'structs.db.query.h.php',
			'structs.db.sybase.h.php',
			'structs.eer.h.php',
			'structs.h.php',
			'structs.meta.h.php',
			'structs.model.h.php',
			'structs.ui.h.php',
			'structs.workbench.h.php',
			'structs.workbench.logical.h.php',
			'structs.workbench.model.h.php',
			'structs.workbench.model.reporting.h.php',
			'structs.workbench.physical.h.php',
		];

		$data_dir = dirname(__DIR__, 4).'/gen_grt_format/data/generated/6.3'; // structs.db.h.php
		$out_dir = dirname(__DIR__, 4).'/gen_grt_format/data/tmp/6.3/vendor/' . self::GRT_DIR;
		$this->reflectionAllTypes($data_dir, $structFilenames);

		//print_r($this->mapTypes);
		//print_r($this->qfnTypes);

		$this->reflectionAllObjects($data_dir, $structFilenames);
		$whiteList = ['GrtLogEntry', 'GrtLogObject', 'GrtMessage', 'GrtNamedObject', 'GrtObject', 'GrtStoredNote', 'GrtVersion'];
		foreach($this->reflectionFiles as $key => $reflectionFile) {

			//if (!in_array($key, $whiteList)) continue;
			$filepath = $out_dir.'/'.$reflectionFile->getFilename();
			$path = dirname($filepath);
			`mkdir -pv $path`;
			`touch $filepath`;
			echo " + \e[31m".$filepath."\e[0m".PHP_EOL;
			file_put_contents($filepath, $reflectionFile->generate());
		}

		echo "TODO: Mwb\Document.php \n";
/*
		$mwbGenerator = $this->reflectionMwb();
		$filepath = $out_dir.'/'.str_replace('\\', '/', self::MWB_NAMESPACE).'/'.$mwbGenerator->getFilename();
		echo " + \e[31m".$filepath."\e[0m".PHP_EOL;
		file_put_contents($filepath, $mwbGenerator->generate());

		$grtGenerator = $this->reflectionGrt();
		$filepath = $out_dir.'/'.str_replace('\\', '/', self::GRT_NAMESPACE).'/'.$grtGenerator->getFilename();
		echo " + \e[31m".$filepath."\e[0m".PHP_EOL;
		file_put_contents($filepath, $grtGenerator->generate());
*/
		echo "TODO: Move ./Grt/GrtObject.php to ./GrtObject.php \n";
		echo "TODO: Rename GrtVersion.php to /Version.php \n";
		// $ find . -name "*.php" -exec sed -i "s/Grt\\\\GrtVersion/Grt\\\\Version/g" {} +
		// $ find . -name "*.php" -exec sed -i "s/Grt\\\\GrtNamedObject/Grt\\\\NamedObject/g" {} +
		// $ find . -name "*.php" -exec sed -i "s/Grt\\\\GrtStoredNote/Grt\\\\StoredNote/g" {} +

		// find . -name "*.php" -exec sed -i "s/Grt\\\\Model\\\\Object/Grt\\\\Model_Object/g" {} +

/*
Grt/Version.php
Grt/NamedObject.php

Grt/LogEntry.php
Grt/LogObject.php
Grt/Message.php
Grt/StoredNote.php


Grt/Model_Object.php

*/

		echo "TODO: fix extends of GrtObject.php\n";
		// grep -r "GrtObject"
		// $ find . -name "*.php" -exec sed -i "s/\\\\Mwb\\\\Grt\\\\GrtObject/\\\\Mwb\\\\GrtObject/g" {} +
		// grep -r "GrtObject"		
	}
}

