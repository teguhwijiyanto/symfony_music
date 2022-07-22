<?php

namespace App\Service;

class GeometryCalculator
{

    public $type;

    public $parameter_A;
	public $parameter_B;
	public $parameter_C;

	private function getSurface(string $type, int $parameter_A): float
	{
		if($type=="circle") {
            $surface = ($parameter_A * $parameter_A) * 3.4;
		}
		if($type=="triangle") {
            $surface = ($parameter_A * $parameter_A) / 2;
		}
		return $surface;
	}

    private function getCircumference(string $type, int $parameter_A): float
	{
		if($type=="circle") {
            $circumference = $parameter_A * 2 * 3.14;
		}
        if($type=="triangle") {
		     $circumference = $parameter_A * 3;
		}
	    return $circumference;
	}

    private function getDiameter(int $parameter_A): float
	{
         $diameter = $parameter_A * 2;
		 return $diameter;
	}

    public function sumOfAreas(string $type, int $parameter_B, int $parameter_C): float
    {
		$sumOfAreas = $this->getSurface($type, $parameter_B) + $this->getSurface($type, $parameter_C);
		return $sumOfAreas;
    }

    public function sumOfDiameters(int $parameter_B, int $parameter_C): float
    {
        $sumOfAreas = $this->getDiameter($parameter_B) + $this->getDiameter($parameter_C);
        return $sumOfAreas;
    }

    public function sumOfCircumference(string $type, int $parameter_B, int $parameter_C): float
    {
        $sumOfAreas = $this->getCircumference($type, $parameter_B) + $this->getCircumference($type, $parameter_C);
        return $sumOfAreas;
    }

}