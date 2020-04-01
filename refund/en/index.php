<?php
//========================================
$titles = 'Refund';
$m = 3;
//-------------------------------
include('../../header2.php');
echo "<div class='cat_content' style='text-align: left; float: none;'>";
//-------------------------------
$node_key = 'Mp999d3789d40ff0c699f861758bcafde15d3b4828c7518bc94810837688888888';
$from = 'en';
$name = 'Enlightenment node';
$comm = 7;

echo "<title>MinterCat | $name</title>";

$status = file_get_contents('https://explorer-api.minter.network/api/v1/status-page');
$statuspayload = json_decode($status,true);
$totalDelegatedBip = $statuspayload['data']['totalDelegatedBip'];
$numberOfBlocks = $statuspayload['data']['numberOfBlocks'];

class Reward extends SQLite3
{
    function __construct()
    {
        $this->open('../../../config/refund/en.sqlite');
    }
}

$db = new Reward();
$result = $db->query('SELECT * FROM "'.$from.'"');
$data = $result->fetchArray();

$block_r = $data['numberOfBlocks'];
$block_reward = $block_r + 17280;

        echo "<h1>$name</h1><h4>$node_key</h4>
		REFUND has already been paid in block <a href='https://minterscan.net/block/$block_r' target='_blank'>$block_r</a> <br><br>
The current block $numberOfBlocks <br><br>
		The next REFUND will be paid after block $block_reward<br><br>";
		
        $block = file_get_contents('https://explorer-api.minter.network/api/v1/blocks');
		$blockpayload = json_decode($block,true);
		$blockReward = $blockpayload['data'][0]['reward'];

		$commision = 1 - ($comm/100);//commision(0..1) - комиссия валидатора

		$delegators = file_get_contents("https://minterscan.pro/validators/$node_key/delegators?coin=MINTERCAT");
		$delegatorspayload = json_decode($delegators,true);

		$count = count($delegatorspayload)-1;

		$will_get = JSON('https://api.mintercat.com/coin')->estimateCoinBuy;

			echo "
				-------------------------------
				<br>
				Block Reward: $blockReward BIP<br>
				Commision node: $comm% <br>
				Total Delegated Bip: $totalDelegatedBip BIP<br>
				1 BIP = $will_get MINTERCAT<br>
				-------------------------------
				<br>
				";

		$tx_reward = array();
$a = 0;
		for($i = 0; $i <= $count; $i++) 
			{
				$address = $delegatorspayload[$i]['address'];
				if (($address != 'Mx836a597ef7e869058ecbcc124fae29cd3e2b4444') and ($address != 'Mxaa9a68f11241eb18deff762eac316e2ccac22a03')) 
					{ $a+=1;
					    $mc_value = $delegatorspayload[$i]['value'];
						$bip_value = $delegatorspayload[$i]['bip_value'];
						$reward = $blockReward*17280*0.8*$bip_value*$commision/$totalDelegatedBip;
						$comm_node = ($blockReward*17280*0.8*$bip_value*1/$totalDelegatedBip)-$reward;
						$value = $will_get*$comm_node;
						
						$json_profile = file_get_contents("https://minterscan.pro/profiles/$address");
						$profile = json_decode($json_profile,true);
						$title = $profile['title'];
						
						if ($title == '') {$title = $address;}
						
						echo "<br>$a)
								Address:  <a href='https://minterscan.net/address/$address' target='_blank'>$title</a><br>
								Delegated: $mc_value MINTERCAT<br>
								Bip value: $bip_value BIP<br>
								Reward: $reward BIP<br>
								Commision node: $comm_node BIP<br>
								Refund: $value MINTERCAT
								<br><br>
						";
					}
			}
//-------------------------------
echo '</div>';
include('../../footer.php');