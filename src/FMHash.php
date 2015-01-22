<?php

class FMHash {
	
    public static function make($key, $value)
    {
    	$hasher = new static;

        $head = "<:";
        $key_hashed = $hasher->hashString($key);
		$middle = ":=";
        $value_hashed = $hasher->hashString($value);
		$tail = ":>";
		
		return implode('', [
			$head, $key_hashed, $middle, $value_hashed, $tail
		]);
    }
    
    public static function get($hash, $key)
    {
    	$hasher = new static;

        $match = '<:' . $hasher->hashString($key) . ':=';
        $pstart = strpos($hash, $match);
        $start = $pstart + strlen($match);
        $end = strpos($hash, ':>', $start);
        $len = $end == 0 ? 999999999 : $end - $start;

        if($pstart < 0) {
        	return false;
        }

        $hashed_value = substr($hash, $start, $len);

        return $hasher->deHashString($hashed_value);
    }

    private function hashString($string)
    {
    	return str_replace(
			array('=', ':', '>', '<'),
			array('/=', '/:', '/>', '/<'),
			$string
		);
    }

    private function deHashString($string)
    {
    	return str_replace(
			array('/=', '/:', '/>', '/<'),
			array('=', ':', '>', '<'),
			$string
		);
    }

}
