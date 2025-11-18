<?php

namespace App\Services\Agreement;

use App\Models\Contract;
use App\Repositories\Agreement\AgreementDocRepository;
use App\Repositories\Agreement\AgreementPaymentDetailRepository;
use App\Repositories\Agreement\AgreementPaymentRepository;
use App\Repositories\Agreement\AgreementRepository;
use App\Repositories\Agreement\AgreementTenantRepository;
use App\Repositories\Agreement\AgreementUnitRepository;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class AgreementDocumentService
{
    public function __construct(
        protected AgreementRepository $agreementRepository,
        protected AgreementDocRepository $agreementDocRepository,
        protected AgreementTenantRepository $agreementTenantRepository,


    ) {}
    public function storeDocuments($agreement, array $documents, $addedBy)
    {
        // dd($agreement);
        if (empty($documents)) {
            return;
        }

        foreach ($documents as $doc) {
            // Validate document fields

            $validator = Validator::make($doc, [
                'document_type' => 'nullable|string|max:255',
                'document_number' => 'required_with:document_path|nullable|string|max:255',
                'document_path' => [
                    'required_with:document_number',
                    function ($attribute, $value, $fail) {
                        if (!empty($value) && !$value instanceof \Illuminate\Http\UploadedFile) {
                            $fail('The document must be a valid uploaded file.');
                        }
                    },
                ],
            ], [
                'document_number.required_with' => 'Document number is required when a file is uploaded.',
                'document_path.required_with' => 'Document file is required when a document number is provided.',
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }
            if (
                empty($doc['document_number']) ||
                empty($doc['document_path']) ||
                !($doc['document_path'] instanceof UploadedFile)
            ) {
                continue;
            }

            // Store file
            $path = $doc['document_path']->store('agreements/documents', 'public');
            // dd($agreement);

            $doc_data = [
                'agreement_id' => $agreement->id,
                'document_type' => $doc['document_type'] ?? null,
                'document_number' => $doc['document_number'] ?? null,
                'original_document_path' => $path,
                'original_document_name' => $doc['document_path']->getClientOriginalName(),
                'added_by' => $addedBy,
            ];

            // Create record
            $createdDoc = $this->agreementDocRepository->create($doc_data);


            // Update flag based on document type
            $this->updateAgreementFlags($agreement, $createdDoc->document_type);
        }
    }

    /**
     * Update agreement document upload status flags.
     */
    private function updateAgreementFlags($agreement, $type)
    {
        $flagMap = [
            1 => 'is_passport_uploaded',
            2 => 'is_emirates_id_uploaded',
            3 => 'is_trade_license_uploaded',
            4 => 'is_visa_uploaded',
            5 => 'is_signed_agreement_uploaded'
        ];

        if (isset($flagMap[$type])) {
            $agreement->{$flagMap[$type]} = 1;
            $agreement->save();
        }
    }
    public function update($agreement, array $documents, $updatedBy)
    {
        // dd($documents);
        if (empty($documents)) {
            return;
        }

        // // Fetch existing document IDs from the form, if present
        // $existingIds = array_filter(array_column($documents, 'id') ?? []);

        // // Delete documents that were removed in the form
        // $agreement->documents()
        //     ->whereNotIn('id', $existingIds)
        //     ->get()
        //     ->each(function ($doc) {
        //         Storage::disk('public')->delete($doc->original_document_path);
        //         $doc->delete();
        //     });

        foreach ($documents as $doc) {
            // If document is existing, update it
            if (!empty($doc['id'])) {
                $existingDoc = $agreement->agreement_documents()->find($doc['id']);
                // dd($existingDoc);
                if ($existingDoc) {
                    $existingDoc->document_number = $doc['document_number'] ?? $existingDoc->document_number;

                    if (!empty($doc['document_path']) && $doc['document_path'] instanceof UploadedFile) {
                        // Delete old file
                        Storage::disk('public')->delete($existingDoc->original_document_path);

                        // Store new file
                        $path = $doc['document_path']->store('agreements/documents', 'public');
                        $existingDoc->original_document_path = $path;
                        $existingDoc->original_document_name = $doc['document_path']->getClientOriginalName();
                    }

                    $existingDoc->save();
                    $this->updateAgreementFlags($agreement, $existingDoc->document_type);
                }
                continue;
            }

            // If document is new, create it
            if (
                empty($doc['document_number']) ||
                empty($doc['document_path']) ||
                !($doc['document_path'] instanceof UploadedFile)
            ) {
                continue;
            }

            // Store file
            $path = $doc['document_path']->store('agreements/documents', 'public');

            $doc_data = [
                'agreement_id' => $agreement->id,
                'document_type' => $doc['document_type'] ?? null,
                'document_number' => $doc['document_number'] ?? null,
                'original_document_path' => $path,
                'original_document_name' => $doc['document_path']->getClientOriginalName(),
                'updated_by' => $updatedBy,
                'added_by' => $updatedBy
            ];

            $createdDoc = $this->agreementDocRepository->create($doc_data);
            $this->updateAgreementFlags($agreement, $createdDoc->document_type);
        }
    }
    public function getDocuments($id)
    {
        return $this->agreementDocRepository->getDocuments($id);
    }
}
