<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\MembersController;
use App\Http\Controllers\SavingsController;
use App\Http\Controllers\WelfareController;
use App\Http\Controllers\DisasterController;
use App\Http\Controllers\paymentsController;
use App\Http\Controllers\LoansController;
use App\Http\Controllers\adminController;
use App\Http\Controllers\settingsController;
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

// Route::get('/', [ProfileController::class, 'home'])->middleware(['auth', 'verified'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');   
})->middleware(['verified','superAdmin','auth'])->name('dashboard');


Route::middleware(['auth','superAdmin','verified'])->group(function(){
    Route::get('/add-group', [adminController::class, 'addGroups'])->name('groups.addGroups');
    Route::post('/add-group', [adminController::class, 'saveAddedGroup'])->name('groups.save');
    Route::get('/add-group-admin', [adminController::class, 'addGroupAdmin'])->name('groups.addGroupAdmin');
    Route::post('/add-group-admin', [adminController::class, 'saveAddedGroupAdmin'])->name('groups.saveAdmin');

});
Route::middleware(['auth','verifiedUser','verified','member'])->group(function(){
    Route::get('/withdrawals', [paymentsController::class, 'verifiedAccount'])->name('savings.verified');

});
Route::middleware(['auth','secretary','verified'])->group(function(){
    Route::get('/register-Users', [adminController::class, 'registration'])->name('admin.register');
    Route::post('/register-Users', [adminController::class, 'saveMember'])->name('admin.addMembers');

});
Route::middleware(['auth','loanOfficer','verified','member'])->group(function(){
   
    Route::get('/loans', [LoansController::class, 'index'])->name('loans.index');
    Route::get('/loans/requests/members', [LoansController::class, 'loanRequestMembers'])->name('loans.loanRequestMembers');
    Route::get('/loans/requests', [LoansController::class, 'loanRequest'])->name('loans.loanRequest');
    Route::get('/loans/loan-details/{borrowerId}', [LoansController::class, 'loanDetails'])->name('loans.loanDetails');
    Route::get('/loans/approve-loan-request/{id}', [LoansController::class, 'approveRequest'])->name('loans.approval');
    Route::get('/loans/approve-members-loan-request/{uid}', [LoansController::class, 'approveMembersRequest'])->name('loans.membersApproval');
    Route::post('/loans/approve-loan-request', [LoansController::class, 'handleApproval'])->name('loans.handleApproval');
    Route::post('/loans/approve-members-loan-request', [LoansController::class, 'handleMembersApproval'])->name('loans.handleMembersApproval');
    Route::get('/loans/loan-details/members', [LoansController::class, 'memberLoanDetails'])->name('loans.memberLoanDetails');
    Route::get('/loans/record-non-member', [LoansController::class, 'nonMemberRecording'])->name('loans.nonMemberRecording');
    Route::get('/loans/loan-defaulters', [LoansController::class, 'defaulters'])->name('loans.defaulters');
    Route::get('/loans/loan-defaulters-welfare', [LoansController::class, 'welfareLoanDefaulters'])->name('loans.welfareDefaulters');
    Route::get('/loans/loan-defaulters/non-members', [LoansController::class, 'nonMemberDefaulters'])->name('loans.nonMembersDefaulters');
    Route::post('/loans/record-non-member', [LoansController::class, 'addingLoanRequest'])->name('loans.nonMembersRequest');

});
Route::middleware(['auth','admin','member'])->group(function(){
    Route::get('/register-group-leaders', [adminController::class, 'groupLeaders'])->name('admin.leaders');
    Route::post('/register-group-leaders', [adminController::class, 'saveGroupLeader'])->name('groups.saveGroupLeaders');
    Route::get('/settings', [settingsController::class, 'settings'])->name('settings.index');
    Route::post('/settings', [settingsController::class, 'saveSettings'])->name('settings.save');

});
Route::middleware(['auth','member','verified'])->group(function () {

    Route::get('/loans/send-requests', [LoansController::class, 'sendRequest'])->name('loans.sendRequest');
    Route::post('/loans/sending-requests', [LoansController::class, 'getRequest'])->name('loans.getRequest');
    Route::get('/members', [MembersController::class, 'index'])->name('members.index');
    Route::get('/savings', [SavingsController::class, 'index'])->name('savings.index');
    Route::get('/disaster', [DisasterController::class, 'index'])->name('disaster.index');
    Route::get('/welfare', [WelfareController::class, 'index'])->name('welfare.index');
    Route::get('/welfare/loan-requests', [WelfareController::class, 'welfareLoanRequest'])->name('welfare.loanRequest');

    Route::get('/payments', [paymentsController::class, 'addSavings'])->name('savings.addSavings');
    Route::get('/verification', [paymentsController::class, 'withdrawals'])->name('savings.withdraw');
    Route::post('/withdrawals', [paymentsController::class, 'confirmPasswordToWithdraw'])->name('savings.confirmPassword');

    Route::get('/savings/details', [SavingsController::class, 'savingDetails'])->name('savings.savingDetails');
    Route::post('/withdraw', [paymentsController::class, 'withdraw'])->name('verified.withdrawal');

});
Route::middleware(['auth'])->group(function(){
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/payments', [paymentsController::class, 'registerSavings'])->name('savings.registerSavings');
    Route::post('/payments', [paymentsController::class, 'transactionProcessing'])->name('savings.transactions');
});

require __DIR__.'/auth.php';


