<?php

class APIModule
{
	const METHOD_GET_WALLETS = 'getWallets';
	const METHOD_GET_WALLET = 'getWallet';

	/**
	 * @return array
	 */
	public static function getWallets()
	{
		$output = array();

		$wallets = WalletHandler::getAll();
		foreach ($wallets as $wallet)
		{
			$cur_wallet = array();
			$cur_wallet['id'] = $wallet->getID();
			$cur_wallet['name'] = $wallet->getName();
			$cur_wallet['type'] = $wallet->setType();
			$output['wallets'][] = $cur_wallet;
		}

		return $output;
	}


	public static function getWallet($id)
	{
		$output = array();
		$wallet = WalletHandler::getByID($id);
		return $output;
	}
}