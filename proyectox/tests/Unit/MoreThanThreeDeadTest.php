<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\MoreThanThreeDeadRule;
use App\Cell;

class MoreThanThreeDeadTest extends TestCase
{
    protected $rule;

    public function setUp()
    {
        $this->rule = new MoreThanThreeDeadRule();
    }

    /**
     * @test
     */
    public function it_implemented_ruleInterface()
    {
        $this->assertInstanceOf('App\RuleInterface', $this->rule);
    }

    /**
     * @test
     */
    public function it_implemented_abstractRuleClass()
    {

        $this->assertInstanceOf('App\AbstractRule', $this->rule);
    }

    /**
     * @test
     */
    public function it_neighbours_over_population_cell_dead()
    {
        $cell= $this->createCell(4);
        $action= $this->rule->apply($cell);
        $this->assertInstanceOf('App\KillAction', $action);
        $this->assertSame($cell, $action->getCell());
    }

    /**
     * @test
     *
     */
    public function it_neighbours_2_or_3_live_return_null_action()
    {
        $cell= $this->createCell(2);
        $action= $this->rule->apply($cell);
        $this->assertInstanceOf('App\NullAction', $action);
        $cell= $this->createCell(3);
        $action= $this->rule->apply($cell);
        $this->assertInstanceOf('App\NullAction', $action);
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