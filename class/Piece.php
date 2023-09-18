<?php
include('Position.php');

class Piece {
    private const ROTATION_INCREMENTALS = [[[1,-1],[0,0],[1,1],[2,2]],[[1,1],[0,0],[-1,1],[-2,2]],[[-1,1],[0,0],[-1,-1],[-2,-2]],[[-1,-1],[0,0],[1,-1],[2,-2]]];

    //Info: We can represent every Position as an array too.
    private array $positions;
    private int $status;

    //Info: Initial position of the pice are a design decision.Not necessarily these ones.
    public function __construct() {
        $this->positions = array();
        $this->positions[] = new Position(4,0);
        $this->positions[] = new Position(4,1);
        $this->positions[] = new Position(5,1);
        $this->positions[] = new Position(6,1);
        $this->status = 0;
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

    public function moveDown(): void {
        foreach($this->positions as $position) {
            ++$position->y;
        }   
    }

    public function moveLeft(): void {
        if($this->canMoveLeft()) {
            foreach($this->positions as $position) {
                --$position->x;
            }
        } 
    }

    public function moveRight(int $max_column): void {
        if($this->canMoveRight($max_column)) {
            foreach($this->positions as $position) {
            ++$position->x;
            }
        } 
    }

    public function rotate(int $max_row, int $max_column): void {
        $new_status = $this->changeStatus(); 
        if($this->canRotate($max_row,$max_column, $new_status)) {
            $this->status = $new_status;
            for($i = 0; $i < count($this->positions); ++$i) {
                $this->positions[$i]->x += Piece::ROTATION_INCREMENTALS[$this->status][$i][0];
                $this->positions[$i]->y += Piece::ROTATION_INCREMENTALS[$this->status][$i][1];
            }
        }
    }

    private function canMoveLeft() : bool {
        foreach($this->positions as $position) {
            if($position->x <= 0) return false;
        }
        return true;      
    }

    private function canMoveRight(int $max_column) : bool {
        foreach($this->positions as $position) {
            if($position->x >= $max_column-1) return false;
        }
        return true;      
    }

    private function changeStatus() : int {
        if($this->status == 3) return 0;
        return $this->status + 1;
    }

    private function canRotate(int $max_row, int $max_column,int $status): bool {
        for($i = 0; $i < count($this->positions); ++$i) {
            $column_variation = $this->positions[$i]->x + Piece::ROTATION_INCREMENTALS[$status][$i][0];
            $row_variation = $this->positions[$i]->y + Piece::ROTATION_INCREMENTALS[$status][$i][1]; 
            if(($column_variation < 0 || $column_variation >= $max_column) || 
                ($row_variation < 0 || $row_variation >= $max_row)) return false;

        }
        return true;
    }
}

?>