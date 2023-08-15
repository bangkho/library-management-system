<?php

namespace App\Http\Controllers\API;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Carbon\Carbon;

class TransactionController extends BaseController
{
    public function get(Request $request){
        try {
            $from = $request->query('from','');
            $to = $request->query('to','');
            if($from == '' && $to == ''){
                $data = Transaction::all();
            } else {
                $data = Transaction::whereDate('created_at', '>=', $from)->whereDate('created_at', '<=', $to)->get();
            }
            return $this->sendResponse($data);
        } catch (\Throwable $th) {
            return $this->sendError([ 'error' => $th->getMessage()], 500);
        }
    }

    public function getDetail(Request $request){
        try {
            $data = TransactionDetail::all();
            return $this->sendResponse($data);
        } catch (\Throwable $th) {
            return $this->sendError([ 'error' => $th->getMessage()], 500);
        }
    }

    public function create(Request $request){
        try {
            $user = $request->user();
            $data['user_id'] = $user->id;
            $data['transaction_code'] = 'TRX'.time();
            $data['transaction_date'] = Carbon::now();
            $resTrans = Transaction::create($data);

            $dataBooks = $request['books'];
            foreach ($dataBooks as &$key) {
                $key['transaction_id'] = $resTrans->id;
                $book = Book::find($key['book_id']);
                $book->stock = $book->stock - $key['quantity'];
                $book->save();
            }

            TransactionDetail::insert($dataBooks);

            return $this->sendResponse(["transaction" => $resTrans, "transaction_detail" => $dataBooks]);
        } catch (\Throwable $th) {
            return $this->sendError([ 'error' => $th->getMessage()], 500);
        }
    }

    public function update(Request $request,$id){
        try {
            $detail = TransactionDetail::find($id);
            $data['return_date'] = Carbon::now();
            $transaction = Transaction::find($detail->transaction_id);
            $data['borrow_date'] = Carbon::parse($transaction->transaction_date);
            $days = $data['borrow_date']->diffInDays($data['return_date']) - 7;

            if(($detail->return_date == null) && ($days > 0) && $days <= 10){
                $data['fine'] = (($days) * 10000) * $detail->quantity;
                $data['fine_days'] = $days;
            } else if(($detail->return_date == null) && ($days > 10)){
                $data['fine'] = 120000 * $detail->quantity;
                $data['fine_days'] = $days;
            } else {
                $data['fine'] = 0;
                $data['fine_days'] = 0;
            }

            $book = Book::find($detail->book_id);
            $book->stock = $book->stock + $detail->quantity;
            $book->save();

            $transaction->fine_total = $transaction->fine_total + $data['fine'];
            $transaction->save();

            $detail->update($data);
            return $this->sendResponse($detail);
        } catch (\Throwable $th) {
            return $this->sendError([ 'error' => $th->getMessage()], 500);
        }
    }

    public function delete($id){
        try {
            $res = TransactionDetail::find($id);
            $book = Book::find($res->book_id);
            $book->stock = $book->stock + $res->quantity;
            $book->save();
            $res->delete();
            return $this->sendResponse([ "deleted" => $res ]);
        } catch (\Throwable $th) {
            return $this->sendError([ 'error' => $th->getMessage()], 500);
        }
    }
}
