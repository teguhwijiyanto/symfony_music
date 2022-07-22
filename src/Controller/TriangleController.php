<?php
 
namespace App\Controller;
 
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Triangle;
use App\Service\GeometryCalculator;
 
/**
 * @Route("/api", name="api_")
 */
class TriangleController extends AbstractController
{

	public int $parameter_A;
	public int $parameter_B;
	public int $parameter_C;

    /**
     * @Route("/triangle/test_service/{parameter_A}/{parameter_B}", name="triangle_test_service", methods={"GET"})
     */
    public function test_service(string $type='triangle', int $parameter_A, int $parameter_B): Response
    {

       $geometryCalculator = new GeometryCalculator;
	   $sumOfAreas = $geometryCalculator->sumOfAreas($type, $parameter_A, $parameter_B);
	   $sumOfCircumference = $geometryCalculator->sumOfCircumference($type, $parameter_A, $parameter_B);

        $data = [];
        $data =  [
            'type' => $type,
            'length_1' => $parameter_A,
		    'length_2' => $parameter_B,
		    'sumOfAreas' => $sumOfAreas,
		    'sumOfCircumference' => $sumOfCircumference,
        ];

        return $this->json($data);
    }
 
    private function calculateSurface(int $a, int $b, int $c): float
	{
         $surface = ($a * $b) / 2;
		 return $surface;
	}

    private function calculateCircumference(int $a, int $b, int $c): float
	{
         $circumference = $a + $b + $c;
		 return $circumference;
	}

    /**
     * @Route("/triangle/{a}/{b}/{c}", name="triangle_show", methods={"GET"})
     */
    public function show(int $a, int $b, int $c): Response
    {
		       
        $data =  [
            'type' => 'triangle',
            'a' => $a,
            'b' => $b,
			'c' => $c,
			'surface' => $this->calculateSurface($a, $b, $c),
			'circumference' => $this->calculateCircumference($a, $b, $c),
        ];
         
        return $this->json($data);
    } 
}
