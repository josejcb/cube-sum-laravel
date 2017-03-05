<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\MainFormRequest;

class MainController extends Controller
{
    public function solve(MainFormRequest $request)
	{	
		//Input typed	
		$inputt = $request->get('inputt');
		
		//getting lines within the input
		$lines=explode("\n", $inputt);
		
		//line by line process
		$this->loopLines($lines);
		
        return view('welcome');
    }
	
	/*
		Function to sort arrays
	*/
	public function sortArray($array, $type) {
		if($type == 'a') {
			uasort($array, function($a, $b) {
				if ($a == $b) {
					return 0;
				}
				return ($a < $b) ? -1 : 1;
			});
		}
	}
	
	/*
		Set number of test cases to execute 
	*/
	public function testCases($line) {
		$testcasesT = 0;
		if(strpos($line, "UPDATE") || strpos($line, 'QUERY')) {
			exit();
		} else { 
			$testcasesT = $line;
			if(!((int)$testcasesT && (int)$testcasesT > 0 && (int)$testcasesT <= 50)) {                    
				exit;
			}
		}
		return $testcasesT;
	}
	
	/*
		Set size of matrix  
	*/
	public function matrixSize($nm) {
		$matrixSize = (int)$nm[0]; 
		if(!((int)$matrixSize && (int)$matrixSize > 0 && (int)$matrixSize <= 100)) {                    
			exit;
		}
		return $matrixSize; 
	}		
	
	/*
		Set number of operations to execute 
	*/
	public function operationsNumber($nm) {
		$operation = (int)$nm[1];
		if(!((int)$operation && (int)$operation > 0 && (int)$operation <= 1000)) {                    
			exit;
		}
		return $operation; 
	}
	
	/*
		Array of X coordinate of updated values		
	*/
	public function xIndexValues($coordinate, $xArray) {
		if(!in_array($coordinate[0], $xArray))
			array_push($xArray, $coordinate[0]);
		return $xArray;
	}
	
	/*
		Array of Y coordinate of updated values		
	*/
	public function yIndexValues($coordinate, $yArray) {
		if(array_key_exists($coordinate[0], $yArray )) {
			if(!in_array($coordinate[1], $yArray[$coordinate[0]]))
				array_push($yArray[$coordinate[0]], $coordinate[1]);
		} else
			$yArray[$coordinate[0]] = array(0 => $coordinate[1]);
		return $yArray;
	}
	
	/*
		Array of Z coordinate of updated values		
	*/
	public function zIndexValues($coordinate, $zArray) {
		if(array_key_exists($coordinate[0], $zArray)) {   
			if(array_key_exists($coordinate[1], $zArray[$coordinate[0]])) {  
				if(!in_array($coordinate[2], $zArray[$coordinate[0]][$coordinate[1]]))
					$zArray[$coordinate[0]][$coordinate[1]][] = $coordinate[2];      
			} else {
				$zArray[$coordinate[0]][$coordinate[1]] = array(0=>$coordinate[2]);
			}
		}else
			$zArray[$coordinate[0]][$coordinate[1]] = array(0=>$coordinate[2]);
		return $zArray;
	}
	
	/*
		Sum of values in matrix between coordinates queued	
	*/	
	public function sumCube($line, $xArray, $yArray, $zArray, $matrix) {
		$coordinate = explode(" ", substr($line, 6, strlen($line) - 1));
		if(count($coordinate) == 6) {
			$suma=0;
			$this->sortArray($xArray,'a');	
			foreach($xArray as $x) {
				if($x < $coordinate[0] || $x > $coordinate[3]) {
					continue;
				}
				$this->sortArray($yArray[$x], 'a');	
				foreach($yArray[$x] as $y) {							
					if($y < $coordinate[1] || $y > $coordinate[4]) {
						continue;
					}
					$this->sortArray($zArray[$x][$y], 'a');
					foreach($zArray[$x][$y] as $z){									
						if(($z < $coordinate[2]) || ($z > $coordinate[5])) {
							continue;
						}
						$suma += (int)$matrix[$x][$y][$z];																	
					}
				}
			}						
			return $suma . "<br>";  					
		} else {
			exit;
		}
	}
	
	/*
		Main process to get the required output
	*/
	public function loopLines($lines) {
		/*
			Declarations	
		*/
		$c = 0;//counter of operations per test
		$testCount = 0;//counter of tests
		$operationCount = 0;//counter of operation (queries  and updates)
		$testcasesT= 0;//total of cases  
		
		foreach($lines as $item){    
			$c++;
			$item = preg_replace("/[\\n\\r]+/", "", $item);
			switch($c) {
				case 1:   
					$testcasesT = $this->testCases($item);     
					break;
				case 2:
					if(strpos($item, 'UPDATE') || strpos($item, 'QUERY')) {
						exit;
					} else {
						$testCount++;
						$nm = explode(" ", $item);
						if(count($nm) == 2) {
							$matrixSize = $this->matrixSize($nm);
							$operations = $this->operationsNumber($nm);
							
							//clearing arrays
							unset($matrix);  
							unset($xArray);   
							unset($yArray);   
							unset($zArray);
							$xArray = array();
							$yArray = array();
							$zArray = array();
							$matrix = array();                    
						} else {
							exit;                    
						}
					}  
					break; 
				default:
					if(substr($item, 0, 7) === "UPDATE ") {
						$operationCount++;           
						
						//getting coordinates and value to set
						$coordinate = explode(" ", substr($item, 7, strlen($item) - 1));
						
						//Validating task, coordinates with matrix size and max value allowed
						if(count($coordinate) == 4) {
							if($coordinate[0]<=$matrixSize && $coordinate[1]<=$matrixSize && $coordinate[2]<=$matrixSize) {
								if($coordinate[3] >= pow(-10,9) && $coordinate[3] <= pow(10,9)) {
									//Filling matrix
									$matrix[$coordinate[0]][$coordinate[1]][$coordinate[2]] = $coordinate[3];
									
									//Instead of looping from 0 to N, some arrays 
									//containing the updated values are looped 
									//avoiding time execution exceptions
									$xArray = $this->xIndexValues($coordinate, $xArray);									
									$yArray = $this->yIndexValues($coordinate, $yArray);								   
									$zArray = $this->zIndexValues($coordinate, $zArray);
								}                   
							}
						} else {
							exit;
						}
					} else if(substr($item, 0, 6) === "QUERY ") {
						$operationCount++;  
						
						//showing OUTPUT
						echo $this->sumCube($item, $xArray, $yArray, $zArray, $matrix);
					}
					
					//Validation to finish the whole process or a test
					if($operationCount == $operations) {
					   $operationCount = 0;
					   $c = 1;
					   if($testcasesT == $testCount) {
						   exit;
					   }
					}
				break; 
			}
		}	
	}	
}
