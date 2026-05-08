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
    <title>Recu de paiement N° 0000{{ $operation->id }} | Ecofleet </title>
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
                        <h1>BAMA TRANSPORT</h1>
                    </div>
                    <div class="text-right h-25 w-200">
                        {!! QrCode::size(100)->generate( $operation->uuid); !!}
                    </div>
                    <div class="text-right fs-16px ff-mono mt-5">
                        <p class="mb-3 text-right">Bamako le {{ now()->format('d/m/Y') }}</p>
                    </div>
                    <div class="text-center text-uppercase fs-22px fw-bold ff-mono mt-5">
                        <p class="mb-5"><ins>Reçu de paiement N° 0000{{ $operation->id }}</ins></p>
                    </div>

                    <div class="fs-16px ff-mono">
                        <p class="mb-5 fw-bold">
                            <ins>Détails de l'operation</ins>
                        </p>
                        <div class="card">
                            <div class="card-inner border">
                                <div class="nk-block">
                                    <div class="profile-ud-list">
                                        @if( $operation->paid_at)
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">Date</span>
                                                    <span class="profile-ud-value">
                                                    {{ $operation->paid_at->format('d/m/Y') }}
                                                </span>
                                                </div>
                                            </div>
                                        @endif
                                        @if( $operation->op_type )
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">Le Type d'opération</span>
                                                    <span class="profile-ud-value">
                                                {{ $operation->op_type }}
                                            </span>
                                                </div>
                                            </div>
                                        @endif
                                        @if($operation->vehicle)
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">Le véhicule</span>
                                                    <span class="profile-ud-value">
                                                {{ $operation->vehicle }}
                                            </span>
                                                </div>
                                            </div>
                                        @endif
                                        @if($operation->driver)
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">Le Chauffeur</span>
                                                    <span class="profile-ud-value">
                                                {{ $operation->driver }}
                                            </span>
                                                </div>
                                            </div>
                                        @endif
                                        @if($operation->type_expense)
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">Le type de dépense</span>
                                                    <span class="profile-ud-value">
                                                        {{ $operation->type_expense }}
                                                    </span>
                                                </div>
                                            </div>
                                        @endif
                                        @if($operation->motif)
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">Le motif</span>
                                                    <span class="profile-ud-value">
                                                        {{ $operation->motif }}
                                                    </span>
                                                </div>
                                            </div>
                                        @endif
                                        @if($operation->amount)
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">Le montant</span>
                                                    <span class="profile-ud-value">
                                                        {{ $operation->amount }}
                                                    </span>
                                                </div>
                                            </div>
                                        @endif
                                        @if($operation->beneficiary)
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">Le bénéficiaire</span>
                                                    <span class="profile-ud-value">
                                                        {{ $operation->beneficiary }}
                                                    </span>
                                                </div>
                                            </div>
                                        @endif
                                        @if($operation->description)
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">La description</span>
                                                    <span class="profile-ud-value">
                                                        {{ $operation->description }}
                                                    </span>
                                                </div>
                                            </div>
                                        @endif
                                    </div><!-- .profile-ud-list -->
                                </div><!-- .nk-block -->
                            </div>
                        </div>

                        <div class="d-flex justify-content-center">
                            <div class="p-5">
                                LE CAISSIER
                                <p style="margin-top: 100px"> - </p>
                            </div>
                            <div class="p-5">
                                LE BENEFICIAIRE
                                <p style="margin-top: 100px" class="fw-bold">
                                    -
                                </p>
                            </div>
                            <div class="p-5">
                                LE RESP. TRANSPORT
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
