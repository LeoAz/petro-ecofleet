
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
    <title>Etat des bon de carburants
        @if( request()->get('start_date') && request()->get('end_date') )
            du {{ \Carbon\Carbon::createFromFormat('d/m/Y', request()->get('start_date'))->format('d/m/Y') }} au
            {{ \Carbon\Carbon::createFromFormat('d/m/Y', request()->get('end_date'))->format('d/m/Y') }}
        @elseif( request()->get('vehicle') )
            - {{ request()->get('vehicle') }}
        @endif
        | Ecofleet
    </title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="{{ asset('assets/css/dashlite.css?ver=2.9.0') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/theme.css?ver=2.9.0') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/skins/theme-egyptian.css') }}">
    <style>
        @media print {
            .table-print th, .table-print td, .table th, .table td {
                font-size: 16px !important;
            }
            .fs-12px, .fs-14px {
                font-size: 16px !important;
            }
        }
        .table th, .table td {
            font-size: 16px;
        }
    </style>
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
                        <ins>
                            <p class="mb-5">
                                Etat des bons de carburants
                                @if( request()->get('start_date') && request()->get('end_date') )
                                    du {{ \Carbon\Carbon::createFromFormat('d/m/Y', request()->get('start_date'))->format('d/m/Y') }} au
                                    {{ \Carbon\Carbon::createFromFormat('d/m/Y', request()->get('end_date'))->format('d/m/Y') }}
                                @elseif( request()->get('vehicle') )
                                    - {{ request()->get('vehicle') }}
                                @endif
                            </p>
                        </ins>
                    </div>
                    <div class="fs-16px ff-mono">
                        <div class="col-sm-12">
                            <table class="table table-bordered" data-auto-responsive="false">
                                <thead>
                                <th class="nk-tb-col">Vehicule</th>
                                <th class="nk-tb-col">Place</th>
                                <th class="nk-tb-col tb-col-mb">Date</th>
                                <th class="nk-tb-col tb-col-mb">Quantité</th>
                                <th class="nk-tb-col tb-col-mb">Prix Unitaire</th>
                                <th class="nk-tb-col tb-col-mb">Prix Total</th>
                                <th class="nk-tb-col tb-col-mb">Fournisseur</th>

                                </thead>
                                <tbody>
                                @foreach( $fuels as $fuel)
                                    <tr>
                                        <td>
                                            <span>{{ $fuel->trip->vehicle->registration }}</span>
                                        </td>
                                        <td>
                                            <span>{{ $fuel->place }}</span>
                                        </td>
                                        <td>
                                            <span>{{ $fuel->date_order->format('d/m/Y')}}</span>
                                        </td>
                                        <td>
                                            <span>{{ $fuel->quantity }}</span>
                                        </td>
                                        <td>
                                            <span>{{ $fuel->unit_price }}</span>
                                        </td>
                                        <td>
                                            <span>{{ number_format($fuel->total_price, 0, '', ' ') }}</span>
                                        </td>
                                        <td>
                                            <span>{{ $fuel->provider->name ?? '-' }}</span>
                                        </td>
                                    </tr><!-- .nk-tb-item  -->
                                @endforeach
                                </tbody>
                                <tfoot>
                                    <tr class="bg-danger-dim">
                                        <td colspan="5" class="text-right fs-14px">TOTAL</td>
                                        <td colspan="2" class="text-center fs-14px"> {{ number_format($fuels->sum('total_price'),0,'',' ') }} CFA</td>
                                    </tr>
                                </tfoot>
                            </table>
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
