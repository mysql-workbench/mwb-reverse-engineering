<?php

declare(strict_types=1);

namespace Mwb\ReverseEngineering\Generation;

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


	public function generateToString($classGenerator)
	{
		$__toStringBody  = '$output  = \'\';'.PHP_EOL;
		//$__toStringBody .= PHP_EOL;
		//$__toStringBody .= '$thisType = gettype($this);'.PHP_EOL;
		//$__toStringBody .= '$thisObject = \'object\' == $thisType ? \'struct-name="\'.get_class($this).\'" \': \'\';'.PHP_EOL;
		$__toStringBody .= PHP_EOL;
		$__toStringBody .= PHP_EOL;
		//$__toStringBody .= '$output .= \'<\'.$thisType.\' \'.$thisObject.\'id="#\'.spl_object_id($this).\'" >\'.PHP_EOL'.PHP_EOL;
		//$__toStringBody .= PHP_EOL;

		foreach ($classGenerator->getProperties() as $property) {
			$strType = $property->getType()->__toString();
			$comType = $strType;
			/*$comType = str_replace('Mwb\\Grt\\', '', $strType);
			$comType = str_replace('\\', '.', $comType);*/

			$__toStringBody .= '$propertyType = gettype($this->'.$property->getName().');'.PHP_EOL;
			$__toStringBody .= '$propertyObject = \'object\' == $propertyType ? \'struct-name="\'.get_class($this->'.$property->getName().').\'" \': \'\';'.PHP_EOL;
			$__toStringBody .= '$propertyId = \'object\' == $propertyType ? \'id="\'.spl_object_id($this->'.$property->getName().').\'" \': \'\';'.PHP_EOL;
			if ('ArrayObject' == $strType) {
				$__toStringBody .= 'if (empty($this->'.$property->getName().')) {'.PHP_EOL;
				$__toStringBody .= '  $output .= \'  <array key="'.$property->getName().'"/>\'.PHP_EOL'.PHP_EOL;
				$__toStringBody .= '} else {'.PHP_EOL;
				$__toStringBody .= '  $output .= \'  <array key="'.$property->getName().'"/>\'.PHP_EOL'.PHP_EOL;
				$__toStringBody .= '  foreach($this->'.$property->getName().' as $'.$property->getName().'_) {'.PHP_EOL;
				// <object>
				$__toStringBody .= '    $output .= $'.$property->getName().'_->__toString();'.PHP_EOL;
				// </object>
				$__toStringBody .= '  }'.PHP_EOL;
				$__toStringBody .= '  $output .= \'  <array key="'.$property->getName().'"/>\'.PHP_EOL'.PHP_EOL;
				$__toStringBody .= '}'.PHP_EOL;
			} else {
				$__toStringBody .= 'if (empty($this->'.$property->getName().')) {'.PHP_EOL;
				$__toStringBody .= '  $output .= \'  <\'.$propertyType.\' \'.$propertyObject.\'id="#NULL" key="'.$property->getName().'"/>\'.PHP_EOL'.PHP_EOL;
				$__toStringBody .= '} else {'.PHP_EOL;
				$__toStringBody .= '  $output .= $this->'.$property->getName().'->__toString();'.PHP_EOL;
				$__toStringBody .= '}'.PHP_EOL;
			}
			$__toStringBody .= PHP_EOL;
			
		}

		//$__toStringBody .= '$output .= \'</\'.$thisType.\'>\'.PHP_EOL'.PHP_EOL;


		/*
		$__toStringBody .= 'if (true !== $zip->open($filepath)) {'.PHP_EOL;
		$__toStringBody .= '	throw new \\RuntimeException("Impossible to open file \'$filename\'");'.PHP_EOL;
		$__toStringBody .= '}'.PHP_EOL;
		$__toStringBody .= '$mwbDocument = new self();'.PHP_EOL;
		$__toStringBody .= ''.PHP_EOL;
		$__toStringBody .= '$mwbDocument->db[self::DATA_DB] = Null;'.PHP_EOL;
		$__toStringBody .= '$mwbDocument->images[\'icon-service.png\'] = Null;'.PHP_EOL;
		$__toStringBody .= '$mwbDocument->notes[\'1\'] = \'My note\';'.PHP_EOL;
		$__toStringBody .= ''.PHP_EOL;
		$__toStringBody .= '$content = $zip->getFromName(self::DOCUMENT_MWB_XML);'.PHP_EOL;
		$__toStringBody .= '$zip->close();'.PHP_EOL;
		$__toStringBody .= ''.PHP_EOL;
		$__toStringBody .= 'if (false === $content) {'.PHP_EOL;
		$__toStringBody .= '	throw new \RuntimeException(\'File "document.mwb.xml" not found in *.mwb\');'.PHP_EOL;
		$__toStringBody .= '}'.PHP_EOL;
		$__toStringBody .= ''.PHP_EOL;
		$__toStringBody .= '$mwbDocument->doc = GrtDocument::loadXml($content);'.PHP_EOL;
		$__toStringBody .= '// TODO: try{}'.PHP_EOL;
		$__toStringBody .= ''.PHP_EOL;
		$__toStringBody .= '// TODO: $mwbDocument->db, $mwbDocument->images, $mwbDocument->notes'.PHP_EOL;
		$__toStringBody .= '$mwbDocument->db[self::DATA_DB] = Null;'.PHP_EOL;
		$__toStringBody .= '$mwbDocument->images[\'icon-service.png\'] = Null;'.PHP_EOL;
		$__toStringBody .= '$mwbDocument->notes[\'1\'] = \'My note\';'.PHP_EOL;
		*/
		$__toStringBody .= ''.PHP_EOL;
		$__toStringBody .= 'return $output;'.PHP_EOL;

		$__toStringMethod = new MethodGenerator('__toString', [], MethodGenerator::FLAG_PUBLIC, $__toStringBody);

		return $__toStringMethod;
	}
}

