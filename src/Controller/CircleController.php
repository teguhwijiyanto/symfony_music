<?php
 
namespace App\Controller;
 
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Circle;
use App\Service\GeometryCalculator;
 
/**
 * @Route("/api", name="api_")
 */
class CircleController extends AbstractController
{

	public int $parameter_A;
	public int $parameter_B;
	public int $parameter_C;

    /**
     * @Route("/circle/test_service/{parameter_A}/{parameter_B}", name="circle_test_service", methods={"GET"})
     */
    public function test_service(string $type='circle', int $parameter_A, int $parameter_B): Response
    {

       $geometryCalculator = new GeometryCalculator;
	   $sumOfAreas = $geometryCalculator->sumOfAreas($type, $parameter_A, $parameter_B);
	   $sumOfDiameters = $geometryCalculator->sumOfDiameters($parameter_A, $parameter_B);

        $data = [];
        $data =  [
            'type' => $type,
            'radius_1' => $parameter_A,
		    'radius_2' => $parameter_B,
		    'sumOfAreas' => $sumOfAreas,
		    'sumOfDiameters' => $sumOfDiameters,
        ];

        return $this->json($data);
    }
 
    private function calculateSurface(int $parameter): float
	{
         $surface = ($parameter * $parameter) * 3.4;
		 return $surface;
	}

    private function calculateCircumference(int $parameter): float
	{
         $circumference = $parameter * 2 * 3.14;
		 return $circumference;
	}

    private function calculateDiameter(int $parameter): float
	{
         $diameter = $parameter * 2;
		 return $diameter;
	}

    /**
     * @Route("/circle/{parameter}", name="circle_show", methods={"GET"})
     */
    public function show(int $parameter): Response
    {
        $data =  [
            'type' => 'circle',
            'radius' => $parameter,
			'surface' => $this->calculateSurface($parameter),
			'circumference' => $this->calculateCircumference($parameter),
        ];
         
        return $this->json($data);
    }
 
}
