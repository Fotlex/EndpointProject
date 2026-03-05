<?php

namespace App\MessageHandler;

use App\Entity\Port;
use App\Message\ImportPortMessage;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class ImportPortHandler
{
    public function __construct(private EntityManagerInterface $em) {}

    public function __invoke(ImportPortMessage $message): void
    {
        foreach ($message->getData() as $item) {
            $port = $this->em->getRepository(Port::class)->findOneBy(['code' => $item['code']]) ?? new Port();
            $port->setCode($item['code']);
            $port->setName($item['name']);
            $port->setCountry($item['country']);
            $this->em->persist($port);
        }
        $this->em->flush();
    }
}