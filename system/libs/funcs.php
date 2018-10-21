<?php
function GetDrivingDistance($lat1, $lat2, $long1, $long2)
{
    $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=".$lat1.",".$long1."&destinations=".$lat2.",".$long2."&mode=driving&language=pl-PL";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    $response = curl_exec($ch);
    curl_close($ch);
    $response_a = json_decode($response, true);
    $dist = @$response_a['rows'][0]['elements'][0]['distance']['text']?$response_a['rows'][0]['elements'][0]['distance']['text']:'';
    $km = @$response_a['rows'][0]['elements'][0]['distance']['value']?$response_a['rows'][0]['elements'][0]['distance']['value']:0;
    $time = @$response_a['rows'][0]['elements'][0]['duration']['text']?$response_a['rows'][0]['elements'][0]['duration']['text']:'';

    return array('distance' => $dist,'km' => $km, 'time' => $time);
}
function get_coordinates($city, $street, $province)
{
    $address = urlencode($city.','.$street.','.$province);
    $url = "https://maps.google.com/maps/api/geocode/json?address=$address&sensor=false&region=Vietnam&key=".KEYAPI;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    $response = curl_exec($ch);
    curl_close($ch);
    $response_a = json_decode($response);
    //echo '<pre>',print_r($response_a),'<pre>'; exit;
    $status = $response_a->status;

    if ( $status == 'ZERO_RESULTS' )
    {
        return FALSE;
    }
    else
    {
        $return = array('lat' => $response_a->results[0]->geometry->location->lat, 'long' => $long = $response_a->results[0]->geometry->location->lng);
        return $return;
    }
}
function base_url($ref = '')
{
	return BASEURL.$ref;
}

function checkmail($email)
{
	if($email)
	{
		$dt = new database();
		$dt->setQuery('select id,keyapi from apicheckmail where state=1 limit 0,1');
		$key = $dt->loadRow();
		if($key){
			$json = cURL('http://apilayer.net/api/check?access_key='.$key->keyapi.'&email='.trim($email).'&smtp=1&format=1');
			$kq = json_decode($json);
			//print_r($kq);
			if($kq && @$kq->smtp_check)
				return 1;
			else if(@$kq && @$kq->error && @$kq->error->code==104)
			{
				$dt->setQuery('delete from apicheckmail where id=?');
				$dt->execute(array($key->id));
				return checkmail($email);
			}
			return 2;
		}else
			return 3;
	}
	return 2;
}
function cURL($url){
	//echo $url;exit;
	$c = curl_init();
	$user_agents = array(
		"Mozilla/5.0 (Linux; Android 5.0.2; Andromax C46B2G Build/LRX22G) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/37.0.0.0 Mobile Safari/537.36 [FB_IAB/FB4A;FBAV/60.0.0.16.76;]",
		"[FBAN/FB4A;FBAV/35.0.0.48.273;FBDM/{density=1.33125,width=800,height=1205};FBLC/en_US;FBCR/;FBPN/com.facebook.katana;FBDV/Nexus 7;FBSV/4.1.1;FBBK/0;]",
		"Mozilla/5.0 (Linux; Android 5.1.1; SM-N9208 Build/LMY47X) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.81 Mobile Safari/537.36",
		"Mozilla/5.0 (Linux; U; Android 5.0; en-US; ASUS_Z008 Build/LRX21V) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 UCBrowser/10.8.0.718 U3/0.8.0 Mobile Safari/534.30",
		"Mozilla/5.0 (Linux; U; Android 5.1; en-US; E5563 Build/29.1.B.0.101) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 UCBrowser/10.10.0.796 U3/0.8.0 Mobile Safari/534.30",
		"Mozilla/5.0 (Linux; U; Android 4.4.2; en-us; Celkon A406 Build/MocorDroid2.3.5) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1"
	);
	$useragent = $user_agents[array_rand($user_agents)];
	$opts = array(
		CURLOPT_URL => $url,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_SSL_VERIFYPEER => false,
		CURLOPT_USERAGENT => $useragent
	);	
	curl_setopt_array($c, $opts);
	$d = curl_exec($c);
	curl_close($c);
	return $d;
}
function getKey()
{
	$pass_phrase = KEYECTYE;
	$master_key = hash('sha256', $pass_phrase);
	return $master_key;
}
function redirect($url,$time=0)
{
	$time=$time*1000;
	echo '<script>setTimeout(function(){window.location.href="'.BASEURL.$url.'"},'.$time.')</script>';
	die('<div class="wap"><div style="text-align:center; padding: 20px 0; font-size: 14px;">Đang chuyển hướng...<br> <img src="'.BASEURL.'layout/images/loading.gif"/></div></div>');
}
function showmsg($msg,$type)
{
	echo '<script>showMessage("'.$msg.'","'.$type.'");</script>';
}
function varray($ar,$e=false)
{
	echo '<pre>',print_r($ar),'</pre>';if($e) exit;
}
function checklogin()
{
	//echo '<pre>',print_r($_SESSION),'</pre>';
	if(isset($_SESSION['login'.SALT]) && $_SESSION['login'.SALT] ==true 
	&& isset($_SESSION['me']) && $_SESSION['me'])
	{
		return true;
	}
	return false;
}

