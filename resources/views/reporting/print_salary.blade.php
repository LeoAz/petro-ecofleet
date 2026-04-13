
<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <base href="../../">
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="./images/favicon.png">
    <!-- Page Title  -->
    <title>Etat des salaire du mois " {{ request()->get('month') }} {{ request()->get('year') }} " | Ecofleet </title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="{{ asset('assets/css/dashlite.css?ver=2.9.0') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/theme.css?ver=2.9.0') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/skins/theme-egyptian.css') }}">
</head>

<body class="bg-white" onload="printPromot()">
<div class="nk-block">
    <div class="invoice invoice-print" style="margin-top: 100px">
        <div class="invoice-wrap">
            <div class="invoice-wrap">
                <div>
                    <div class="text-right fs-16px ff-mono">
                        <p class="mb-3 text-right">Bamako le {{ now()->format('d/m/Y') }}</p>
                    </div>
                    <div class="text-center text-uppercase fs-22px fw-bold ff-mono">
                        <ins><p class="mb-5">Etat des salaire du mois {{ request()->get('month') }} {{ now()->year }}</p></ins>
                    </div>
                    <div class="fs-16px ff-mono">
                        <div class="col-sm-12">
                            <table class="table table-bordered table-condensed table-sm table" data-auto-responsive="false">
                                <thead>
                                <tr class="nk-tb-item nk-tb-head">
                                    <th class="nk-tb-col"><span class="sub-text">Nom</span></th>
                                    <th class="nk-tb-col"><span class="sub-text">Matricule</span></th>
                                    <th class="nk-tb-col tb-col-mb"><span class="sub-text">Contact</span></th>
                                    <th class="nk-tb-col tb-col-mb"><span class="sub-text">Vehicule</span></th>
                                    <th class="nk-tb-col tb-col-mb"><span class="sub-text">Salaire</span></th>
                                    <th class="nk-tb-col tb-col-mb"><span class="sub-text">Signature</span></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach( $drivers as $driver)
                                    <tr class="nk-tb-item">
                                        <td class="nk-tb-col">
                                            <div class="user-card">
                                                <div class="user-info">
                                        <span class="tb-lead">
                                            {{ $driver->name }}
                                        </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="nk-tb-col tb-col-md">
                                            <span>{{ $driver->matricule }}</span>
                                        </td>
                                        <td class="nk-tb-col tb-col-md">
                                            <span>{{ $driver->tel }}</span>
                                        </td>
                                        <td class="nk-tb-col tb-col-md">
                                            <span>{{$driver->ActiveVehicle ? $driver->ActiveVehicle->vehicle->registration : '-'}}</span>
                                        </td>
                                        <td class="nk-tb-col tb-col-md">
                                            <span>{{ number_format($driver->salary,0, ' ', ' ') }} CFA</span>
                                        </td>
                                        <td class="nk-tb-col tb-col-md">

                                        </td>
                                    </tr><!-- .nk-tb-item  -->
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr class="bg-danger-dim">
                                    <td colspan="4" class="text-right fs-14px">TOTAL SALAIRE</td>
                                    <td colspan="2" class="text-center fs-14px"> {{ number_format($drivers->sum('salary'),0,'',' ') }} CFA</td>
                                </tr>
                                </tfoot>
                            </table>
                            <div class="mt-5 d-flex justify-content-center">
                            <div class="p-5">
                                RESP. COMPTABLE
                            </div>
                            <div class="p-5">
                                RESP. TRANSPORT
                            </div>
                            <div class="p-5">
                                DIR. GENERALE
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div><!-- .invoice-wrap -->
        </div><!-- .invoice-wrap -->
    </div><!-- .invoice -->
</div><!-- .nk-block -->
<script>
    function printPromot() {
        window.print();
    }
</script>
</body>

</html>
