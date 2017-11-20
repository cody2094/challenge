<?php
use Cody\Challenge\Challenge;

class BaseTestCase extends \PHPUnit_Framework_TestCase { 


	public function testCanBeCreated() {
		$Challenge = new Challenge;
		$this->assertInstanceOf(	Challenge::class, $Challenge);
	}
	public function testCurrencyChange() {
		$Challenge = new Challenge;
		//test invalid entry
		$this->assertEquals(	$Challenge->change_currency(""),  'Invalid Input.');
		//test with valid entry
		$this->assertTrue(	$Challenge->change_currency("Quarter,4,Dime,10,Nickel,20,Penny,100") );
	}
	public function testResults() {
		$Challenge = new Challenge;
		//run main function with default "Quarter,4,Dime,10,Nickel,20,Penny,100"
		$Challenge->build_possibilities();
		//check solution count
		$this->assertEquals( $Challenge->solution_count, 242);
		//change currency to "Coin,1.5,Arrowhead,3,Button,150", check for solution_count of 6
		$this->assertTrue(	$Challenge->change_currency("Coin,1.5,Arrowhead,3,Button,150") );
		$Challenge->build_possibilities();
		$this->assertEquals( $Challenge->solution_count, 6);
	}

}

?>	