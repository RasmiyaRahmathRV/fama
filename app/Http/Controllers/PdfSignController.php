<?php

namespace App\Http\Controllers;

use App\Jobs\SignAndSendJob;
use App\Models\ContractSignedEmail;
use App\Repositories\Contracts\ContractRepository;
use App\Repositories\Contracts\DocumentRepository;
use App\Services\Contracts\ContractService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use setasign\Fpdi\Tcpdf\Fpdi;
use TCPDF;

class PdfSignController extends Controller
{
    public function __construct(
        protected ContractService $contractService,
        protected ContractRepository $contractRepo,
        protected DocumentRepository $documentRepo,
    ) {}

    public function signedPdf($id)
    {
        $title = "Sign Vendor Contract";
        $contract = $this->contractService->getAllDataById($id);
        $vendorContract = $this->documentRepo->findByDocumentType($id, 1);
        return view('admin.projects.contract.signature-append', compact("title", 'contract', 'vendorContract'));
    }


    // public function convertPdfWithGhostscript($inputPdf)
    // {
    //     // Directories
    //     $convertedDir = storage_path('app/public/converted');
    //     if (!file_exists($convertedDir)) mkdir($convertedDir, 0777, true);

    //     $convertedPdf = $convertedDir . '/converted_' . basename($inputPdf);


    //     // ----------------------------
    //     // Step 1: Ghostscript conversion to PDF 1.4
    //     // ----------------------------
    //     $gsPath = env('GHOSTSCRIPT_PATH'); // Example: "C:/Program Files/gs/gs10.06.0/bin/gswin64c.exe"
    //     $cmd = "\"$gsPath\" -sDEVICE=pdfwrite -dCompatibilityLevel=1.4 -dNOPAUSE -dQUIET -dBATCH -sOutputFile=\"$convertedPdf\" \"$inputPdf\"";
    //     exec($cmd . " 2>&1", $outputLog, $returnVar);

    //     if ($returnVar !== 0 || !file_exists($convertedPdf)) {
    //         return response()->json([
    //             'status' => 'error',
    //             'message' => 'Ghostscript conversion failed',
    //             'log' => $outputLog
    //         ]);
    //     }

    //     return $convertedPdf;
    // }


    // public function saveSignedPdf(Request $request)
    // {
    //     // dd($request->contract_id);
    //     SignAndSendJob::dispatch(
    //         $request->contract_id,
    //         str_replace(asset('storage/'), '', $request->pdf_path),
    //         auth()->user()->id
    //     );

    //     return response()->json([
    //         'status' => 'error',
    //         'message' => 'This contract is already being processed. Please wait.'
    //     ]);
    // }

    public function saveSignedPdf(Request $request)
    {
        $contract = $this->contractRepo->find($request->contract_id);

        $contract1 = $contract;
        $contract1->is_processing = true;
        $contract1->save();

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

        $withoutExt = pathinfo($fullPath, PATHINFO_FILENAME);          // Output folder
        $signature = public_path('img/signature.png'); // Signature image
        $convertedPdf = storage_path($outputDir . '/converted/' . $withoutExt . '_converted.pdf');
        $savefinalPdf = $outputDir . '/signed/' . $withoutExt . '_signed.pdf';
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

        // -----------------------
        // 1. Ghostscript Convert
        // -----------------------
        $convertedPdf = $this->convertPdfWithGhostscript($inputPdf);

        // -----------------------
        // 2. Sign PDF with FPDI
        // -----------------------
        $pdf = new Fpdi('P', 'mm');
        $pageCount = $pdf->setSourceFile($convertedPdf);

        for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {

            $tpl = $pdf->importPage($pageNo);
            $size = $pdf->getTemplateSize($tpl);

            $pdf->AddPage($size['orientation'], [$size['width'], $size['height']]);
            $pdf->useTemplate($tpl);

            // Get coordinates based on odd/even
            $coords = $this->convertFrontendToPdfCoords($contract, $pageNo);

            $pdf->Image($signature, $coords['x'], $coords['y'], $coords['width']);
        }

        $pdf->Output($finalPdf, 'F');

        // -----------------------
        // 3. Email the PDF
        // -----------------------
        $recipientEmail = 'rahmathrasmiya@gmail.com' ?? 'default@mail.com'; //$contract->vendor->email
        $recipientName  = $contract->vendor->vendor_name ?? 'Vendor';

        Mail::send('emails.pdf_sent', [
            'pdfPath' => $finalPdf,
            'pdfName' => basename($finalPdf),
            'recipientName' => $recipientName
        ], function ($message) use ($recipientEmail) {
            $message->to($recipientEmail)->subject('Signed PDF Document');
        });

        // Update contract
        $contractdocu = $contract->contract_documents->where('document_type_id', 1)->first();
        $contractdocu->signed_document_path = str_replace('app/public/', '', $savefinalPdf);
        $contractdocu->signed_document_name = basename($finalPdf);
        $contractdocu->signed_status = 1;
        $contractdocu->save();

        $email = new ContractSignedEmail();
        $email->contract_id   = $contract->id;
        $email->vendor_id     = $contract->vendor_id;
        $email->email_to      = $recipientEmail;
        $email->email_subject = 'Signed PDF Document';
        $email->email_body    = "PDF attached: " . basename($finalPdf);
        $email->save();

        $contract->signed_at = now();
        $contract->contract_status = '6'; // Signed
        $contract->signed_by = auth()->user()->id;
        $contract->is_processing = false;
        $contract->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Contract signed and emailed successfully.'
        ]);
    }

    public function convertPdfWithGhostscript($inputPdf)
    {
        $convertedDir = storage_path('app/public/converted');
        if (!file_exists($convertedDir)) mkdir($convertedDir, 0777, true);

        $convertedPdf = $convertedDir . '/converted_' . basename($inputPdf);

        $gsPath = env('GHOSTSCRIPT_PATH');
        $cmd = "\"$gsPath\" -sDEVICE=pdfwrite -dCompatibilityLevel=1.4 -dNOPAUSE -dQUIET -dBATCH -sOutputFile=\"$convertedPdf\" \"$inputPdf\"";

        exec($cmd . " 2>&1", $outputLog, $returnVar);

        if ($returnVar !== 0) {
            throw new \Exception("Ghostscript failed: " . json_encode($outputLog));
        }

        return $convertedPdf;
    }


    public function convertFrontendToPdfCoords($contract, $pageNo)
    {
        $dimension = $contract->vendor->contract_template->contract_signature_dimensions;

        if ($pageNo % 2 !== 0) {
            $d = $dimension->where('page_type', 'odd')->first();
        } else {
            $d = $dimension->where('page_type', 'even')->first();
        }

        return [
            'x'     => $d->x,
            'y'     => $d->y,
            'width' => $d->width,
        ];
    }
}
