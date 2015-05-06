<?php
namespace Bleicker\Converter;

/**
 * Class Converter
 *
 * @package Bleicker\Converter
 */
interface ConverterInterface {

	/**
	 * @param string $alias
	 * @return boolean
	 */
	public static function has($alias);

	/**
	 * @param string $alias
	 * @param TypeConverterInterface $data
	 * @return static
	 */
	public static function add($alias, $data);

	/**
	 * @return static
	 */
	public static function prune();

	/**
	 * @param string $alias
	 * @return TypeConverterInterface
	 */
	public static function get($alias);

	/**
	 * @param string $alias
	 * @return static
	 */
	public static function remove($alias);
}