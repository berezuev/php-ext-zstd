--TEST--
namespace: Zstd\compress()/uncompress()
--SKIPIF--
<?php if (PHP_VERSION_ID < 50300) die("Skipped: PHP 5.3+ required."); ?>
--FILE--
<?php
include(dirname(__FILE__) . '/data.inc');

// Initialise all required variables
$smallstring = "A small string to compress\n";


// Calling \Zstd\compress() with all possible arguments
$level = 1;

// Compressing a big string
echo "*** Compression ***", PHP_EOL;
$output = \Zstd\compress($data, $level);
var_dump(md5($output));
var_dump(\Zstd\uncompress($output) === $data);

// Compressing a smaller string
echo "*** Compression ***", PHP_EOL;
$output = \Zstd\compress($smallstring, $level);
var_dump(bin2hex($output));
var_dump(\Zstd\uncompress($output) === $smallstring);

// Calling \Zstd\compress() with mandatory arguments
echo "*** Testing with no specified compression ***", PHP_EOL;
var_dump(bin2hex(\Zstd\compress($smallstring) ));

?>
===Done===
--EXPECT--
*** Compression ***
string(32) "332567c3885f9745988ec1dcd39c71d0"
bool(true)
*** Compression ***
string(72) "28b52ffd201bd900004120736d616c6c20737472696e6720746f20636f6d70726573730a"
bool(true)
*** Testing with no specified compression ***
string(72) "28b52ffd201bd900004120736d616c6c20737472696e6720746f20636f6d70726573730a"
===Done===