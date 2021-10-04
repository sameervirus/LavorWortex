<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin\Pages\Page;
use App\Admin\Slide\Slider;
use App\Admin\Post;
use App\Admin\Wproduct;
use App\Admin\Distributor;
use App\Admin\SiteContent\Sitecontent;


class WortexHomeController extends Controller
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
        $slides = Slider::all();
        $pages = Page::all();
        $posts = Post::orderBy('sort_order')->get();
        return view('wortex.home', compact('pages', 'slides', 'posts'));
    }

    public function posts()
    {
        $items = Post::orderBy('sort_order')->get();
        return view('wortex.posts', compact('items'));
    }

    public function post($slug = '')
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        return view('wortex.post', compact('post'));
    }

    public function distributors()
    {
        $distributors = Distributor::orderBy('sort_order')->get();
        return view('wortex.distributors', compact('distributors'));
    }

    public function category($slug)
    {
        $products = Wproduct::where('category', $slug)->orderBy('sort_order')->get();
        return view('wortex.category', compact('products'));
    }

    public function product($category, $slug)
    {
        $product = Wproduct::where('slug', $slug)->first();

        return view('wortex.product', compact('product'));
    }

    public function contact()
    {
        $site_content = Sitecontent::where('lang', app()->getLocale())->pluck('content', 'code');
        return view('wortex.contacts', compact('site_content'));
    }

    public function feed(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required'
        ]);

        $this->to = \App\Admin\SiteContent\Sitecontent::where('code','=','email')->value('content');

        $this->email = $request->email;
        $this->name = $request->name;

        $data = $request->all();
        
        //$this->to = 'admin@minervagroupegypt.com';
        
        $send = \Mail::send('email', $data, function($message) {
             $message->to($this->to)->bcc('sales@raindesigner.com')->subject('Feed Back from Website');
             $message->from('website@wortex-egypt.com', 'Feedback from website');
             
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
             $message->from('website@wortex-egypt.com', 'Feedback from website');             
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

    public function quote(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'name' => 'required',
            'phone' => 'required'
        ]);

        $this->to = \App\Admin\SiteContent\Sitecontent::where('code','=','email')->value('content');

        $this->email = $request->email;

        $data = $request->all();
        
        $send = \Mail::send('email', $data, function($message) {
             $message->to($this->to)->bcc('sales@raindesigner.com')->subject('Request a quote');
             $message->from('website@wortex-egypt.com', 'Feedback from website');             
        });

        if($send) {
            return back()->with('quote','sucsses');
        }        
        
        return back()->with('quote','fail');
    }
    
}
