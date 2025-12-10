<?php

namespace App\Services\Contracts;

use App\Repositories\Contracts\ContractRepository;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use setasign\Fpdi\Tcpdf\Fpdi;

class VendorContractSign
{
    public function __construct(
        protected ContractRepository $contractRepo,
    ) {}

    public function addImageToPdf($contract_id)
    {
        $contract = $this->contractRepo->find($contract_id);
        $vendor = $contract->vendor;

        // dd($contract->contract_documents);
        $fullPath = '';
        foreach ($contract->contract_documents as $documents) {
            if ($documents->document_type_id == 1) {
                $fullPath = $documents->original_document_path;
            }
        }
        // ------------------------
        // Configuration
        // ------------------------
        $gsPath = env('GHOSTSCRIPT_PATH');
        // $fullPath = $contract->contract_document->original_document_path;
        $inputPdf = storage_path('app/public/' . $fullPath);  // Input PDF //'app/public/pdf/original2.pdf'
        $outputDir = dirname('app/public/' . $fullPath);
        $fileName = basename($fullPath);
        $withoutExt = pathinfo($fullPath, PATHINFO_FILENAME);          // Output folder
        $signature = public_path('img/signature.png'); // Signature image
        $convertedPdf = storage_path($outputDir . '/converted/' . $withoutExt . '_converted.pdf');
        $finalPdf = storage_path($outputDir . '/signed/' . $withoutExt . '_signed.pdf');

        $gsPath        = str_replace('\\', '/', $gsPath);
        $convertedPdf  = str_replace('\\', '/', $convertedPdf);
        $inputPdf      = str_replace('\\', '/', $inputPdf);
        $finalPdf      = str_replace('\\', '/', $finalPdf);
        $signature      = str_replace('\\', '/', $signature);

        // ------------------------
        // Step 1: Ensure output folder exists
        // ------------------------
        if (!file_exists($outputDir)) {
            mkdir($outputDir, 0777, true);
        }

        if (!file_exists(dirname($convertedPdf))) {
            mkdir(dirname($convertedPdf), 0777, true);
        }

        if (!file_exists(dirname($finalPdf))) {
            mkdir(dirname($finalPdf), 0777, true);
        }


        // dd(file_exists($inputPdf), $inputPdf);

        // ------------------------
        // Step 2: Convert PDF to 1.4 using Ghostscript
        // ------------------------

        if (!file_exists($signature)) {
            dd("Signature file missing", $signature);
        }

        // dd($signature);

        $cmd = "\"$gsPath\" -sDEVICE=pdfwrite -dCompatibilityLevel=1.4 -dNOPAUSE -dQUIET -dBATCH -sOutputFile=\"$convertedPdf\" \"$inputPdf\"";

        exec($cmd . " 2>&1", $outputLog, $returnVar);
        // dd($returnVar, $outputLog);
        if ($returnVar !== 0) {
            return response()->json([
                'status' => 'error',
                'message' => 'Ghostscript conversion failed',
                'log' => $outputLog
            ]);
        }
        // dd($finalPdf);

        if (!file_exists($convertedPdf)) {
            return response()->json(['status' => 'error', 'message' => 'Converted PDF not found.']);
        }
        // ------------------------
        // Step 3: Add image using FPDI-TCPDF
        // ------------------------
        $pdf = new Fpdi();
        $pageCount = $pdf->setSourceFile($convertedPdf);

        for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
            $tpl = $pdf->importPage($pageNo);
            $pdf->AddPage();
            $pdf->useTemplate($tpl);

            // Add image on specific pages
            if ($pageNo == 1) {
                $pdf->Image($signature, 135, 243, 40); // Adjust X, Y, Width
            }
            if ($pageNo == 2) {
                $pdf->Image($signature, 135, 232, 40);
            }
        }

        // Save final PDF
        $pdf->Output($finalPdf, 'F');
        dd($finalPdf);
        return response()->json([
            'status' => 'success',
            'message' => 'PDF updated successfully',
            'file' => $finalPdf
        ]);
    }
}
