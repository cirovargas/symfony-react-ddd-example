<?php
declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api')]
class ApiController extends AbstractController
{

    #[Route('/charge-batch-file', name: 'charge_batch_file_upload', methods: ['POST'])]
    public function upload(): Response
    {
        return new JsonResponse(
            [
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/ApiController.php',
            ]
        );
    }

    #[Route('/charge-batch-file', name: 'charge_batch_file_list', methods: ['GET'])]
    public function list(): Response
    {
        return new JsonResponse(
            [
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/ApiController.php',
            ]
        );
    }

}
