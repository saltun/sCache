<?php 
/**
* @author Savaş Can Altun <savascanaltun@gmail.com>
* Web : http://savascanaltun.com.tr
* Mail : savascanaltun@gmail.com
* GİT : http://github.com/saltun
* Date : 13.06.2015
* Update :  04.07.2016
*/
class sCache extends Predis\Client {
	
	private  $cache = null;
	private  $time = 60;
	private  $status = 0;
	private  $buffer=false;
	private  $start=null;
	private  $load=false;
	private  $external=array();
	private  $type=true;
	private  $active=true;
	private  $name=null;


	public function __construct($redisStart=array(),$options=NULL,$active=true){

		/**
		* Predis ile redis server'e bağlanılıyor
		*/
		if (is_array($redisStart)) {
			parent::__construct($redisStart);
		}else{
			die('Predis Document page => https://github.com/nrk/predis');
		}

		
		/**
		* İstek sayfanın adresi md5 formatta redis'e anahtar değer olarak gönderiliyor.
		*/
		$this->name=md5($_SERVER['REQUEST_URI']);

		

		$this->active=$active;

		if ($active) {
			
		

			if (isset($options)) {

				if (is_array($options)) {

					if(isset($options['dir']))    	  $this->dir = $options['dir'];
					if(isset($options['buffer'])) 	  $this->buffer = $options['buffer'];
					if(isset($options['time']))   	  $this->time = $options['time'];
					if(isset($options['load']))  	  $this->load = $options['load'];
					if(isset($options['external']))   $this->external = $options['external'];
					if(isset($options['extension']))   $this->extension = $options['extension'];

				}else{
					die('Options only array');
				}
				
			}

			/**
			* Cache dışı tutulacak sayfalardan mı değil mi diye kontrol ediyoruz
			*/

			$myPage=explode('/',$_SERVER["SCRIPT_FILENAME"]);
			
			foreach ($this->external as $key => $external) {
				if (in_array(end($myPage), $this->external)) {
					$this->type=false;
					break;
				}
			}

			if ($this->type) {
			


				

				if ($this->load) {
						list($time[1], $time[0]) = explode(' ', microtime());
						$this->start = $time[1] + $time[0];
				}

			


				 if(parent::exists($this->name)) { 

			 	  /**
			 	  * Redis'den sayfayı alıyoruz ve ekrana yansıtıp işlemleri tamamlıyoruz 
			 	  */
			   	  echo parent::get($this->name);
			      $this->status=1;
			      die();
				}else { 
				 
			      @unlink($this->cache); 

				  ob_start();
				}

			}
		}
	}

	/**
	* Buffer function
	* @param string $buffer
	* @return string
	*/
	private function buffer($buffer){

		$buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);
		$buffer = str_replace(': ', ':', $buffer);
		$buffer = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $buffer);

		return $buffer;
	}

	/**
	* Write cache redis
	* @return null
	*/

	private function writeCache($content){
		
		$content=$content."<!--- sCache Class - ".$this->time." Second -->";
	
		parent::set($this->name,$content);
		parent::expire($this->name,$this->time);


	}

	/**
	* Clear all redis key
	* @return true|false
	*/
	public function clearCache(){

		if (parent::flushAll()) {
			return true;
		}else{
			return false;
		}
		die();

		
	}


	public function __destruct(){

		if ($this->active) {
			
			
				if ($this->type) {

						if ($this->status==0) {
							if ($this->buffer) {
								$this->writeCache($this->buffer(ob_get_contents()));
							}else{
								$this->writeCache(ob_get_contents());
							}
							
						}


						if ($this->load) {
								list($time[1], $time[0]) = explode(' ', microtime());
								$finish = $time[1] + $time[0];
								$total_time = number_format(($finish - $this->start), 6);
								echo "Load Time (S) :  {$total_time} ";
						}

				

						ob_end_flush();
				}
		}
	}


}
