<?php

namespace App\MessageHandler;

use App\Entity\Vessel;
use App\Message\ImportVesselMessage;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class ImportVesselHandler
{
    public function __construct(private EntityManagerInterface $em) {}

    public function __invoke(ImportVesselMessage $message): void
    {
        foreach ($message->getData() as $item) {
            $vessel = $this->em->getRepository(Vessel::class)->findOneBy(['imo' => $item['imo']]) ?? new Vessel();
            $vessel->setImo($item['imo']);
            $vessel->setName($item['name']);
            $vessel->setFlag($item['flag']);
            $this->em->persist($vessel);
        }
        $this->em->flush();
    }
}