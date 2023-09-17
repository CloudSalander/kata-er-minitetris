<?php
include('Position.php');

class Piece {

    //Info: We can represent every Position as an array too.
    private array $positions;

    //Info: Initial position of the pice are a design decision.Not necessarily these ones.
    public function __construct() {
        $this->positions = array();
        $this->positions[] = new Position(4,0);
        $this->positions[] = new Position(4,1);
        $this->positions[] = new Position(5,1);
        $this->positions[] = new Position(6,1);
    }

    public function hasPieceInPosition(int $x, int $y): bool {
		foreach($this->positions as $position) {
            if($position->x == $x && $position->y == $y) return true;
        }
        return false;
	}

    public function isLastRow(int $max_row): bool {
        foreach($this->positions as $position) {
            if($position->y >= $max_row-1) return true;
        }
        return false;
    }

    public function canMoveLeft() : bool {
        foreach($this->positions as $position) {
            if($position->x <= 0) return false;
        }
        return true;      
    }

    public function canMoveRight(int $max_column) : bool {
        foreach($this->positions as $position) {
            if($position->x >= $max_column-1) return false;
        }
        return true;      
    }

    public function moveDown(): void {
        foreach($this->positions as $position) {
            ++$position->y;
        }   
    }

    public function moveLeft(): void {
        foreach($this->positions as $position) {
            --$position->x;
        } 
    }

    public function moveRight(): void {
        foreach($this->positions as $position) {
            ++$position->x;
        } 
    }
}

?>