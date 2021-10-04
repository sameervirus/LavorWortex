<?php

namespace App\Http\Controllers\Admin;
 
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\User;
use Analytics;
use Spatie\Analytics\Period;
use App\Classes\GoogleAnalytics;
use App\Admin\Product\Product;
use App\Admin\Wproduct;
use App\Admin\Post;

class AdminController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function range2($unit)
    {
    	$array ='[';
        for ($i=8;$i>-1;$i--) {
            if ($unit == 'day') {
                $date2 = date('Y-m-d',strtotime('-'.$i.' day'));
                $date1 = date('Y-m-d', strtotime($date2));               
            } elseif ($unit == 'week') {
                $date2 = date('Y-m-d',strtotime('-'.$i.' week'));
                $date1 = date('Y-m-d', strtotime($date2 .'- 6 days'));
            } elseif ($unit == 'month') {
                $date1 = date('Y-m-01',strtotime('-'. $i .' month'));
                $date2 = date('Y-m-01', strtotime($date1 .'+ 1 month'));
            }            

            $array .= "[". strtotime($date2 ."UTC") * 1000 .",".Visitor::range($date1,$date2)."],";
        }
        $array = rtrim($array,",");

        $array .=']';

        return $array;
    }

    public function index()
    {
        //$data = GoogleAnalytics::visitors_and_pageviews();
        //dd($data);exit;
        $analyticsData_one = Analytics::fetchTotalVisitorsAndPageViews(Period::days(14));
        $this->data['dates'] = $analyticsData_one->pluck('date');
        $this->data['visitors'] = $analyticsData_one->pluck('visitors');
        $this->data['pageViews'] = $analyticsData_one->pluck('pageViews');
        
        /* $analyticsData_two = Analytics::fetchVisitorsAndPageViews(Period::days(14)); */
        /* $this->data['two_dates'] = $analyticsData_two->pluck('date'); */
        /* $this->data['two_visitors'] = $analyticsData_two->pluck('visitors')->count(); */
        /* $this->data['two_pageTitle'] = $analyticsData_two->pluck('pageTitle')->count(); */
        
        /* $analyticsData_three = Analytics::fetchMostVisitedPages(Period::days(14)); */
        /* $this->data['three_url'] = $analyticsData_three->pluck('url'); */
        /* $this->data['three_pageTitle'] = $analyticsData_three->pluck('pageTitle'); */
        /* $this->data['three_pageViews'] = $analyticsData_three->pluck('pageViews'); */
        
        $this->data['browserjson'] = GoogleAnalytics::topbrowsers();

        $result = GoogleAnalytics::country();
        $this->data['country'] = $result->pluck('country');
        $this->data['country_sessions'] = $result->pluck('sessions');

        $this->data['ceci_ver'] = config('mycms.ceci_ver');
        $this->data['title'] = trans('backpack::base.dashboard'); // set the page title
        return view('admin.dashboard', $this->data);
    }

    public function upload_img(Request $request)
    {     
        $path = $request->file('file')->storeAs('files', $request->file('file')->getClientOriginalName(),'public_uploads');

        return json_encode(['location' => $path]);
    }

    public function reorder(Request $request)
    {
        $i = 1;
        foreach ($request->item as $value) {
            DB::table($request->table)
                ->where('id', $value)
                ->update(['sort_order' => $i]);            
            $i++;
        }

        return 1;
    }

    public function preorder(Request $request)
    {
        $order = str_replace('^','-', json_encode($request->product));
        DB::table('pages')
                ->where('page', 'product_order')
                ->update(['content' => $order]);        
        
        return 1;
    }

    public function delimg(Request $request)
    {
        $product = Product::findOrFail($request->id);

        $product->deleteMedia($request->imgs);

        flash('Successfully Deleted')->success();

        return 'ok';
    }

    public function wdelimg(Request $request)
    {
        $product = Wproduct::findOrFail($request->id);

        $product->deleteMedia($request->imgs);

        flash('Successfully Deleted')->success();

        return 'ok';
    }

    public function delimgpost(Request $request)
    {
        $product = Post::findOrFail($request->id);

        $product->deleteMedia($request->imgs);

        flash('Successfully Deleted')->success();

        return 'ok';
    }

}
