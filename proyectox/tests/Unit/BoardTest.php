<?php

namespace Tests\Unit;

use App\Board;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BoardTest extends TestCase
{
   /**
    * @var Board
    */
   protected $board;
   public function setUp()
   {
       $this->board= new Board();
   }
}
