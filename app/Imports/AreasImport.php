<?php

namespace App\Imports;

use App\Models\ImportBatch;
use Illuminate\Support\Collection;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use App\Services\AreaImportService;
use Maatwebsite\Excel\Events\AfterImport;
use Illuminate\Support\Facades\Log;

class AreasImport implements ToCollection, WithChunkReading, WithBatchInserts, ShouldQueue
{
    protected AreaImportService $service;
    protected int $user_id;
    protected int $batch_id;

    public function __construct(AreaImportService $service, int $user_id, int $batch_id)
    {
        $this->service = $service;
        $this->user_id = $user_id;
        $this->batch_id = $batch_id;
    }

    public function collection(Collection $rows)
    {
        $this->service->save($rows, $this->user_id, $this->batch_id);
    }

    public function chunkSize(): int
    {
        return 1000; // read 1000 rows per chunk
    }

    public function batchSize(): int
    {
        return 1000; // insert 1000 rows per batch
    }

    public function registerEvents(): array
    {
        return [
            AfterImport::class => function (AfterImport $event) {
                $batch = ImportBatch::find($this->batch_id);
                $batch->update(['status' => 'completed']);
            }
        ];
    }
}