/*
    public function __toString() {
      $output  = '  <object struct-name="workbench.Document" id="#'.spl_object_id($this).'" >'.PHP_EOL;

      if (!empty($this->logicalModel)) {
        $output .= '    <object struct-name="workbench.logical.Model" id="#'.spl_object_id($this->logicalModel).'" key="logicalModel">'.PHP_EOL;
        //$output .= $this->logicalModel->__toString();
        $output .= '    </object>'.PHP_EOL;
      } else {
        $output .= '    <object struct-name="workbench.logical.Model" id="#NULL" key="logicalModel"/>'.PHP_EOL;
      }

      if (!empty($this->overviewCurrentModelType)) {
        $output .= '    <object struct-name="model.Model" id="#'.spl_object_id($this->overviewCurrentModelType).'" key="overviewCurrentModelType">'.PHP_EOL;
        $output .= $this->overviewCurrentModelType->__toString();
        $output .= '    </object>'.PHP_EOL;
      } else {
        $output .= '    <object struct-name="model.Model" id="#NULL" key="overviewCurrentModelType"/>'.PHP_EOL;
      }

      if (!empty($this->overviewPanels)) {
        $output .= '    <array key="overviewCurrentModelType">'.PHP_EOL;
        //$output .= $this->overviewPanels->__toString();
        $output .= '    </array>'.PHP_EOL;
      } else {
        $output .= '    <array key="overviewCurrentModelType"/>'.PHP_EOL;
      }

      if (!empty($this->physicalModels)) {
        $output .= '    <array key="physicalModels">'.PHP_EOL;
        foreach($this->physicalModels as $this->physicalModel) {
          //$this->physicalModel->__toString();
        }
        $output .= '    </array>'.PHP_EOL;
      } else {
        $output .= '    <array key="physicalModels"/>'.PHP_EOL;
      }

      $output .= '  </object>'.PHP_EOL;
      return $output;
    }
*/

