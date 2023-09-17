<?php
include('class/Move.php');
include('class/Board.php');
define("BOARD_ROWS",10);
define("BOARD_COLUMNS",10);

$board = new Board(BOARD_ROWS, BOARD_COLUMNS);
$board->draw();

$move = Move::DOWN;
while($move != 0) {
	echo '1-DOWN'.PHP_EOL;
	echo '2-LEFT'.PHP_EOL;
	echo '3-RIGHT'.PHP_EOL;
	echo '4-ROTATE'.PHP_EOL;
	echo '0-END OF GAME'.PHP_EOL;
	$move = readline("Next move!");
	$board->draw();
}


?>