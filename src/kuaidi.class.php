<?php 
	//688624242254 shunfeng
	class Kuaidi {
		//para
		static $ch = null;
		var $number = 0;
		var $comCode = array();

		//const
		const UA = 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:41.0) Gecko/20100101 Firefox/41.0';
		const HOST = 'www.kuaidi100.com';
		const REFER = 'http://www.kuaidi100.com/';

		//function construct & destruct
		function __construct($num) {
			$this->number = $num;
			$this->create_obj();
		} 

		function __destruct() {
			$this->destroy_obj();
		}

		private function create_obj() {
			if(self::$ch == null) {
				self::$ch = curl_init();
				$host = array("Host: ".self::HOST);
				curl_setopt_array(self::$ch, array(
					//debug start
					//debug end
					CURLOPT_RETURNTRANSFER => 1,
					CURLOPT_FOLLOWLOCATION => 1,
					CURLOPT_USERAGENT => self::UA,
					CURLOPT_REFERER => self::REFER,
					CURLOPT_HTTPHEADER => $host
				));
			}
		}

		private function destroy_obj() {
			curl_close(self::$ch);
			self::$ch = null;
		}

		//functions
		//
		//Choose company
		public function query_com() {
			curl_setopt_array(self::$ch, array(
				CURLOPT_URL => 'http://www.kuaidi100.com/autonumber/autoComNum?text='.$this->number ,
				CURLOPT_POST => 1
			));
			$response = curl_exec(self::$ch);
			$response = json_decode($response, true);
			$coms = $response['auto'];
			$this->comCode = array();
			foreach ($coms as $com) {
				$this->comCode[] = $com['comCode'];
			}
			return $this->comCode;
		}

		//Query number with that comCode
		public function query_num($comCode = false) {
			//?type=shunfeng&postid=688624242254&id=1&valicode=&temp=0.5323619142104129
			if($comCode) {
				$query = '?type='.$comCode.'&postid='.$this->number.'&valicode=&temp='.random_float();
			}else {
				$query = '?type='.$this->comCode[0].'&postid='.$this->number.'&valicode=&temp='.random_float();
			}
			curl_setopt_array(self::$ch, array(
				CURLOPT_URL => 'http://www.kuaidi100.com/query'.$query,
				CURLOPT_POST => 0
			));
			$response = curl_exec(self::$ch);
			//$response = json_decode($response, true);
			return $response;
		}

		public function quick_query() {
			$this->query_com();
			return $this->query_num();
		}

	}

	function random_float($min = 0, $max = 1) {  
        return $min + mt_rand() / mt_getrandmax() * ($max - $min);  
    }  

 ?>
