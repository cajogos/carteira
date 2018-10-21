<?php

use Cajogos\Biscuit\Controller as Controller;

class APIController extends Controller
{
	private $result = array();

	public static function handleGet($method = null)
	{
		$controller = new self();
		switch ($method)
		{
			case APIModule::METHOD_GET_WALLETS:
				$controller->method_get_wallets();
				break;
			case APIModule::METHOD_GET_WALLET:
				$controller->method_get_wallet();
				break;
		}
		$controller->display_error(self::ERROR_INVALID_METHOD);
	}

	public static function handlePost($method = null)
	{
		$controller = new self();
		$controller->display_error(self::ERROR_INVALID_METHOD);
	}

	private function method_get_wallets()
	{
		$this->result = APIModule::getWallets();
		$this->display_result();
	}

	private function method_get_wallet()
	{
		$id = Request::getGetVariable('id');
		$id = trim($id);
		try
		{
			$this->result = APIModule::getWallet($id);
			$this->display_result();
		}
		catch (WalletHandlerException $e)
		{
			switch ($e->getCode())
			{
				case WalletHandlerException::INVALID_WALLET_ID:
					$this->display_error(self::ERROR_INVALID_WALLET_ID);
					break;
			}
			$this->display_error(self::ERROR_EXCEPTION);
		}
	}

	private function display_result($status = 'success')
	{
		header('Content-type: application/json');
		$output = array();
		$output['status'] = $status;
		$output['result'] = $this->result;
		echo json_encode($output);
		exit;
	}

	const ERROR_EXCEPTION = 501;
	const ERROR_INVALID_METHOD = 502;
	const ERROR_INVALID_WALLET_ID = 503;
	private function display_error($error_code)
	{
		$error_message = 'Unknown error occurred.';
		switch ($error_code)
		{
			case self::ERROR_EXCEPTION:
				$error_message = 'An exception has occurred.';
				break;
			case self::ERROR_INVALID_METHOD:
				$error_message = 'Invalid method provided.';
				break;
			case self::ERROR_INVALID_WALLET_ID:
				$error_message = 'Invalid wallet ID provided.';
				break;
		}
		$this->result = array(
			'error_code' => $error_code,
			'error_message' => $error_message
		);
		$this->display_result(false);
	}
}