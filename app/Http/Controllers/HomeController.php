<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin\Pages\Page;
use App\Admin\Product\Product;
use App\Admin\Download;
use App\Admin\Post;
use App\Admin\SiteContent\Sitecontent;
use Illuminate\Support\Arr;
use App\Admin\Distributor;
use App\Newsletter;

class HomeController extends Controller
{
    
    public $locale;
    public $to;
    public $email;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $pages = Page::all();
        return view('en.home', compact('pages'));
    }

    public function products()
    {
        $products = Product::all();
        return view('en.products', compact('products'));
    }

    public function category($slug)
    {
        $products = Product::where('category', $slug)->orderBy('sort_order')->get();
        return view('en.category', compact('products'));
    }

    public function product($category, $slug)
    {
        $product = Product::where('model', $slug)->first();
        $site_content = Sitecontent::where('lang', app()->getLocale())->pluck('content', 'code');

        return view('en.product', compact('product', 'site_content'));
    }

    public function downloads()
    {
        $items = Download::where('type', 'file')->orderBy('sort_order')->get();
        return view('en.files', compact('items'));
    }

    public function videos()
    {
        $items = Download::where('type', 'video')->orderBy('sort_order')->get();
        return view('en.videos', compact('items'));
    }

    public function posts()
    {
        $items = Post::orderBy('sort_order')->get();
        return view('en.posts', compact('items'));
    }

    public function post($slug = '')
    {
        $post = Post::where('slug', $slug)->first();
        return view('en.post', compact('post'));
    }

    public function distributors()
    {
        $distributors = Distributor::orderBy('sort_order')->get();
        return view('en.distributors', compact('distributors'));
    }

    public function contact()
    {
        $site_content = Sitecontent::where('lang', app()->getLocale())->pluck('content', 'code');
        return view('en.contacts', compact('site_content'));
    }

    public function feed(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'subject' => 'required',
            'email' => 'required|email',
            'phone' => 'required'
        ]);

        $this->to = \App\Admin\SiteContent\Sitecontent::where('code','=','email')->value('content');

        $this->email = $request->email;
        $this->name = $request->name;

        $data = $request->all();
        
        $send = \Mail::send('email', $data, function($message) {
            $message->to($this->to)->bcc('sales@raindesigner.com')->subject('Feed Back from Website');
            $message->from('website@lavor-egypt.com', 'Feedback from website');
        });

        if($send) {
            return 'ok';
        }
        
        
        return back()->with('feedback','sucsses');
    }

    public function newsletter(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $this->to = \App\Admin\SiteContent\Sitecontent::where('code','=','email')->value('content');

        $this->email = $request->email;

        $data = $request->all();
        
        $send = \Mail::send('email', $data, function($message) {
             $message->to($this->to)->bcc('sales@raindesigner.com')->subject('Join newsletter');
             $message->from('website@lavor-egypt.com', 'Feedback from website');             
        });

        Newsletter::updateOrCreate([
            'email' => $request->email
        ],[
            'email' => $request->email
        ]);

        if($send) {
            return back()->with('newsletter','sucsses');
        }
        
        
        return back()->with('newsletter','fail');
    }
}
