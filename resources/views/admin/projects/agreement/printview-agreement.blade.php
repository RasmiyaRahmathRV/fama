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
                <table width="1025" border="2" align="center" cellpadding="0" cellspacing="0"
                    style="box-shadow:-4px 4px 20px #666" ;>
                    <tr height="21">
                        <td width="1025" colspan="6" bgcolor="#FFFFFF">
                            <table width="1025" height="80" border="0" align="center" cellpadding="5"
                                class="table0">
                                <tr>
                                    <td height="70">
                                        <table width="100%" height="70" border="0" align="center" cellpadding="10">
                                            <tr>
                                                <td height="66">
                                                    <strong>
                                                        <img width="280" height="90"
                                                            src="../images/Fama Real Estate Logo PNG.png" alt="fama-logo"
                                                            style="margin-left: 10px;" />
                                                    </strong>
                                                </td>
                                                <td>
                                                    <div align="right" style="margin-right: 10px; ">
                                                        <strong>
                                                            P.O. Box:32963, Dubai, U.A.E<br />
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td width="1025" colspan="6" bgcolor="#FFFFFF">
                            <table width="100%" border="1" align="center">
                                <tr>
                                    <td width="15%" bgcolor="#FFFFFF">
                                        <div align="center" class="text-sm text-sm">
                                            <strong> <span class="text-sm text-sm style14">Building
                                                    Management</span></strong>
                                        </div>
                                    </td>
                                    <td width="11%" bgcolor="#FFFFFF">
                                        <div align="center" class="text-sm text-sm">
                                            <strong> <span class="text-sm text-sm style14">Area</span></strong>
                                        </div>
                                    </td>
                                    <td width="15%" bgcolor="#FFFFFF">
                                        <div align="center" class="text-sm text-sm"><strong>Plot No:</strong></div>
                                    </td>
                                    <td width="15%" bgcolor="#FFFFFF">
                                        <div align="center" class="text-sm text-sm"><strong>Agreement Date:</strong></div>
                                    </td>
                                    <td rowspan="2">
                                        <div align="center" class="text-sm text-sm style72 style8">
                                            <strong>Flat No.</strong>
                                        </div>
                                        <div align="center" class="style72"><strong>102</strong></div>
                                    </td>
                                    <td width="16%">
                                        <div align="center" class="text-sm text-sm"><strong>Unit Type:</strong></div>
                                    </td>
                                    <td width="15%">
                                        <div align="center" class="text-sm text-sm"><strong>3BHK</strong></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td bgcolor="#FFFFFF">
                                        <div align="center" class="text-sm text-sm">
                                            <strong>Primark properties</strong>
                                        </div>
                                    </td>
                                    <td bgcolor="#FFFFFF">
                                        <div align="center" class="text-sm text-sm">
                                            <strong>Al Barsha</strong>
                                        </div>
                                    </td>
                                    <td bgcolor="#FFFFFF">
                                        <div align="center" class="text-sm text-sm">
                                            <strong>438-217</strong>
                                        </div>
                                    </td>
                                    <td>
                                        <div align="center" class="text-sm text-sm">
                                            <strong>
                                                26/10/2022
                                            </strong>
                                        </div>
                                    </td>
                                    <td>
                                        <div align="center" class="text-sm text-sm">
                                            <strong>
                                                Building Name:</strong>
                                        </div>
                                    </td>
                                    <td>
                                        <div align="center" class="text-sm text-sm">
                                            <strong>
                                                Al Buhaira Building</strong>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td width="26.5%" bgcolor="#FFFFFF" colspan="2">
                                        <div class="text-sm text-sm ml-1">
                                            <strong> <span class="text-sm text-sm style14">Tenant Name:</span></strong>
                                        </div>
                                    </td>
                                    <td colspan="3" width="41.9%" bgcolor="#FFFFFF">
                                        <div class="text-sm text-sm ml-1">
                                            <strong> <span class="text-sm text-sm style14">FAATEH REAL
                                                    ESTATE</span></strong>
                                        </div>
                                    </td>
                                    <td width="33%" colspan="2" bgcolor="#FFFFFF">
                                        <div align="center" class="text-sm text-sm"><strong>Project No:</strong></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="26.5%" bgcolor="#FFFFFF" colspan="2">
                                        <div class="text-sm text-sm ml-1">
                                            <strong> <span class="text-sm text-sm style14">Mobile Number</span></strong>
                                        </div>
                                    </td>
                                    <td bgcolor="#FFFFFF" colspan="2" width="30.9%">
                                        <div align="center" class="text-sm text-sm">
                                            <strong>056-8856995</strong>
                                        </div>
                                    </td>
                                    <td>
                                        <div align="center" class="text-sm text-sm">
                                            <strong>
                                                Email
                                            </strong>
                                        </div>
                                    </td>
                                    <td colspan="2">
                                        <div align="center" class="text-sm text-sm">
                                            <strong>
                                                Adil@faateh.ae</strong>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td width="26.5%" bgcolor="#FFFFFF" colspan="2">
                                        <div class="text-sm text-sm ml-1">
                                            <strong> <span class="text-sm text-sm style14">Contact Person</span></strong>
                                        </div>
                                    </td>
                                    <td bgcolor="#FFFFFF" colspan="2" width="30.9%">
                                        <div align="center" class="text-sm text-sm">
                                            <strong>Adil Faridi</strong>
                                        </div>
                                    </td>
                                    <td>
                                        <div align="center" class="text-sm text-sm">
                                            <strong>
                                                TRN No.
                                            </strong>
                                        </div>
                                    </td>
                                    <td>
                                        <div align="center" class="text-sm text-sm">
                                            <strong></strong>
                                        </div>
                                    </td>
                                    <td>
                                        <div align="center" class="text-sm text-sm">
                                            <strong></strong>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td width="26.5%" bgcolor="#FFFFFF" colspan="2">
                                        <div class="text-sm text-sm ml-1">
                                            <strong> <span class="text-sm text-sm style14">Start Date</span></strong>
                                        </div>
                                    </td>
                                    <td bgcolor="#FFFFFF">
                                        <div align="center" class="text-sm text-sm">
                                            <strong></strong>
                                        </div>
                                    </td>
                                    <td bgcolor="#FFFFFF">
                                        <div align="center" class="text-sm text-sm">
                                            <strong>Months/Days</strong>
                                        </div>
                                    </td>
                                    <td>
                                        <div align="center" class="text-sm text-sm">
                                            <strong>
                                                12M-0D
                                            </strong>
                                        </div>
                                    </td>
                                    <td>
                                        <div align="center" class="text-sm text-sm">
                                            <strong>Expiry</strong>
                                        </div>
                                    </td>
                                    <td>
                                        <div align="center" class="text-sm text-sm">
                                            <strong></strong>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td width="26.5%" bgcolor="#FFFFFF" colspan="2">
                                        <div class="text-sm text-sm ml-1">
                                            <strong> <span class="text-sm text-sm style14">Rent Charges P.A</span></strong>
                                        </div>
                                    </td>
                                    <td bgcolor="#FFFFFF">
                                        <div class="text-sm text-sm ml-1">
                                            <strong>0.00</strong>
                                        </div>
                                    </td>
                                    <td bgcolor="#FFFFFF">
                                        <div align="center" class="text-sm text-sm">
                                            <strong>Installments</strong>
                                        </div>
                                    </td>
                                    <td>
                                        <div align="center" class="text-sm text-sm">
                                            <strong>
                                                12 cheques
                                            </strong>
                                        </div>
                                    </td>
                                    <td colspan="2">
                                        <div align="center" class="text-sm text-sm">
                                            <strong>VAT Breakups</strong>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td width="26.5%" bgcolor="#FFFFFF" colspan="2">
                                        <div class="text-sm text-sm ml-1">
                                            <strong> <span class="text-sm text-sm style14">Rent for Period</span></strong>
                                        </div>
                                    </td>
                                    <td bgcolor="#FFFFFF" colspan="3" width="41.9%">
                                        <div class="text-sm text-sm ml-1">
                                            <strong>0.00</strong>
                                        </div>
                                    </td>
                                    <td bgcolor="#FFFFFF">
                                        <div class="text-sm text-sm ml-1">
                                            <strong>Rent</strong>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-sm text-sm ml-1">
                                            <strong>
                                                0.00
                                            </strong>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td width="26.5%" bgcolor="#FFFFFF" colspan="2">
                                        <div class="text-sm text-sm ml-1">
                                            <strong> <span class="text-sm text-sm style14">Commission</span></strong>
                                        </div>
                                    </td>
                                    <td bgcolor="#FFFFFF" colspan="3" width="41.9%">
                                        <div class="text-sm text-sm ml-1">
                                            <strong>0.00</strong>
                                        </div>
                                    </td>
                                    <td bgcolor="#FFFFFF">
                                        <div class="text-sm text-sm ml-1">
                                            <strong>Commission</strong>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-sm text-sm ml-1">
                                            <strong>
                                                0.00
                                            </strong>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td width="26.5%" bgcolor="#FFFFFF" colspan="2">
                                        <div class="text-sm text-sm ml-1">
                                            <strong> <span class="text-sm text-sm style14">Refundable Security
                                                    Deposit</span></strong>
                                        </div>
                                    </td>
                                    <td bgcolor="#FFFFFF" colspan="3" width="41.9%">
                                        <div class="text-sm text-sm ml-1">
                                            <strong>0.00</strong>
                                        </div>
                                    </td>
                                    <td bgcolor="#FFFFFF">
                                        <div align="center" class="text-sm text-sm">
                                            <strong>RSD</strong>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-sm text-sm ml-1">
                                            <strong>
                                                0.00
                                            </strong>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td width="26.5%" bgcolor="#FFFFFF" colspan="2">
                                        <div class="text-sm text-sm ml-1">
                                            <strong> <span class="text-sm text-sm style14">DEWA Deposit</span></strong>
                                        </div>
                                    </td>
                                    <td bgcolor="#FFFFFF" colspan="3" width="41.9%">
                                        <div class="text-sm text-sm ml-1">
                                            <strong>0.00</strong>
                                        </div>
                                    </td>
                                    <td bgcolor="#FFFFFF">
                                        <div class="text-sm text-sm ml-1">
                                            <strong>DEWA Deposit</strong>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-sm text-sm ml-1">
                                            <strong>
                                                0.00
                                            </strong>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td width="26.5%" bgcolor="#FFFFFF" colspan="2">
                                        <div class="text-sm text-sm ml-1">
                                            <strong> <span class="text-sm text-sm style14">Admin Charges</span></strong>
                                        </div>
                                    </td>
                                    <td bgcolor="#FFFFFF" colspan="3" width="41.9%">
                                        <div class="text-sm text-sm ml-1">
                                            <strong>0.00</strong>
                                        </div>
                                    </td>
                                    <td bgcolor="#FFFFFF">
                                        <div class="text-sm text-sm ml-1">
                                            <strong>Admin Charges</strong>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-sm text-sm ml-1">
                                            <strong>
                                                0.00
                                            </strong>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td width="26.5%" bgcolor="#FFFFFF" colspan="2">
                                        <div class="text-sm text-sm ml-1">
                                            <strong> <span class="text-sm text-sm style14">Chiller</span></strong>
                                        </div>
                                    </td>
                                    <td bgcolor="#FFFFFF" colspan="3" width="41.9%">
                                        <div class="text-sm text-sm ml-1">
                                            <strong>0.00</strong>
                                        </div>
                                    </td>
                                    <td bgcolor="#FFFFFF">
                                        <div class="text-sm text-sm ml-1">
                                            <strong>Chiller</strong>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-sm text-sm ml-1">
                                            <strong>
                                                0.00
                                            </strong>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td width="26.5%" bgcolor="#FFFFFF" colspan="2">
                                        <div class="text-sm text-sm ml-1">
                                            <strong> <span class="text-sm text-sm style14">A/C Charges</span></strong>
                                        </div>
                                    </td>
                                    <td bgcolor="#FFFFFF" colspan="3" width="41.9%">
                                        <div class="text-sm text-sm ml-1">
                                            <strong>0.00</strong>
                                        </div>
                                    </td>
                                    <td bgcolor="#FFFFFF">
                                        <div class="text-sm text-sm ml-1">
                                            <strong>A/C Charges</strong>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-sm text-sm ml-1">
                                            <strong>
                                                0.00
                                            </strong>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td width="26.5%" bgcolor="#FFFFFF" colspan="2">
                                        <div class="text-sm text-sm ml-1">
                                            <strong> <span class="text-sm text-sm style14">Maint/Others</span></strong>
                                        </div>
                                    </td>
                                    <td bgcolor="#FFFFFF" colspan="3" width="41.9%">
                                        <div class="text-sm text-sm ml-1">
                                            <strong>0.00</strong>
                                        </div>
                                    </td>
                                    <td bgcolor="#FFFFFF">
                                        <div class="text-sm text-sm ml-1">
                                            <strong>Maint/Others</strong>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-sm text-sm ml-1">
                                            <strong>
                                                0.00
                                            </strong>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td width="26.5%" bgcolor="#FFFFFF" colspan="2">
                                        <div class="text-sm text-sm ml-1">
                                            <strong> <span class="text-sm text-sm style14">Ejari</span></strong>
                                        </div>
                                    </td>
                                    <td bgcolor="#FFFFFF" colspan="3" width="41.9%">
                                        <div class="text-sm text-sm ml-1">
                                            <strong>0.00</strong>
                                        </div>
                                    </td>
                                    <td bgcolor="#FFFFFF" colspan="2">
                                        <div align="center" class="text-sm text-sm">
                                            <strong></strong>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="26.5%" bgcolor="#FFFFFF" colspan="2">
                                        <div class="text-sm text-sm ml-1">
                                            <strong> <span class="text-sm text-sm style14">Misc</span></strong>
                                        </div>
                                    </td>
                                    <td bgcolor="#FFFFFF" colspan="3" width="41.9%">
                                        <div class="text-sm text-sm ml-1">
                                            <strong>0.00</strong>
                                        </div>
                                    </td>
                                    <td bgcolor="#FFFFFF">
                                        <div class="text-sm text-sm ml-1">
                                            <strong>Total VAT</strong>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-sm text-sm ml-1">
                                            <strong>
                                                0.00
                                            </strong>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="26.5%" bgcolor="#FFFFFF" colspan="2">
                                        <div class="text-sm text-sm ml-1">
                                            <strong> <span class="text-sm text-sm style14">VAT</span></strong>
                                        </div>
                                    </td>
                                    <td bgcolor="#FFFFFF" colspan="3" width="41.9%">
                                        <div class="text-sm text-sm ml-1">
                                            <strong>0.00</strong>
                                        </div>
                                    </td>
                                    <td bgcolor="#FFFFFF" colspan="2">
                                        <div align="center" class="text-sm text-sm">
                                            <strong>Purpose</strong>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="26.5%" bgcolor="#FFFFFF" colspan="2">
                                        <div class="text-sm text-sm ml-1">
                                            <strong> <span class="text-sm text-sm style14">Total Receivable</span></strong>
                                        </div>
                                    </td>
                                    <td bgcolor="#FFFFFF" colspan="3" width="41.9%">
                                        <div class="text-sm text-sm ml-1">
                                            <strong>0.00</strong>
                                        </div>
                                    </td>
                                    <td bgcolor="#FFFFFF" colspan="2">
                                        <div align="center" class="text-sm text-sm">
                                            <strong>Residential</strong>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="7">
                                        <div align="center" class="text-sm text-sm">
                                            <strong>Payment Schedule</strong>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr>
                        <td width="1025" colspan="6" bgcolor="#FFFFFF">
                            <table width="100%" border="1" align="center">
                                <tr>
                                    <td width="26.5%" bgcolor="#FFFFFF">
                                        <div align="center" class="text-sm text-sm">
                                            <strong> <span class="text-sm text-sm style14">Date</span></strong>
                                        </div>
                                    </td>
                                    <td width="25%" bgcolor="#FFFFFF">
                                        <div align="center" class="text-sm text-sm">
                                            <strong> <span class="text-sm text-sm style14">Amount</span></strong>
                                        </div>
                                    </td>
                                    <td width="22%" bgcolor="#FFFFFF">
                                        <div align="center" class="text-sm text-sm"><strong>Cash/ Cheque/
                                                Transfer</strong></div>
                                    </td>
                                    <td width="15%" bgcolor="#FFFFFF">
                                        <div align="center" class="text-sm text-sm"><strong>Composition</strong></div>
                                    </td>
                                </tr>

                                <tr>
                                    <td width="15%" bgcolor="#FFFFFF">
                                        <div align="center" class="text-sm text-sm">
                                            <strong> <span class="text-sm text-sm style14"></span></strong>
                                        </div>
                                    </td>
                                    <td width="11%" bgcolor="#FFFFFF">
                                        <div align="center" class="text-sm text-sm">
                                            <strong> <span class="text-sm text-sm style14"></span></strong>
                                        </div>
                                    </td>
                                    <td width="15%" bgcolor="#FFFFFF">
                                        <div align="center" class="text-sm text-sm"><strong>Bank Transfer #1: </strong>
                                        </div>
                                    </td>
                                    <td width="15%" bgcolor="#FFFFFF">
                                        <div align="center" class="text-sm text-sm"><strong>| Rent 1/12</strong></div>
                                    </td>
                                </tr>

                                <tr>
                                    <td width="15%" bgcolor="#FFFFFF">
                                        <div align="center" class="text-sm text-sm">
                                            <strong> <span class="text-sm text-sm style14"></span></strong>
                                        </div>
                                    </td>
                                    <td width="11%" bgcolor="#FFFFFF">
                                        <div align="center" class="text-sm text-sm">
                                            <strong> <span class="text-sm text-sm style14"></span></strong>
                                        </div>
                                    </td>
                                    <td width="15%" bgcolor="#FFFFFF">
                                        <div align="center" class="text-sm text-sm"><strong>Bank Transfer #2: </strong>
                                        </div>
                                    </td>
                                    <td width="15%" bgcolor="#FFFFFF">
                                        <div align="center" class="text-sm text-sm"><strong>| Rent 2/12</strong></div>
                                    </td>
                                </tr>

                                <tr>
                                    <td width="15%" bgcolor="#FFFFFF">
                                        <div align="center" class="text-sm text-sm">
                                            <strong> <span class="text-sm text-sm style14"></span></strong>
                                        </div>
                                    </td>
                                    <td width="11%" bgcolor="#FFFFFF">
                                        <div align="center" class="text-sm text-sm">
                                            <strong> <span class="text-sm text-sm style14"></span></strong>
                                        </div>
                                    </td>
                                    <td width="15%" bgcolor="#FFFFFF">
                                        <div align="center" class="text-sm text-sm"><strong>Bank Transfer #3: </strong>
                                        </div>
                                    </td>
                                    <td width="15%" bgcolor="#FFFFFF">
                                        <div align="center" class="text-sm text-sm"><strong>| Rent 3/12</strong></div>
                                    </td>
                                </tr>

                                <tr>
                                    <td width="15%" bgcolor="#FFFFFF">
                                        <div align="center" class="text-sm text-sm">
                                            <strong> <span class="text-sm text-sm style14"></span></strong>
                                        </div>
                                    </td>
                                    <td width="11%" bgcolor="#FFFFFF">
                                        <div align="center" class="text-sm text-sm">
                                            <strong> <span class="text-sm text-sm style14"></span></strong>
                                        </div>
                                    </td>
                                    <td width="15%" bgcolor="#FFFFFF">
                                        <div align="center" class="text-sm text-sm"><strong>Bank Transfer #4: </strong>
                                        </div>
                                    </td>
                                    <td width="15%" bgcolor="#FFFFFF">
                                        <div align="center" class="text-sm text-sm"><strong>| Rent 4/12</strong></div>
                                    </td>
                                </tr>

                                <tr>
                                    <td width="15%" bgcolor="#FFFFFF">
                                        <div align="center" class="text-sm text-sm">
                                            <strong> <span class="text-sm text-sm style14"></span></strong>
                                        </div>
                                    </td>
                                    <td width="11%" bgcolor="#FFFFFF">
                                        <div align="center" class="text-sm text-sm">
                                            <strong> <span class="text-sm text-sm style14"></span></strong>
                                        </div>
                                    </td>
                                    <td width="15%" bgcolor="#FFFFFF">
                                        <div align="center" class="text-sm text-sm"><strong>Bank Transfer #5: </strong>
                                        </div>
                                    </td>
                                    <td width="15%" bgcolor="#FFFFFF">
                                        <div align="center" class="text-sm text-sm"><strong>| Rent 5/12</strong></div>
                                    </td>
                                </tr>

                                <tr>
                                    <td width="15%" bgcolor="#FFFFFF">
                                        <div align="center" class="text-sm text-sm">
                                            <strong> <span class="text-sm text-sm style14"></span></strong>
                                        </div>
                                    </td>
                                    <td width="11%" bgcolor="#FFFFFF">
                                        <div align="center" class="text-sm text-sm">
                                            <strong> <span class="text-sm text-sm style14"></span></strong>
                                        </div>
                                    </td>
                                    <td width="15%" bgcolor="#FFFFFF">
                                        <div align="center" class="text-sm text-sm"><strong>Bank Transfer #6: </strong>
                                        </div>
                                    </td>
                                    <td width="15%" bgcolor="#FFFFFF">
                                        <div align="center" class="text-sm text-sm"><strong>| Rent 6/12</strong></div>
                                    </td>
                                </tr>

                                <tr>
                                    <td width="15%" bgcolor="#FFFFFF">
                                        <div align="center" class="text-sm text-sm">
                                            <strong> <span class="text-sm text-sm style14"></span></strong>
                                        </div>
                                    </td>
                                    <td width="11%" bgcolor="#FFFFFF">
                                        <div align="center" class="text-sm text-sm">
                                            <strong> <span class="text-sm text-sm style14"></span></strong>
                                        </div>
                                    </td>
                                    <td width="15%" bgcolor="#FFFFFF">
                                        <div align="center" class="text-sm text-sm"><strong>Bank Transfer #7: </strong>
                                        </div>
                                    </td>
                                    <td width="15%" bgcolor="#FFFFFF">
                                        <div align="center" class="text-sm text-sm"><strong>| Rent 7/12</strong></div>
                                    </td>
                                </tr>

                                <tr>
                                    <td width="15%" bgcolor="#FFFFFF">
                                        <div align="center" class="text-sm text-sm">
                                            <strong> <span class="text-sm text-sm style14"></span></strong>
                                        </div>
                                    </td>
                                    <td width="11%" bgcolor="#FFFFFF">
                                        <div align="center" class="text-sm text-sm">
                                            <strong> <span class="text-sm text-sm style14"></span></strong>
                                        </div>
                                    </td>
                                    <td width="15%" bgcolor="#FFFFFF">
                                        <div align="center" class="text-sm text-sm"><strong>Bank Transfer #8: </strong>
                                        </div>
                                    </td>
                                    <td width="15%" bgcolor="#FFFFFF">
                                        <div align="center" class="text-sm text-sm"><strong>| Rent 8/12</strong></div>
                                    </td>
                                </tr>

                                <tr>
                                    <td width="15%" bgcolor="#FFFFFF">
                                        <div align="center" class="text-sm text-sm">
                                            <strong> <span class="text-sm text-sm style14"></span></strong>
                                        </div>
                                    </td>
                                    <td width="11%" bgcolor="#FFFFFF">
                                        <div align="center" class="text-sm text-sm">
                                            <strong> <span class="text-sm text-sm style14"></span></strong>
                                        </div>
                                    </td>
                                    <td width="15%" bgcolor="#FFFFFF">
                                        <div align="center" class="text-sm text-sm"><strong>Bank Transfer #9: </strong>
                                        </div>
                                    </td>
                                    <td width="15%" bgcolor="#FFFFFF">
                                        <div align="center" class="text-sm text-sm"><strong>| Rent 9/12</strong></div>
                                    </td>
                                </tr>

                                <tr>
                                    <td width="15%" bgcolor="#FFFFFF">
                                        <div align="center" class="text-sm text-sm">
                                            <strong> <span class="text-sm text-sm style14"></span></strong>
                                        </div>
                                    </td>
                                    <td width="11%" bgcolor="#FFFFFF">
                                        <div align="center" class="text-sm text-sm">
                                            <strong> <span class="text-sm text-sm style14"></span></strong>
                                        </div>
                                    </td>
                                    <td width="15%" bgcolor="#FFFFFF">
                                        <div align="center" class="text-sm text-sm"><strong>Bank Transfer #10: </strong>
                                        </div>
                                    </td>
                                    <td width="15%" bgcolor="#FFFFFF">
                                        <div align="center" class="text-sm text-sm"><strong>| Rent 10/12</strong></div>
                                    </td>
                                </tr>

                                <tr>
                                    <td width="15%" bgcolor="#FFFFFF">
                                        <div align="center" class="text-sm text-sm">
                                            <strong> <span class="text-sm text-sm style14"></span></strong>
                                        </div>
                                    </td>
                                    <td width="11%" bgcolor="#FFFFFF">
                                        <div align="center" class="text-sm text-sm">
                                            <strong> <span class="text-sm text-sm style14"></span></strong>
                                        </div>
                                    </td>
                                    <td width="15%" bgcolor="#FFFFFF">
                                        <div align="center" class="text-sm text-sm"><strong>Bank Transfer #11: </strong>
                                        </div>
                                    </td>
                                    <td width="15%" bgcolor="#FFFFFF">
                                        <div align="center" class="text-sm text-sm"><strong>| Rent 11/12</strong></div>
                                    </td>
                                </tr>

                                <tr>
                                    <td width="15%" bgcolor="#FFFFFF">
                                        <div align="center" class="text-sm text-sm">
                                            <strong> <span class="text-sm text-sm style14"></span></strong>
                                        </div>
                                    </td>
                                    <td width="11%" bgcolor="#FFFFFF">
                                        <div align="center" class="text-sm text-sm">
                                            <strong> <span class="text-sm text-sm style14"></span></strong>
                                        </div>
                                    </td>
                                    <td width="15%" bgcolor="#FFFFFF">
                                        <div align="center" class="text-sm text-sm"><strong>Bank Transfer #12: </strong>
                                        </div>
                                    </td>
                                    <td width="112%" bgcolor="#FFFFFF">
                                        <div align="center" class="text-sm text-sm"><strong>| Rent 12/12</strong></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="15%" bgcolor="#FFFFFF">
                                        <div align="center" class="text-sm text-sm">
                                            <strong> <span class="text-sm text-sm style14">&nbsp</span></strong>
                                        </div>
                                    </td>
                                    <td width="11%" bgcolor="#FFFFFF">
                                        <div align="center" class="text-sm text-sm">
                                            <strong> <span class="text-sm text-sm style14"></span></strong>
                                        </div>
                                    </td>
                                    <td width="15%" colspan="2" bgcolor="#FFFFFF">
                                        <div align="center" class="text-sm text-sm"><strong></strong></div>
                                    </td>
                                </tr>

                                <tr>
                                    <td width="15%" bgcolor="#FFFFFF">
                                        <div class="text-sm text-sm ml-1">
                                            <strong> <span class="text-sm text-sm style14">To Collect</span></strong>
                                        </div>
                                    </td>
                                    <td width="15%" colspan="3" bgcolor="#FFFFFF">
                                        <div class="text-sm text-sm ml-1"><strong>All as above on or before due
                                                date</strong></div>
                                    </td>
                                </tr>

                                <tr>
                                    <td width="100%" colspan="4" bgcolor="#FFFFFF">
                                        <div class="text-xs ml-1" style="font-size: .65rem !important"><strong>Additional
                                                Terms:</br>
                                                1. I the tenant hereby agree to follow the laws of the UAE and undertake not
                                                to carry out any illegal activity in the above premises. If there is breach
                                                of this rule, I undertake to vacate the premises immediately without any
                                                compensation.</br>
                                                2. It is agreed that if any of the cheque issued by the tenant for rental or
                                                other payments is returned unpaid by the bank for any reason then there will
                                                be a penalty of AED 1000/- for each cheque on each occasion plus the tenant
                                                has to make good the cheque amount by cash immediately failing which he will
                                                have to vacate the premises immediately and landlord has full right to enter
                                                and take over the flat in the event of non-payment of rent.</br>
                                                3. Tenant hereby confirms and agrees with the Landlord that they will not
                                                hang clothes to dry in the balconies and outside the windows in compliance
                                                with municipal regulations and if there is breach on the part of the tenant
                                                then he is responsible for the municipal fines if any.</br>
                                                4. Tenant hereby confirms and agrees with the Landlord that more than 4
                                                persons will not occupy a flat at any time.</br>
                                                5. Tenant hereby confirms and agrees that they will not make any alteration
                                                or additions in the leased premises and not to fix showers in half
                                                bathrooms.</br>
                                                6. All levies due to the Government including VAT or other levies as and
                                                when applicable is payable by the tenant.</br>
                                                7. Tenant must inform the landlord 90 days before expiry of contract whether
                                                they want to renew or vacate the Unit and if the Tenant fails to inform then
                                                contract will be renewed for 1 year.</br>
                                                8. Tenant must pay an amount of AED 1000/- as Admin Charges.</br>
                                                9. In case of Contract cancellation, Faateh Real Estate must return the flat
                                                same as at time of procurement time.</br>
                                            </strong>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td width="1025" colspan="6" bgcolor="#FFFFFF">
                            <table width="1025" border="1" align="center" class="table0">
                                <tr>
                                    <td>
                                        <div class="ml-1 text-sm ">
                                            <strong>
                                                Agreed & Accepted By: Fama Real Estate
                                            </strong>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="ml-1 text-sm ">
                                            <strong>Agreed & Accepted By: Faateh Real Estate</strong>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td height="70">


                                    </td>
                                    <td height="70">

                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>

                <div class="mt-5" align="center">
                    <a href="agreement.php" class="btn btn-default">back</a>
                    <a href="view_agreement.php" rel="noopener" target="_blank" class="btn btn-info">Print</a>
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
