<?php
include('Piece.php');

class Board {
	
	private const EMPTY_SQUARE = 0x2B1c;
	private const BUSY_SQUARE =  0x2B1B; 
	
	private int $rows;
	private int $columns;
	private Piece $piece;

	public function __construct(int $rows,int $columns) {
		$this->rows = $rows;
		$this->columns = $columns;
		$this->piece = new Piece();
	}

	public function play(?Move $move = null):void {
		
		if(!is_null($move)) $this->movePiece($move);
		$this->draw();
	}

	private function draw() {
		$rows_count = 0;
		while($rows_count < $this->rows) {
			$this->drawRow($rows_count);
			++$rows_count;
		}
	}

	private function drawRow(int $row): void {
		for($column = 0; $column < $this->columns; ++$column) {
			$char_to_print = Board::EMPTY_SQUARE;
			if($this->piece->hasPieceInPosition($column,$row)) $char_to_print = Board::BUSY_SQUARE;
			echo mb_chr($char_to_print);
		}
		echo PHP_EOL;
	}

	private function movePiece(Move $move): void {
		//Info: Decided that, if we arrive to the last row, can't move more
		if(!$this->piece->isLastRow($this->rows)) {
			switch($move) {
				case MOVE::DOWN:
					$this->piece->moveDown();
					break;
				case MOVE::LEFT:
					if($this->piece->canMoveLeft()) $this->piece->moveLeft();
					break;
				case MOVE::RIGHT:
					if($this->piece->canMoveRight($this->columns)) $this->piece->moveRight();
					break;
				case MOVE::ROTATE:
					echo 'giiira';
					break;
			}
		}
	}
}
?>