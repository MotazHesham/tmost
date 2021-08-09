<?php

Route::view('/', 'welcome');
Route::get('userVerification/{token}', 'UserVerificationController@approve')->name('userVerification');
Auth::routes();

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Audit Logs
    Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // User Alerts
    Route::delete('user-alerts/destroy', 'UserAlertsController@massDestroy')->name('user-alerts.massDestroy');
    Route::get('user-alerts/read', 'UserAlertsController@read');
    Route::resource('user-alerts', 'UserAlertsController', ['except' => ['edit', 'update']]);

    // Books
    Route::delete('books/destroy', 'BooksController@massDestroy')->name('books.massDestroy');
    Route::post('books/media', 'BooksController@storeMedia')->name('books.storeMedia');
    Route::post('books/ckmedia', 'BooksController@storeCKEditorImages')->name('books.storeCKEditorImages');
    Route::resource('books', 'BooksController');

    // Videos
    Route::delete('videos/destroy', 'VideosController@massDestroy')->name('videos.massDestroy');
    Route::post('videos/media', 'VideosController@storeMedia')->name('videos.storeMedia');
    Route::post('videos/ckmedia', 'VideosController@storeCKEditorImages')->name('videos.storeCKEditorImages');
    Route::resource('videos', 'VideosController');

    // Client Managment
    Route::delete('client-managments/destroy', 'ClientManagmentController@massDestroy')->name('client-managments.massDestroy');
    Route::resource('client-managments', 'ClientManagmentController');

    // Packages
    Route::delete('packages/destroy', 'PackagesController@massDestroy')->name('packages.massDestroy');
    Route::post('packages/media', 'PackagesController@storeMedia')->name('packages.storeMedia');
    Route::post('packages/ckmedia', 'PackagesController@storeCKEditorImages')->name('packages.storeCKEditorImages');
    Route::resource('packages', 'PackagesController');

    // Quotes
    Route::delete('quotes/destroy', 'QuotesController@massDestroy')->name('quotes.massDestroy');
    Route::resource('quotes', 'QuotesController');

    // Countries
    Route::delete('countries/destroy', 'CountriesController@massDestroy')->name('countries.massDestroy');
    Route::resource('countries', 'CountriesController');

    // Content Category
    Route::delete('content-categories/destroy', 'ContentCategoryController@massDestroy')->name('content-categories.massDestroy');
    Route::resource('content-categories', 'ContentCategoryController');

    // Content Tag
    Route::delete('content-tags/destroy', 'ContentTagController@massDestroy')->name('content-tags.massDestroy');
    Route::resource('content-tags', 'ContentTagController');

    // Content Page
    Route::delete('content-pages/destroy', 'ContentPageController@massDestroy')->name('content-pages.massDestroy');
    Route::post('content-pages/media', 'ContentPageController@storeMedia')->name('content-pages.storeMedia');
    Route::post('content-pages/ckmedia', 'ContentPageController@storeCKEditorImages')->name('content-pages.storeCKEditorImages');
    Route::resource('content-pages', 'ContentPageController');

    // Blogs Managment
    Route::delete('blogs-managments/destroy', 'BlogsManagmentController@massDestroy')->name('blogs-managments.massDestroy');
    Route::post('blogs-managments/media', 'BlogsManagmentController@storeMedia')->name('blogs-managments.storeMedia');
    Route::post('blogs-managments/ckmedia', 'BlogsManagmentController@storeCKEditorImages')->name('blogs-managments.storeCKEditorImages');
    Route::resource('blogs-managments', 'BlogsManagmentController');

    // Contact Us
    Route::delete('contactuses/destroy', 'ContactUsController@massDestroy')->name('contactuses.massDestroy');
    Route::resource('contactuses', 'ContactUsController');

    // Refugees Lega Registration
    Route::delete('refugees-lega-registrations/destroy', 'RefugeesLegaRegistrationController@massDestroy')->name('refugees-lega-registrations.massDestroy');
    Route::resource('refugees-lega-registrations', 'RefugeesLegaRegistrationController');

    // Real Estate Registration
    Route::delete('real-estate-registrations/destroy', 'RealEstateRegistrationController@massDestroy')->name('real-estate-registrations.massDestroy');
    Route::resource('real-estate-registrations', 'RealEstateRegistrationController');

    // Refugees Legal Services
    Route::delete('refugees-legal-services/destroy', 'RefugeesLegalServicesController@massDestroy')->name('refugees-legal-services.massDestroy');
    Route::resource('refugees-legal-services', 'RefugeesLegalServicesController');

    // Consulting
    Route::delete('consultings/destroy', 'ConsultingController@massDestroy')->name('consultings.massDestroy');
    Route::post('consultings/media', 'ConsultingController@storeMedia')->name('consultings.storeMedia');
    Route::post('consultings/ckmedia', 'ConsultingController@storeCKEditorImages')->name('consultings.storeCKEditorImages');
    Route::resource('consultings', 'ConsultingController');

    // Packages Orders
    Route::delete('packages-orders/destroy', 'PackagesOrdersController@massDestroy')->name('packages-orders.massDestroy');
    Route::resource('packages-orders', 'PackagesOrdersController');

    // Consulting Bookings
    Route::delete('consulting-bookings/destroy', 'ConsultingBookingsController@massDestroy')->name('consulting-bookings.massDestroy');
    Route::resource('consulting-bookings', 'ConsultingBookingsController');

    // Seminars
    Route::delete('seminars/destroy', 'SeminarsController@massDestroy')->name('seminars.massDestroy');
    Route::post('seminars/media', 'SeminarsController@storeMedia')->name('seminars.storeMedia');
    Route::post('seminars/ckmedia', 'SeminarsController@storeCKEditorImages')->name('seminars.storeCKEditorImages');
    Route::resource('seminars', 'SeminarsController');

    // Seminars Subscription
    Route::delete('seminars-subscriptions/destroy', 'SeminarsSubscriptionController@massDestroy')->name('seminars-subscriptions.massDestroy');
    Route::resource('seminars-subscriptions', 'SeminarsSubscriptionController');

    // Code For Pay
    Route::delete('code-for-pays/destroy', 'CodeForPayController@massDestroy')->name('code-for-pays.massDestroy');
    Route::resource('code-for-pays', 'CodeForPayController');

    // Settings
    Route::post('settings/media', 'SettingsController@storeMedia')->name('settings.storeMedia');
    Route::post('settings/ckmedia', 'SettingsController@storeCKEditorImages')->name('settings.storeCKEditorImages');
    Route::resource('settings', 'SettingsController', ['except' => ['create', 'store', 'show', 'destroy']]);

    Route::get('messenger', 'MessengerController@index')->name('messenger.index');
    Route::get('messenger/create', 'MessengerController@createTopic')->name('messenger.createTopic');
    Route::post('messenger', 'MessengerController@storeTopic')->name('messenger.storeTopic');
    Route::get('messenger/inbox', 'MessengerController@showInbox')->name('messenger.showInbox');
    Route::get('messenger/outbox', 'MessengerController@showOutbox')->name('messenger.showOutbox');
    Route::get('messenger/{topic}', 'MessengerController@showMessages')->name('messenger.showMessages');
    Route::delete('messenger/{topic}', 'MessengerController@destroyTopic')->name('messenger.destroyTopic');
    Route::post('messenger/{topic}/reply', 'MessengerController@replyToTopic')->name('messenger.reply');
    Route::get('messenger/{topic}/reply', 'MessengerController@showReply')->name('messenger.showReply');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
