<?php

namespace Tests\Unit;

use App\CommunityResurrectionRule;
use App\Cell;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CommunityResurrectionTest extends TestCase
{
  protected $rule;

  public function setUp()
  {
      $this->rule = new LessThanTwoDeadRule();
  }
  /**
   * @test
   */
  public function it_implemented_ruleInterface(){
      $this->assertInstanceOf('App\RuleInterface',$this->rule);
  }

  /**
   * @test
   */
  public function it_implemented_abstractRuleClass(){

      $this->assertInstanceOf('App\AbstractRule', $this->rule);
  }

  /**
   * @test
   */
  public function it_apply_rule_less_than_2_return_dead(){
      $cell = new Cell();
      $cell->addNeighbours(new Cell(true));
      $cell->addNeighbours(new Cell(true));
      $action = $this->rule->apply($cell);
      $this->assertSame($cell,$action->getCell());
  }
  public function it_resurrection_when_number_neighbours_is_2_or_3(){

  }
  public function it_return_nullaction_when_number_neighbours_is_less_than_2(){
    $cell=$this->createCell(1);
    $action = $this->rule->apply($cell);
    $this->assertrInstanceOf('App\NullAction',$action);
    $this->assertSame($cell,$action->getCell());
    $cell=$this->createCell(4);
    $action=$this->rule->apply($cell);
    $this->assertInstanceOf('App\NullAction',$action);
    $this->assertSame($cell,$action->getCell());
  }
  public function createCell($numberofAliveNeighbours)
  {
    $cell = new Cell();
    for($i=1;$i<=$numberofAliveNeighbours; $i++){
      $cell->addNeighbours(new Cell(isAlive:true));
    }
    return $cell;
  }

}
