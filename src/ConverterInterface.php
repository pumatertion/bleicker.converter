<?php
namespace Bleicker\Converter;

use Bleicker\Converter\TypeConverter\TypeConverterInterface;

/**
 * Class Converter
 *
 * @package Bleicker\Converter
 */
interface ConverterInterface {

	const STRING = 'string', INTEGER = 'integer', INT = 'int', FLOAT = 'float', DOUBLE = 'double', BOOLEAN = 'boolean', BOOL = 'boolean';

	/**
	 * @param mixed $source
	 * @param string $targetType
	 * @return mixed
	 */
	public static function convert($source = NULL, $targetType);

	/**
	 * @param string $alias
	 * @param TypeConverterInterface $typeConverter
	 * @return void
	 */
	public static function register($alias, TypeConverterInterface $typeConverter);

	/**
	 * @param string $alias
	 * @return void
	 */
	public static function unregister($alias);

	/**
	 * @param string $alias
	 * @return TypeConverterInterface|NULL
	 */
	public static function get($alias);

	/**
	 * @return void
	 */
	public static function prune();
}