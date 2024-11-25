<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ConditionController;
use App\Http\Controllers\PatientController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::prefix('/conditions')->group(
    function () {
        route::get('/', [ConditionController::class, 'index']);
        route::get('/{patient}', [ConditionController::class, 'show']);
        route::post('/', [ConditionController::class, 'store']);
        route::patch('/{condition}', [ConditionController::class, 'update']);
        route::delete('/', [ConditionController::class, 'destroy']);
        route::post('/attach', [ConditionController::class, 'attachCondition']);
        route::delete('/detach', [ConditionController::class, 'detachCondition']);
    
    }
);
route::prefix('/patients')->group(
    function () {
        route::get('/', [PatientController::class, 'index']);
        route::get('/{patient}', [PatientController::class, 'show']);
        route::post('/', [PatientController::class, 'store']);
        route::patch('/{patient}', [PatientController::class, 'update']);
        route::delete('/{patient}', [PatientController::class, 'destroy']);
    }
);


