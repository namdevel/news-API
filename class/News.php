<?php 

class News
{
	protected $imei;
	protected $secret;
	public function __construct(){
		$this->imei = md5(time());
		$this->secret = md5(time());
	}
	
	protected function Request($url, $post = false, $headers = false)
    {
        $ch = curl_init();

        curl_setopt_array($ch,array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true
			)
        );

        if ($post) {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        }
		
        if ($headers) {
			$headers = array(
			'Host: baca.co.id',
			'X-Imsi: eea017bcdefe4b92bf539448b1146341',
			'User-Agent: Baca/1.8.8 (iPhone; iOS 13.3.1; Scale/3.00)',
			'X-App-Name: baca',
			'X-Device-Type: iPhone11,6',
			'X-TimeZone: Asia/Jakarta',
			'X-Os-Version: 13.3.1',
			'X-Device-Platform: iOS',
			'Accept-Language: id-ID;q=1, en-ID;q=0.9',
			'X-Secret: 6ee6d064e69ce5b757975773940bc872',
			'X-User-Id: 80185721e1d9d1e7200dd396b0719960',
			'Accept: */*',
			'X-Imei: eea017bcdefe4b92bf539448b1146341',
			'Connection: keep-alive'
			);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }

        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }
	
	public function search($keyword){
		return self::Request('http://baca.co.id/api/v1/search?keyword='.$keyword.'&type=-1', false, true);
	}
	
	public function getLastesNews(){
		return self::Request('http://baca.co.id/api/v1/News?categoryId=-1', false, true);
	}
	
}