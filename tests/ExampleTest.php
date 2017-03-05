<?php

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $this->visit('/')
             ->see('Laravel');
    }
	
	/**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {        
		$_fp = fopen("testcases.dat", "r");
		while (!feof($_fp)) {
			$contenido .= fread($_fp, 8192);
		}
			$lines=explode("\n",$contenido);
		$c=0;
		foreach($lines as $item)
		{    
			$c++;
			$item=preg_replace("/[\\n\\r]+/", "", $item);
			switch($c) 
			{
				case 1:   
					if(!strpos($item, "UPDATE") || strpos($item, 'QUERY')) {
						$this->assertTrue(true);
					}        
					break;
				case 2:
					if(!(strpos($item, 'UPDATE') || strpos($item, 'QUERY'))){						
						$this->assertTrue(true);
					}  
					break; 
				default:
					if(substr($item, 0, 7) === "UPDATE ") {						
						$this->assertTrue(true);
					}else if(substr($item, 0, 6) === "QUERY ") {
						$this->assertTrue(true);
					}					
					break; 
			}
		}		
    }
}
