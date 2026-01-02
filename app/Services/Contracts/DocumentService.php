<?php

namespace App\Services\Contracts;

use App\Repositories\Contracts\ContractRepository;
use App\Repositories\Contracts\DocumentRepository;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class DocumentService
{
    public function __construct(
        protected DocumentRepository $documentRepo,
        protected ContractRepository $contractRepo,
    ) {}

    public function getAll()
    {
        return $this->documentRepo->all();
    }

    public function getById($id)
    {
        return $this->documentRepo->find($id);
    }

    public function getByContractId($id)
    {
        return $this->documentRepo->findByContractId($id);
    }

    public function uploadDocuments($data)
    {
        // dd($data);
        $contractStatus = null;
        $contractId = $data['contract_id'];
        // print($contractId);
        $result = Arr::except($data, ['contract_id', '_token']);

        $hasFile = !empty(array_filter($result, function ($item) {
            return isset($item['file']) && !empty($item['file']);
        }));

        if (!$hasFile) {
            // Throw an exception that can be caught in controller
            throw ValidationException::withMessages([
                'file' => 'At least one file must be uploaded.'
            ]);
        }


        // foreach ($result as $key => $value) {
        //     if (!empty($value['file'])) {
        //         // dd($value["file"]);
        //         $cDocument = $this->documentRepo->findByDocumentType($contractId, $value['document_type']);
        //         // dd(!$cDocument->isEmpty());
        //         // dump($value['document_type']);
        //         // dump('Before IF:', $value['file'], !empty($value['file']));


        //         $documentData = [];
        //         $contract = $this->contractRepo->find($contractId);
        //         // dump($key);
        //         // dump(!$cDocument);
        //         if ($contract->{$value['status_change']} == 1 && $cDocument) {
        //             if (
        //                 $cDocument->original_document_name && Storage::disk('public')->exists($cDocument->original_document_path) ||
        //                 $cDocument->signed_document_name && Storage::disk('public')->exists($cDocument->signed_document_path)
        //             ) {
        //                 Storage::disk('public')->delete($cDocument->original_document_path);
        //             }
        //         }

        //         $filename = time() . '_' . $value["file"]->getClientOriginalName();
        //         $path = $value["file"]->storeAs('projects/' . $contract->project_code . '/contract_documents', $filename, 'public');

        //         $documentData['document_type_id'] = $value['document_type'];
        //         $documentData['contract_id'] = $contractId;


        //         if (isset($value['signed_contract'])) {
        //             $documentData['signed_document_name'] = $filename;
        //             $documentData['signed_document_path'] = $path;
        //             $documentData['signed_status'] = 2;
        //             $contractStatus = 7;

        //             if (!$cDocument || $cDocument->original_document_name == null) {
        //                 $documentData['original_document_name'] = $filename;
        //                 $documentData['original_document_path'] = $path;
        //             }
        //         } else {
        //             $documentData['original_document_name'] = $filename;
        //             $documentData['original_document_path'] = $path;
        //         }
        //         // dd($documentData);
        //         // dump(!$cDocument->isEmpty());
        //         if ($cDocument) {
        //             // dump('inside if update');
        //             $documentData['updated_by'] = auth()->user()->id;
        //             $this->documentRepo->update($cDocument->id, $documentData);
        //         } else {
        //             // dump('inside if create');
        //             $documentData['added_by'] = auth()->user()->id;
        //             $this->documentRepo->create($documentData);
        //         }

        //         $this->contractFlagUpdate($contractId, $value['status_change'], $contractStatus);
        //     }
        // }
        foreach ($result as $key => $value) {

            if (!empty($value['file'])) {

                // Find existing document, make sure it returns a SINGLE model
                $cDocument = $this->documentRepo->findByDocumentType($contractId, $value['document_type']);
                if ($cDocument && $cDocument->isEmpty()) {
                    $cDocument = null; // in case repository returns empty collection
                }

                $contract = $this->contractRepo->find($contractId);
                $documentData = [];

                // Delete old files if needed
                if ($contract->{$value['status_change']} == 1 && $cDocument) {
                    if (
                        ($cDocument->original_document_name && Storage::disk('public')->exists($cDocument->original_document_path)) ||
                        ($cDocument->signed_document_name && Storage::disk('public')->exists($cDocument->signed_document_path))
                    ) {
                        Storage::disk('public')->delete($cDocument->original_document_path);
                    }
                }

                // Clean filename: replace spaces with underscores
                $filename = time() . '_' . str_replace(' ', '_', $value['file']->getClientOriginalName());

                // Store the file on public disk and get RELATIVE path
                $path = $value['file']->storeAs(
                    'projects/' . $contract->project_code . '/contract_documents',
                    $filename,
                    'public'
                );

                // Prepare data for DB
                $documentData['document_type_id'] = $value['document_type'];
                $documentData['contract_id'] = $contractId;

                if (isset($value['signed_contract'])) {
                    $documentData['signed_document_name'] = $filename;
                    $documentData['signed_document_path'] = $path;
                    $documentData['signed_status'] = 2;
                    $contractStatus = 7;

                    if (!$cDocument || $cDocument->original_document_name == null) {
                        $documentData['original_document_name'] = $filename;
                        $documentData['original_document_path'] = $path;
                    }
                } else {
                    $documentData['original_document_name'] = $filename;
                    $documentData['original_document_path'] = $path;
                }

                // Add user info
                if ($cDocument && $cDocument->id) {
                    $documentData['updated_by'] = auth()->user()->id;
                    $this->documentRepo->update($cDocument->id, $documentData);
                } else {
                    $documentData['added_by'] = auth()->user()->id;
                    $this->documentRepo->create($documentData);
                }

                $this->contractFlagUpdate($contractId, $value['status_change'], $contractStatus);

                // Debug log (optional)
                \Log::info('Saved document:', $documentData);
            }
        }


        return true;
    }

    public function contractFlagUpdate($contractId, $flag, $contractStatus)
    {
        $contract = $this->contractRepo->find($contractId);

        if ($contract->contract_status < $contractStatus && $contract->approved_by != null && $contractStatus != null) {
            $contract->contract_status = $contractStatus;
        }

        $contract->{$flag} = 1;
        $contract->save();
    }
}
