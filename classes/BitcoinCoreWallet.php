<?php

class BitcoinCoreWallet extends Wallet
{
	const TYPE = 'bitcoin-core';

	/**
	 * @var string
	 */
	private $endpoint = null;

	/**
	 * @param string $endpoint
	 */
	public function setEndpoint($endpoint)
	{
		$this->endpoint = $endpoint;
	}

	/**
	 * @var array
	 */
	private $balances = null;

	/**
	 * @throws BitcoinCoreWalletException
	 */
	private function load_balances()
	{
		if (is_null($this->balances))
		{
			$this->balances = $this->do_curl('getwalletinfo');
		}
	}

	/**
	 * @return float
	 * @throws BitcoinCoreWalletException
	 */
	public function getBalance()
	{
		$this->load_balances();
		return (float) $this->balances['balance'];
	}

	/**
	 * @return float
	 * @throws BitcoinCoreWalletException
	 */
	public function getUnconfirmedBalance()
	{
		$this->load_balances();
		return (float) $this->balances['unconfirmed_balance'];
	}

	/**
	 * @return float
	 * @throws BitcoinCoreWalletException
	 */
	public function getImmatureBalance()
	{
		$this->load_balances();
		return (float) $this->balances['immature_balance'];
	}

	public function getTransactions($limit = 40)
	{
	}

	public function makePayment()
	{
	}

	/**
	 * @param string $method
	 * @param array $params
	 * @return array
	 * @throws BitcoinCoreWalletException
	 */
	private function do_curl($method, $params = array())
	{
		if (is_null($this->endpoint))
		{
			throw new BitcoinCoreWalletException('No endpoint set.', BitcoinCoreWalletException::NO_ENDPOINT_SET);
		}

		$uri = $this->endpoint . '/' . $method;

		$client = new GuzzleHttp\Client();

		$response = (string) $client->get($uri)->getBody();
		$response = json_decode($response, true);

		if ($response['status'] === 'success')
		{
			return $response['result'];
		}

		return array();
	}
}