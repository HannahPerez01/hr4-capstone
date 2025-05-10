<?php
use App\Http\Controllers\apps\Calendar;
use App\Http\Controllers\apps\Chat;
use App\Http\Controllers\authentications\LoginBasic;
use App\Http\Controllers\ClaimController;
use App\Http\Controllers\CompensationController;
use App\Http\Controllers\CompensationPlanController;
use App\Http\Controllers\EmployeeProfileController;
use App\Http\Controllers\HRAnalyticsController;
use App\Http\Controllers\language\LanguageController;
use App\Http\Controllers\laravel_example\UserManagement;
use App\Http\Controllers\LeaveManagementController;
use App\Http\Controllers\pages\UserProfile;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\PerformanceController;
use App\Http\Controllers\RecruitmentController;
use App\Http\Controllers\ShiftandschedulingController;
use App\Http\Controllers\UserAccountController;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::post('/notifications/{id}/mark-as-read', function ($id) {
        $notification = DatabaseNotification::find($id);

        if ($notification) {
            $notification->markAsRead();
        }
        return response()->json(['success' => true]);
    })->name('notifications.markAsRead');

    Route::get('/app/chat', [Chat::class, 'index'])->name('app-chat');
    Route::post('/logout', [App\Http\Controllers\LogoutController::class, 'logout'])->name('logout');
    Route::get('/app/calendar', [Calendar::class, 'index'])->name('app-calendar');

    Route::controller(HRAnalyticsController::class)
        ->group(function () {
            Route::get('/hr-analytics', 'index')->name('hr-analytics');
            Route::get('/hr-analytics/export-pdf', 'exportDashboardPdf')->name('dashboard.export-pdf');
            Route::get('/hr-analytics/export-excel', 'exportDashboardExcel')->name('dashboard.export-excel');
            Route::post('/hr-analytics/generate-printable-dashboard', 'generatePrintableDashboard')->name('dashboard.generate-printable-dashboard');
        });

    Route::controller(ClaimController::class)
        ->group(function () {
            Route::post('/claims', 'store')->name('claims.store');
            Route::get('/claims/{id}', 'edit')->name('claims.edit');
            Route::put('/claims/{id}', 'update')->name('claims.update');
            Route::delete('/claims/{id}', 'destroy')->name('claims.delete');
        });

    Route::controller(ShiftandschedulingController::class)
        ->group(function () {
            Route::post('/Shift_and_schedule', 'store')->name('Shift_and_schedule.store');
            Route::delete('/Shift_and_schedule/{id}', 'destroy')->name('Shift_and_schedule.delete');
            Route::post('/Shift_and_schedules', 'update')->name('Shift_and_schedules.update');
        });

    Route::controller(UserAccountController::class)
        ->group(function () {
            Route::get('/users', 'index')->name('user-account');
            Route::post('/users/store', 'store')->name('user.store');
            Route::get('/users/edit/{id}', 'edit')->name('user.edit');
            Route::put('/users/update/{id}', 'update')->name('user.update');
            Route::delete('/users/delete/{id}', 'destroy')->name('user.delete');
        });

    Route::controller(PayrollController::class)
        ->group(function () {
            Route::get('/payroll/', 'index')->name('payroll');
            Route::get('/payroll/create', 'create')->name('payroll-create');
            Route::post('/payroll/store', 'store')->name('payroll-store');
            Route::get('/payroll/view/{id}', 'show')->name('payroll-view');
            Route::get('/payroll/edit/{id}', 'edit')->name('payroll-edit');
            Route::put('/payroll/update/{id}', 'update')->name('payroll-update');
            Route::delete('/payroll/delete/{id}', 'destroy')->name('payroll-delete');
            Route::get('/payroll-records', 'records')->name('payroll.records');
            Route::post('/payroll/generate', 'generatePayroll')->name('payroll.generate');
            Route::put('/payroll/generate-payslip/{id}', 'generatePayslip')->name('payroll-generate-payslip-to-ess');
            Route::post('/payroll/generate-records-to-finance/{id}', 'generatePayrollToFinance')->name('payroll.generate-to-finance');
        });

    Route::controller(EmployeeProfileController::class)
        ->group(function () {
            Route::get('/employee-profile/', 'index')->name('employee-profile');
            Route::get('/employee-profile/view/{id}', 'view')->name('employee-profile-view');
            Route::get('/employee-profile/edit/{id}', 'edit')->name('employee-profile-edit');
            Route::put('/employee-profile/update/{id}', 'update')->name('employee-profile-update');
            Route::post('/employee-profile/attach-file', 'attachFile')->name('employee-profile.attach-file');
        });

    Route::controller(CompensationController::class)
        ->group(function () {
            Route::get('/compensation', 'index')->name('compensation');
            Route::get('/compensation/create', 'create')->name('compensation-create');
            Route::get('/compensation/edit/{id}', 'edit')->name('compensation-edit');
            Route::post('/compensation/store', 'store')->name('compensation-store');
            Route::put('/compensation/update/{id}', 'update')->name('compensation-update');
        });

    Route::controller(CompensationPlanController::class)
        ->group(function () {
            Route::get('/compensation-plan', 'index')->name('compensation-plan');
        });

    Route::controller(PerformanceController::class)
        ->group(function () {
            Route::get('/performance', 'index')->name('performance');
            Route::get('/performance/succession', 'succession')->name('performance-succession');
            Route::put('/performance/succession/promote/{id}', 'promote')->name('succession-promote');
            Route::put('/performance/succession/reject/{id}', 'reject')->name('succession-reject');
            Route::put('/performance/succession/request', 'successionRequest')->name('performance-succession-request');
        });

    Route::controller(RecruitmentController::class)
        ->group(function () {
            Route::get('/recruitment', 'index')->name('recruitment');
            Route::get('/recruitment/create', 'create')->name('recruitment-create');
            Route::post('/recruitment/store', 'store')->name('recruitment-store');
            Route::get('/recruitment/edit/{id}', 'edit')->name('recruitment-edit');
            Route::put('/recruitment/update/{id}', 'update')->name('recruitment-update');
            Route::delete('/recruitment/delete/{id}', 'destroy')->name('recruitment-delete');
        });

    Route::controller(LeaveManagementController::class)
        ->group(function () {
            Route::get('/leave-management', 'index')->name('leave-management');
        });

    Route::get('/time/and/attendance', [App\Http\Controllers\timeandattendance::class, 'index'])->name('time-and-attendance');

    Route::get('/deduction', [App\Http\Controllers\DeductionController::class, 'index'])->name('deduction');
    Route::post('/deduction', [App\Http\Controllers\DeductionController::class, 'store'])->name('store');

    Route::get('/analytic/view', [App\Http\Controllers\analytic::class, 'index'])->name('analytic-view');

    Route::get('/pages/profile-user', [UserProfile::class, 'index'])->name('pages-profile-user');

    Route::post('/storeImage', [UserProfile::class, 'storeImage'])->name('storeImage');
    Route::post('/userupdate', [UserProfile::class, 'update'])->name('userupdate');

});

