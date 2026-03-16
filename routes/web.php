<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Backend\HeroController;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\ResumeController;
use App\Http\Controllers\Backend\SkillsController;
use App\Http\Controllers\Backend\CommentController;
use App\Http\Controllers\Backend\BlogPostController;
use App\Http\Controllers\Backend\ServicesController;
use App\Http\Controllers\Backend\PortfolioController;
use App\Http\Controllers\Backend\TestimonialController;
use App\Http\Controllers\Backend\SiteSettingsController;


// FrontEnd All Routes


// Route::get('/', [FrontendController::class, 'index']);
Route::get('/', function () { return "Homepage works!"; });

Route::fallback(function(){
    return view('frontend.errorpage');
});


Route::get('post/details/{slug}',[FrontendController::class, 'BlogDetails']);
Route::post('store.comment',[FrontendController::class, 'StoreComment'])->name('store.comment');
Route::post('store-contact-message',[FrontendController::class, 'StoreContactMessage'])->name('store.contact.message');

// Backend All Routes
Route::middleware('auth')->group(function(){
    Route::get('/dashboard', function () {
    return view('Admin.pages.index');
})->middleware(['verified'])->name('dashboard');

Route::get('admin.logout',[AdminController::class, 'AdminLogout'])->name('admin.logout');
Route::get('admin-profile-edit',[AdminController::class, 'AdminEditProfile'])->name('admin.profile.edit');
Route::post('admin-update-edit',[AdminController::class, 'AdminUpdateProfile'])->name('admin.update.profile');
Route::get('admin-change-edit',[AdminController::class, 'AdminChangePassword'])->name('admin.change.password');
Route::post('admin.update.password',[AdminController::class, 'AdminUpdatePassword'])->name('admin.update.password');

// Hero Section All Routes
Route::controller(HeroController::class)->group(function(){
Route::get('hero-section', 'HeroSection')->name('hero.section');
Route::post('update-hero-section', 'UpdateHeroSection')->name('update.hero.section');

});

// Services Section All Routes
Route::controller(ServicesController::class)->group(function(){
Route::get('all-services', 'AllServices')->name('all.services');
Route::get('add-service', 'AddService')->name('add.service');
Route::post('store-service', 'StoreService')->name('store.service');
Route::get('edit-service/{id}', 'EditService')->name('edit.service'); 
Route::post('update-service', 'UpdateService')->name('update.service');
Route::get('delete-service/{id}', 'DeleteService')->name('delete.service');  
    

});

// Portfolio/Recent works Section All Routes
Route::controller(PortfolioController::class)->group(function(){
    Route::get('all-recent-works', 'AllRecentWorks')->name('all.recent.works');
    Route::get('add-work', 'AddWork')->name('add.work');
    Route::post('store-work', 'StoreWork')->name('store.work');
    Route::get('edit-work/{id}', 'EditWork')->name('edit.work');
    Route::post('update-work', 'UpdateWork')->name('update.work');
    Route::get('delete-work/{id}', 'DeleteWork')->name('delete.work');
});

//My Experience All Routes
Route::controller(ResumeController::class)->group(function(){
    Route::get('my-experience', 'MyExperience')->name('my.experience');
    Route::post('store-experience', 'StoreExperience')->name('store.experience');
    Route::get('edit-experience/{id}', 'EditExperience');
    Route::post('update-experience', 'UpdateExperience')->name('update.experience');
    Route::get('delete-experience/{id}', 'DeleteExperience')->name('delete.experience');


    //My Education all routes
    Route::get('my-education', 'MyEducation')->name('my.education');
});

// My Skills Section All Routes
Route::controller(SkillsController::class)->group(function(){
    Route::get('add-skill', 'AddSkill')->name('add.skill');
    Route::post('store-skill', 'StoreSkill')->name('store.skill');
    Route::get('all-skills', 'AllSkills')->name('all.skills');
    Route::get('edit-skill/{id}', 'EditSkill')->name('edit.skill');
    Route::post('update-skill/{id}', 'UpdateSkill')->name('update.skill');
    Route::get('delete-skill/{id}', 'DeleteSkill')->name('delete.skill');
  
});

// Testimony Section All Routes
Route::controller(TestimonialController::class)->group(function(){
    Route::get('add-testimony', 'AddTestimony')->name('add.testimony');
    Route::post('store-testimony', 'StoreTestimony')->name('store.testimony');
    Route::get('all-testimony', 'AllTestimonies')->name('all.testimonies');
    Route::get('edit-testimony/{id}', 'EditTestimony')->name('edit.testimony');
    Route::post('update-testimony', 'UpdateTestimony')->name('update.testimony');
    Route::get('delete-testimony/{id}', 'DeleteTestimony')->name('delete.testimony');
   
  
});

// BlogPosts Section All Routes
Route::controller(BlogPostController::class)->group(function(){
    Route::get('add-post', 'AddPost')->name('add.post');
    Route::post('store-post', 'StorePost')->name('store.post');
    Route::get('all-post', 'AllPost')->name('all.post');
    Route::get('edit-post/{id}', 'EditPost')->name('edit.post');
    Route::post('update-post', 'UpdatePost')->name('update.post');
    Route::get('delete-post/{id}', 'DeletePost')->name('delete.post');
  
});

// Comment Section All Routes
Route::controller(CommentController::class)->group(function(){
    Route::get('user-comments', 'UserComments')->name('user.comments');
    Route::post('comment-status-update', 'CommentStatusUpdate')->name('comment.status.update');

 // Contact Message All routes   
    Route::get('contacts-message', 'ContactMessage')->name('contacts.message');
    Route::get('delete-contact/{id}', 'DeleteContact')->name('delete.contact');
   
  
});

// Site Settings Section All Routes
Route::controller(SiteSettingsController::class)->group(function(){
    Route::get('site-settings', 'SiteSettings')->name('site.settings');
    Route::post('update-site-settings', 'UpdateSiteSettings')->name('update.site.settings');
 
   
  
});


}); // End Admin's Group Middleware



Route::middleware('auth')->group(function () {
Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


