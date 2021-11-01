<?php

namespace App\Http\Controllers;

use App\Fundo;
use App\Patrimonio;
use DB;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get_data(Request $request)
    {
        $query = Fundo::select('fundos.name', DB::raw('group_concat(patrimonios.value) as dados'))
        ->leftJoin('patrimonios', 'fundos.id', '=', 'patrimonios.fundo_id')
        ->groupBy('fundos.name')
        ->orderBy('patrimonios.date');

        $query->when(!is_null($request->id), function($e) use ($request){
            $e->whereIn('fundos.id', $request->id);
        });
        $query->when(!empty($request->dth_inical), function($e) use ($request){
            $e->where('patrimonios.date', '>=', $request->dth_inical);
        });
        $query->when(!empty($request->dth_final), function($e) use ($request){
            $e->where('patrimonios.date', '<=', $request->dth_final);
        });
        $query->when(!empty($request->min_value), function($e) use ($request){
            $e->where('patrimonios.value', '>=', $request->min_value);
        });
        $query->when(!empty($request->max_value), function($e) use ($request){
            $e->where('patrimonios.value', '<=', $request->max_value);
        });

        $result = $query->get();
        foreach($result as $i=>$values) {
            $arr[$i] = ['name' => $values->name, 'data' => $values->dados];
        }
        return response()->json($arr);
    }
}
