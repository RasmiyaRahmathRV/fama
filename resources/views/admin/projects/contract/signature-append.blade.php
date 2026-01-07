@extends('admin.layout.admin_master')

@section('custom_css')
    <style>
        #pdf-container {
            position: relative;
        }

        .pdf-page {
            position: relative;
            margin-bottom: 20px;
        }
    </style>
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{ $title }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                            <li class="breadcrumb-item active">Contract</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">{{ $title }}</h3>
                            </div>
                            <div class="card-body">
                                <div id="pdf-container"></div>
                                <button id="save-sign" class="btn btn-info">Sign & Send</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('custom_js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.min.js"></script>
    <script>
        pdfjsLib.GlobalWorkerOptions.workerSrc = "{{ asset('js/pdf.worker.js') }}";

        const container = document.getElementById('pdf-container');
        const pdfUrl = "{{ asset('storage/' . $vendorContract->original_document_path) }}"; // uploaded PDF

        const loadingTask = pdfjsLib.getDocument(pdfUrl);
        loadingTask.promise.then(async pdf => {
            const numPages = pdf.numPages;

            for (let i = 1; i <= numPages; i++) {
                const page = await pdf.getPage(i);
                const viewport = page.getViewport({
                    scale: 1.5
                });

                // Page container
                const pageDiv = document.createElement('div');
                pageDiv.classList.add('pdf-page');
                pageDiv.style.width = viewport.width + 'px';
                pageDiv.style.height = viewport.height + 'px';
                container.appendChild(pageDiv);

                // Canvas
                const canvas = document.createElement('canvas');
                canvas.width = viewport.width;
                canvas.height = viewport.height;
                pageDiv.appendChild(canvas);
                const context = canvas.getContext('2d');
                await page.render({
                    canvasContext: context,
                    viewport: viewport
                }).promise;
            }
        });

        // Sign & Send button
        $('#save-sign').on('click', function() {

            showLoader('Processing contract...', 'Please wait while the PDF is converted, signed, and emailed.');


            $.ajax({
                type: "POST",
                dataType: "json",
                url: "{{ url('save-signed-pdf') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    pdf_path: "{{ asset('storage/' . $vendorContract->original_document_path) }}",
                    contract_id: {{ $contract->id }}
                },

                // processData: false,
                // contentType: false,
                success: function(response) {
                    // console.log(response);
                    hideLoader();
                    toastr.success(response.message);
                    window.location.href = "{{ route('contract.index') }}";
                },
                error: function(errors) {
                    hideLoader();
                    toastr.error(errors.responseJSON.message);
                }
            });


            // $.ajax({
            //     url: ,
            //     type: 'POST',
            //     dataType: 'json',


            //     success: function(data) {
            //         toastr.success(data.message);
            //         // alert('Signed PDF sent successfully!');
            //     },
            //     error: function(xhr, status, error) {
            //         toastr.error(xhr.responseText);
            //         window.location.href = "{{ route('contract.index') }}";
            //         // toast.error(xhr.responseText);
            //         // alert('Error signing PDF.');
            //     }
            // });
        });
    </script>
@endsection
