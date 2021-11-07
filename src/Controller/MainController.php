<?php

namespace App\Controller;

use App\Helpers\CSVGenerator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Helpers\RuGenerator;
use App\Helpers\USGenerator;
use App\Helpers\ByGenerator;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index() : Response
    {
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

    /**
     * @Route("/ajax/generate")
     */
    public function generate(Request $request) : JsonResponse
    {
        switch($request->get('country')){
            case 'ru': 
                $generator = new RuGenerator($request->get('seed'), $request->get('page'), $request->get('error-count'), $this->getDoctrine());
                break;
            case 'by':
                $generator = new ByGenerator($request->get('seed'), $request->get('page'), $request->get('error-count'), $this->getDoctrine());
                break;
            case 'us': 
                $generator = new USGenerator($request->get('seed'), $request->get('page'), $request->get('error-count'), $this->getDoctrine());
                break;
        }
        $json = $this->json($generator->getRandomData());
        return $json;
    }

    /**
     * @Route("/ajax/createcsv")
     */
    public function generateCSV(Request $request) : JsonResponse
    {
        $generator = new CSVGenerator($request->request->get('data'));
        return $this->json($generator->createFileAndSave());
    }
}
