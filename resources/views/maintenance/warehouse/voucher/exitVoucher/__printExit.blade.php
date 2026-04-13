
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
    <title>Bon de sortie N° {{ $exit->code }} | Ecofleet </title>
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
                        <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" class="h-100px">
                        <h1>PETRO GO</h1>
                    </div>
                    <div class="text-right mb-5 h-25 w-200">
                        {!! QrCode::size(100)->generate( $exit->uuid); !!}
                    </div>
                    <div class="text-right fs-16px ff-mono">
                        <p class="mb-3 text-right">Bamako le {{ now()->format('d/m/Y') }}</p>
                    </div>
                    <div class="text-center text-uppercase fs-22px fw-bold ff-mono">
                        <ins><p class="mb-5">Bon de sortie N°: {{ $exit->code }}</p></ins>
                    </div>
                    <div class="fs-16px ff-mono">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-inner">
                                    <div class="nk-block">
                                        <div class="profile-ud-list">
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">N° Bon de sortie</span>
                                                    <span class="profile-ud-value">
                                                        {{ $exit->code }}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">Date</span>
                                                    <span class="profile-ud-value">
                                                        {{ $exit->date->format('d/m/Y')}}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">Le vehicule</span>
                                                    <span class="profile-ud-value">
                                                        {{ $exit->vehicle->registration }}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">La marque</span>
                                                    <span class="profile-ud-value">
                                                        {{ $exit->vehicle->brand->name }}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">Le chauffeur</span>
                                                    <span class="profile-ud-value">
                                                        {{ $exit->vehicle->activeDriver->driver->name ?? '-' }}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">Status</span>
                                                    <span class="profile-ud-value">
                                                        @include('layout.partials.enum.maintenance.ExitVoucherStatus', ['status' => $exit->status_exit])
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">Observation</span>
                                                    <span class="profile-ud-value">
                                                        {{ $exit->observation ?? '-' }}
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
                                                Liste pièces de rechange sorties en stock
                                            </h6>
                                        </div><!-- .nk-block-head -->
                                    </div>

                                    <table class="table table-bordered mt-5" data-auto-responsive="false">
                                        <thead>
                                        <tr class="nk-tb-item nk-tb-head">
                                            <th class="nk-tb-col"><span class="sub-text">Code</span></th>
                                            <th class="nk-tb-col tb-col-mb"><span class="sub-text">Nom</span></th>
                                            <th class="nk-tb-col tb-col-mb"><span class="sub-text">Reference</span></th>
                                            <th class="nk-tb-col tb-col-mb"><span class="sub-text">N° Serie</span></th>
                                            <th class="nk-tb-col tb-col-mb"><span class="sub-text">Quantité</span></th>
                                            <th class="nk-tb-col tb-col-mb"><span class="sub-text">Prix unitaire</span></th>
                                            <th class="nk-tb-col tb-col-mb"><span class="sub-text">Prix total</span></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach( $exit->parts as $detail)
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
                                                <td class="nk-tb-col tb-col-md"><span>{{ $detail->part->reference ?? '-' }}</span></td>
                                                <td class="nk-tb-col tb-col-md"><span>{{ $detail->reference ?? '-' }}</span></td>
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
                                <div class="d-flex justify-content-center mt-5">
                                    <div class="p-5 text-center fs-16px ff-mono">
                                        <ins>Le Magasinier</ins>
                                    </div>
                                    <div class="p-5">
                                        <ins>Le Responsable Transport</ins>
                                    </div>
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
