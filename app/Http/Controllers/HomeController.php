<?php

namespace App\Http\Controllers;

use App;
use App\UserProfile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Gate;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::allows('isSuperAdmin')) {
            $getMales = DB::table('records')
                ->selectRaw("count(case when barangay=1 then 1 end) as Balangobong, count(case when barangay=2 then 1 end) as Bued, count(case when barangay=3 then 1 end) as Bugayong, count(case when barangay=4 then 1 end) as Camangaan, count(case when barangay=5 then 1 end) as Canarvacanan, count(case when barangay=6 then 1 end) as Capas, count(case when barangay=7 then 1 end) as Cili, count(case when barangay=8 then 1 end) as Dumayat, count(case when barangay=9 then 1 end) as Linmansangan, count(case when barangay=10 then 1 end) as Mangcasuy, count(case when barangay=11 then 1 end) as Moreno, count(case when barangay=12 then 1 end) as PasilengNorte, count(case when barangay=13 then 1 end) as PasilengSur, count(case when barangay=14 then 1 end) as Poblacion, count(case when barangay=15 then 1 end) as SanFelipCentral, count(case when barangay=16 then 1 end) as SanFelipSur, count(case when barangay=17 then 1 end) as SanPablo, count(case when barangay=18 then 1 end) as SantaCatalina, count(case when barangay=19 then 1 end) as SantaMariaNorte, count(case when barangay=20 then 1 end) as Santiago, count(case when barangay=21 then 1 end) as SantoNino, count(case when barangay=22 then 1 end) as Sumabnit, count(case when barangay=23 then 1 end) as Tabuyoc, count(case when barangay=24 then 1 end) as Vacante")
                ->where('gender', '=', "Male")
                ->get();
            $getFemales = DB::table('records')
                ->selectRaw("count(case when barangay=1 then 1 end) as Balangobong, count(case when barangay=2 then 1 end) as Bued, count(case when barangay=3 then 1 end) as Bugayong, count(case when barangay=4 then 1 end) as Camangaan, count(case when barangay=5 then 1 end) as Canarvacanan, count(case when barangay=6 then 1 end) as Capas, count(case when barangay=7 then 1 end) as Cili, count(case when barangay=8 then 1 end) as Dumayat, count(case when barangay=9 then 1 end) as Linmansangan, count(case when barangay=10 then 1 end) as Mangcasuy, count(case when barangay=11 then 1 end) as Moreno, count(case when barangay=12 then 1 end) as PasilengNorte, count(case when barangay=13 then 1 end) as PasilengSur, count(case when barangay=14 then 1 end) as Poblacion, count(case when barangay=15 then 1 end) as SanFelipCentral, count(case when barangay=16 then 1 end) as SanFelipSur, count(case when barangay=17 then 1 end) as SanPablo, count(case when barangay=18 then 1 end) as SantaCatalina, count(case when barangay=19 then 1 end) as SantaMariaNorte, count(case when barangay=20 then 1 end) as Santiago, count(case when barangay=21 then 1 end) as SantoNino, count(case when barangay=22 then 1 end) as Sumabnit, count(case when barangay=23 then 1 end) as Tabuyoc, count(case when barangay=24 then 1 end) as Vacante")
                ->where('gender', '=', "Female")
                ->get();
            $brgy = [];
            foreach ($getMales[0] as $key => $value) {
                array_push($brgy, $key);
            }
            $data['title'] = "Dashboard";
            $data['reports'] = DB::table('records')
                ->selectRaw("count(case when gender='Male' then 1 end) as male,count(case when gender='Female' then 1 end) as female")
                ->get();
            $data['getMales'] = $getMales[0];
            $data['getFemales'] = $getFemales[0];
            $data['base_url'] = App::make("url")->to('/');
            $data['prof_pic'] = UserProfile::where('user_id', '=', Auth::user()->id)->select('user_profile_pic')->pluck('user_profile_pic');

            return view('admin.dashboard', $data);
        } else if (Gate::allows('isAdmin')) {

            $getMales = DB::table('records')
                ->selectRaw("count(case when barangay=1 then 1 end) as Balangobong, count(case when barangay=2 then 1 end) as Bued, count(case when barangay=3 then 1 end) as Bugayong, count(case when barangay=4 then 1 end) as Camangaan, count(case when barangay=5 then 1 end) as Canarvacanan, count(case when barangay=6 then 1 end) as Capas, count(case when barangay=7 then 1 end) as Cili, count(case when barangay=8 then 1 end) as Dumayat, count(case when barangay=9 then 1 end) as Linmansangan, count(case when barangay=10 then 1 end) as Mangcasuy, count(case when barangay=11 then 1 end) as Moreno, count(case when barangay=12 then 1 end) as PasilengNorte, count(case when barangay=13 then 1 end) as PasilengSur, count(case when barangay=14 then 1 end) as Poblacion, count(case when barangay=15 then 1 end) as SanFelipCentral, count(case when barangay=16 then 1 end) as SanFelipSur, count(case when barangay=17 then 1 end) as SanPablo, count(case when barangay=18 then 1 end) as SantaCatalina, count(case when barangay=19 then 1 end) as SantaMariaNorte, count(case when barangay=20 then 1 end) as Santiago, count(case when barangay=21 then 1 end) as SantoNino, count(case when barangay=22 then 1 end) as Sumabnit, count(case when barangay=23 then 1 end) as Tabuyoc, count(case when barangay=24 then 1 end) as Vacante")
                ->where('gender', '=', "Male")
                ->get();
            $getFemales = DB::table('records')
                ->selectRaw("count(case when barangay=1 then 1 end) as Balangobong, count(case when barangay=2 then 1 end) as Bued, count(case when barangay=3 then 1 end) as Bugayong, count(case when barangay=4 then 1 end) as Camangaan, count(case when barangay=5 then 1 end) as Canarvacanan, count(case when barangay=6 then 1 end) as Capas, count(case when barangay=7 then 1 end) as Cili, count(case when barangay=8 then 1 end) as Dumayat, count(case when barangay=9 then 1 end) as Linmansangan, count(case when barangay=10 then 1 end) as Mangcasuy, count(case when barangay=11 then 1 end) as Moreno, count(case when barangay=12 then 1 end) as PasilengNorte, count(case when barangay=13 then 1 end) as PasilengSur, count(case when barangay=14 then 1 end) as Poblacion, count(case when barangay=15 then 1 end) as SanFelipCentral, count(case when barangay=16 then 1 end) as SanFelipSur, count(case when barangay=17 then 1 end) as SanPablo, count(case when barangay=18 then 1 end) as SantaCatalina, count(case when barangay=19 then 1 end) as SantaMariaNorte, count(case when barangay=20 then 1 end) as Santiago, count(case when barangay=21 then 1 end) as SantoNino, count(case when barangay=22 then 1 end) as Sumabnit, count(case when barangay=23 then 1 end) as Tabuyoc, count(case when barangay=24 then 1 end) as Vacante")
                ->where('gender', '=', "Female")
                ->get();
            $brgy = [];
            foreach ($getMales[0] as $key => $value) {
                array_push($brgy, $key);
            }
            $data['title'] = "Dashboard";
            $data['reports'] = DB::table('records')
                ->selectRaw("count(case when gender='Male' then 1 end) as male,count(case when gender='Female' then 1 end) as female")
                ->get();
            $data['getMales'] = $getMales[0];
            $data['getFemales'] = $getFemales[0];
            $data['base_url'] = App::make("url")->to('/');
            $data['prof_pic'] = UserProfile::where('user_id', '=', Auth::user()->id)->select('user_profile_pic')->pluck('user_profile_pic');

            return view('admin.dashboard', $data);
        } else {
            abort(404, "Sorry, You can do this actions");
        }
    }
}
