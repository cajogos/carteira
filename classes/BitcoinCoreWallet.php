<?php

class BitcoinCoreWallet extends Wallet
{
	const TYPE = 'bitcoin-core';

	private $endpoint = null;
	public function setEndpoint($endpoint)
	{
		$this->endpoint = $endpoint;
	}

	public function getBalance()
	{
		// TODO: Implement getBalance() method.
	}

	public function getTransactions($limit = 40)
	{
		// TODO: Implement getTransactions() method.
	}

	public function makePayment()
	{
		// TODO: Implement makePayment() method.
	}
}