Route::group(['as' => 'frontend.', 'namespace' => 'Frontend', 'middleware' => ['auth']], function () {
    Route::get('/home', 'HomeController@index')->name('home');

    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // User Alerts
    Route::delete('user-alerts/destroy', 'UserAlertsController@massDestroy')->name('user-alerts.massDestroy');
    Route::resource('user-alerts', 'UserAlertsController', ['except' => ['edit', 'update']]);

    // Books
    Route::delete('books/destroy', 'BooksController@massDestroy')->name('books.massDestroy');
    Route::post('books/media', 'BooksController@storeMedia')->name('books.storeMedia');
    Route::post('books/ckmedia', 'BooksController@storeCKEditorImages')->name('books.storeCKEditorImages');
    Route::resource('books', 'BooksController');

    // Videos
    Route::delete('videos/destroy', 'VideosController@massDestroy')->name('videos.massDestroy');
    Route::post('videos/media', 'VideosController@storeMedia')->name('videos.storeMedia');
    Route::post('videos/ckmedia', 'VideosController@storeCKEditorImages')->name('videos.storeCKEditorImages');
    Route::resource('videos', 'VideosController');

    // Client Managment
    Route::delete('client-managments/destroy', 'ClientManagmentController@massDestroy')->name('client-managments.massDestroy');
    Route::resource('client-managments', 'ClientManagmentController');

    // Packages
    Route::delete('packages/destroy', 'PackagesController@massDestroy')->name('packages.massDestroy');
    Route::post('packages/media', 'PackagesController@storeMedia')->name('packages.storeMedia');
    Route::post('packages/ckmedia', 'PackagesController@storeCKEditorImages')->name('packages.storeCKEditorImages');
    Route::resource('packages', 'PackagesController');

    // Quotes
    Route::delete('quotes/destroy', 'QuotesController@massDestroy')->name('quotes.massDestroy');
    Route::resource('quotes', 'QuotesController');

    // Countries
    Route::delete('countries/destroy', 'CountriesController@massDestroy')->name('countries.massDestroy');
    Route::resource('countries', 'CountriesController');

    // Content Category
    Route::delete('content-categories/destroy', 'ContentCategoryController@massDestroy')->name('content-categories.massDestroy');
    Route::resource('content-categories', 'ContentCategoryController');

    // Content Tag
    Route::delete('content-tags/destroy', 'ContentTagController@massDestroy')->name('content-tags.massDestroy');
    Route::resource('content-tags', 'ContentTagController');

    // Content Page
    Route::delete('content-pages/destroy', 'ContentPageController@massDestroy')->name('content-pages.massDestroy');
    Route::post('content-pages/media', 'ContentPageController@storeMedia')->name('content-pages.storeMedia');
    Route::post('content-pages/ckmedia', 'ContentPageController@storeCKEditorImages')->name('content-pages.storeCKEditorImages');
    Route::resource('content-pages', 'ContentPageController');

    // Blogs Managment
    Route::delete('blogs-managments/destroy', 'BlogsManagmentController@massDestroy')->name('blogs-managments.massDestroy');
    Route::post('blogs-managments/media', 'BlogsManagmentController@storeMedia')->name('blogs-managments.storeMedia');
    Route::post('blogs-managments/ckmedia', 'BlogsManagmentController@storeCKEditorImages')->name('blogs-managments.storeCKEditorImages');
    Route::resource('blogs-managments', 'BlogsManagmentController');

    // Contact Us
    Route::delete('contactuses/destroy', 'ContactUsController@massDestroy')->name('contactuses.massDestroy');
    Route::resource('contactuses', 'ContactUsController');

    // Refugees Lega Registration
    Route::delete('refugees-lega-registrations/destroy', 'RefugeesLegaRegistrationController@massDestroy')->name('refugees-lega-registrations.massDestroy');
    Route::resource('refugees-lega-registrations', 'RefugeesLegaRegistrationController');

    // Real Estate Registration
    Route::delete('real-estate-registrations/destroy', 'RealEstateRegistrationController@massDestroy')->name('real-estate-registrations.massDestroy');
    Route::resource('real-estate-registrations', 'RealEstateRegistrationController');

    // Refugees Legal Services
    Route::delete('refugees-legal-services/destroy', 'RefugeesLegalServicesController@massDestroy')->name('refugees-legal-services.massDestroy');
    Route::resource('refugees-legal-services', 'RefugeesLegalServicesController');

    // Consulting
    Route::delete('consultings/destroy', 'ConsultingController@massDestroy')->name('consultings.massDestroy');
    Route::post('consultings/media', 'ConsultingController@storeMedia')->name('consultings.storeMedia');
    Route::post('consultings/ckmedia', 'ConsultingController@storeCKEditorImages')->name('consultings.storeCKEditorImages');
    Route::resource('consultings', 'ConsultingController');

    // Packages Orders
    Route::delete('packages-orders/destroy', 'PackagesOrdersController@massDestroy')->name('packages-orders.massDestroy');
    Route::resource('packages-orders', 'PackagesOrdersController');

    // Consulting Bookings
    Route::delete('consulting-bookings/destroy', 'ConsultingBookingsController@massDestroy')->name('consulting-bookings.massDestroy');
    Route::resource('consulting-bookings', 'ConsultingBookingsController');

    // Seminars
    Route::delete('seminars/destroy', 'SeminarsController@massDestroy')->name('seminars.massDestroy');
    Route::post('seminars/media', 'SeminarsController@storeMedia')->name('seminars.storeMedia');
    Route::post('seminars/ckmedia', 'SeminarsController@storeCKEditorImages')->name('seminars.storeCKEditorImages');
    Route::resource('seminars', 'SeminarsController');

    // Seminars Subscription
    Route::delete('seminars-subscriptions/destroy', 'SeminarsSubscriptionController@massDestroy')->name('seminars-subscriptions.massDestroy');
    Route::resource('seminars-subscriptions', 'SeminarsSubscriptionController');

    // Code For Pay
    Route::delete('code-for-pays/destroy', 'CodeForPayController@massDestroy')->name('code-for-pays.massDestroy');
    Route::resource('code-for-pays', 'CodeForPayController');

    // Settings
    Route::post('settings/media', 'SettingsController@storeMedia')->name('settings.storeMedia');
    Route::post('settings/ckmedia', 'SettingsController@storeCKEditorImages')->name('settings.storeCKEditorImages');
    Route::resource('settings', 'SettingsController', ['except' => ['create', 'store', 'show', 'destroy']]);

    Route::get('frontend/profile', 'ProfileController@index')->name('profile.index');
    Route::post('frontend/profile', 'ProfileController@update')->name('profile.update');
    Route::post('frontend/profile/destroy', 'ProfileController@destroy')->name('profile.destroy');
    Route::post('frontend/profile/password', 'ProfileController@password')->name('profile.password');
});
