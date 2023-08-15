<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Book;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends BaseController
{
    public function get(Request $request){
        try {
            $from = $request->query('from','');
            $to = $request->query('to','');
            if($from == '' && $to == ''){
                $data = Report::all();
            } else {
                $data = Report::whereDate('created_at', '>=', $from)->whereDate('created_at', '<=', $to)->get();
            }
            return $this->sendResponse($data);
        } catch (\Throwable $th) {
            return $this->sendError([ 'error' => $th->getMessage()], 500);
        }
    }

    public function getCount(Request $request){
        try {
            $from = $request->query('from','');
            $to = $request->query('to','');
            if($from == '' && $to == ''){
                $data['all'] = Report::all()->count();
                $data['returned'] = Report::where('return_date', '!=', null)->count();
                $data['borrowed'] = Report::where('return_date', '=', null)->count();
                $data['late'] = Report::where('fine_days', '>', 0)->count();
                $data['ontime'] = Report::where('fine_days', '=', 0)->count();
            } else {
                $data['all'] = Report::whereDate('created_at', '>=', $from)->whereDate('created_at', '<=', $to)->count();
                $data['returned'] = Report::whereDate('created_at', '>=', $from)->whereDate('created_at', '<=', $to)->where('return_date', '!=', null)->count();
                $data['borrowed'] = Report::whereDate('created_at', '>=', $from)->whereDate('created_at', '<=', $to)->where('return_date', '=', null)->count();
                $data['late'] = Report::whereDate('created_at', '>=', $from)->whereDate('created_at', '<=', $to)->where('fine_days', '>', 0)->count();
                $data['ontime'] =Report::whereDate('created_at', '>=', $from)->whereDate('created_at', '<=', $to)->where('fine_days', '=', 0)->count();
            }
            return $this->sendResponse($data);
        } catch (\Throwable $th) {
            return $this->sendError([ 'error' => $th->getMessage()], 500);
        }
    }

    public function getBookFav(){
        try {
            $data = Report::select('book_id', 'book_name', 'description', 'book_type_name', 'publisher', 'year', 'stock', DB::raw('sum(quantity) as total_borrowed_times'))
            ->groupBy(['book_id', 'book_name', 'description', 'book_type_name', 'publisher', 'year', 'stock'])->orderByRaw('COUNT(*) DESC')->limit(10)->get();
            return $this->sendResponse($data);
        } catch (\Throwable $th) {
            return $this->sendError([ 'error' => $th->getMessage()], 500);
        }
    }
}
