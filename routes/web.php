<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\VaccineController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SpecieController;
use App\Http\Controllers\VetController;
use App\Http\Controllers\VetMemberController;
use App\Http\Controllers\AnimalController;
use App\Http\Controllers\SponsorshipController;
use App\Http\Controllers\DeathController;
use App\Http\Controllers\VetAppointmentController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\AdoptionController;
use App\Http\Controllers\RefugeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VaccinatedAnimalController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\ClientController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('login', [AuthController::class, 'login']);

Route::get('/', function () {
    return view('welcome');
});

Route::get('home', [HomeController::class, 'index']);

Route::get('vetsView', [VetController::class, 'vetsView']);

Route::prefix('error')->group(function () {
    Route::get('/404', function () {
        return view('error/404');
    });
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('dashboard', DashboardController::class);

    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::resource('users', UserController::class)->middleware('can:viewUser');

    Route::get('/species', [SpecieController::class, 'index'])->name('species');
    Route::resource('species',SpecieController::class)->middleware('can:viewSpecie');

    Route::resource('roles', RoleController::class)->middleware('can:viewRol');

    Route::post('/users/{user}/updateRole', [UserController::class, 'updateRole'])->middleware('can:viewUser')->name('users.updateRole');
    Route::put('/users/{id}/updatePassword', [UserController::class, 'updatePassword'])->name('users.updatePassword');

    Route::get('/godfather', [VetMemberController::class, 'godfatherIndex'])->name('vetMembers.godfather');
    Route::get('/adopter', [VetMemberController::class, 'adopterIndex'])->name('vetMembers.adopter');
    Route::get('/donor', [VetMemberController::class, 'donorIndex'])->name('vetMembers.donor');
    Route::get('/staff', [VetMemberController::class, 'staffIndex'])->name('vetMembers.staff');
    Route::resource('vetMember',VetMemberController::class);
 
    Route::get('/sponsorship/pdfSponsorship/{id}', [SponsorshipController::class, 'pdfSponsorship'])->name('sponsorship.pdfSponsorship');
    Route::resource('sponsorship',SponsorshipController::class);

    Route::get('/animals', [AnimalController::class, 'index'])->name('animals.index');
    Route::resource('animals', AnimalController::class)->middleware('can:viewAnimal');

    Route::get('/animals/petProfile/{animalId}', [AnimalController::class, 'petProfile'])->name('animals.petProfile');

    Route::get('/vaccines', [VaccineController::class, 'index'])->name('vaccines');
    Route::resource('vaccines', VaccineController::class)->middleware('can:viewVaccine');

    Route::get('/vets', [VetController::class, 'vets.index'])->name('vets');
    Route::resource('vets', VetController::class)->middleware('can:viewVet');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/vetAppointments', [VetAppointmentController::class, 'vetAppointments.index'])->name('vetAppointments');
    Route::resource('vetAppointments', VetAppointmentController::class);

    Route::get('/deaths', [DeathController::class, 'index'])->name('deaths');
    Route::resource('deaths', DeathController::class);

    Route::get('/adoptions/pdfAdoption/{id}', [AdoptionController::class, 'pdfAdoption'])->name('adoptions.pdfAdoption');
    Route::resource('adoptions', AdoptionController::class)->except(['index']);

    Route::get('/donations/pdfDonation/{id}', [DonationController::class, 'pdfDonation'])->name('donations.pdfDonation');
    Route::resource('donation',DonationController::class);

    Route::resource('vaccinated_animals',VaccinatedAnimalController::class);

    Route::get('/user/profile', [UserProfileController::class, 'show'])->name('user.profile');
    Route::put('/user/profile', [UserProfileController::class, 'update'])->name('user.update');
    Route::post('/user/profile/update-picture', [UserProfileController::class, 'updatePicture'])->name('user.updatePicture');
    Route::post('/user/profile/update-picture-vet', [UserProfileController::class, 'updatePictureVet'])->name('user.updatePictureVet');
    Route::post('user/profile/change-password', [UserProfileController::class, 'changePassword'])->name('user.changePassword');

    Route::get('/clients', [ClientController::class, 'index'])->name('clients.index');
    Route::get('/clients/report/{id}', [ClientController::class, 'generateClientReport'])->name('clients.report');
    Route::get('/clients/{client}/selectPets', [ClientController::class, 'selectPets'])->name('clients.selectPets');
    Route::put('/clients/{client}/updatePets', [ClientController::class, 'updatePets'])->name('clients.updatePets');
    Route::resource('clients', ClientController::class);
});