function isadmin()
{
	//echo '<pre>',print_r($_SESSION),'</pre>';
	if(isset($_SESSION['login'.SALT]) && $_SESSION['login'.SALT] ==true 
	&& isset($_SESSION['me'],$_SESSION['me']['permiss']) && $_SESSION['me'] && $_SESSION['me']['permiss']==1)
	{
		return true;
	}
	return false;
}
function checkpermiss()
{
	$cr = new xl_roles();
	$listrole = $cr->roles($_SESSION['me']['id']);
	//echo '<pre>',print_r($listrole),'</pre>',$_GET['v'];exit;
	if($listrole){
		foreach($listrole as $r)
		{
			$v =@$r->link?explode('?v=',$r->link):null;
			if(@$v && @$v[1] && $v[1]==@$_GET['v'])
			{
				return true;
			}
		}
		return false;
	}else return false;
}
function checkadmin()
{
	//echo '<pre>',print_r($_SESSION),'</pre>';
	if(isset($_SESSION['loginadmin'.SALT]) && $_SESSION['loginadmin'.SALT] ==true 
	&& isset($_SESSION['admin']) && $_SESSION['admin'])
	{
		return true;
	}
	return false;
}
// Code mã hóa

function encode($encrypt, $key='') {
	$key =(!empty($key))?$key:getKey();
    $encrypt = serialize($encrypt);
    $iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC), MCRYPT_DEV_URANDOM);
    $key = pack('H*', $key);
    $mac = hash_hmac('sha256', $encrypt, substr(bin2hex($key), -32));
    $passcrypt = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $encrypt . $mac, MCRYPT_MODE_CBC, $iv);
    $encoded = base64_encode($passcrypt) . '|' . base64_encode($iv);
    return $encoded;
}

// Code giải mã

function decode($decrypt, $key='') {
	$key =(!empty($key))?$key:getKey();
    $decrypt = explode('|', $decrypt);
    $decoded = base64_decode($decrypt[0]);
    $iv = base64_decode($decrypt[1]);
    if (strlen($iv) !== mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC)) {
        return false;
    }
    $key = pack('H*', $key);
    $decrypted = trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, $decoded, MCRYPT_MODE_CBC, $iv));
    $mac = substr($decrypted, -64);
    $decrypted = substr($decrypted, 0, -64);
    $calcmac = hash_hmac('sha256', $decrypted, substr(bin2hex($key), -32));
    if ($calcmac !== $mac) {
        return false;
    }
    $decrypted = unserialize($decrypted);
    return $decrypted;
}
function array_trim($array)
{
	$func = function($value){
		return trim($value);
	};
	return array_map($func, $array);
}


