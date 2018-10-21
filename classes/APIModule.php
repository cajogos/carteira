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
			$cur_wallet['type'] = $wallet->getType();
			$output['wallets'][] = $cur_wallet;
		}

		return $output;
	}

	/**
	 * @param string $id
	 * @return array
	 * @throws WalletHandlerException
	 */
	public static function getWallet($id)
	{
		$output = array();
		$wallet = WalletHandler::getByID($id);
		$output['id'] = $wallet->getID();
		$output['type'] = $wallet->getType();
		$output['name'] = $wallet->getName();
		$balances = array(
			'balance' => $wallet->getBalance(),
			'unconfirmed' => $wallet->getUnconfirmedBalance(),
			'immature' => $wallet->getImmatureBalance()
		);
		$output['balances'] = $balances;
		return $output;
	}
}