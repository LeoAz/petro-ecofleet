
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
    <title>Liste des pièces de rechange | Ecofleet </title>
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
                    <div class="col-md-6">
                        <h1>PETRO BAMA</h1>
                    </div>
                    <div class="text-right fs-20px ff-mono">
                        <p class="mb-3 text-right">Bamako le {{ now()->format('d/m/Y') }}</p>
                    </div>
                    <div class="text-center text-uppercase fs-22px fw-bold ff-mono">
                        <ins><p class="mb-5">Liste des pièces de rechange</p></ins>
                    </div>
                    <div class="fs-20px ff-mono">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-inner">
                                    <div class="nk-block">
                                        <div class="nk-block-head mb-2 mt-2">
                                            <h4 class="ff-mono">
                                                Liste pièces de rechange disponible en stock
                                            </h4>
                                        </div><!-- .nk-block-head -->
                                    </div>

                                    <table class="table table-bordered mt-5" data-auto-responsive="false">
                                        <thead>
                                        <tr class="nk-tb-item nk-tb-head">
                                            <th class="nk-tb-col tb-col-mb">Nom</th>
                                            <th class="nk-tb-col tb-col-mb">Reference</th>
                                            <th class="nk-tb-col tb-col-mb">N° Serie</th>
                                            <th class="nk-tb-col tb-col-mb">Qté Stock</th>
                                            <th class="nk-tb-col tb-col-mb">Qté Réellé</th>
                                            <th class="nk-tb-col tb-col-mb">Observation</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach( $parts as $part)
                                            <tr class="nk-tb-item" height="75px">
                                                <td class="nk-tb-col tb-col-md"><span>{{ $part->name }}</span></td>
                                                <td class="nk-tb-col tb-col-md"><span>{{ $part->reference ?? '-' }}</span></td>
                                                <td class="nk-tb-col tb-col-md"><span>{{ $part->reference ?? '-' }}</span></td>
                                                <td class="nk-tb-col tb-col-md"><span> {{ $part->qty }}</span></td>
                                                <td class="nk-tb-col tb-col-md">
                                                </td>
                                                <td class="nk-tb-col tb-col-md">
                                                </td>
                                            </tr><!-- .nk-tb-item  -->
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="d-flex justify-content-center mt-5">

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
