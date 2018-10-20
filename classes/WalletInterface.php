<?php

interface WalletInterface
{
	public function getBalance();

	public function getTransactions($limit = 40);

	public function makePayment();
}