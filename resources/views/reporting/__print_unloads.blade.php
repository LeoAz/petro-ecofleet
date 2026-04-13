
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
    <title>Etat des salaire du mois " {{ now()->translatedFormat('F') }} {{ now()->year }} " | Ecofleet </title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="{{ asset('assets/css/dashlite.css?ver=2.9.0') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/theme.css?ver=2.9.0') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/skins/theme-egyptian.css') }}">
    <style type="text/css" media="print">
        @page { size: landscape; }
    </style>
</head>

<body class="bg-white" onload="printPromot()">
<div class="nk-block">
    <div class="invoice invoice-print" style="margin-top: 50px">
        <div class="invoice-wrap">
            <div class="invoice-wrap">
                <div>
                    <div class="text-right fs-16px ff-mono">
                        <p class="mb-3 text-right">Bamako le {{ now()->format('d/m/Y') }}</p>
                    </div>
                    <div class="text-center text-uppercase fs-22px fw-bold ff-mono">
                        <ins><p class="mb-5">Etat des déchargements</p></ins>
                    </div>
                    <div class="fs-14px ff-mono">
                        <div class="col-sm-12">
                            <table class="table table-bordered table-condensed table-sm table" data-auto-responsive="false">
                                <thead>
                                <tr class="nk-tb-item nk-tb-head">
                                    <th><span class="sub-text">Date</span></th>
                                    <th><span class="sub-text">Vehicule</span></th>
                                    <th><span class="sub-text">Citerne</span></th>
                                    <th><span class="sub-text">Depot</span></th>
                                    <th><span class="sub-text">Produit</span></th>
                                    <th><span class="sub-text">Qte chargé</span></th>
                                    <th><span class="sub-text">Bon chrgmt</span></th>
                                    <th><span class="sub-text">Qte décharger</span></th>
                                    <th><span class="sub-text">Manquant</span></th>
                                    <th><span class="sub-text">Lieu</span></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach( $unloads as $unload)
                                    <tr class="nk-tb-item">
                                        <td class="nk-tb-col">
                                            <div class="user-card">
                                                <div class="user-info">
                                                    <span class="tb-lead">
                                                        {{ $unload->date->format('d/m/Y') }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span>{{ $unload->trip->vehicle->registration }}</span>
                                        </td>
                                        <td>
                                            <span>{{ $unload->trip->trailer }}</span>
                                        </td>
                                        <td>
                                            <span>{{ $unload->trip->loads->deposit->name }}</span>
                                        </td>
                                        <td>
                                            <span>{{ $unload->product->name }}</span>
                                        </td>
                                        <td>
                                            <span>{{ $unload->trip->loads->load_qty ?? '-'}}</span>
                                        </td>
                                        <td>
                                            <span>{{ $unload->trip->loads->num_bordereau?? '-'}}</span>
                                        </td>
                                        <td>
                                            <span>{{ $unload->unload_qty }}</span>
                                        </td>
                                        <td>
                                            <span>{{ $unload->trip->loads->load_qty - $unload->unload_qty  }}</span>
                                        </td>
                                        <td>
                                            <span>{{ $unload->place }}</span>
                                        </td>
                                    </tr><!-- .nk-tb-item  -->
                                @endforeach
                                </tbody>
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
