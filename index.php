<?php
include('class/Board.php');
include('class/Move.php');

define("BOARD_ROWS",10);
define("BOARD_COLUMNS",10);
define("MOVE_MSG","Next move!");
define("AVAILABLE_MOVES", ['1-DOWN','2-LEFT','3-RIGHT','4-ROTATE']);

$board = new Board(BOARD_ROWS, BOARD_COLUMNS);
$board->play();
$move = -1;

while($move != 0) {
	writeAvailableMoves();
	$move = readline(MOVE_MSG);
	if(isRightMove($move)) {
		$move = generateMove(intval($move));
		$board->play($move);
	}
}

function writeAvailableMoves(): void {
	foreach(AVAILABLE_MOVES as $available_move) {
		echo $available_move.PHP_EOL;
	}
}

function isRightMove($move): bool {
	if(is_numeric($move) && ($move > 0 && $move < 5)) return true;
	return false;
}

function generateMove(int $move): Move {
	return match($move) {
		1 => MOVE::DOWN,
		2 => MOVE::LEFT,
		3 => MOVE::RIGHT,
		4 => MOVE::ROTATE
	};
}


?>