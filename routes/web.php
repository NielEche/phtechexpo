<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\SubscribeController;
use App\Http\Controllers\AdminHomeController;
use App\Http\Controllers\AdminAboutController;
use App\Http\Controllers\AdminEventController;
use App\Http\Controllers\WhatsAppController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
});
Route::get('/about', [GeneralController::class, 'about'])->name('about');
Route::get('/events', [GeneralController::class, 'events'])->name('events');
Route::get('/speakers', [GeneralController::class, 'speakers'])->name('speakers');
Route::get('/contact', [GeneralController::class, 'contact'])->name('contact');
Route::get('/confirmAttending', [GeneralController::class, 'confirmAttend'])->name('confirmAttending');
Route::get('/schedule/{schedule}',  [GeneralController::class, 'viewSchedule'])->name('schedule.view');
Route::post('/generate-code', [ProfileController::class, 'generateCode'])->name('generate.code');


Route::post('/subscribe', [SubscribeController::class, 'subscribe'])->name('subscribe');
Route::get('/send-messages', [WhatsAppController::class, 'sendMessages']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/successReg', function () {
    return view('success');
})->middleware(['auth', 'verified'])->name('successReg');

Route::get('/successCode', function () {
    return view('successCode');
})->name('successCode');


Route::get('/privacyPolicy', function () {
    return view('privacy');
})->name('privacyPolicy');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/userId', [ProfileController::class, 'userId'])->name('user.id');
    Route::post('/id', [ProfileController::class, 'storeId'])->name('uploadId');
});


Route::middleware('admin')->group(function () {
    Route::get('/adminHome', [AdminHomeController::class, 'index'])->name('admin.dashboard');
    Route::post('/GalleryImage', [AdminHomeController::class, 'storeImage'])->name('GalleryImage.store');
    Route::patch('/home_gallerys/{id}', [AdminHomeController::class, 'updateGallery'])->name('home_gallerys.update');
    Route::patch('/home_abouts/{id}', [AdminHomeController::class, 'updateAbout'])->name('home_abouts.update');
    Route::delete('/galleryDelete/{id}', [AdminHomeController::class, 'destroyGallery'])->name('galleryDelete.destroy');


    Route::get('/adminUsers', [AdminHomeController::class, 'users'])->name('admin.users');

    Route::post('/HomeService', [AdminHomeController::class, 'storeHomeServices'])->name('HomeService.store');
    Route::patch('/home_services/{id}', [AdminHomeController::class, 'updateHomeServices'])->name('home_services.update');
    Route::delete('/homeServicesDelete/{id}', [AdminHomeController::class, 'destroyHomeServices'])->name('homeServicesDelete.destroy');

    
    Route::post('/HomeVideo', [AdminHomeController::class, 'storeHomeVideos'])->name('HomeVideo.store');
    Route::patch('/home_videos/{id}', [AdminHomeController::class, 'updateHomeVideos'])->name('home_videos.update');
    Route::delete('/homeVideosDelete/{id}', [AdminHomeController::class, 'destroyHomeVideos'])->name('homeVideosDelete.destroy');


    Route::post('/programs', [AdminHomeController::class, 'storeProgram'])->name('programs.store');
    Route::patch('/programs/{id}', [AdminHomeController::class, 'updateProgram'])->name('programs.update');
    Route::patch('/eprograms/{id}', [AdminHomeController::class, 'updateExploreProgram'])->name('eprograms.update');
    Route::delete('/programDelete/{id}', [AdminHomeController::class, 'destroyProgram'])->name('programDelete.destroy');

    Route::get('/adminPartner', [AdminHomeController::class, 'adminPartner'])->name('admin.partner');
    Route::post('/partners', [AdminHomeController::class, 'storePartner'])->name('partners.store');
    Route::patch('/partners/{id}', [AdminHomeController::class, 'updatePartner'])->name('partners.update');
    Route::delete('/partnersDelete/{id}', [AdminHomeController::class, 'destroyPartner'])->name('partnersDelete.destroy');

    Route::get('/adminAbout', [AdminAboutController::class, 'index'])->name('admin.about');
    Route::post('/AboutGalleryImage', [AdminAboutController::class, 'storeImage'])->name('AboutGalleryImage.store');
    Route::patch('/about_gallerys/{id}', [AdminAboutController::class, 'updateGallery'])->name('about_gallerys.update');
    Route::delete('/aboutGalleryDelete/{id}', [AdminAboutController::class, 'destroyGallery'])->name('aboutGalleryDelete.destroy');

    Route::post('/AboutParagraph', [AdminAboutController::class, 'storePara'])->name('AboutParagraph.store');
    Route::patch('/about_paragraph/{id}', [AdminAboutController::class, 'updatePara'])->name('about_paragraph.update');
    Route::delete('/aboutParagraphDelete/{id}', [AdminAboutController::class, 'destroyPara'])->name('aboutParagraphDelete.destroy');
    Route::get('/about/{id}',  [AdminAboutController::class, 'aboutEdit'])->name('about.edit');

    Route::get('/adminEvents', [AdminEventController::class, 'index'])->name('admin.events');
    Route::post('/events', [AdminEventController::class, 'storeEvent'])->name('events.store');
    Route::patch('/events/{id}', [AdminEventController::class, 'updateEvent'])->name('events.update');
    Route::patch('/eventsmain/{id}', [AdminEventController::class, 'updateEventMain'])->name('eventsmain.update');
    Route::delete('/eventDelete/{id}', [AdminEventController::class, 'destroyEvent'])->name('eventDelete.destroy');

    Route::get('/event/{id}',  [AdminEventController::class, 'speakers'])->name('event.speakers');
    
    Route::post('/speakers', [AdminEventController::class, 'storeSpeaker'])->name('speakers.store');
    Route::patch('/speakers/{id}', [AdminEventController::class, 'updateSpeaker'])->name('speakers.update');
    Route::delete('/speakersDelete/{id}', [AdminEventController::class, 'destroySpeaker'])->name('speakersDelete.destroy');
    Route::post('/post/post_order_change', [AdminEventController::class, 'post_order_change'])->name('post.order_change');
    Route::get('/speaker/{id}',  [AdminEventController::class, 'speakerEdit'])->name('speaker.edit');

    Route::get('/eventSchedule/{id}',  [AdminEventController::class, 'schedule'])->name('event.schedule');
    Route::post('/schedule', [AdminEventController::class, 'storeSchedule'])->name('schedule.store');
    Route::patch('/schedule/{id}', [AdminEventController::class, 'updateSchedule'])->name('schedule.update');
    Route::delete('/scheduleDelete/{id}', [AdminEventController::class, 'destroySchedule'])->name('scheduleDelete.destroy');
});


require __DIR__.'/auth.php';
