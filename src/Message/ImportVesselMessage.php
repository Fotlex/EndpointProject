<?php

namespace App\Message;

class ImportVesselMessage
{
    public function __construct(
        private readonly array $data
    ) {
    }

    public function getData(): array
    {
        return $this->data;
    }
}