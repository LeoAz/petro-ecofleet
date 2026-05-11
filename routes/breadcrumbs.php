<?php
try {
    /*
    |--------------------------------------------------------------------------
    | Gestion de flotte breadcrumbs
    |--------------------------------------------------------------------------
    |
    | Gestion de flotte
    */
    Breadcrumbs::for('fleet', fn ($trail) =>
        $trail->push('Gestion de flotte', route('fleet.index'))
    );

    // Gestion de Flotte > Index
    Breadcrumbs::for('index', fn ($trail) =>
        $trail->parent('fleet')
            ->push('index', '')
    );

    // Gestion de Flotte > Les marques
    Breadcrumbs::for('brand', fn ($trail) =>
        $trail->parent('fleet')
            ->push('Les marques', '')
    );

    // Gestion de Flotte > Les models
    Breadcrumbs::for('pattern', fn ($trail) =>
        $trail->parent('fleet')
            ->push('Les models', '')
    );

    // Gestion de Flotte > Historique des attélages
    Breadcrumbs::for('link', fn ($trail) =>
    $trail->parent('fleet')
        ->push('Historique des attelages', '')
    );

    // Gestion de Flotte > Historique des asssociations
    Breadcrumbs::for('assignation', fn ($trail) =>
    $trail->parent('fleet')
        ->push('Historique des associations', '')
    );

    // Gestion de Flotte > Parc Auto
    Breadcrumbs::for('vehicle', fn ($trail) =>
        $trail->parent('fleet')
            ->push('parc auto', route('fleet.vehicle.index'))
    );

    // Gestion de Flotte > Parc Auto > Vehicule disponible
    Breadcrumbs::for('vehicle-available', fn ($trail) =>
    $trail->parent('vehicle')
        ->push('Vehicule disponible', '')
    );

    // Gestion de Flotte > Parc Auto > Vehicule en voyage
    Breadcrumbs::for('vehicle-travel', fn ($trail) =>
    $trail->parent('vehicle')
        ->push('Vehicule en voyage', '')
    );

    // Gestion de Flotte > Parc Auto > Vehicule au garage
    Breadcrumbs::for('vehicle-garage', fn ($trail) =>
    $trail->parent('vehicle')
        ->push('Vehicule au garage', '')
    );

    // Gestion de Flotte > Parc Auto > Vehicule en reforme
    Breadcrumbs::for('vehicle-reform', fn ($trail) =>
    $trail->parent('vehicle')
        ->push('Vehicule en reforme', '')
    );

    // Gestion de Flotte > Parc Auto > Details véhicule
    Breadcrumbs::for('vehicle-show',
        fn ($trail, \App\Models\Vehicle $vehicle) =>
        $trail
            ->parent('vehicle')
            ->push('Détails véhicule', route('fleet.vehicle.show', $vehicle))
    );

    // Gestion de Flotte > Parc Auto > Details véhicule > {vehicule}
    Breadcrumbs::for(
        'vehicle-edit',
        fn ( $trail, \App\Models\Vehicle $vehicle)
            => $trail
                ->parent('vehicle-show', $vehicle)
                ->push($vehicle->registration, '')
    );

    // Gestion de Flotte > Parc Auto > Remorques
    Breadcrumbs::for('trailer', function ($trail) {
        $trail->parent('vehicle');
        $trail->push('Remorques', route('fleet.trailer.index'));
    });

    // Gestion de Flotte > Parc Auto > Remorques > Remorque au garage
    Breadcrumbs::for('trailer-garage', fn ($trail) =>
    $trail->parent('trailer')
        ->push('Remorque au garage', '')
    );

    // Gestion de Flotte > Parc Auto > Remorques > Remorque en reforme
    Breadcrumbs::for('trailer-reform', fn ($trail) =>
    $trail->parent('trailer')
        ->push('Trailer en reforme', '')
    );

    // Gestion de Flotte > Parc Auto > Remorques > Details remorque
    Breadcrumbs::for('trailer-show',
        fn ($trail, \App\Models\Trailer $trailer)  =>
        $trail
            ->parent('trailer')
            ->push('Détails remorque', route('fleet.trailer.show', $trailer))
        );

    // Gestion de Flotte > Parc Auto > Remorques > Details remorque > {remorque}
    Breadcrumbs::for(
        'trailer-edit',
        fn ( $trail, \App\Models\Trailer $trailer)
        => $trail
            ->parent('trailer-show', $trailer)
            ->push($trailer->registration, '')
    );

    // Gestion de Flotte > Parc Auto > Chauffeurs
    Breadcrumbs::for('driver', function ($trail) {
        $trail->parent('vehicle');
        $trail->push('Chauffeurs', route('fleet.driver.index'));
    });

    // Gestion de Flotte > Parc Auto > Chauffeurs > Détails chauffeur
    Breadcrumbs::for('driver-show',
        fn ($trail, \App\Models\Driver $driver) =>
        $trail->parent('driver')
            ->push('Détails chauffeur', route('fleet.driver.show', $driver))
    );

    // Gestion de Flotte > Parc Auto > Chauffeurs > Détails chauffeur > {chauffeur}
    Breadcrumbs::for(
        'driver-edit',
        fn ( $trail, \App\Models\Driver $driver) =>
        $trail
            ->parent('driver-show', $driver)
            ->push($driver->name, '')
    );

    // Gestion de Flotte > Parc Auto > Chauffeurs > Détails chauffeur > {chauffeur}
    Breadcrumbs::for('exploitation', fn ($trail) =>
    $trail->push('Exploitation', route('exploitation.index'))
    );

    // Administration
    Breadcrumbs::for('admin', fn ($trail) =>
    $trail->push('Administration', '#')
    );

    // Administration > Utilisateurs
    Breadcrumbs::for('user', fn ($trail) =>
    $trail->parent('admin')
        ->push('Utilisateurs', route('admin.user.index'))
    );

    // Administration > Paramètres
    Breadcrumbs::for('setting', function ($trail) {
        $trail->parent('admin');
        $trail->push('Paramètres', route('admin.user.setting'));
    });

    // Administration > Rôles
    Breadcrumbs::for('role', function ($trail) {
        $trail->parent('admin');
        $trail->push('Rôles', route('admin.role.index'));
    });

    // Administration > Permissions
    Breadcrumbs::for('permission', function ($trail) {
        $trail->parent('admin');
        $trail->push('Permissions', route('admin.permission.index'));
    });

    // Caisse
    Breadcrumbs::for('cashbox', function ($trail) {
        $trail->push('Caisse', route('cashbox.index'));
    });

    // Maintenance
    Breadcrumbs::for('maintenance', function ($trail) {
        $trail->push('Maintenance', '#');
    });

    // Maintenance > Garage
    Breadcrumbs::for('garage', function ($trail) {
        $trail->parent('maintenance');
        $trail->push('Garage', route('maintenance.garage.index'));
    });

    // Maintenance > Entretien
    Breadcrumbs::for('maintenance.entretien', function ($trail) {
        $trail->parent('maintenance');
        $trail->push('Entretien', route('maintenance.entretien.index'));
    });

    // Maintenance > Accident
    Breadcrumbs::for('maintenance.accident', function ($trail) {
        $trail->parent('maintenance');
        $trail->push('Accident', route('maintenance.accident.index'));
    });

    // Maintenance > Magasin
    Breadcrumbs::for('warehouse', function ($trail) {
        $trail->parent('maintenance');
        $trail->push('Magasin', route('maintenance.warehouse.part.index'));
    });

    // Ventes
    Breadcrumbs::for('sale', function ($trail) {
        $trail->push('Ventes', route('exploitation.sale.index'));
    });

    // Documents
    Breadcrumbs::for('docs', function ($trail) {
        $trail->push('Documents', '#');
    });

    // Reporting
    Breadcrumbs::for('reporting', function ($trail) {
        $trail->push('Reporting', route('reporting.index'));
    });

    // Clients
    Breadcrumbs::for('customer', function ($trail) {
        $trail->parent('exploitation');
        $trail->push('Clients', route('exploitation.customer.index'));
    });

    /*
    |--------------------------------------------------------------------------
    | Exploitation breadcrumbs
    |--------------------------------------------------------------------------
    |
    | Exploitation
    */
    Breadcrumbs::for('exploitation-index', fn ($trail) =>
    $trail->parent('exploitation')
        ->push('index', '')
    );

    // Exploitation > Trajets
    Breadcrumbs::for('trajet', fn ($trail) =>
    $trail->parent('exploitation')
        ->push('Trajet', '')
    );

    // Exploitation > Type de depense
    Breadcrumbs::for('type', fn ($trail) =>
    $trail->parent('exploitation')
        ->push('Type de depense', '')
    );

    // Exploitation > Dossier de voyage
    Breadcrumbs::for('folders', fn ($trail) =>
    $trail->parent('exploitation')
        ->push('Dossier de voyage',  route('exploitation.folder.index'))
    );

    // Exploitation > Dossier de voyage > Dossier  de voyage en cours
    Breadcrumbs::for('ongoing', fn ($trail) =>
    $trail->parent('folders')
        ->push('Dossier de voyage en cours', '')
    );

    // Exploitation > Dossier de voyage > Dossier de voyage clôturés
    Breadcrumbs::for('closed', fn ($trail) =>
    $trail->parent('folders')
        ->push('Dossier de voyage clôturés', '')
    );

    // Exploitation > Dossier de voyage > Dossier de voyage non facturés
    Breadcrumbs::for('unbilled', fn ($trail) =>
    $trail->parent('folders')
        ->push('Dossier de voyage non facturés', '')
    );


    // Exploitation > Dossier de voyage
    Breadcrumbs::for(
        'folder-show',
        fn ( $trail, \App\Models\Trip $folder) =>
        $trail
            ->parent('folders')
            ->push('Détails du dossier', route('exploitation.folder.details', $folder))
    );

    // Exploitation > Dossier de voyage > {Dossier}
    Breadcrumbs::for('folder-details',
        fn ($trail, \App\Models\Trip $folder) =>
        $trail->parent('folder-show', $folder)
            ->push('Dossier'.' - '.$folder->code_trip, '')
    );

    // Exploitation > Dossier de voyage > {Dossier} > Nouvelle depense
    Breadcrumbs::for('expense-create',
        fn ($trail, \App\Models\Trip $folder) =>
        $trail->parent('folder-details', $folder)
            ->push('Saisir une dépense')
    );

    // Exploitation > Dossier de voyage > {Dossier} > Modifier la depense
    Breadcrumbs::for('expense-edit',
        fn ($trail, \App\Models\Trip $folder) =>
        $trail->parent('folder-details', $folder)
            ->push('Modifier la dépense')
    );

    // Exploitation > Dossier de voyage > {Dossier} > Nouveau un bon de carburant
    Breadcrumbs::for('fuelorder-create',
        fn ($trail, \App\Models\Trip $folder) =>
        $trail->parent('folder-details', $folder)
            ->push('Nouveau bon de carburant')
    );

    // Exploitation > Dossier de voyage > {Dossier} > Modifier bon de carburant
    Breadcrumbs::for('fuelorder-edit',
        fn ($trail, \App\Models\Trip $folder) =>
        $trail->parent('folder-details', $folder)
            ->push('Modifier bon de carburant')
    );

    // Exploitation > Dossier de voyage > {Dossier} > Nouveau un bon de chargement
    Breadcrumbs::for('load-create',
        fn ($trail, \App\Models\Trip $folder) =>
        $trail->parent('folder-details', $folder)
            ->push('Nouveau bon de chargement')
    );

    // Exploitation > Dossier de voyage > {Dossier} > Modifier bon de chargement
    Breadcrumbs::for('load-edit',
        fn ($trail, \App\Models\Trip $folder) =>
        $trail->parent('folder-details', $folder)
            ->push('Modifier bon de chargement')
    );

    // Exploitation > Dossier de voyage > {Dossier} > Nouveau un bon de livraison
    Breadcrumbs::for('unload-create',
        fn ($trail, \App\Models\Trip $folder) =>
        $trail->parent('folder-details', $folder)
            ->push('Nouveau bon de livraison')
    );

    // Exploitation > Dossier de voyage > {Dossier} > Modifier bon de livraison
    Breadcrumbs::for('unload-edit',
        fn ($trail, \App\Models\Trip $folder) =>
        $trail->parent('folder-details', $folder)
            ->push('Modifier bon de livraison')
    );


} catch (\Diglactic\Breadcrumbs\Exceptions\DuplicateBreadcrumbException $e){
}
