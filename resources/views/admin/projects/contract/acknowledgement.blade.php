@extends('admin.layout.admin_master')
@section('custom_css')
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/fontawesome-free/css/all.min.css') }}">
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
            <div id="printablediv" class="page table-responsive common-table">
                @include('admin.projects.contract.includes.acknowledgement_content', [
                    'contract' => $contract,
                ])


            </div>
            <table width="84%" border="0" align="center" cellpadding="30">
                <tr>
                    <td>
                        <table width="85%" border="0" align="center" cellpadding="30">
                            <tr>
                                <td>
                                    <div align="center" class="noprint">

                                        <a href="{{ route('contract.documents', $contract->id) }}" rel="noopener"
                                            class="btn btn-info"><i class="fas mr-2 fa-arrow-left"></i> Back</a>
                                        <a href="{{ route('contracts.acknowledgement.print', $contract->id) }}"
                                            rel="noopener" target="_blank" class="btn btn-success pull-right">Print</a>
                                    </div>
                                    <br><br>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </section>
        <!-- /.content -->
    </div>
@endsection
@section('custom_js')
    <!-- jQuery -->
    <script src="{{ asset('assets/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('assets/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <script>
        function printDiv(divID) {

            //Get the HTML of div

            var divElements = document.getElementById(divID).innerHTML;

            //Get the HTML of whole page

            var oldPage = document.body.innerHTML;

            //Reset the page's HTML with div's HTML only

            document.body.innerHTML =

                "<html><head><title></title></head><body>" +

                divElements + "</body>";

            //Print Page

            window.print();

            //Restore orignal HTML

            document.body.innerHTML = oldPage;

        }
    </script>
@endsection
