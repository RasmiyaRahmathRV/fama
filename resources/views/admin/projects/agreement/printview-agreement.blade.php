@extends('admin.layout.admin_master')
@section('custom_css')
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section class="content">
            <div class="container-fluid p-5">
                @include('admin.projects.agreement.partials.agreement_content', [
                    'agreement' => $agreement,
                ])
                {{-- {{ dd($agreement) }} --}}

                <div class="mt-5" align="center">
                    <a href="agreement.php" class="btn btn-default">back</a>
                    <a href="{{ route('agreement.print', $agreement->id) }}" rel="noopener" target="_blank"
                        class="btn btn-info">Print</a>
                </div>

            </div><!-- /.container-fluid -->


        </section>
        <!-- /.content -->
    </div>
@endsection
@section('custom_js')
    <!-- jQuery -->
    <script src="{{ asset('assets/jquery/jquery.min.js"') }}></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('assets/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('js/adminlte.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('/js/demo.js') }}"></script>
@endsection
