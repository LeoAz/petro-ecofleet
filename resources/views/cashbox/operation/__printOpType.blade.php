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
    <title>Liste des opérations | Ecofleet </title>
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
                    <div class="text-right fs-16px ff-mono mt-5">
                        <p class="mb-3 text-right">Bamako le {{ now()->format('d/m/Y') }}</p>
                    </div>
                    <div class="text-center text-uppercase fs-22px fw-bold ff-mono mt-5">
                        <p class="mb-5"><ins>Liste des opérations</ins></p>
                    </div>

                    <div class="fs-16px ff-mono">
                        <div class="col-sm-12 mt-5">
                            <table class="table table-condensed table-bordered" data-auto-responsive="false">
                                <thead>
                                <tr class="nk-tb-item nk-tb-head">
                                    <th class="nk-tb-col tb-col-mb"><span class="sub-text">Vehicule</span></th>
                                    <th class="nk-tb-col tb-col-mb"><span class="sub-text">Chauffeur</span></th>
                                    <th class="nk-tb-col tb-col-mb"><span class="sub-text">Type dépense</span></th>
                                    <th class="nk-tb-col tb-col-mb"><span class="sub-text">Motif</span></th>
                                    <th class="nk-tb-col tb-col-mb"><span class="sub-text">Montant</span></th>
                                    <th class="nk-tb-col tb-col-mb"><span class="sub-text">Béneficiare</span></th>
                                    <th class="nk-tb-col tb-col-mb"><span class="sub-text">Description</span></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach( $operations->sortByDesc('created_at') as $op)
                                    <tr>
                                        <td class="nk-tb-col tb-col-md">
                                            <span>{{ $op->vehicle }}</span>
                                        </td>
                                        <td class="nk-tb-col tb-col-md">
                                            <span>{{ $op->driver }}</span>
                                        </td>
                                        <td class="nk-tb-col tb-col-md">
                                            <span>{{ $op->type_expense }}</span>
                                        </td>
                                        <td class="nk-tb-col tb-col-md">
                                            <span>{{ $op->motif }}</span>
                                        </td>
                                        <td class="nk-tb-col tb-col-md">
                                            <span>{{ number_format($op->amount,0,'',' ') }}</span>
                                        </td>
                                        <td class="nk-tb-col tb-col-md">
                                            <span>{{ $op->beneficiary }}</span>
                                        </td>
                                        <td class="nk-tb-col tb-col-md">
                                            <span>{{ $op->description }}</span>
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
