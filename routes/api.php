<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;

// User routes

Route::post('/user/signup', [UserController::class, "registerUser"]);

Route::post("/user/login", [UserController::class, "login"]);

Route::post("/user/logout", [UserController::class, "logout"]);

Route::get("/test")->middleware("auth:sanctum");

// Category routes

Route::post("/admin/add-category", [CategoryController::class, "add"]);

Route::get("/admin/get-categories", [CategoryController::class,"getCategories"]);


