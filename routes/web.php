<?php

use App\Http\Controllers\Auth\PermissionController;
use App\Http\Controllers\Auth\RoleController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\Cashbox\BoxController;
use App\Http\Controllers\Cashbox\Operation\ApproBoxController;
use App\Http\Controllers\Cashbox\Operation\CashOutBoxController;
use App\Http\Controllers\Cashbox\Operation\OperationController;
use App\Http\Controllers\Cashbox\Operation\PayExpenseController;
use App\Http\Controllers\Cashbox\Operation\PayOtherController;
use App\Http\Controllers\Cashbox\Operation\PrintOpController;
use App\Http\Controllers\Dashbord\Transport\DashbordController;
use App\Http\Controllers\Docs\DriverDocsController;
use App\Http\Controllers\Docs\TrailerDocsController;
use App\Http\Controllers\Docs\VehDocsController;
use App\Http\Controllers\Exploitation\Customer\CustomerController;
use App\Http\Controllers\Exploitation\Salary\SalaryController;
use App\Http\Controllers\Exploitation\DailyExpense\DailyExpenseController;
use App\Http\Controllers\Exploitation\Divers\ExpenseListController;
use App\Http\Controllers\Exploitation\Divers\FuelListController;
use App\Http\Controllers\Exploitation\Divers\LoadListController;
use App\Http\Controllers\Exploitation\Divers\UnloadListController;
use App\Http\Controllers\Exploitation\OtherExpense\OtherExpenseController;
use App\Http\Controllers\Exploitation\Plan\PlanController;
use App\Http\Controllers\Exploitation\Recap\RecapController;
use App\Http\Controllers\Exploitation\Salary\DetailSalaryController;
use App\Http\Controllers\Exploitation\Sale\DetailController;
use App\Http\Controllers\Exploitation\Sale\SaleController;
use App\Http\Controllers\Exploitation\Setting\DepositController;
use App\Http\Controllers\Exploitation\Setting\ProductController;
use App\Http\Controllers\Exploitation\Setting\RoadController;
use App\Http\Controllers\Exploitation\Setting\TownController;
use App\Http\Controllers\Exploitation\Setting\TypeController;
use App\Http\Controllers\Exploitation\Supplying\SupplyingController;
use App\Http\Controllers\Exploitation\Trip\ExpenseController;
use App\Http\Controllers\Exploitation\Trip\FolderClosedController;
use App\Http\Controllers\Exploitation\Trip\FolderController;
use App\Http\Controllers\Exploitation\Trip\FolderOngoingController;
use App\Http\Controllers\Exploitation\Trip\FolderUnbiledController;
use App\Http\Controllers\Exploitation\Trip\FuelController;
use App\Http\Controllers\Exploitation\Trip\LoadController;
use App\Http\Controllers\Exploitation\Trip\PrintFolderController;
use App\Http\Controllers\Exploitation\Trip\PrintLoadController;
use App\Http\Controllers\Exploitation\Trip\PrintUnloadController;
use App\Http\Controllers\Exploitation\Trip\UnloadController;
use App\Http\Controllers\Fleet\AssignationController;
use App\Http\Controllers\Fleet\DriverController;
use App\Http\Controllers\Fleet\LinkController;
use App\Http\Controllers\Fleet\RevokeAssignationController;
use App\Http\Controllers\Fleet\RevokeLinkController;
use App\Http\Controllers\Fleet\Setting\BrandController;
use App\Http\Controllers\Fleet\Setting\PatternController;
use App\Http\Controllers\Fleet\TrailerController;
use App\Http\Controllers\Fleet\Vehicle\AvailableFleetController;
use App\Http\Controllers\Fleet\Vehicle\GarageFleetController;
use App\Http\Controllers\Fleet\Vehicle\LinkedTractorController;
use App\Http\Controllers\Fleet\Vehicle\PrintFleetController;
use App\Http\Controllers\Fleet\Vehicle\ReformFleetController;
use App\Http\Controllers\Fleet\Vehicle\TravelFleetController;
use App\Http\Controllers\Fleet\Vehicle\UnlinkedTractorController;
use App\Http\Controllers\Fleet\Vehicle\VehicleHasDriverController;
use App\Http\Controllers\Fleet\Vehicle\VehicleWithoutDriverController;
use App\Http\Controllers\Fleet\VehicleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Maintenance\Accident\AccidentController;
use App\Http\Controllers\Maintenance\Garage\DetailMaintenanceController;
use App\Http\Controllers\Maintenance\Garage\GarageController;
use App\Http\Controllers\Maintenance\Garage\MaintenanceController;
use App\Http\Controllers\Maintenance\Inventory\CreateDetailInventoryController;
use App\Http\Controllers\Maintenance\Inventory\Detail\DeleteDetailInventoryController;
use App\Http\Controllers\Maintenance\Inventory\Detail\PrintPartController;
use App\Http\Controllers\Maintenance\Inventory\InventoryController;
use App\Http\Controllers\Maintenance\Provider\ProviderController;
use App\Http\Controllers\Maintenance\Reform\ReformController;
use App\Http\Controllers\Maintenance\Repair\DetailRepairController;
use App\Http\Controllers\Maintenance\Repair\RepairController;
use App\Http\Controllers\Maintenance\Setting\BuyerController;
use App\Http\Controllers\Maintenance\Setting\CategoryController;
use App\Http\Controllers\Maintenance\Setting\MotifController;
use App\Http\Controllers\Maintenance\Warehouse\Order\DetailOrderController;
use App\Http\Controllers\Maintenance\Warehouse\Order\OrderController;
use App\Http\Controllers\Maintenance\Warehouse\Part\PartController;
use App\Http\Controllers\Maintenance\Warehouse\Purchase\DetailPurchaseController;
use App\Http\Controllers\Maintenance\Warehouse\Purchase\PurchaseController;
use App\Http\Controllers\Maintenance\Warehouse\ReportController;
use App\Http\Controllers\Maintenance\Warehouse\Voucher\DetailExitVoucherController;
use App\Http\Controllers\Maintenance\Warehouse\Voucher\EntranceVoucherController;
use App\Http\Controllers\Maintenance\Warehouse\Voucher\ExitVoucherController;
use App\Http\Controllers\Reporting\Transport\ReportingController;
use App\Http\Controllers\Tiers\Exploitation\TiersExpenseController;
use App\Http\Controllers\Tiers\Exploitation\TiersFolderClosedController;
use App\Http\Controllers\Tiers\Exploitation\TiersFolderController;
use App\Http\Controllers\Tiers\Exploitation\TiersFolderUnbiledController;
use App\Http\Controllers\Tiers\Exploitation\TiersFuelController;
use App\Http\Controllers\Tiers\Exploitation\TiersLoadController;
use App\Http\Controllers\Tiers\Exploitation\TiersPrintFolderController;
use App\Http\Controllers\Tiers\Exploitation\TiersPrintLoadController;
use App\Http\Controllers\Tiers\Exploitation\TiersPrintUnloadController;
use App\Http\Controllers\Tiers\Exploitation\TiersUnloadController;
use App\Http\Controllers\Tiers\Fleet\TiersVehicleController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', HomeController::class);

    // Administration routes
    Route::group([
        'prefix' => 'admin',
        'as' => 'admin.'
    ],
        function (){
            // users route
            Route::group([
                'prefix' => 'user',
                'as' => 'user.'
            ], function (){
                Route::get('/', [UserController::class, 'index'])->name('index');
                Route::post('/store', [UserController::class, 'store'])->name('store');
                Route::get('/{user:uuid}/edit', [UserController::class, 'edit'])->name('edit');
                Route::put('/{user:uuid}', [UserController::class, 'update'])->name('update');
                Route::delete('/{user:uuid}', [UserController::class, 'destroy'])->name('delete');
                //Route::get('/{exit:uuid}/print', [ExitController::class, 'print'])->name('print');
            });

            // permission route
            Route::group([
                'prefix' => 'permission',
                'as' => 'permission.'
            ], function (){
                Route::get('/', [PermissionController::class, 'index'])->name('index');
            });

            // setting route
            Route::group([
                'prefix' => 'role',
            ], function (){
                Route::resource('role', RoleController::class)->except(['create', 'show']);
            });
    });

    Route::get('dashboard', [DashbordController::class, 'index'])->name('dashbord.index');
    Route::group([
        'prefix' => 'reporting',
        'as' => 'reporting.'
    ], function (){
        Route::get('index', [ReportingController::class, 'index'])->name('index');
        Route::get('turnover', [ReportingController::class, 'turnover'])->name('turnover');
        Route::get('maintenance', [ReportingController::class, 'maintenance'])->name('maintenance');
        Route::get('purchaseParts', [ReportingController::class, 'purchaseParts'])->name('purchaseParts');
        Route::get('salary', [ReportingController::class, 'salary'])->name('salary');
        Route::get('print-salary', [ReportingController::class, 'printSalary'])->name('print_salary');
        Route::get('missing', [ReportingController::class, 'missing'])->name('missing');
        Route::get('tripExpense', [ReportingController::class, 'tripExpense'])->name('TripExpense');
        Route::get('exploitation', [ReportingController::class, 'exploitation'])->name('exploitation');
        Route::get('annual-exp', [ReportingController::class, 'annualExploitation'])->name('annual-exp');
        Route::get('print-annual-exp', [ReportingController::class, 'printAnnualExploitation'])->name('print-annual-exp');
        Route::get('print', [ReportingController::class, 'printExploitation'])->name('print_exploitation');
        Route::get('unloads', [ReportingController::class, 'unloads'])->name('unloads');
        Route::get('print-unloads', [ReportingController::class, 'print_unloads'])->name('print-unloads');
        Route::get('fuels', [ReportingController::class, 'fuels'])->name('fuels');
        Route::get('print-fuels', [ReportingController::class, 'print_fuels'])->name('print_fuels');
        Route::get('/fuelsExport', [ReportingController::class, 'exportFuelExcel'])->name('fuel-export');
    });

    // module fleet route
    Route::group([
        'prefix' => 'fleet',
        'as' => 'fleet.'
    ],
        function (){
            // index route
            Route::get('/', fn () => view('fleet.index'))->name('index');

            // setting route
            Route::group([
                'prefix' => 'setting',
                'as' => 'setting.'
            ], function (){
                Route::resource('brand', BrandController::class)->except(['create', 'show']);
                Route::resource('pattern', PatternController::class)->except(['create', 'show']);
            });

            // vehicle route
            Route::group([
                'prefix' => 'vehicle',
                'as' => 'vehicle.'
            ], function (){
                Route::get('/', [VehicleController::class, 'index'])->name('index');
                Route::get('/printable', PrintFleetController::class)->name('printable');
                Route::get('/print', [VehicleController::class, 'print'])->name('print-fleet');
                Route::post('/store', [VehicleController::class, 'store'])->name('store');
                Route::get('/{vehicle:uuid}', [VehicleController::class, 'show'])->name('show');
                Route::get('/{vehicle:uuid}/edit', [VehicleController::class, 'edit'])->name('edit');
                Route::put('/{vehicle:uuid}', [VehicleController::class, 'update'])->name('update');
                Route::group([
                    'prefix' => 'state',
                    'as' =>'state.'
                ], function () {
                    Route::get('/available', AvailableFleetController::class)->name('available');
                    Route::get('/travel', TravelFleetController::class)->name('travel');
                    Route::get('/garage', GarageFleetController::class)->name('garage');
                    Route::get('/reform', ReformFleetController::class)->name('reform');
                    Route::get('/unlinked-tractor', UnlinkedTractorController::class)->name('unlinked-tractor');
                    Route::get('/linked-tractor', LinkedTractorController::class)->name('linked-tractor');
                    Route::get('/has-driver', VehicleHasDriverController::class)->name('has-driver');
                    Route::get('/without-driver', VehicleWithoutDriverController::class)->name('without-driver');
                });
            });

            // trailer route
            Route::group([
                'prefix' => 'trailer',
                'as' => 'trailer.'
            ], function (){
                Route::get('/', [TrailerController::class, 'index'])->name('index');
                Route::get('/garage', [TrailerController::class, 'garage'])->name('garage');
                Route::get('reform', [TrailerController::class, 'reform'])->name('reform');
                Route::post('/store', [TrailerController::class, 'store'])->name('store');
                Route::get('/{trailer:uuid}', [TrailerController::class, 'show'])->name('show');
                Route::get('/{trailer:uuid}/edit', [TrailerController::class, 'edit'])->name('edit');
                Route::put('/{trailer:uuid}', [TrailerController::class, 'update'])->name('update');
            });

            // driver route
            Route::group([
                'prefix' => 'driver',
                'as' => 'driver.'
            ], function (){
                Route::get('/', [DriverController::class, 'index'])->name('index');
                Route::post('/store', [DriverController::class, 'store'])->name('store');
                Route::get('/{driver:uuid}', [DriverController::class, 'show'])->name('show');
                Route::get('/{driver:uuid}/edit', [DriverController::class, 'edit'])->name('edit');
                Route::put('/{driver:uuid}', [DriverController::class, 'update'])->name('update');
            });

            // assignation route
            Route::group([
                'prefix' => 'assignation',
                'as' => 'assignation.'
            ], function (){
                Route::get('/', [AssignationController::class, 'index'])->name('index');
                Route::post('/store', [AssignationController::class, 'store'])->name('store');
                Route::get('/edit/{assignation:uuid}',[AssignationController::class, 'edit'])->name('edit');
                Route::delete('/{assignation:uuid}', [AssignationController::class, 'delete'])->name('delete');
                Route::post('/revoke/{driver:uuid}', [RevokeAssignationController::class, '__invoke'])->name('revoke');
            });

            // link route
            Route::group([
                'prefix' => 'link',
                'as' => 'link.'
            ], function (){
                Route::get('/', [LinkController::class, 'index'])->name('index');
                Route::post('/store', [LinkController::class, 'store'])->name('store');
                Route::get('/edit/{link:uuid}', [LinkController::class, 'edit'])->name('edit');
                Route::delete('/{link:uuid}', [LinkController::class, 'delete'])->name('delete');
                Route::post('/revoke/{vehicle:uuid}', [RevokeLinkController::class, '__invoke'])->name('revoke');
            });

        });

    // module tier fleet route
    Route::group([
        'prefix' => 'tiers',
        'as' => 'tiers.'
    ],
        function (){
            Route::group([
                'prefix' => 'fleet',
                'as' => 'fleet.'
            ], function (){
                // vehicle route
                Route::group([
                    'prefix' => 'vehicle',
                    'as' => 'vehicle.'
                ], function (){
                    Route::get('/', [TiersVehicleController::class, 'index'])->name('index');
                    Route::post('/store', [TiersVehicleController::class, 'store'])->name('tiers.store');
                    Route::get('/{vehicle:uuid}/edit', [TiersVehicleController::class, 'edit'])->name('edit');
                    Route::put('/{vehicle:uuid}', [TiersVehicleController::class, 'update'])->name('update');
                });
            });

            // Exploitation group
            Route::group([
                'prefix' => 'exploitation',
                'as' => 'exploitation.'
            ], function (){
                //index route
                Route::get('/', fn () => view('tiers.exploitation.index'))->name('index');

                // folder route
                Route::group([
                    'prefix' => 'folder',
                    'as' => 'folder.',
                ],
                    function (){
                        Route::get('/', [TiersFolderController::class, 'index'])->name('index');
                        Route::post('/store', [TiersFolderController::class, 'store'])->name('store');
                        Route::get('/{folder:uuid}/edit', [TiersFolderController::class, 'edit'])->name('edit');
                        Route::put('/{folder:uuid}/update', [TiersFolderController::class, 'update'])->name('update');
                        Route::get('/{folder:uuid}', [TiersFolderController::class, 'show'])->name('details');
                        Route::put('/{folder:uuid}', [TiersFolderController::class, 'closed'])->name('closed');
                        Route::put('/{folder:uuid}/open', [TiersFolderController::class, 'opened'])->name('open');
                        Route::get('/{folder:uuid}/print', TiersPrintFolderController::class)->name('print');
                        Route::get('/{folder:uuid}/expenses/print', [TiersFolderController::class, 'printExpenses'])->name('printExpenses');
                        Route::delete('/{folder:uuid}', [TiersFolderController::class, 'delete'])->name('delete');

                        Route::group([
                            'prefix' => 'status',
                            'as' =>'status.'
                        ], function () {
                            Route::get('/ongoing', FolderOngoingController::class)->name('ongoing');
                            Route::get('/closed', TiersFolderClosedController::class)->name('closed');
                            Route::get('/unbilled', TiersFolderUnbiledController::class)->name('unbilled');
                        });

                        Route::group([
                            'prefix' => 'product',
                            'as' =>'product.'
                        ], function () {
                            Route::get('/essence', [TiersFolderController::class, 'essence'])->name('essence');
                            Route::get('/gasoil', [TiersFolderController::class, 'gasoil'])->name('gasoil');
                            Route::get('/fuel', [TiersFolderController::class, 'fuel'])->name('fuel');
                        });

                        Route::group([
                            'prefix' => 'fuel',
                            'as' => 'fuel.'
                        ], function (){
                            Route::get('/{folder:uuid}/create', [TiersFuelController::class, 'create'])->name('create');
                            Route::get('/{folder:uuid}/{fuelorder:uuid}', [TiersFuelController::class, 'fuelorder'])->name('fuelorder');
                            Route::get('/{folder:uuid}/{fuelorder:uuid}/print', [TiersFuelController::class, 'printfuelorder'])->name('printfuelorder');
                            Route::post('/{folder:uuid}/store', [TiersFuelController::class, 'store'])->name('store');
                            Route::get('/{folder:uuid}/edit/{fuelorder:uuid}', [TiersFuelController::class, 'edit'])->name('edit');
                            Route::put('/{folder:uuid}/edit/{fuelorder:uuid}', [TiersFuelController::class, 'update'])->name('update');
                            Route::delete('/{folder:uuid}/{fuelorder:uuid}', [TiersFuelController::class, 'delete'])->name('delete');
                        });

                        Route::group([
                            'prefix' => 'load',
                            'as' => 'load.'
                        ], function (){
                            Route::get('/{folder:uuid}/create', [TiersLoadController::class, 'create'])->name('create');
                            Route::get('/{folder:uuid}/{load:uuid}/print', TiersPrintLoadController::class)->name('printload');
                            Route::post('/{folder:uuid}/store', [TiersLoadController::class, 'store'])->name('store');
                            Route::get('/{folder:uuid}/edit/{load:uuid}', [TiersLoadController::class, 'edit'])->name('edit');
                            Route::put('/{folder:uuid}/edit/{load:uuid}', [TiersLoadController::class, 'update'])->name('update');
                            Route::delete('/{folder:uuid}/{load:uuid}', [TiersLoadController::class, 'delete'])->name('delete');
                        });

                        Route::group([
                            'prefix' => 'unload',
                            'as' => 'unload.'
                        ], function (){
                            Route::get('/{folder:uuid}/create', [TiersUnloadController::class, 'create'])->name('create');
                            Route::get('/{folder:uuid}/{unload:uuid}/print', TiersPrintUnloadController::class)->name('printload');
                            Route::post('/{folder:uuid}/store', [TiersUnloadController::class, 'store'])->name('store');
                            Route::get('/{folder:uuid}/edit/{unload:uuid}', [TiersUnloadController::class, 'edit'])->name('edit');
                            Route::put('/{folder:uuid}/edit/{unload:uuid}', [TiersUnloadController::class, 'update'])->name('update');
                            Route::delete('/{folder:uuid}/{unload:uuid}', [TiersUnloadController::class, 'delete'])->name('delete');
                        });

                        Route::group([
                            'prefix' => 'expense',
                            'as' => 'expense.'
                        ], function (){
                            Route::get('/{folder:uuid}/create', [TiersExpenseController::class, 'create'])->name('create');
                            Route::post('/{folder:uuid}/store', [TiersExpenseController::class, 'store'])->name('store');
                            Route::get('/{folder:uuid}/edit/{expense:uuid}', [TiersExpenseController::class, 'edit'])->name('edit');
                            Route::get('/{folder:uuid}/{expense:uuid}/print', [TiersExpenseController::class, 'printExpense'])->name('print');
                            Route::put('/{folder:uuid}/edit/{expense:uuid}', [TiersExpenseController::class, 'update'])->name('update');
                            Route::delete('/{folder:uuid}/{expense:uuid}', [TiersExpenseController::class, 'delete'])->name('delete');
                        });
                    });
            });

        });