//compenstaion
Route::get('/salary/view', [App\Http\Controllers\salarylevelController::class, 'index'])->name('salary-view');
Route::post('/salarystore', [App\Http\Controllers\salarylevelController::class, 'store'])->name('store');
Route::post('/deleted', [App\Http\Controllers\salarylevelController::class, 'destroy'])->name('destroy');

//summary
Route::get('/summary/view', [App\Http\Controllers\summarytableController::class, 'index'])->name('salary-view');
Route::post('/summarystore', [App\Http\Controllers\summarytableController::class, 'store'])->name('store');
Route::post('/deleted', [App\Http\Controllers\summarytableController::class, 'destroy'])->name('destroy');

//benefit
Route::get('/benefit/view', [App\Http\Controllers\benefitsController::class, 'index'])->name('salary-view');
Route::post('/benefitstore', [App\Http\Controllers\benefitsController::class, 'store'])->name('store');

Route::post('/showdata', [App\Http\Controllers\benefitsController::class, 'showdata'])->name('showdata');

Route::get('/basicrate/view', [App\Http\Controllers\BasicController::class, 'index'])->name('index');
Route::post('/insertdata', [App\Http\Controllers\BasicController::class, 'store'])->name('store');
Route::post('/deleted', [App\Http\Controllers\basicController::class, 'destroy'])->name('destroy');

