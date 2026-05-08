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
    <title>Liste des vehicules | Ecofleet </title>
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
<div class="nk-block mt-5">
    <div class="invoice invoice-print">
        <div class="invoice">
            <div class="invoice-wrap">
                <div class="text-center text-uppercase fs-22px fw-bold ff-mono mt-5">
                    <h5 class="mb-5"><ins>Liste des vehicules au {{ now()->format('d/m/Y') }}</ins></h5>
                </div>
                <div class="invoice-bills">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th >#</th>
                                <th >N°Plaque</th>
                                <th>chassis</th>
                                <th>remorque</th>
                                <th>chauffeur</th>
                                <th>marque</th>
                                <th>Model</th>
                                <th>type</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach( $vehicles as $vehicle )
                                <tr>
                                    <td>{{ $vehicle->id }}</td>
                                    <td>{{ $vehicle->registration }}</td>
                                    <td>{{ $vehicle->chassis }}</td>
                                    <td>
                                        {{ $vehicle->activeTrailer->trailer->registration ?? '-'}}
                                    </td>
                                    <td>
                                        {{ $vehicle->activeDriver->driver->name ?? '-'}}
                                    </td>
                                    <td>{{ $vehicle->brand ? $vehicle->brand->name : '' }}</td>
                                    <td>{{ $vehicle->pattern ? $vehicle->pattern->name : ''}}</td>
                                    <td>
                                        {{ \App\Enums\Fleet\VehicleType::getDescription($vehicle->type) }}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div><!-- .invoice-bills -->
            </div><!-- .invoice-wrap -->
        </div><!-- .invoice -->
    </div><!-- .invoice -->
</div><!-- .nk-block -->
<script>
    function printPromot() {
        window.print();
    }
</script>
</body>
</html>
