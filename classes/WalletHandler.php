<?php

class WalletHandler
{
	private static $instance = null;

	public static function get()
	{
		if (is_null(self::$instance))
		{
			self::$instance = new self();
		}
		return self::$instance;
	}

	private function __construct()
	{
		$this->load_wallets();
	}

	private $wallets = array();

	public function getWallets()
	{
		return $this->wallets;
	}

	/**
	 * @param string $id
	 * @return Wallet
	 * @throws WalletHandlerException
	 */
	public function getWalletByID($id)
	{
		if (isset($this->wallets[$id]))
		{
			return $this->wallets[$id];
		}
		throw new WalletHandlerException('Invalid wallet ID provided', WalletHandlerException::INVALID_WALLET_ID);
	}

	private function load_wallets()
	{
		$filename = $_SERVER['DOCUMENT_ROOT'] . '/../../config/wallets.json';
		$config = file_get_contents($filename);
		$config = json_decode($config, true);

		$wallets = $config['wallets'];
		foreach ($wallets as $wallet)
		{
			switch ($wallet['type'])
			{
				case 'bitcoin-core':
					$w = new BitcoinCoreWallet();
					$w->setID($wallet['id']);
					$w->setName($wallet['name']);
					$w->setEndpoint($wallet['endpoint']);
					$this->wallets[$wallet['id']] = $w;
					break;
			}
		}
	}

	/**
	 * @return Wallet[]
	 */
	public static function getAll()
	{
		$instance = self::get();
		return $instance->getWallets();
	}

	/**
	 * @param string $id
	 * @return Wallet
	 * @throws WalletHandlerException
	 */
	public static function getByID($id)
	{
		$instance = self::get();
		return $instance->getWalletByID($id);
	}
}