// Main Page Route
Route::get('/', [LoginBasic::class, 'index'])->name('auth-login-basic');
Route::get('/login', [LoginBasic::class, 'index'])->name('login');
//Route::post('/', [LoginBasic::class,'loginpost'])->name('auth-login-basic');
Route::post('/', [LoginBasic::class, 'loginpost']);

Route::controller(LoginBasic::class)
    ->group(function () {
        Route::get('/auth/login/basic', 'index')->name('auth-login-basic');
        Route::get('/auth/forgot-password', 'forgotPassword')->name('auth-forgot-password');
        Route::post('/auth/reset-password', 'sendResetLinkEmail')->name('auth-reset-password');
        Route::get('/reset-password/{token}', 'displayResetPassword')->name('password.reset');
        Route::post('/reset-password', 'resetPassword')->name('password.update');
    });

// locale
Route::get('lang/{locale}', [LanguageController::class, 'swap']);

// layout
// Route::get('/layouts/collapsed-menu', [CollapsedMenu::class, 'index'])->name('layouts-collapsed-menu');
// Route::get('/layouts/content-navbar', [ContentNavbar::class, 'index'])->name('layouts-content-navbar');
// Route::get('/layouts/content-nav-sidebar', [ContentNavSidebar::class, 'index'])->name('layouts-content-nav-sidebar');
// Route::get('/layouts/navbar-full', [NavbarFull::class, 'index'])->name('layouts-navbar-full');
// Route::get('/layouts/navbar-full-sidebar', [NavbarFullSidebar::class, 'index'])->name('layouts-navbar-full-sidebar');
// Route::get('/layouts/horizontal', [Horizontal::class, 'index'])->name('dashboard-analytics');
// Route::get('/layouts/vertical', [Vertical::class, 'index'])->name('dashboard-analytics');
// Route::get('/layouts/without-menu', [WithoutMenu::class, 'index'])->name('layouts-without-menu');
// Route::get('/layouts/without-navbar', [WithoutNavbar::class, 'index'])->name('layouts-without-navbar');
// Route::get('/layouts/fluid', [Fluid::class, 'index'])->name('layouts-fluid');
// Route::get('/layouts/container', [Container::class, 'index'])->name('layouts-container');
// Route::get('/layouts/blank', [Blank::class, 'index'])->name('layouts-blank');

// // Front Pages
// Route::get('/front-pages/landing', [Landing::class, 'index'])->name('front-pages-landing');
// Route::get('/front-pages/pricing', [Pricing::class, 'index'])->name('front-pages-pricing');
// Route::get('/front-pages/payment', [Payment::class, 'index'])->name('front-pages-payment');
// Route::get('/front-pages/checkout', [Checkout::class, 'index'])->name('front-pages-checkout');
// Route::get('/front-pages/help-center', [HelpCenter::class, 'index'])->name('front-pages-help-center');
// Route::get('/front-pages/help-center-article', [HelpCenterArticle::class, 'index'])->name('front-pages-help-center-article');

// // apps
// Route::get('/app/email', [Email::class, 'index'])->name('app-email');

// Route::get('/time/and/attendance', [timeandattendance::class, 'index'])->name('time-and-attendance');

