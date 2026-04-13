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
    <title>Déclaration d'accident au  {{ $accident->date->format('d/m/Y') }} | Ecofleet </title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="{{ asset('assets/css/dashlite.css?ver=2.9.0') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/theme.css?ver=2.9.0') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/skins/theme-egyptian.css') }}">
</head>

<body class="bg-white" onload="printPromot()">
<div class="nk-block">
    <div class="invoice invoice-print" style="margin-top: 50px">
        <div class="invoice-wrap">
            <div class="invoice-wrap">
                <div>
                    <div class="text-right h-25 w-200">
                        {!! QrCode::size(100)->generate( $accident->uuid); !!}
                    </div>
                    <div class="text-right fs-16px ff-mono mt-5">
                        <p class="mb-3 text-right">Bamako le {{ now()->format('d/m/Y') }}</p>
                    </div>
                    <div class="text-center text-uppercase fs-22px fw-bold ff-mono mt-5">
                        <p class="mb-5"><ins>Déclatation d'accident</ins>  du  {{ $accident->date->format('d/m/Y') }}</p>
                    </div>

                    <div class="fs-16px ff-mono">
                        <p class="mb-5 fw-bold">
                            <ins>Détails de l'accident</ins>
                        </p>
                        <table class="table table-bordered fs-16px">
                            <thead>
                            <tr>
                                <th >Date</th>
                                <th >Vehicule</th>
                                <th >Lieu</th>
                                <th>Gravité</th>
                                <th>Montant</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $accident->date->format('d/m/Y') }}</td>
                                    <td>{{ $accident->vehicle->registration }}</td>
                                    <td>{{ $accident->place }}</td>
                                    <td>
                                        {{ \App\Enums\Maintenance\Gravity::getDescription($accident->gravity)}}
                                    </td>
                                    <td>{{ $accident->amount}}</td>
                                </tr>
                            </tbody>
                        </table>

                        <p class="mb-5 fw-bold mt-5">
                            <ins>Description de l'accident</ins>
                        </p>
                        <p class="mb-2">
                            {{ $accident->description }}
                        </p>
                        <div class="d-flex justify-content-center mt-5">
                            <div class="p-5">
                                P/LA DIRECTION
                            </div>

                            <div class="p-5">
                                LE CHAUFFEUR
                                <p style="margin-top: 100px" class="fw-bold">
                                    {{ $fuel->trip->vehicle->activeDriver->driver->name ?? '-'}}
                                </p>
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
