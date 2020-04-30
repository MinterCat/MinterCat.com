<?php
// $db_cats = new dbCats();
class dbCats extends SQLite3
{
    function __construct()
    {
        $this->open(explode('public_html', $_SERVER['DOCUMENT_ROOT'])[0] . 'config/cats.sqlite');
    }
}
// $db_rss = new RSS();
class RSS extends SQLite3
{
    function __construct()
    {
        $this->open(explode('public_html', $_SERVER['DOCUMENT_ROOT'])[0] . 'config/rss.sqlite');
    }
}
// $db_gen = new dbGen();
class dbGen extends SQLite3
{
    function __construct()
    {
        $this->open(explode('public_html', $_SERVER['DOCUMENT_ROOT'])[0] . 'config/gen.sqlite');
    }
}
// $db_users = new Users();
class Users extends SQLite3
{
    function __construct()
    {
        $this->open(explode('public_html', $_SERVER['DOCUMENT_ROOT'])[0] . 'config/users.sqlite');
    }
}
// $db_api = new db_api();
class db_api extends SQLite3
{
    function __construct()
    {
        $this->open(explode('public_html', $_SERVER['DOCUMENT_ROOT'])[0] . 'config/api.sqlite');
    }
}
function TransactionSend($api,$address,$privat_key,$chainId,$gasCoin,$text,$tx_array)
{
	$api = new MinterAPI($api);
	if ($chainId == 1) 
		{
			$tx = new MinterTx([
				'nonce' => $api->getNonce($address),
				'chainId' => MinterTx::MAINNET_CHAIN_ID,
				'gasPrice' => 1,
				'gasCoin' => $gasCoin,
				'type' => MinterMultiSendTx::TYPE,
				'data' => [
					'list' => $tx_array
				],
				'payload' => $text,
				'serviceData' => '',
				'signatureType' => MinterTx::SIGNATURE_SINGLE_TYPE
			]);
		} 
	else 
		{
			$tx = new MinterTx([
				'nonce' => $api->getNonce($address),
				'chainId' => MinterTx::TESTNET_CHAIN_ID,
				'gasPrice' => 1,
				'gasCoin' => $gasCoin,
				'type' => MinterMultiSendTx::TYPE,
				'data' => [
					'list' => $tx_array
				],
				'payload' => $text,
				'serviceData' => '',
				'signatureType' => MinterTx::SIGNATURE_SINGLE_TYPE
			]);
		}
	$transaction = $tx->sign($privat_key);
	return $api->send($transaction)->result;
}