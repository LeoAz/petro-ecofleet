
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
    <title>Bon d'entré N° {{ $entrance->code }} | Ecofleet </title>
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
    <div class="invoice invoice-print" style="margin-top: 50px">
        <div class="invoice-wrap">
            <div class="invoice-wrap">
                <div>
                    <div class="col-md-6">
                        <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" class="h-100px">
                        <h1>PETRO GO</h1>
                    </div>
                    <div class="text-right mb-5 h-25 w-200">
                        {!! QrCode::size(100)->generate( $entrance->uuid); !!}
                    </div>
                    <div class="text-right fs-16px ff-mono">
                        <p class="mb-3 text-right">Bamako le {{ now()->format('d/m/Y') }}</p>
                    </div>
                    <div class="text-center text-uppercase fs-22px fw-bold ff-mono">
                        <ins><p class="mb-5">Bon d'entré N°: {{ $entrance->code }}</p></ins>
                    </div>
                    <div class="fs-16px ff-mono">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-inner">
                                    <div class="nk-block">
                                        <div class="profile-ud-list">
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">N° bon</span>
                                                    <span class="profile-ud-value">
                                                        {{ $entrance->code }}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">Date</span>
                                                    <span class="profile-ud-value">
                                                        {{ $entrance->date->format('d/m/Y')}}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">Bon de commande</span>
                                                    <span class="profile-ud-value">
                                                        {{ $entrance->order->code ?? '-' }}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">Bon d'achat</span>
                                                    <span class="profile-ud-value">
                                                        {{ $entrance->purchase->code ?? '-'}}
                                                    </span>
                                                </div>
                                            </div>
                                        </div><!-- .profile-ud-list -->
                                    </div><!-- .nk-block -->
                                    <div class="nk-divider divider md"></div>
                                    <div class="nk-block">
                                        <div class="nk-block-head mb-2 mt-5">
                                            <h6 class="nk-block-title">
                                                <em class="icon ni ni-file-text"></em>
                                                Liste pièces de rechange rentrées en stock
                                            </h6>
                                        </div><!-- .nk-block-head -->
                                    </div>

                                    <table class="table table-bordered mt-5" data-auto-responsive="false">
                                        <thead>
                                        <tr class="nk-tb-item nk-tb-head">
                                            <th class="nk-tb-col"><span class="sub-text">Code</span></th>
                                            <th class="nk-tb-col tb-col-mb"><span class="sub-text">Nom</span></th>
                                            <th class="nk-tb-col tb-col-mb"><span class="sub-text">Quantité</span></th>
                                            <th class="nk-tb-col tb-col-mb"><span class="sub-text">Prix unitaire</span></th>
                                            <th class="nk-tb-col tb-col-mb"><span class="sub-text">Prix total</span></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach( $entrance->parts as $detail)
                                            <tr class="nk-tb-item">
                                                <td class="nk-tb-col">
                                                    <div class="user-card">
                                                        <div class="user-info">
                                                                <span class="tb-lead">
                                                                     {{ $detail->part->code }}
                                                                </span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="nk-tb-col tb-col-md"><span>{{ $detail->part->name }}</span></td>
                                                <td class="nk-tb-col tb-col-md"><span> {{ $detail->qty }}</span></td>
                                                <td class="nk-tb-col tb-col-md">
                                                    <span> {{ number_format($detail->part->price, 0, ' ', ' ') }}</span>
                                                </td>
                                                <td class="nk-tb-col tb-col-md">
                                                    <span>{{ number_format($detail->part->price *  $detail->qty, 0, ' ', ' ' ) }}</span>
                                                </td>
                                            </tr><!-- .nk-tb-item  -->
                                        @endforeach
                                        </tbody>
                                    </table>
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
