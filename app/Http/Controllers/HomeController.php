<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;
use App\Models\stock_quote;
use Calendar;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {


 $response=[];
        $records=[];
        $asteroid_date=[];
        $total_asteroid=[];


        $start_date=$request->start_date;
        $end_date=$request->end_date;


        $toDate = Carbon::parse($end_date);

        $fromDate = Carbon::parse($start_date);

  

        $days = $toDate->diffInDays($fromDate);
if ($days > 5) {
   
         return view('frontend.home',compact('response','records','asteroid_date','total_asteroid'))->withErrors(['msg' => 'The Feed date limit is only 7 Days']);

}
// dd($days);

       



        if ($start_date && $end_date) {

            $httpClient = new \GuzzleHttp\Client();

            $request =
            $httpClient
            ->get("https://api.nasa.gov/neo/rest/v1/feed?start_date=".$start_date."&end_date=".$end_date."&api_key=0JuNrHYdUKeCP1gCX4gfdpaeYTL7fdtZk7pFwJrr");


            $response = json_decode($request->getBody()->getContents());
            $near_earth_objects=(array)  $response->near_earth_objects;

            $records=[];
            $arrays=[];

            $velocity1=0;
            $distance1=0;
            $average_size=[];
            $asteroid_date=[];
            $total_asteroid=[];


            foreach(array_values($near_earth_objects) as $key=>$value){

                $total_asteroid[$key]=count($value);
                $arrays[$key]=$value[$key]->close_approach_data[0];
                $arr1 =$value[$key]->estimated_diameter->kilometers->estimated_diameter_min; 
                $arr2 =$value[$key]->estimated_diameter->kilometers->estimated_diameter_max;
                $average_size[$key] =($arr1+$arr2)/2;

            }

    // dd($arrays);

            foreach($arrays as $index1=>$data1){


                $velocity1+=$data1->relative_velocity->kilometers_per_hour;
                $distance1+=$data1->miss_distance->kilometers;
                $asteroid_date[]=$data1->close_approach_date;

                $records[]=(object)[
                    'date'=>$data1->close_approach_date,
                    'velocity'=>$velocity1,
                    'distance'=>$distance1,
                    'average_size'=>$average_size[$index1], 

                ];
            }



        }

        return view('frontend.home',compact('response','records','asteroid_date','total_asteroid'));

    }





    public function destroy(Request $request)
    {
     $stock_quote = stock_quote::find($request->id);
     $stock_quote->delete();

     return $stock_quote;
 }

}
