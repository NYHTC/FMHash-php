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

    private function hashString($string)
    {
    	return str_replace(
			array('=', ':', '>', '<'),
			array('/=', '/:', '/>', '/<'),
			$string
		);
    }

}
