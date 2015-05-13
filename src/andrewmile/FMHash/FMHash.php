<?php namespace andrewmile\FMHash;

class FMHash {
	
    public static function make($key, $value = null)
    {
    	$hasher = new static;

        //allow for array as first param
        if(is_array($key)) {
            $hash = '';
            foreach($key as $name => $value) {
                $hash .= $hasher::make($name, $value);
            }

            return $hash;
        }

        $head = "<:";
        $key_hashed = $hasher->escape($key);
		$middle = ":=";
        $value_hashed = $hasher->escape($value);
		$tail = ":>";
		
		return implode('', [
			$head, $key_hashed, $middle, $value_hashed, $tail
		]);
    }
    
    public static function get($hash, $key)
    {
    	$hasher = new static;

        $match = '<:' . $hasher->escape($key) . ':=';
        $pstart = strpos($hash, $match);
        $start = $pstart + strlen($match);
        $end = strpos($hash, ':>', $start);
        $len = $end == 0 ? 999999999 : $end - $start;

        if($pstart < 0) {
        	return false;
        }

        $hashed_value = substr($hash, $start, $len);

        return $hasher->deEscape($hashed_value);
    }

    private function escape($string)
    {
    	return str_replace(
			array('=', ':', '>', '<'),
			array('/=', '/:', '/>', '/<'),
			$string
		);
    }

    private function deEscape($string)
    {
    	return str_replace(
			array('/=', '/:', '/>', '/<'),
			array('=', ':', '>', '<'),
			$string
		);
    }

}
