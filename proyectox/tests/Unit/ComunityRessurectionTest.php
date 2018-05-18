<?php

namespace Tests\Unit;

use App\CommunityResurrectionRule;
use App\Cell;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ComunityRessurectionTest extends TestCase
{
    protected $rule;

    public function setUp()
    {
        $this->rule = new CommunityResurrectionRule();
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
    public function it_ressurection_when_number_neighbours_is_2_or_3(){
        $cell= $this->createCell(2);
        $action = $this->rule->apply($cell);
        $this->assertSame($cell, $action->getCell());
        $cell= $this->createCell(3);
        $action = $this->rule->apply($cell);
        $this->assertSame($cell, $action->getCell());

    }
    /**
     * @test
     */
    public function it_return_nullaction_when_number_neighbours_is_less_2_or_more_3(){
        $cell= $this->createCell(1);
        $action = $this->rule->apply($cell);
        $this->assertInstanceOf('App\NullAction', $action);
        $this->assertSame($cell, $action->getCell());
        $cell= $this->createCell(4);
        $action = $this->rule->apply($cell);
        $this->assertInstanceOf('App\NullAction', $action);
        $this->assertSame($cell, $action->getCell());


    }

    public function createCell($numberofAliveNeighbours)
    {
        $cell = new Cell();
        for($i=1; $i<=$numberofAliveNeighbours; $i++){
            $cell->addNeighbours(new Cell(true));
        }

        return $cell;
    }
}
