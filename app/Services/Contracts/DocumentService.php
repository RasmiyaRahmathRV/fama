<?php

namespace App\Services\Contracts;

use App\Repositories\Contracts\DocumentRepository;

class DocumentService
{
    public function __construct(
        protected DocumentRepository $documentRepo,
    ) {}

    public function getAll()
    {
        return $this->documentRepo->all();
    }

    public function getById($id)
    {
        return $this->documentRepo->find($id);
    }
}
