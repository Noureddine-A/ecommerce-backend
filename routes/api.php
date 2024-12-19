<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

// User routes

Route::post('/user/signup', [UserController::class, "signup"]);

Route::post("/user/login", [UserController::class, "login"]);

Route::post("/user/logout", [UserController::class, "logout"])->middleware("auth");

// Product routes

Route::post("/admin/add-product", [ProductController::class, "create"])->middleware("auth");

Route::get("/product/latest", [ProductController::class, "latestCollection"]);

Route::get("/product/all", [ProductController::class, "getAllProducts"]);

Route::post("/order/create", [OrderController::class, "create"]);



