<?php
declare(strict_types=1);

namespace App\Controller;

use App\Entity\ChargeBatchFile;
use App\Repository\ChargeBatchFileRepository;
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
        try {
            $file = $request->files->get('file');

            $envelope = $commandBus->dispatch(
                new SaveChargeBatchFileCommand(
                    $file->getPathname(),
                    $file->getClientOriginalName()
                )
            );

            $command = $envelope->last(HandledStamp::class);

            return new JsonResponse($command->getResult());
        } catch (\Exception $e) {
            return new JsonResponse(['error' => $e->getMessage()], 500);
        }
    }

    #[Route('/charge-batch-file', name: 'charge_batch_file_list', methods: ['GET'])]
    public function list(ChargeBatchFileRepository $chargeBatchFileRepository): Response
    {
        if (random_int(1,5) === 1) {
            return new JsonResponse(['error' => 'Random error'], 500);
        }

        return new JsonResponse($chargeBatchFileRepository->findAll());
    }

    #[Route('/charge-batch-file/{id}/charges', name: 'charge_batch_file_charges', methods: ['GET'])]
    public function charges(ChargeBatchFile $chargeBatchFile): Response
    {
        if (random_int(1,5) === 1) {
            return new JsonResponse(['error' => 'Random error'], 500);
        }

        return new JsonResponse($chargeBatchFile->getCharges()->toArray());
    }

}
