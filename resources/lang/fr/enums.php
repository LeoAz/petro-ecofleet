<?php

use App\Enums\CashboxStatus;
use App\Enums\Exploitation\StateStatus;
use App\Enums\Exploitation\TripState;
use App\Enums\Exploitation\TripStatus;
use App\Enums\Fleet\AssignationStatus;
use App\Enums\Fleet\DocumentStatus;
use App\Enums\Fleet\DriverStatus;
use App\Enums\Fleet\LinkStatus;
use App\Enums\Fleet\TrailerStatus;
use App\Enums\Fleet\VehicleStatus;
use App\Enums\Maintenance\ExitVoucherState;
use App\Enums\Maintenance\ExitVoucherStatus;
use App\Enums\Maintenance\GarageStatus;
use App\Enums\Maintenance\Gravity;
use App\Enums\Maintenance\InventoryStatus;
use App\Enums\Maintenance\OrderStatus;
use App\Enums\Maintenance\PartState;
use App\Enums\Maintenance\PurchaseStatus;
use App\Enums\OpType;
use App\Enums\User\UserStatus;

return [
    VehicleStatus::class => [
        VehicleStatus::Available => 'Disponible',
        VehicleStatus::Garage => 'Garage',
        VehicleStatus::Reform => 'Reforme',
        VehicleStatus::Travel => 'En voyage',
    ],

    TrailerStatus::class => [
        TrailerStatus::Available => 'Disponible',
        TrailerStatus::Reform => 'Reforme',
        TrailerStatus::Garage => 'Garage',
        TrailerStatus::Linked => 'Attelé',
    ],

    DriverStatus::class => [
        DriverStatus::Assign => 'Affecté',
        DriverStatus::Unassign => 'Non Affecté'
    ],

    AssignationStatus::class => [
       AssignationStatus::Active => 'Active',
        AssignationStatus::Revoked => 'Revolue'
    ],

    LinkStatus::class => [
        LinkStatus::Active => 'Active',
        LinkStatus::Revoked => 'Revolue'
    ],

    TripStatus::class => [
        TripStatus::Ongoing => 'En cours',
        TripStatus::Closed => 'Clôturer'
    ],

    TripState::class => [
        TripState::Billed => 'Facturé',
        TripState::Unbilled => 'Non Facturé'
    ],

    Gravity::class => [
        Gravity::Low => 'Faible',
        Gravity::High => 'Elevé',
        Gravity::Critical => 'Critique',
    ],

    PartState::class => [
        PartState::InStock => 'En stock',
        PartState::OutOfStock => 'Rupture de stock',
    ],

    GarageStatus::class => [
        GarageStatus::Pending => 'En attente',
        GarageStatus::Ongoing => 'En maintenance',
        GarageStatus::Finished => 'Sortie de garage',
    ],

    PurchaseStatus::class => [
        PurchaseStatus::Validated => 'Validé',
        PurchaseStatus::Pending => 'En Attente',
    ],

    OrderStatus::class => [
        OrderStatus::Validated => 'Validé',
        OrderStatus::Canceled => 'Annulé',
        OrderStatus::Received => 'Réceptioné',
        OrderStatus::Created =>  'Attente de validation'
    ],

    UserStatus::class => [
        UserStatus::Active => 'Active',
        UserStatus::Desactivate => 'Desactivé'
    ],

    DocumentStatus::class => [
        DocumentStatus::Active => 'Active',
        DocumentStatus::Expired => 'Expiré'
    ],

    ExitVoucherStatus::class => [
        ExitVoucherStatus::Validated => 'VALIDE',
        ExitVoucherStatus::Opened => 'A VALIDER'
    ],

    ExitVoucherState::class => [
        ExitVoucherState::Unused => 'NON UTILISE',
        ExitVoucherState::Used => 'UTILISE'
    ],

    CashboxStatus::class => [
        CashboxStatus::Open => 'OUVERT',
        CashboxStatus::Closed => 'CLÔTURER'
    ],

    OpType::class => [
        OpType::CashIn => 'ENTRE',
        OpType::CashOut => 'SORTIE'
    ],

    InventoryStatus::class => [
        InventoryStatus::Open => 'Ouvert',
        InventoryStatus::Closed => 'Clôturer'
    ],

    StateStatus::class => [
        StateStatus::VALIDATED => 'Clôturé',
        StateStatus::PENDING => 'En attente'
    ],

];
