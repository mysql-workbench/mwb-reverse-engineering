<?php

use Laminas\Code\Generator\PropertyGenerator;
use Laminas\Code\Generator\TypeGenerator;

class GrtPropertyGenerator extends PropertyGenerator
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


