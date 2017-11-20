## Class Overview

This is a class that builds and outputs all possible sums given currency denominations where each denomination equals an arbitrary sum

## Build and run procedures


Download this repository via Git and run composer on the package.


Below is a code sample displaying how to run this challenge:

```
include('Challenge.php');
$challenge = new Challenge();
//build_possibilities with default values
$challenge->build_possibilities();

$challenge->change_currency("Coin,1.5,Arrowhead,3,Button,150");
$challenge->build_possibilities();

```

## Tests

Run /vendor/bin/phpunit to run the PHPunit tests
