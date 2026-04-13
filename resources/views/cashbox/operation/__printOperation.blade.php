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
    <title>Brouillard de caisse N° 0000{{ $box->id }} | Ecofleet </title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="{{ asset('assets/css/dashlite.css?ver=2.9.0') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/theme.css?ver=2.9.0') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/skins/theme-egyptian.css') }}">
</head>

<body class="bg-white" onload="printPromot()">
<div class="nk-block">
    <div class="invoice invoice-print" style=": 50px">
        <div class="invoice-wrap">
            <div class="invoice-wrap">
                <div>
                    <div class="text-right fs-16px ff-mono mt-5">
                        <p class="mb-3 text-right">Bamako le {{ now()->format('d/m/Y') }}</p>
                    </div>
                    <div class="text-center text-uppercase fs-22px fw-bold ff-mono mt-5">
                        <p class="mb-5"><ins>BROUILLARD DE CAISSE N° 0000{{ $box->id }} DU {{ $box->start_at->format('d/m/Y') }}</ins></p>
                    </div>

                    <div class="fs-16px ff-mono">
                        <div class="row g-gs">
                            <div class="col-sm-8">
                                <div class="card shadow-sm">
                                    <div class="card-inner">
                                        <div class="nk-block">
                                            <div class="profile-ud-list">
                                                <div class="profile-ud-item">
                                                    <div class="profile-ud wider">
                                                        <span class="profile-ud-label">Date ouverture</span>
                                                        <span class="profile-ud-value">
                                    </span>
                                                        {{ $box->start_at->format('d/m/Y') }}
                                                    </div>
                                                </div>
                                                <div class="profile-ud-item">
                                                    <div class="profile-ud wider">
                                                        <span class="profile-ud-label">Date clôture</span>
                                                        <span class="profile-ud-value">
                                    </span>
                                                        {{ $box->end_at ? $box->end_at->format('d/m/Y') : '-' }}
                                                    </div>
                                                </div>
                                                <div class="profile-ud-item">
                                                    <div class="profile-ud wider">
                                                        <span class="profile-ud-label">Status</span>
                                                        <span class="profile-ud-value">
                                    </span>
                                                        @include('layout.partials.enum.Fleet.CashboxStatus', ['status' => $box->status])
                                                    </div>
                                                </div>
                                                <div class="profile-ud-item">
                                                    <div class="profile-ud wider">
                                                        <span class="profile-ud-label">Nbre d'opérations</span>
                                                        <span class="profile-ud-value">
                                    </span>
                                                        <span class="badge badge-dim badge-primary">{{ $box->operations->count() }}</span>
                                                    </div>
                                                </div>
                                            </div><!-- .profile-ud-list -->
                                        </div><!-- .nk-block -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="col-sm-12">
                                    <div class="card shadow-sm">
                                        <div class="nk-tb-list is-loose">
                                            <div class="nk-tb-item nk-tb-head">
                                                <div class="nk-tb-col"><span>Libellé</span></div>
                                                <div class="nk-tb-col tb-col-sm text-right"><span>Montant</span></div>
                                            </div><!-- .nk-tb-head -->
                                            <div class="nk-tb-item">
                                                <div class="nk-tb-col">
                                                    <div class="icon-text">
                                                        <span class="tb-lead">Solde départ</span>
                                                    </div>
                                                </div>
                                                <div class="nk-tb-col tb-col-sm text-right">
                                <span class="tb-sub fw-bold text-danger">
                                    {{ number_format($box->start_solde,0, ' ', ' ')}} CFA
                                </span>
                                                </div>
                                            </div><!-- .nk-tb-item -->
                                            <div class="nk-tb-item">
                                                <div class="nk-tb-col">
                                                    <div class="icon-text">
                                                        <span class="tb-lead">Total Appros</span>
                                                    </div>
                                                </div>
                                                <div class="nk-tb-col tb-col-sm text-right">
                                <span class="tb-sub fw-bold text-orange">
                                    {{ number_format($box->total_appros,0, ' ', ' ')}} CFA
                                </span>
                                                </div>
                                            </div><!-- .nk-tb-item -->
                                            <div class="nk-tb-item">
                                                <div class="nk-tb-col">
                                                    <div class="icon-text">
                                                        <span class="tb-lead">Total dépenses</span>
                                                    </div>
                                                </div>
                                                <div class="nk-tb-col tb-col-sm text-right">
                                <span class="tb-sub fw-bold text-teal">
                                    {{ number_format($box->total_expenses,0, ' ', ' ')}} CFA
                                </span>
                                                </div>
                                            </div><!-- .nk-tb-item -->
                                            <div class="nk-tb-item">
                                                <div class="nk-tb-col">
                                                    <div class="icon-text">
                                                        <span class="tb-lead">Solde caisse</span>
                                                    </div>
                                                </div>
                                                <div class="nk-tb-col tb-col-sm text-right">
                                <span class="tb-sub fw-bold text-teal">
                                    {{ number_format($box->solde,0, ' ', ' ')}} CFA
                                </span>
                                                </div>
                                            </div><!-- .nk-tb-item -->
                                        </div><!-- .nk-tb-list -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 mt-5">
                            <table class="table table-condensed table-bordered" data-auto-responsive="false">
                                <thead>
                                <tr class="nk-tb-item nk-tb-head">
                                    <th class="nk-tb-col tb-col-mb"><span class="sub-text">Type</span></th>
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
                                @foreach( $box->operations->sortByDesc('created_at') as $op)
                                    <tr>
                                        <td class="nk-tb-col tb-col-md">
                                            @include('layout.partials.enum.Fleet.OpType', ['type' => $op->op_type])
                                        </td>
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