function convertVNDtoUSD($money)
{
	if(is_numeric($money)&& $money>0)
	{
		$link = 'http://www.vietcombank.com.vn/ExchangeRates/ExrateXML.aspx';
		$data = simplexml_load_file($link);
		$uniprice = 0;
		foreach($data->Exrate as $obj)
		{
			 if(isset($obj['CurrencyCode']) && $obj['CurrencyCode'] =='USD')
			 {
				$uniprice =round($money/$obj['Transfer'],2);
				break;
			 }
		}
		return $uniprice;

	}else
		return false;
}
function convertUSDtoVND($money)
{
	if(is_numeric($money)&& $money>0)
	{
		$link = 'http://www.vietcombank.com.vn/ExchangeRates/ExrateXML.aspx';
		$data = simplexml_load_file($link);
		$uniprice = 0;
		foreach($data->Exrate as $obj)
		{
			 if(isset($obj['CurrencyCode']) && $obj['CurrencyCode'] =='USD')
			 {
				$uniprice =round($money*$obj['Transfer'],0);
				break;
			 }
		}
		return $uniprice;

	}else
		return false;
}
function clearwithoutlogin()
{
	if(isset($_SESSION))
	{
		//varray($_SESSION);
		foreach($_SESSION as $k=>$item)
		{
			//echo $k,'<br>';
			if($k!='login'.SALT && $k!='me' && $k!='pack' )
				unset($_SESSION[$k]);
		}
		//varray($_SESSION,true);
	}
}

function cutstring($str,$len)
{
	$str = trim($str);
	$n = strlen($str);
	if($len<$n)
	{
		$str = substr($str,0,$len);
		$p = strrpos($str,' ');
		$str = substr($str,0,$p);
		return $str.'[...]';
	}else
		return $str;
}
function readmoney($amount)
{
         if($amount <=0)
        {
            return $textnumber="Tiền phải là số nguyên dương lớn hơn số 0";
        }
        $Text=array("không", "một", "hai", "ba", "bốn", "năm", "sáu", "bảy", "tám", "chín");
        $TextLuythua =array("","nghìn", "triệu", "tỷ", "ngàn tỷ", "triệu tỷ", "tỷ tỷ");
        $textnumber = "";
        $length = strlen($amount);
        
        for ($i = 0; $i < $length; $i++)
        $unread[$i] = 0;
        
        for ($i = 0; $i < $length; $i++)
        {               
            $so = substr($amount, $length - $i -1 , 1);                
            
            if ( ($so == 0) && ($i % 3 == 0) && ($unread[$i] == 0)){
                for ($j = $i+1 ; $j < $length ; $j ++)
                {
                    $so1 = substr($amount,$length - $j -1, 1);
                    if ($so1 != 0)
                        break;
                }                       
                       
                if (intval(($j - $i )/3) > 0){
                    for ($k = $i ; $k <intval(($j-$i)/3)*3 + $i; $k++)
                        $unread[$k] =1;
                }
            }
        }
        
        for ($i = 0; $i < $length; $i++)
        {        
            $so = substr($amount,$length - $i -1, 1);       
            if ($unread[$i] ==1)
            continue;
            
            if ( ($i% 3 == 0) && ($i > 0))
            $textnumber = $TextLuythua[$i/3] ." ". $textnumber;     
            
            if ($i % 3 == 2 )
            $textnumber = 'trăm ' . $textnumber;
            
            if ($i % 3 == 1)
            $textnumber = 'mươi ' . $textnumber;
            
            
            $textnumber = $Text[$so] ." ". $textnumber;
        }
        
        //Phai de cac ham replace theo dung thu tu nhu the nay
        $textnumber = str_replace("không mươi", "lẻ", $textnumber);
        $textnumber = str_replace("lẻ không", "", $textnumber);
        $textnumber = str_replace("mươi không", "mươi", $textnumber);
        $textnumber = str_replace("một mươi", "mười", $textnumber);
        $textnumber = str_replace("mươi năm", "mươi lăm", $textnumber);
        $textnumber = str_replace("mươi một", "mươi mốt", $textnumber);
        $textnumber = str_replace("mười năm", "mười lăm", $textnumber);
        
        return ucfirst($textnumber." đồng chẵn");
}
?>