<?php
class Board {
	
	private const SQUARE = 0x2B1c; 
	
	private int $rows;
	private int $columns;

	public function __construct(int $rows,int $columns) {
		$this->rows = $rows;
		$this->columns = $columns;
	}

	public function draw():void  {
		$rows_count = 0;
		while($rows_count < $this->rows) {
			$this->drawDashesLine();
			++$rows_count;
		}
	}
	private function drawDashesLine(): void {
		for($i = 0; $i < $this->columns; ++$i) {
			echo mb_chr(Board::SQUARE);
		}
		echo PHP_EOL;
	}
}
?>