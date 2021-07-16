<?php

$prefix=config("artadmin.url_prefix");

Route::prefix($prefix)->middleware(["web"])->group(function () {
    Route::middleware(['artadmin.check_login' ])->group( function () {
        Route::get("/index",[\Artadmin\Controllers\DashboardController::class,"index"])->name("artadmin.index");
        Route::get("/file_frame",[\Artadmin\Controllers\FilemanagerController::class,"index"])->name("artadmin.filemanager");
        Route::get("/logout",[\Artadmin\Controllers\DashboardController::class,"logout"])->name("artadmin.logout");
        Route::get("/password",[\Artadmin\Controllers\MyController::class,"index"])->name("artadmin.password");
        Route::post("/change_password",[\Artadmin\Controllers\MyController::class,"change"])->name("artadmin.change_password");

        Route::get("/clear_cache",[\Artadmin\Controllers\DashboardController::class,"clear_cache"])->name("artadmin.clear_cache");
        Route::middleware(["artadmin.permission:root"])->group(function(){

            Route::get("/roles",[\Artadmin\Controllers\RoleController::class,"index"])->name("artadmin.roles.list");
            Route::post("/roles/add",[\Artadmin\Controllers\RoleController::class,"add"])->name("artadmin.roles.add");
            Route::get("/roles/show/{id}",[\Artadmin\Controllers\RoleController::class,"show"])->name("artadmin.roles.show");

            Route::post("/roles/update/{id}",[\Artadmin\Controllers\RoleController::class,"update"])->name("artadmin.roles.update");
            Route::get("/roles/delete/{id}",[\Artadmin\Controllers\RoleController::class,"delete"])->name("artadmin.roles.delete");


            Route::get("/permissions",[\Artadmin\Controllers\PermissionController::class,"index"])->name("artadmin.permissions.list");
            Route::post("/permissions/add",[\Artadmin\Controllers\PermissionController::class,"add"])->name("artadmin.permissions.add");
            Route::get("/permissions/delete/{id}",[\Artadmin\Controllers\PermissionController::class,"delete"])->name("artadmin.permissions.delete");

            Route::get("/admins",[\Artadmin\Controllers\AdminsController::class,"index"])->name("artadmin.admins.list");
            Route::post("/admins/add",[\Artadmin\Controllers\AdminsController::class,"add"])->name("artadmin.admins.add");

            Route::get("/admins/edit/{id}",[\Artadmin\Controllers\AdminsController::class,"edit"])->name("artadmin.admins.edit");
            Route::post("/admins/doedit/{id}",[\Artadmin\Controllers\AdminsController::class,"doedit"])->name("artadmin.admins.doedit");

            Route::get("/admins/delete/{id}",[\Artadmin\Controllers\AdminsController::class,"delete"])->name("artadmin.admins.delete");
        });


    });

    Route::get('/login',[\Artadmin\Controllers\LoginController::class,"login"])->name("artadmin.login");

    Route::post('/doit',[\Artadmin\Controllers\LoginController::class,"doit"])->name("artadmin.doit");
});

