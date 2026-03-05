<?php

namespace App\MessageHandler;

use App\Message\ImportCompanyMessage;
use App\Message\ImportPortMessage;
use App\Message\ImportVesselMessage;
use App\Message\IncomingImportMessage;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Messenger\MessageBusInterface;

#[AsMessageHandler]
class IncomingImportMessageHandler
{
    public function __construct(
        private readonly MessageBusInterface $bus
    ) {
    }

    public function __invoke(IncomingImportMessage $message): void
    {
        $data = $message->getData();

        if (!empty($data['vessels']) && is_array($data['vessels'])) {
            $this->bus->dispatch(new ImportVesselMessage($data['vessels']));
        }

        if (!empty($data['ports']) && is_array($data['ports'])) {
            $this->bus->dispatch(new ImportPortMessage($data['ports']));
        }

        if (!empty($data['companies']) && is_array($data['companies'])) {
            $this->bus->dispatch(new ImportCompanyMessage($data['companies']));
        }
    }
}