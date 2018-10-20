<?php

abstract class Wallet implements WalletInterface
{
	const TYPE = 'general';

	protected $id = null;

	public function getID()
	{
		return $this->id;
	}

	public function setID($id)
	{
		$this->id = $id;
	}

	protected $name = null;

	public function getName()
	{
		return $this->name;
	}

	public function setName($name)
	{
		$this->name = $name;
	}

	public function setType()
	{
		return static::TYPE;
	}
}