// Route::get('/app/academy/course-details', [AcademyCourseDetails::class, 'index'])->name('app-academy-course-details');
// Route::get('/app/logistics/dashboard', [LogisticsDashboard::class, 'index'])->name('app-logistics-dashboard');
// Route::get('/app/logistics/fleet', [LogisticsFleet::class, 'index'])->name('app-logistics-fleet');
// Route::get('/app/invoice/list', [InvoiceList::class, 'index'])->name('app-invoice-list');
// Route::get('/app/invoice/preview', [InvoicePreview::class, 'index'])->name('app-invoice-preview');
// Route::get('/app/invoice/print', [InvoicePrint::class, 'index'])->name('app-invoice-print');
// Route::get('/app/invoice/edit', [InvoiceEdit::class, 'index'])->name('app-invoice-edit');
// Route::get('/app/invoice/add', [InvoiceAdd::class, 'index'])->name('app-invoice-add');
// Route::get('/app/user/list', [UserList::class, 'index'])->name('app-user-list');
// Route::get('/app/user/view/account', [UserViewAccount::class, 'index'])->name('app-user-view-account');
// Route::get('/app/user/view/security', [UserViewSecurity::class, 'index'])->name('app-user-view-security');
// Route::get('/app/user/view/billing', [UserViewBilling::class, 'index'])->name('app-user-view-billing');
// Route::get('/app/user/view/notifications', [UserViewNotifications::class, 'index'])->name('app-user-view-notifications');
// Route::get('/app/user/view/connections', [UserViewConnections::class, 'index'])->name('app-user-view-connections');
// Route::get('/app/access-permission', [AccessPermission::class, 'index'])->name('app-access-permission');

// // pages

// Route::get('/pages/profile-teams', [UserTeams::class, 'index'])->name('pages-profile-teams');
// Route::get('/pages/profile-projects', [UserProjects::class, 'index'])->name('pages-profile-projects');
// Route::get('/pages/profile-connections', [UserConnections::class, 'index'])->name('pages-profile-connections');
// Route::get('/pages/account-settings-account', [AccountSettingsAccount::class, 'index'])->name('pages-account-settings-account');
// Route::get('/pages/account-settings-security', [AccountSettingsSecurity::class, 'index'])->name('pages-account-settings-security');
// Route::get('/pages/account-settings-billing', [AccountSettingsBilling::class, 'index'])->name('pages-account-settings-billing');
// Route::get('/pages/account-settings-notifications', [AccountSettingsNotifications::class, 'index'])->name('pages-account-settings-notifications');
// Route::get('/pages/account-settings-connections', [AccountSettingsConnections::class, 'index'])->name('pages-account-settings-connections');
// Route::get('/pages/faq', [Faq::class, 'index'])->name('pages-faq');
// Route::get('/pages/pricing', [PagesPricing::class, 'index'])->name('pages-pricing');
// Route::get('/pages/misc-error', [MiscError::class, 'index'])->name('pages-misc-error');
// Route::get('/pages/misc-under-maintenance', [MiscUnderMaintenance::class, 'index'])->name('pages-misc-under-maintenance');
// Route::get('/pages/misc-comingsoon', [MiscComingSoon::class, 'index'])->name('pages-misc-comingsoon');
// Route::get('/pages/misc-not-authorized', [MiscNotAuthorized::class, 'index'])->name('pages-misc-not-authorized');

// // authentication
// Route::get('/auth/login-basic', [LoginBasic::class, 'index'])->name('auth-login-basic');
// Route::get('/auth/login-cover', [LoginCover::class, 'index'])->name('auth-login-cover');
// Route::get('/auth/register-basic', [RegisterBasic::class, 'index'])->name('auth-register-basic');
// Route::get('/auth/register-cover', [RegisterCover::class, 'index'])->name('auth-register-cover');
// Route::get('/auth/register-multisteps', [RegisterMultiSteps::class, 'index'])->name('auth-register-multisteps');
// Route::get('/auth/verify-email-basic', [VerifyEmailBasic::class, 'index'])->name('auth-verify-email-basic');
// Route::get('/auth/verify-email-cover', [VerifyEmailCover::class, 'index'])->name('auth-verify-email-cover');
// Route::get('/auth/reset-password-basic', [ResetPasswordBasic::class, 'index'])->name('auth-reset-password-basic');
// Route::get('/auth/reset-password-cover', [ResetPasswordCover::class, 'index'])->name('auth-reset-password-cover');
// Route::get('/auth/forgot-password-basic', [ForgotPasswordBasic::class, 'index'])->name('auth-reset-password-basic');
// Route::get('/auth/forgot-password-cover', [ForgotPasswordCover::class, 'index'])->name('auth-forgot-password-cover');
// Route::get('/auth/two-steps-basic', [TwoStepsBasic::class, 'index'])->name('auth-two-steps-basic');
// Route::get('/auth/two-steps-cover', [TwoStepsCover::class, 'index'])->name('auth-two-steps-cover');

