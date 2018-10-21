<?php

abstract class Wallet implements WalletInterface
{
	const TYPE = 'general';

	/**
	 * @return string
	 */
	public function getType()
	{
		return static::TYPE;
	}

	/**
	 * @var string
	 */
	protected $id = null;

	/**
	 * @return string
	 */
	public function getID()
	{
		return $this->id;
	}

	/**
	 * @param string $id
	 */
	public function setID($id)
	{
		$this->id = $id;
	}

	/**
	 * @var string
	 */
	protected $name = null;

	/**
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * @param string $name
	 */
	public function setName($name)
	{
		$this->name = $name;
	}
}