// module exploitation route
    Route::group([
        'prefix' => 'exploitation',
        'as' => 'exploitation.'
    ],
        function (){
            //index route
            Route::get('/', fn () => view('exploitation.index'))->name('index');

            // setting route
            Route::group([
                'prefix' => 'setting',
                'as' => 'setting.'
            ],
                function (){
                    Route::resource('town', TownController::class)->except(['create', 'show']);
                    Route::resource('road', RoadController::class)->except(['create', 'show']);
                    Route::resource('type', TypeController::class)->except(['create', 'show']);
                    Route::resource('product', ProductController::class)->except(['create', 'show']);
                    Route::resource('deposit', DepositController::class)->except(['create', 'show']);
                });

            // customer route
            Route::group([
                'prefix' => 'customer',
            ],
                function (){
                    Route::resource('customer', CustomerController::class)->except(['create', 'show']);
                });

            // salary route
            Route::group([
                'prefix' => 'salary',
                'as' => 'salary.'
            ], function (){
                Route::get('/', [SalaryController::class, 'index'])->name('index');
                Route::post('/store', [SalaryController::class, 'store'])->name('store');
                Route::get('/{state}', [SalaryController::class, 'show'])->name('show');
                Route::put('/{state}/validated', [SalaryController::class, 'validated'])->name('validated');
                Route::put('/{state}/init', [SalaryController::class, 'initAmount'])->name('init');
                Route::post('/{state}/add', [SalaryController::class, 'addDriver'])->name('add-driver');
                Route::get('/{state}/print', [SalaryController::class, 'print_state'])->name('print');

                // salary details route
                Route::group([
                    'prefix' => 'details',
                    'as' => 'details.'
                ], function(){
                    Route::get('/{salary}', [DetailSalaryController::class, 'edit'])->name('edit');
                    Route::put('/{salary}/update', [DetailSalaryController::class, 'update'])->name('update');
                    Route::delete('/{salary}', [DetailSalaryController::class, 'destroy'])->name('delete');
                });
            });

            // folder route
            Route::group([
                'prefix' => 'folder',
                'as' => 'folder.',
            ],
                function (){
                    Route::get('/', [FolderController::class, 'index'])->name('index');
                    Route::post('/store', [FolderController::class, 'store'])->name('store');
                    Route::get('/{folder:uuid}/edit', [FolderController::class, 'edit'])->name('edit');
                    Route::put('/{folder:uuid}/update', [FolderController::class, 'update'])->name('update');
                    Route::get('/{folder:uuid}', [FolderController::class, 'show'])->name('details');
                    Route::put('/{folder:uuid}', [FolderController::class, 'closed'])->name('closed');
                    Route::put('/{folder:uuid}/open', [FolderController::class, 'opened'])->name('open');
                    Route::get('/{folder:uuid}/print', PrintFolderController::class)->name('print');
                    Route::delete('/{folder:uuid}', [FolderController::class, 'delete'])->name('delete');

                    Route::group([
                        'prefix' => 'status',
                        'as' =>'status.'
                    ], function () {
                        Route::get('/ongoing', FolderOngoingController::class)->name('ongoing');
                        Route::get('/closed', FolderClosedController::class)->name('closed');
                        Route::get('/unbilled', FolderUnbiledController::class)->name('unbilled');
                    });

                    Route::group([
                        'prefix' => 'product',
                        'as' =>'product.'
                    ], function () {
                        Route::get('/essence', [FolderController::class, 'essence'])->name('essence');
                        Route::get('/gasoil', [FolderController::class, 'gasoil'])->name('gasoil');
                        Route::get('/fuel', [FolderController::class, 'fuel'])->name('fuel');
                    });

                    Route::group([
                        'prefix' => 'fuel',
                        'as' => 'fuel.'
                    ], function (){
                        Route::get('/{folder:uuid}/create', [FuelController::class, 'create'])->name('create');
                        Route::get('/{folder:uuid}/{fuelorder:uuid}', [FuelController::class, 'fuelorder'])->name('fuelorder');
                        Route::get('/{folder:uuid}/{fuelorder:uuid}/print', [FuelController::class, 'printfuelorder'])->name('printfuelorder');
                        Route::post('/{folder:uuid}/store', [FuelController::class, 'store'])->name('store');
                        Route::get('/{folder:uuid}/edit/{fuelorder:uuid}', [FuelController::class, 'edit'])->name('edit');
                        Route::put('/{folder:uuid}/edit/{fuelorder:uuid}', [FuelController::class, 'update'])->name('update');
                        Route::delete('/{folder:uuid}/{fuelorder:uuid}', [FuelController::class, 'delete'])->name('delete');
                    });

                    Route::group([
                        'prefix' => 'load',
                        'as' => 'load.'
                    ], function (){
                        Route::get('/{folder:uuid}/create', [LoadController::class, 'create'])->name('create');
                        Route::get('/{folder:uuid}/{load:uuid}/print', PrintLoadController::class)->name('printload');
                        Route::post('/{folder:uuid}/store', [LoadController::class, 'store'])->name('store');
                        Route::get('/{folder:uuid}/edit/{load:uuid}', [LoadController::class, 'edit'])->name('edit');
                        Route::put('/{folder:uuid}/edit/{load:uuid}', [LoadController::class, 'update'])->name('update');
                        Route::delete('/{folder:uuid}/{load:uuid}', [LoadController::class, 'delete'])->name('delete');
                    });

                    Route::group([
                        'prefix' => 'unload',
                        'as' => 'unload.'
                    ], function (){
                        Route::get('/{folder:uuid}/create', [UnloadController::class, 'create'])->name('create');
                        Route::get('/{folder:uuid}/{unload:uuid}/print', PrintUnloadController::class)->name('printload');
                        Route::post('/{folder:uuid}/store', [UnloadController::class, 'store'])->name('store');
                        Route::get('/{folder:uuid}/edit/{unload:uuid}', [UnloadController::class, 'edit'])->name('edit');
                        Route::put('/{folder:uuid}/edit/{unload:uuid}', [UnloadController::class, 'update'])->name('update');
                        Route::delete('/{folder:uuid}/{unload:uuid}', [UnloadController::class, 'delete'])->name('delete');
                    });

                    Route::group([
                        'prefix' => 'expense',
                        'as' => 'expense.'
                    ], function (){
                        Route::get('/{folder:uuid}/create', [ExpenseController::class, 'create'])->name('create');
                        Route::post('/{folder:uuid}/store', [ExpenseController::class, 'store'])->name('store');
                        Route::get('/{folder:uuid}/edit/{expense:uuid}', [ExpenseController::class, 'edit'])->name('edit');
                        Route::get('/{folder:uuid}/{expense:uuid}/print', [ExpenseController::class, 'printExpense'])->name('print');
                        Route::put('/{folder:uuid}/edit/{expense:uuid}', [ExpenseController::class, 'update'])->name('update');
                        Route::delete('/{folder:uuid}/{expense:uuid}', [ExpenseController::class, 'delete'])->name('delete');
                    });
                });

            // plan route
            Route::group([
                'prefix' => 'plan',
                'as' => 'plan.'
            ], function (){
                Route::get('/', [PlanController::class, 'index'])->name('index');
                Route::get('/{plan:uuid}', [PlanController::class, 'show'])->name('show');
                Route::get('/{plan:uuid}/print', [PlanController::class, 'printPlan'])->name('print');
            });

            // Other expenses route
            Route::group([
                'prefix' => 'other',
                'as' => 'other.'
            ], function (){
                Route::get('/', [OtherExpenseController::class, 'index'])->name('index');
                Route::post('/store', [OtherExpenseController::class, 'store'])->name('store');
                Route::get('/{other:uuid}/edit', [OtherExpenseController::class, 'edit'])->name('edit');
                Route::put('/{other:uuid}', [OtherExpenseController::class, 'update'])->name('update');
                Route::delete('/{other:uuid}', [OtherExpenseController::class, 'delete'])->name('delete');
                Route::get('/{other:uuid}/print', [OtherExpenseController::class, 'printOtherExpense'])->name('print');
                Route::any('/print-bulk', [OtherExpenseController::class, 'printSelected'])->name('print-bulk');
            });

            // suppling route
            Route::group([
                'prefix' => 'supplying',
                'as' => 'supplying.'
            ], function (){
                Route::get('/', [SupplyingController::class, 'index'])->name('index');
                Route::get('/{supplying:uuid}', [SupplyingController::class, 'show'])->name('show');
                Route::get('/{supplying:uuid}/print', [SupplyingController::class, 'printSupply'])->name('print');
            });

            // daily expense route
            Route::group([
                'prefix' => 'daily-expense',
                'as' => 'daily-expense.'
            ], function (){
                Route::get('/', [DailyExpenseController::class, 'index'])->name('index');
                Route::get('/{dailyExpense:uuid}', [DailyExpenseController::class, 'show'])->name('show');
                Route::get('/{dailyExpense:uuid}/print', [DailyExpenseController::class, 'printDaily'])->name('print');
            });

            // daily expense route
            Route::group([
                'prefix' => 'recap-expense',
                'as' => 'recap-expense.'
            ], function (){
                Route::get('/', [RecapController::class, 'index'])->name('index');
                Route::get('/{daily}/print', [RecapController::class, 'printDaily'])->name('print');
            });

            // fuel list route
            Route::group([
                'prefix' => 'fuel',
                'as' => 'fuel.'
            ], function (){
                Route::get('/', [FuelListController::class, 'index'])->name('index');
                Route::get('/{fuel:uuid}/print', [FuelListController::class, 'printfuel'])->name('print');
                Route::any('/print-bulk', [FuelListController::class, 'printSelected'])->name('print-bulk');
                Route::put('/{fuel:uuid}/toggle-status', [FuelListController::class, 'toggleStatus'])->name('toggle-status');
            });

            // load list route
            Route::group([
                'prefix' => 'load',
                'as' => 'load.'
            ], function (){
                Route::get('/', [LoadListController::class, 'index'])->name('index');
                Route::get('/{load:uuid}/print', [LoadListController::class, 'printload'])->name('print');
            });

            // expense list route
            Route::group([
                'prefix' => 'expense',
                'as' => 'expense.'
            ], function (){
                Route::get('/', [ExpenseListController::class, 'index'])->name('index');
                Route::get('/{expense:uuid}/print', [ExpenseListController::class, 'printexpense'])->name('print');
                Route::any('/print-bulk', [ExpenseListController::class, 'printSelected'])->name('print-bulk');
                Route::put('/{expense:uuid}/toggle-status', [ExpenseListController::class, 'toggleStatus'])->name('toggle-status');
            });

            // unload list route
            Route::group([
                'prefix' => 'unload',
                'as' => 'unload.'
            ], function (){
                Route::get('/', [UnloadListController::class, 'index'])->name('index');
                Route::get('/{unload:uuid}/print', [UnloadListController::class, 'printUnload'])->name('print');
            });

            Route::group([
                'prefix' => 'sale',
                'as' => 'sale.'
            ], function (){
                Route::get('/', [SaleController::class, 'index'])->name('index');
                Route::get('/{customer}/{sale:uuid}/edit', [SaleController::class, 'edit'])->name('edit');
                Route::put('/{customer}/{sale:uuid}', [SaleController::class, 'update'])->name('update');
                Route::get('/state', [SaleController::class, 'state'])->name('state');
                Route::post('/{customer}/store', [SaleController::class, 'store'])->name('store');
                Route::get('/{customer}/{sale:uuid}/create', [SaleController::class, 'create'])->name('create');
                Route::get('/{customer}/{sale:uuid}/invoice', [SaleController::class, 'invoice'])->name('invoice');
                Route::get('/{customer}/{sale:uuid}/invoice-print', [SaleController::class, 'print'])->name('invoice-print');
                Route::delete('/{sale:uuid}', [SaleController::class, 'delete'])->name('delete');
                Route::group([
                    'prefix' => 'detail',
                    'as' => 'detail.'
                ], function (){
                    Route::post('/{sale:uuid}/{customer}/create', [DetailController::class, 'store'])->name('store');
                    Route::delete('/{detail}', [DetailController::class, 'delete'])->name('delete');
                });
            });
        });

    Route::group([
        'prefix' => 'maintenance',
        'as' => 'maintenance.'
    ],
        function (){
            Route::get('/', fn () => view('maintenance.index'))->name('index');

            Route::group([
                'prefix' => 'provider',
            ],
                function (){
                    Route::resource('provider', ProviderController::class)->except(['create', 'show']);
                });

            // setting route
            Route::group([
                'prefix' => 'setting',
                'as' => 'setting.'
            ],
                function (){
                    Route::resource('category', CategoryController::class)->except(['create', 'show']);
                    Route::resource('motif', MotifController::class)->except(['create', 'show']);
                    Route::resource('buyer', BuyerController::class)->except(['create', 'show']);
                }
            );

            // repair route
            Route::group([
                'prefix' => 'repair',
                'as' => 'repair.'
            ],
                function (){
                    Route::get('/', [RepairController::class, 'index'])->name('index');
                    //Route::get('/create', [RepairController::class, 'create'])->name('create');
                    Route::post('/store', [RepairController::class, 'store'])->name('store');
                    Route::get('/{repair:uuid}', [RepairController::class, 'detail'])->name('detail');
                    Route::put('/{repair:uuid}/closed', [RepairController::class, 'closed'])->name('closed');
                    Route::put('/{repair:uuid}/opened', [RepairController::class, 'opened'])->name('opened');
                    Route::get('/{repair:uuid}/print', [RepairController::class, 'print'])->name('print');
                    Route::delete('/{repair:uuid}', [RepairController::class, 'delete'])->name('delete');

                    //repair - parts
                    Route::group([
                        'prefix' => 'part',
                        'as' => 'part.'
                    ], function (){
                        Route::post('/{repair:uuid}/create', [DetailRepairController::class, 'store'])->name('store');
                        Route::delete('/{detail}', [DetailRepairController::class, 'delete'])->name('delete');
                    });

                }
            );

            // accident route
            Route::group([
                'prefix' => 'accident',
                'as' => 'accident.'
            ],
                function (){
                    Route::get('/', [AccidentController::class, 'index'])->name('index');
                    Route::get('/{vehicle:uuid}/create', [AccidentController::class, 'create'])->name('create');
                    Route::post('/{vehicle:uuid}', [AccidentController::class, 'store'])->name('store');
                    Route::get('/{vehicle:uuid}/{accident:uuid}', [AccidentController::class, 'edit'])->name('edit');
                    Route::put('/{accident:uuid}', [AccidentController::class, 'update'])->name('update');
                    Route::get('/{vehicle:uuid}/{accident:uuid}/print', [AccidentController::class, 'print'])->name('print');
                    Route::delete('/{accident:uuid}', [AccidentController::class, 'delete'])->name('delete');
                }
            );

            // accident route
            Route::group([
                'prefix' => 'garage',
                'as' => 'garage.'
            ],
                function (){
                    Route::get('/', [GarageController::class, 'index'])->name('index');
                    Route::get('/{vehicle:uuid}/create', [GarageController::class, 'create'])->name('create');
                    Route::post('/{vehicle:uuid}', [GarageController::class, 'store'])->name('store');
                    Route::get('/{garage}', [GarageController::class, 'edit'])->name('edit');
                    Route::put('/{garage}', [GarageController::class, 'update'])->name('update');
                    //Route::get('/{vehicle:uuid}/{accident:uuid}/print', [AccidentController::class, 'print'])->name('print');
                    Route::delete('/{garage}', [GarageController::class, 'delete'])->name('delete');
                }
            );

            // accident route
            Route::group([
                'prefix' => 'entretien',
                'as' => 'entretien.'
            ],
                function (){
                    Route::post('/{garage}', [MaintenanceController::class, 'store'])->name('store');
                    Route::get('/{garage}/{maintenance:uuid}/detail', [MaintenanceController::class, 'detail'])->name('detail');
                    Route::get('/{garage}/{maintenance:uuid}/print', [MaintenanceController::class, 'print'])->name('print');
                    Route::get('/{maintenance:uuid}/edit', [MaintenanceController::class, 'edit'])->name('edit');
                    Route::put('/{maintenance:uuid}', [MaintenanceController::class, 'update'])->name('update');
                    Route::put('/{garage}/closed', [MaintenanceController::class, 'closed'])->name('closed');
                    Route::put('/{garage}/open', [MaintenanceController::class, 'opened'])->name('opened');

                    Route::group([
                        'prefix' => 'part',
                        'as' => 'part.'
                    ], function (){
                        Route::post('/{maintenance:uuid}/create', [DetailMaintenanceController::class, 'store'])->name('store');
                        Route::delete('/{detail}', [DetailMaintenanceController::class, 'delete'])->name('delete');
                    });
                }
            );

            // reform route
            Route::group([
                'prefix' => 'reform',
                'as' => 'reform.'
            ],
                function (){
                    Route::get('/', [ReformController::class, 'index'])->name('index');
                    Route::get('/{vehicle:uuid}/create', [ReformController::class, 'create'])->name('create');
                    Route::post('/{vehicle:uuid}', [ReformController::class, 'store'])->name('store');
                    Route::delete('/{reform}', [ReformController::class, 'delete'])->name('delete');
                }
            );

            // Inventories route
            Route::group([
                'prefix' => 'inventory',
                'as' => 'inventory.'
            ],
                function (){
                    Route::get('/', [InventoryController::class, 'index'])->name('index');
                    Route::post('/store', [InventoryController::class, 'store'])->name('store');
                    Route::get('/{inventory:uuid}/details', [InventoryController::class, 'detail'])->name('detail');
                    Route::post('/{inventory:uuid}/store', [CreateDetailInventoryController::class, '__invoke'])->name('create-detail');
                    Route::get('/{inventory:uuid}/print-part', [PrintPartController::class, '__invoke'])->name('print-part');
                    Route::put('/{inventory:uuid}/closed', [InventoryController::class, 'closed'])->name('closed-inventory');
                    Route::delete('/{inventory:uuid}', [InventoryController::class, 'delete'])->name('inventory-delete');
                    Route::delete('/{inventory:uuid}/{detail}', [DeleteDetailInventoryController::class, '__invoke'])->name('detail-delete');
                }
            );

            Route::group([
                'prefix' => 'warehouse',
                'as' => 'warehouse.'
            ], function(){
                Route::get('/', fn () => view('maintenance.warehouse.index'))->name('index');

                // Parts route
                Route::group([
                    'prefix' => 'part',
                    'as' => 'part.'
                ],
                    function (){
                        Route::get('/', [PartController::class, 'index'])->name('index');
                        Route::post('/store', [PartController::class, 'store'])->name('store');
                        Route::get('/{part:uuid}/edit', [PartController::class, 'edit'])->name('edit');
                        Route::put('/{part:uuid}', [PartController::class, 'update'])->name('update');
                    }
                );

                // Purchases route
                Route::group([
                    'prefix' => 'purchase',
                    'as' => 'purchase.'
                ],
                    function (){
                        Route::get('/', [PurchaseController::class, 'index'])->name('index');
                        Route::post('/store', [PurchaseController::class, 'store'])->name('store');
                        Route::get('/{purchase:uuid}', [PurchaseController::class, 'detail'])->name('detail');
                        Route::put('/{purchase:uuid}/validated', [PurchaseController::class, 'validated'])->name('validated');
                        Route::put('/{purchase:uuid}/opened', [PurchaseController::class, 'opened'])->name('opened');
                        Route::get('/{purchase:uuid}/print', [PurchaseController::class, 'print'])->name('print');
                        Route::delete('/{purchase:uuid}', [PurchaseController::class, 'delete'])->name('delete');

                        Route::group([
                            'prefix' => 'part',
                            'as' => 'part.'
                        ], function (){
                            Route::post('/{purchase:uuid}/create', [DetailPurchaseController::class, 'store'])->name('store');
                            Route::delete('/{detail}', [DetailPurchaseController::class, 'delete'])->name('delete');
                        });
                    }
                );

                // order route
                Route::group([
                    'prefix' => 'order',
                    'as' => 'order.'
                ],
                    function (){
                        Route::get('/', [OrderController::class, 'index'])->name('index');
                        Route::post('/store', [OrderController::class, 'store'])->name('store');
                        Route::get('/{order:uuid}', [OrderController::class, 'detail'])->name('detail');
                        Route::get('/{order:uuid}/print', [OrderController::class, 'print'])->name('print');
                        Route::put('/{order:uuid}/validated', [OrderController::class, 'validated'])->name('validated');
                        Route::put('/{order:uuid}/received', [OrderController::class, 'received'])->name('received');
                        Route::put('/{order:uuid}/canceled', [OrderController::class, 'canceled'])->name('canceled');
                        Route::group([
                            'prefix' => 'part',
                            'as' => 'part.'
                        ], function (){
                            Route::post('/{order:uuid}/create', [DetailOrderController::class, 'store'])->name('store');
                            Route::delete('/{detail}', [DetailOrderController::class, 'delete'])->name('delete');
                        });
                    }
                );

                // Entrance voucher route
                Route::group([
                    'prefix' => 'entrance',
                    'as' => 'entrance.'
                ], function (){
                    Route::get('/', [EntranceVoucherController::class, 'index'])->name('index');
                    Route::get('/{entrance:uuid}/print', [EntranceVoucherController::class, 'print'])->name('print');
                });

                // Exit voucher route
                Route::group([
                    'prefix' => 'exit',
                    'as' => 'exit.'
                ], function (){
                    Route::get('/', [ExitVoucherController::class, 'index'])->name('index');
                    Route::post('/store', [ExitVoucherController::class, 'store'])->name('store');
                    Route::get('/{exit:uuid}', [ExitVoucherController::class, 'detail'])->name('detail');
                    Route::put('/{exit:uuid}/validated', [ExitVoucherController::class, 'validated'])->name('validated');
                    Route::put('/{exit:uuid}/opened', [ExitVoucherController::class, 'opened'])->name('opened');
                    Route::get('/{exit:uuid}/print', [ExitVoucherController::class, 'print'])->name('print');

                    // Exit parts Details
                    Route::group([
                        'prefix' => 'part',
                        'as' => 'part.'
                    ], function (){
                        Route::post('/{exit:uuid}/create', [DetailExitVoucherController::class, 'store'])->name('store');
                        Route::delete('/{detail}', [DetailExitVoucherController::class, 'delete'])->name('delete');
                    });
                });

                // warehouse report
                Route::group([
                    'prefix' => 'warehouse-report',
                    'as' => 'warehouse-report.'
                ], function (){
                    Route::get('/', [ReportController::class, 'exitVoucher'])->name('exit-voucher');
                    Route::get('/print-exit-voucher', [ReportController::class, 'printExitVoucher'])->name('print-exit-voucher');
                });

            });

        });

    // Admin documents voucher routes
    Route::group([
        'prefix' => 'docs',
        'as' => 'docs.'
    ], function (){
        // vehs docs controller
        Route::group([
            'prefix' => 'vehs',
            'as' => 'vehs.'
        ], function (){
            Route::get('/', [VehDocsController::class, 'index'])->name('index');
            Route::get('/{vehicle:uuid}', [VehDocsController::class, 'document'])->name('document');
            Route::post('/store', [VehDocsController::class, 'store'])->name('store');
            Route::delete('/{document:uuid}/delete', [VehDocsController::class, 'delete'])->name('delete');
        });

        // trailers docs controller
        Route::group([
            'prefix' => 'trailers',
            'as' => 'trailers.'
        ], function (){
            Route::get('/', [TrailerDocsController::class, 'index'])->name('index');
            Route::get('/{trailer:uuid}', [TrailerDocsController::class, 'document'])->name('document');
            Route::post('/store', [TrailerDocsController::class, 'store'])->name('store');
            Route::delete('/{document:uuid}/delete', [TrailerDocsController::class, 'delete'])->name('delete');
        });

        // vehs docs controller
        Route::group([
            'prefix' => 'driver',
            'as' => 'driver.'
        ], function (){
            Route::get('/', [DriverDocsController::class, 'index'])->name('index');
            Route::get('/{driver:uuid}', [DriverDocsController::class, 'document'])->name('document');
            Route::post('/store', [DriverDocsController::class, 'store'])->name('store');
            Route::delete('/{document:uuid}/delete', [DriverDocsController::class, 'delete'])->name('delete');
        });

    });

    Route::group([
        'prefix' => 'cashbox',
        'as' => 'cashbox.'
    ], function (){
        Route::get('/', [BoxController::class, 'index'])->name('index');
        Route::post('/store', [BoxController::class, 'store'])->name('store');
        Route::get('/{box:uuid}/detail', [BoxController::class, 'details'])->name('detail');
        Route::get('/{box:uuid}/operation', [BoxController::class, 'operation'])->name('operation');
        Route::post('/{box:uuid}/operation/{expense}/pay-other', [PayExpenseController::class, '__invoke'])->name('pay-expense');
        Route::post('/{box:uuid}/operation/pay-other/{other}', [PayOtherController::class, '__invoke'])->name('pay-other');
        Route::post('/{box:uuid}/closed', [BoxController::class, 'closed'])->name('box-closed');
        Route::post('/{box:uuid}/appros', [ApproBoxController::class, '__invoke'])->name('box-appro');
        Route::post('/{box:uuid}/cashout', [CashOutBoxController::class, '__invoke'])->name('box-out');
        Route::get('/{box:uuid}/{operation:uuid}/edit', [OperationController::class, 'edit'])->name('operation-edit');
        Route::get('/{box:uuid}/printOperation', [OperationController::class, 'printOperation'])->name('operation-print');
        Route::get('/{box:uuid}/operationExport', [OperationController::class, 'exportOpExcel'])->name('operation-export');
        Route::put('/{box:uuid}/{operation:uuid}', [OperationController::class, 'update'])->name('operation-update');
        Route::get('/{box:uuid}/{operation:uuid}/print', [PrintOpController::class, '__invoke'])->name('op-print');
        Route::post('/{box:uuid}/printType', [OperationController::class, 'printOpByType'])->name('print_exploitation-type');
    });
});
