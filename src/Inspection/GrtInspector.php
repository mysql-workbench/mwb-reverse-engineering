<?php

declare(strict_types=1);

namespace Mwb\ReverseEngineering\Inspection;

class GrtInspector
{
	protected $data_dir;

	public function __construct($data_dir) {
		$this->data_dir = $data_dir;
	}

	public function inspect()
	{
	}
}

