<?php

declare(strict_types=1);

namespace Mwb\ReverseEngineering;

require_once __DIR__.'/../vendor/autoload.php';

use Mwb\ReverseEngineering\Introspection\GrtIntrospector;

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

$data_dir = dirname(__DIR__, 1).'/data/6.3'; // structs.db.h.php
$out_dir = dirname(__DIR__, 1).'/tmp/6.3/vendor/' . GrtGenerator::GRT_DIR;
var_dump(realpath($data_dir));
var_dump(realpath($out_dir));

$introspector = new GrtIntrospector($data_dir);
//$introspector->inspectAllTypes();
//$introspector->inspectAllObjects($data_dir, $structFilenames);

$introspector->introspect($structFilenames);
$introspector->generate($out_dir);


/*
$generator = new GrtGenerator();
$generator->reflectionAllTypes($data_dir, $structFilenames);

//print_r($this->mapTypes);
//print_r($this->qfnTypes);

$generator->reflectionAllObjects($data_dir, $structFilenames);
*/


/*
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
*/

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

