<?php

namespace App;

class MoreThanThreeDeadRule extends AbstractRule
{
  public function apply(Cell $cell)
  {
   if($this->getNumberAliveNeighbours($cell)>3){
       $killAction = new KillAction($cell);
       $killAction->execute($cell);
       return $killAction;
   }
   $NullAction = new NullAction($cell);
   $NullAction->execute($cell);
   return $NullAction;
  }
}
