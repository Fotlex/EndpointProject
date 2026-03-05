<?php

namespace App\Controller;

use App\Message\IncomingImportMessage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Attribute\Route;

class ImportController extends AbstractController
{
    #[Route('/api/import', name: 'api_import', methods: ['POST'])]
    public function import(Request $request, MessageBusInterface $bus): JsonResponse
    {
        $payload = json_decode($request->getContent(), true);

        if (!$payload || !isset($payload['data'])) {
            return $this->json(['error' => 'Invalid JSON payload. Expected {"data": {...}}'], 400);
        }

        $message = new IncomingImportMessage($payload['data']);

        $bus->dispatch($message);

        $messageId = bin2hex(random_bytes(16));

        return $this->json([
            'status' => 'accepted',
            'message_id' => $messageId
        ], 200);
    }
}