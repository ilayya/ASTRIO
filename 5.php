<?php

class cookies{
	protected static $me = NULL;

	private function __construct(){}
  private function __clone(){}
  private function __wakeup(){}

	public static function Instance(){
		if (self::$me == NULL){
			self::$me = new cookies();
		}
		return self::$me;
	}

	public function set($key, $value, $time = 365){
    if (!isset($_COOKIE[$key])){
      $time = $time*60*60*24;
      setcookie($key,$value,time() + $time);
    } else return false;
	}

  public function get($key){
    if (isset($_COOKIE[$key])){
      return $_COOKIE[$key];
    }
    else return false;
  }

  public function delete($key){
    if (isset($_COOKIE[$key])) {
      setcookie($key,'', -1);
      return true;
    } else return false;
  }

  public function edit($key, $value, $time = 365){
    $time = $time*60*60*24;

    if (isset($_COOKIE[$key])){
      setcookie($key,$value, time()+ $time);
      return true;
    }else return false;
  }
}

?>
