<?php
use Spatie\Honeypot\ProtectAgainstSpam;
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

Auth::routes([
  'register' => false, // Registration Routes...
  'verify' => false, // Email Verification Routes...
]);


Route::group(['domain' => 'www.lavor-egypt.com'], function(){
	Route::redirect('/', '/home');
	// Route::view('/', 'soon');

	Route::group(['middleware' => 'language'], function () {

		
		Route::get('/home', 'HomeController@index')->name('home');

		Route::get('/products', 'HomeController@products')->name('products.products');
		Route::get('/products/{category}', 'HomeController@category')->name('products.category');
		Route::get('/products/{category}/{model}', 'HomeController@product')->name('products.product');

		Route::get('/media-library/downloads', 'HomeController@downloads')->name('media.files');
		Route::get('/media-library/videos', 'HomeController@videos')->name('media.videos');

		Route::get('/news-events/', 'HomeController@posts')->name('news');
		Route::get('/news-events/{post}', 'HomeController@post')->name('post');

		Route::get('/contact-us', 'HomeController@contact')->name('contacts');
		Route::post('/contact-us', 'HomeController@feed')->middleware(ProtectAgainstSpam::class)->name('feed');
		Route::post('/newsletter', 'HomeController@newsletter')->middleware(ProtectAgainstSpam::class)->name('newsletter');

		Route::get('/distributors', 'HomeController@distributors')->name('distributors');

	});
});

Route::group(['domain' => 'www.wortex-egypt.com'], function(){

	Route::redirect('/', '/home');
	//Route::view('/', 'soon');

	Route::group(['middleware' => 'language'], function () {

		Route::get('/home', 'WortexHomeController@index')->name('wortex.home');

		Route::get('/news-events/', 'WortexHomeController@posts')->name('wortex.news');
		Route::get('/news-events/{post}', 'WortexHomeController@post')->name('wortex.post');

		Route::get('/products/{category}', 'WortexHomeController@category')->name('wortex.category');
		Route::get('/products/{category}/{slug}', 'WortexHomeController@product')->name('wortex.product');

		Route::get('/contact-us', 'WortexHomeController@contact')->name('wortex.contacts');
		Route::post('/contact-us', 'WortexHomeController@feed')->middleware(ProtectAgainstSpam::class)->name('wortex.feed');
		Route::post('/newsletter', 'WortexHomeController@newsletter')->middleware(ProtectAgainstSpam::class)->name('wortex.newsletter');

		Route::post('/quote', 'WortexHomeController@quote')->name('wortex.quote');
		
		Route::get('/distributors', 'WortexHomeController@distributors')->name('wortex.distributors');

	});
});

Route::get('/php', function ()
{
	return scandir(base_path('../public_html/wortexegypt'));
});
