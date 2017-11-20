<?php 

namespace Cody\Challenge;

/**
*			This is a class that builds and outputs all possible sums given currency denominations where each denomination equals an arbitrary sum
*
* 		@author			Cody Brown <cody2094@hotmail.com>;
* 		@date			 	2017-11-18;
*			@package		Bundle Shipments		
*
*/
class Challenge {
	
  private $currency_arr = array();
  private $header_arr = array();
	private $target = 0;
	public  $solutions = array();
	public  $solution_count = 0;
	
	/**
	* This function is the construct and sets the default currency and header arrays, and the target value to hit.
	*
	*			@package	 Cody Brown Challenge
	*/
	public function __construct() {
		$this->currency_arr = array(100, 20, 10, 4);
		$this->header_arr = array('Penny', 'Nickel', 'Dime', 'Quarter');
		$this->target = 100;//target is always max number inside of currency_arr
	}
	
	
	/**
	* This function is the function that builds the possibilities using methods of recursion
	*
	*			@package	 Cody Brown Challenge
	*/
	public function build_possibilities() {
		$ratios = array();
		foreach ($this->currency_arr as $key => $cur) {//build ratios for each of the currency values
			$ratios[$key] = ($this->target / $cur);
		}
		$this->ratios = $ratios;
		
		/*
		Commented this out but thought it was an interesting way to find the number without actually calculating
		
		
		$temp_arr = array(0 => 1);
		for ($x = 0; $x < count($this->currency_arr); $x++) {//loop through each denomination
			for ($y = 1; $y < ($this->target + 1); $y++) {//loop through to the max target
				if (!isset($temp_arr[$y])) {//check for instantiation
					$temp_arr[$y] = 0;
				}
				if ($y < $ratios[$x]) {
					$temp_arr[$y] += 0;
				} else {
					$temp_arr[$y] += $temp_arr[$y - $ratios[$x]];
				}
			}
		}
		$num_possibilities = $temp_arr[$this->target];
		echo $num_possibilities;
		
		*/
		
		$this->currency_loop();
		echo implode(" ", $this->header_arr)."\n";
		//find header lengths for padding purposes
		$strpad = array();
		foreach ($this->header_arr as $key => $header) {
			$strpad[$key] = strlen($header);
		}

		foreach ($this->solutions as $sol_arr) {
			foreach ($this->header_arr as $key => $header) {
				if (!isset($sol_arr[$key])) {
					$sol_arr[$key] = 0;
				}
				echo str_pad($sol_arr[$key], $strpad[$key], " ", STR_PAD_LEFT)." ";
			}
			echo "\n";
		}
		echo "Count: ".$this->solution_count."\n";
		
	}
	
	
	/**
	* This function is a recursive function that loops through each possible currency, it is started by calling $this->currency_loop()
	*
	*			@package	 Cody Brown Challenge
	*			@param		 $x 				The accumulated amount passed through the loop
	*			@param		 $y 				The current key iteration for this->currency_arr
	*			@param		 $sol_arr		The current solution array which contains the number of times each currency item is used
	*/
	private function currency_loop($x = 0, $y = 0, $sol_arr = array()) {
		if ($x == $this->target) {
			$this->solutions[] = $sol_arr;
			$this->solution_count++;
		} elseif ($x < $this->target) {
			for ($z = 0; $z < count($this->currency_arr); $z++) {
				if ($z >= $y && (($x + $this->ratios[$z]) <= $this->target)) {
					$new_arr = $sol_arr;
					if (!isset($new_arr[$z])) {
						$new_arr[$z] = 0;
					}
					$new_arr[$z]++; 
					$this->currency_loop($this->ratios[$z] + $x, $z, $new_arr);
				}
			}
		}
	}
	
	/**
	* This function is a function that accepts a string and changes the currency values and headers
	*
	*			@package	 Cody Brown Challenge
	*			@param		 $str		A comma separated string with the denomination first, and then sum of that denomination it takes to hit the maximum sum
	* 											EX: $str = "Quarter,4,Dime,10,Nickel,20,Penny,100";
	*/
  public function change_currency($str) {
		$ret = false;
		if (is_string($str)) {
			$arr = explode(',', $str);
			if (count($arr) % 2 == 0) {//make sure we have an even division of headers and values
				$continue = true;
				$header = array();
				$values = array();
				$max = 0;
				for ($x = 0;$x <= (count($arr) - 2); $x+=2) {
					if (is_string($arr[$x]) && is_numeric($arr[$x+1]) && $arr[$x+1] > 0) {
						$header[] = $arr[$x];
						$values[] = $arr[$x+1];
						$max = max($max, $arr[$x+1]);
					} else {
						$continue = false;
						break;
					}
				}
				if ($continue) {
					$this->header_arr = $header;
					$this->currency_arr = $values;
					$this->target = $max;
					//empty solution array
					$this->solutions = array();
					//reset solution count
					$this->solution_count = 0;
					$ret = true;
				}
			}
		}
		if (!$ret) {
			$ret = 'Invalid Input.';	
		}
		return $ret;
  }
}



?>