// // wizard example
// Route::get('/wizard/ex-checkout', [WizardCheckout::class, 'index'])->name('wizard-ex-checkout');
// Route::get('/wizard/ex-property-listing', [PropertyListing::class, 'index'])->name('wizard-ex-property-listing');
// Route::get('/wizard/ex-create-deal', [CreateDeal::class, 'index'])->name('wizard-ex-create-deal');

// // modal
// Route::get('/modal-examples', [ModalExample::class, 'index'])->name('modal-examples');

// // cards
// Route::get('/cards/basic', [CardBasic::class, 'index'])->name('cards-basic');
// Route::get('/cards/advance', [CardAdvance::class, 'index'])->name('cards-advance');
// Route::get('/cards/statistics', [CardStatistics::class, 'index'])->name('cards-statistics');
// Route::get('/cards/analytics', [CardAnalytics::class, 'index'])->name('cards-analytics');
// Route::get('/cards/gamifications', [CardGamifications::class, 'index'])->name('cards-gamifications');
// Route::get('/cards/actions', [CardActions::class, 'index'])->name('cards-actions');

// // User Interface
// Route::get('/ui/accordion', [Accordion::class, 'index'])->name('ui-accordion');
// Route::get('/ui/alerts', [Alerts::class, 'index'])->name('ui-alerts');
// Route::get('/ui/badges', [Badges::class, 'index'])->name('ui-badges');
// Route::get('/ui/buttons', [Buttons::class, 'index'])->name('ui-buttons');
// Route::get('/ui/carousel', [Carousel::class, 'index'])->name('ui-carousel');
// Route::get('/ui/collapse', [Collapse::class, 'index'])->name('ui-collapse');
// Route::get('/ui/dropdowns', [Dropdowns::class, 'index'])->name('ui-dropdowns');
// Route::get('/ui/footer', [Footer::class, 'index'])->name('ui-footer');
// Route::get('/ui/list-groups', [ListGroups::class, 'index'])->name('ui-list-groups');
// Route::get('/ui/modals', [Modals::class, 'index'])->name('ui-modals');
// Route::get('/ui/navbar', [Navbar::class, 'index'])->name('ui-navbar');
// Route::get('/ui/offcanvas', [Offcanvas::class, 'index'])->name('ui-offcanvas');
// Route::get('/ui/pagination-breadcrumbs', [PaginationBreadcrumbs::class, 'index'])->name('ui-pagination-breadcrumbs');
// Route::get('/ui/progress', [Progress::class, 'index'])->name('ui-progress');
// Route::get('/ui/spinners', [Spinners::class, 'index'])->name('ui-spinners');
// Route::get('/ui/tabs-pills', [TabsPills::class, 'index'])->name('ui-tabs-pills');
// Route::get('/ui/toasts', [Toasts::class, 'index'])->name('ui-toasts');
// Route::get('/ui/tooltips-popovers', [TooltipsPopovers::class, 'index'])->name('ui-tooltips-popovers');
// Route::get('/ui/typography', [Typography::class, 'index'])->name('ui-typography');

