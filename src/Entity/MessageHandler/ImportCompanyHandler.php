<?php

namespace App\MessageHandler;

use App\Entity\Company;
use App\Message\ImportCompanyMessage;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class ImportCompanyHandler
{
    public function __construct(private EntityManagerInterface $em) {}

    public function __invoke(ImportCompanyMessage $message): void
    {
        foreach ($message->getData() as $item) {
            $company = $this->em->getRepository(Company::class)->findOneBy(['taxId' => $item['tax_id']]) ?? new Company();
            $company->setTaxId($item['tax_id']);
            $company->setName($item['name']);
            $this->em->persist($company);
        }
        $this->em->flush();
    }
}