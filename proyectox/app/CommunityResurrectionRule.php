<?php

namespace App;

class CommunityResurrectionRule extends AbstractRule
{
  public function apply(Cell $cell)
  {
    $liveNeighbours = $this->getNumberAliveNeighbours($cell);
    if(in_array($liveNeighbours,array(2,3))){
      $resurrectAction = new ResurrectAction($cell);
      $resurrectAction->execute($cell);
      return $resurrectAction;
    }
    $nullAcion = new $NullAcion($cell);
    $nullAction->execute($cell);
    return $nullAction;
  }
}

 ?>
