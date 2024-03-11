<?php
declare(strict_types=1);

namespace App\Controller;

use App\Service\StorageService;
use DDD\Model\ChargeBatchFile\Command\SaveChargeBatchFileCommand;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api')]
class ApiController extends AbstractController
{

    #[Route('/charge-batch-file', name: 'charge_batch_file_upload', methods: ['POST'])]
    public function upload(Request $request, MessageBusInterface $commandBus): Response
    {
        $file = $request->files->get('file');

        $envelope = $commandBus->dispatch(
            new SaveChargeBatchFileCommand(
                $file->getPathname(),
                $file->getClientOriginalName()
            )
        );

        $command = $envelope->last(HandledStamp::class);

        return new JsonResponse($command->getResult());
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
