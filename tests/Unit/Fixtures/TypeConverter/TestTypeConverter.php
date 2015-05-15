<?php

namespace Tests\Bleicker\Converter\Unit\Fixtures\TypeConverter;

use Bleicker\Converter\AbstractTypeConverter;

/**
 * Class TestTypeConverter
 *
 * @package Tests\Bleicker\Converter\Unit\Fixtures\TypeConverter
 */
class TestTypeConverter extends AbstractTypeConverter {

	/**
	 * @var string
	 */
	public $foo;

	/**
	 * @param integer $priority
	 * @param string $foo
	 */
	public function __construct($priority, $foo = 'bar') {
		parent::__construct($priority);
		$this->foo = $foo;
	}

	/**
	 * @param mixed $source
	 * @param string $targetType
	 * @return boolean
	 */
	public static function canConvert($source = NULL, $targetType) {
		return TRUE;
	}

	/**
	 * @param integer $source
	 * @return string
	 */
	public function convert($source) {
		return 'converted';
	}
}
