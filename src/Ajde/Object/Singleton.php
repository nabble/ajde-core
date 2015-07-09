<?php


namespace Ajde\Object;

use Ajde\Object\Magic;
use Ajde_Object_Singleton_Interface;



interface Ajde_Object_Singleton_Interface
{
	/**
	 * Example:
	 *
	 * public static function getInstance()
	 * {
     *    static $instance;
     *    return $instance === null ? $instance = new self : $instance;
	 * }
	 *
	 * @abstract
	 */
    public static function getInstance();
}

abstract class Singleton extends Magic
implements Ajde_Object_Singleton_Interface
{
	protected static $__pattern = self::OBJECT_PATTERN_SINGLETON;

	public static function __getPattern()
	{
		return self::$__pattern;
	}

	// Do not allow an explicit call of the constructor
    protected function __construct() {}

	// Do not allow the clone operation
    private final function __clone() {}
}