// // extended ui
// Route::get('/extended/ui-avatar', [Avatar::class, 'index'])->name('extended-ui-avatar');
// Route::get('/extended/ui-blockui', [BlockUI::class, 'index'])->name('extended-ui-blockui');
// Route::get('/extended/ui-drag-and-drop', [DragAndDrop::class, 'index'])->name('extended-ui-drag-and-drop');
// Route::get('/extended/ui-media-player', [MediaPlayer::class, 'index'])->name('extended-ui-media-player');
// Route::get('/extended/ui-perfect-scrollbar', [PerfectScrollbar::class, 'index'])->name('extended-ui-perfect-scrollbar');
// Route::get('/extended/ui-star-ratings', [StarRatings::class, 'index'])->name('extended-ui-star-ratings');
// Route::get('/extended/ui-sweetalert2', [SweetAlert::class, 'index'])->name('extended-ui-sweetalert2');
// Route::get('/extended/ui-text-divider', [TextDivider::class, 'index'])->name('extended-ui-text-divider');
// Route::get('/extended/ui-timeline-basic', [TimelineBasic::class, 'index'])->name('extended-ui-timeline-basic');
// Route::get('/extended/ui-timeline-fullscreen', [TimelineFullscreen::class, 'index'])->name('extended-ui-timeline-fullscreen');
// Route::get('/extended/ui-tour', [Tour::class, 'index'])->name('extended-ui-tour');
// Route::get('/extended/ui-treeview', [Treeview::class, 'index'])->name('extended-ui-treeview');
// Route::get('/extended/ui-misc', [Misc::class, 'index'])->name('extended-ui-misc');

// // icons
// Route::get('/icons/tabler', [Tabler::class, 'index'])->name('icons-tabler');
// Route::get('/icons/font-awesome', [FontAwesome::class, 'index'])->name('icons-font-awesome');

// // form elements
// Route::get('/forms/basic-inputs', [BasicInput::class, 'index'])->name('forms-basic-inputs');
// Route::get('/forms/input-groups', [InputGroups::class, 'index'])->name('forms-input-groups');
// Route::get('/forms/custom-options', [CustomOptions::class, 'index'])->name('forms-custom-options');
// Route::get('/forms/editors', [Editors::class, 'index'])->name('forms-editors');
// Route::get('/forms/file-upload', [FileUpload::class, 'index'])->name('forms-file-upload');
// Route::get('/forms/pickers', [Picker::class, 'index'])->name('forms-pickers');
// Route::get('/forms/selects', [Selects::class, 'index'])->name('forms-selects');
// Route::get('/forms/sliders', [Sliders::class, 'index'])->name('forms-sliders');
// Route::get('/forms/switches', [Switches::class, 'index'])->name('forms-switches');
// Route::get('/forms/extras', [Extras::class, 'index'])->name('forms-extras');

// // form layouts
// Route::get('/form/layouts-vertical', [VerticalForm::class, 'index'])->name('form-layouts-vertical');
// Route::get('/form/layouts-horizontal', [HorizontalForm::class, 'index'])->name('form-layouts-horizontal');
// Route::get('/form/layouts-sticky', [StickyActions::class, 'index'])->name('form-layouts-sticky');

// // form wizards
// Route::get('/form/wizard-numbered', [FormWizardNumbered::class, 'index'])->name('form-wizard-numbered');
// Route::get('/form/wizard-icons', [FormWizardIcons::class, 'index'])->name('form-wizard-icons');
// Route::get('/form/validation', [Validation::class, 'index'])->name('form-validation');

// // tables
// Route::get('/tables/basic', [TablesBasic::class, 'index'])->name('tables-basic');
// Route::get('/tables/datatables-basic', [DatatableBasic::class, 'index'])->name('tables-datatables-basic');
// Route::get('/tables/datatables-advanced', [DatatableAdvanced::class, 'index'])->name('tables-datatables-advanced');
// Route::get('/tables/datatables-extensions', [DatatableExtensions::class, 'index'])->name('tables-datatables-extensions');

// // charts
// Route::get('/charts/apex', [ApexCharts::class, 'index'])->name('charts-apex');
// Route::get('/charts/chartjs', [ChartJs::class, 'index'])->name('charts-chartjs');

// // maps
// Route::get('/maps/leaflet', [Leaflet::class, 'index'])->name('maps-leaflet');

// laravel example
Route::get('/laravel/user-management', [UserManagement::class, 'UserManagement'])->name('laravel-example-user-management');
Route::resource('/user-list', UserManagement::class);
