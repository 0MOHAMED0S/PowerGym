<?php

use App\Http\Controllers\Admin\coaches;
use App\Http\Controllers\Admin\contact;
use App\Http\Controllers\Admin\dashboard;
use App\Http\Controllers\Admin\Equipment;
use App\Http\Controllers\Admin\LogoName;
use App\Http\Controllers\Admin\packages;
use App\Http\Controllers\Admin\roles;
use App\Http\Controllers\Admin\shop;
use App\Http\Controllers\Admin\users;
use App\Http\Controllers\Admin\subscribers;
use App\Http\Controllers\chats;
use App\Http\Controllers\Main\favorites;
use App\Http\Controllers\Main\home;
use App\Http\Controllers\Main\perfectweight;
use App\Http\Controllers\PaypalController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\dietTrains;
use App\Http\Controllers\Main\cartController;
use App\Http\Controllers\Main\packages as MainPackages;
use Illuminate\Support\Facades\Route;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [home::class, 'index'])->name('home');

//shop
Route::get('/shop', [shop::class, 'usershop'])->name('usershop');
Route::get('/products/details/{id}', [shop::class, 'details'])->name('productdetails');
Route::get('/packages', [MainPackages::class, 'index'])->name('Packages');

Route::get('/dashboard', function () {
    return view('dashboard');

})->middleware(['auth','CodeVerify'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile/setting', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
    Route::put('/profile/update/pass', [ProfileController::class, 'updatePass'])->name('profile.password.update');
    Route::put('/editimage/{id}', [ProfileController::class, 'editimage'])->name('editimage');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile/qrcode', function () {
        $user = auth()->user();
        $qrText = 'Name: ' . $user->name . "\n" . 'Code: ' . $user->id;
        $qrCode = QrCode::size(300)->generate($qrText);
        return view('profile.qrcode', compact('qrCode'));
    })->name('qrcode');

    //My Favorites
    Route::get('/favorite', [favorites::class, 'index'])->name('Favorites');
    //cart
    Route::get('/Cart', [cartController::class, 'index'])->name('cart');

});

    //perfect weight
    Route::get('/perfectweight', [perfectweight::class, 'index'])->name('perfectweight');
    Route::post('/perfectweight/result', [perfectweight::class, 'result'])->name('weightresult');


    Route::middleware(['auth','CodeVerify','SuberAdmin'])->group(function () {
        //Dite
    Route::get('/dashboard/dite/read/{id}', [dietTrains::class, 'read'])->name('read');
    Route::get('/dashboard/Dite', [dietTrains::class, 'dite'])->name('DiteTrainAdmin');
    //Dashboard
    Route::get('/dashboard', [dashboard::class, 'index'])->name('AdminDashboard');
    //Users
    Route::get('/dashboard/users', [users::class, 'index'])->name('AdminUsers');
    Route::put('/dashboard/users/update/{id}', [users::class, 'update'])->name('UpdateUser');
    Route::delete('/dashboard/users/delete/{id}', [users::class, 'delete'])->name('DeleteUser');
    //Roles
    Route::get('/dashboard/roles', [roles::class, 'index'])->name('AdminRoles');
    Route::get('/dashboard/roles/{role}', [roles::class, 'AdminRolesCounter'])->name('AdminRolesCounter');
    //coaches
    Route::get('/dashboard/coaches', [coaches::class, 'index'])->name('AdminCoaches');
    //packages
    Route::get('/dashboard/packages', [packages::class, 'index'])->name('AdminPackages');
    Route::post('/dashboard/packages/store', [packages::class, 'store'])->name('StorePackage');
    Route::post('/dashboard/packages/AddFeatures/{id}', [packages::class, 'AddFeatures'])->name('AddFeatures');
    Route::get('/dashboard/packages/feature/delete/{id}', [packages::class, 'DeleteFeature'])->name('DeleteFeature');
    Route::put('/dashboard/packages/update/{id}', [packages::class, 'update'])->name('UpdatePackage');
    Route::delete('/dashboard/packages/delete/{id}', [packages::class, 'delete'])->name('DeletePackage');
    //Logo&Name
    Route::get('/dashboard/logoname', [LogoName::class, 'index'])->name('logoname');
    Route::put('/dashboard/logoname/update/{id}', [LogoName::class, 'update'])->name('UpdateLogoName');
    //contact
    Route::get('/dashboard/contact', [contact::class, 'index'])->name('AdminContact');
    Route::put('/dashboard/contact/update/{id}', [contact::class, 'update'])->name('Updatecontacts');
    //Equipments
    Route::get('/dashboard/equipments', [Equipment::class, 'index'])->name('AdminEquipments');
    Route::post('/dashboard/equipments/store', [Equipment::class, 'store'])->name('Storeequipment');
    Route::delete('/dashboard/equipments/delete/{id}', [Equipment::class, 'delete'])->name('DeleteEquipment');
    Route::put('/dashboard/equipments/update/{id}', [Equipment::class, 'update'])->name('UpdateEquipments');
    //Subscripers
    Route::get('/dashboard/subscribers', [subscribers::class, 'index'])->name('AdminSubscribers');
    Route::post('/dashboard/subscribers/renew/{id}', [subscribers::class, 'renew'])->name('renew');
    Route::post('/dashboard/subscribers/reset/{id}', [subscribers::class, 'reset'])->name('reset');
    Route::post('/dashboard/subscribers/store', [subscribers::class, 'store'])->name('StoreSubscribers');
    //shop
    Route::get('/dashboard/products', [shop::class, 'index'])->name('AdminShop');
    Route::post('/dashboard/product/store', [shop::class, 'store'])->name('StoreProduct');
    Route::delete('/dashboard/product/delete/{id}', [shop::class, 'delete'])->name('DeleteProduct');
    Route::put('/dashboard/product/update/{id}', [shop::class, 'update'])->name('UpdateProduct');
});

Route::middleware(['auth','CodeVerify'])->group(function () {
    //paypal
    Route::post('paypal/{id}', [PaypalController::class, 'paypal'])->name('paypal');
    Route::get('success', [PaypalController::class, 'success'])->name('success');
    Route::get('cancel', [PaypalController::class, 'cancel'])->name('cancel');
});
Route::middleware(['AdmSub','auth'])->group(function () {
    //chat
    Route::get('/chat', [chats::class, 'index'])->name('chat');
    Route::get('/dietTrain', [dietTrains::class, 'index'])->name('dietTrain');
Route::post('/dietTrain/store', [dietTrains::class, 'store'])->name('send');

    });
Route::middleware(['Subscriber','SuberAdmin','auth'])->group(function () {

});
require __DIR__.'/auth.php';

