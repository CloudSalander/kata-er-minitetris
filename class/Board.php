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

	public function draw(?Move $move = null):void  {
		
		if(!is_null($move)) var_dump($move);

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
}
?>