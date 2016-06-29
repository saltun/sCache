<?php 
/*
* Author : Savaş Can Altun < savascanaltun@gmail.com >
* Web : http://savascanaltun.com.tr
* Mail : savascanaltun@gmail.com
* GİT : http://github.com/saltun
* Date : 13.06.2015
* Update : 29.06.2016
*/
class sCache {
	
	private  $cache = null;
	private  $time = 60;
	private  $status = 0;
	private  $dir = "sCache";
	private  $buffer=false;
	private  $start=null;
	private  $load=false;
	private  $external=array();
	private  $type=true;
	private  $extension=".html";
	private  $active=true;


	public function __construct($options=NULL,$active=true){
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


			$myPage=explode('/',$_SERVER["SCRIPT_FILENAME"]);
			
			foreach ($this->external as $key => $external) {
				if (in_array(end($myPage), $this->external)) {
					$this->type=false;
					break;
				}
			}

			if ($this->type) {
			


				if(!file_exists(dirname(__FILE__)."/".$this->dir)){
					mkdir(dirname(__FILE__)."/".$this->dir, 0777);
				}

				if ($this->load) {
						list($time[1], $time[0]) = explode(' ', microtime());
						$this->start = $time[1] + $time[0];
				}

			
				

				 $this->cache  =  dirname(__FILE__)."/".$this->dir."/".md5($_SERVER['REQUEST_URI']).$this->extension;

				 if(time() - $this->time < @filemtime($this->cache)) { 
				      readfile($this->cache); 
				      $this->status=1;
				      die();
				}else { 
				 
			      @unlink($this->cache); 

				  ob_start();
				}

			}
		}
	}

	private function buffer($buffer){

		$buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);
		$buffer = str_replace(': ', ':', $buffer);
		$buffer = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $buffer);

		return $buffer;
	}


	private function writeCache($content){
		$file = fopen($this->cache, 'w');
		$content=$content."<!--- sCache Class - ".$this->time." Second -->";
		@fwrite($file, $content);
		fclose($file);


	}

	public function clearCache(){
		$dir = opendir($this->dir); 
		while (($file = readdir($dir)) !== false) 
		{

		if(! is_dir($file)){

		  unlink($this->dir."/".$file);
		}}
		closedir($dir); 

		
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
