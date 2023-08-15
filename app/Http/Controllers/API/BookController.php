<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends BaseController
{
    public function get(){
        try {
            $data = Book::get();
            return $this->sendResponse($data);
        } catch (\Throwable $th) {
            return $this->sendError([ 'error' => $th->getMessage()], 500);
        }
    }

    public function create(Request $request){
        try {
            $data['book_type_id'] = $request['book_type_id'];
            $data['book_name'] = $request['book_name'];
            $data['description'] = $request['description'];
            $data['publisher'] = $request['publisher'];
            $data['year'] = $request['year'];
            $data['stock'] = $request['stock'];
            $res = Book::create($data);
            return $this->sendResponse($res);
        } catch (\Throwable $th) {
            return $this->sendError([ 'error' => $th->getMessage()], 500);
        }
    }

    public function getById($id){
        try {
            $data = Book::find($id);
            return $this->sendResponse($data);
        } catch (\Throwable $th) {
            return $this->sendError([ 'error' => $th->getMessage()], 500);
        }
    }

    public function update(Request $request,$id){
        try {
            $data['book_type_id'] = $request['book_type_id'];
            $data['book_name'] = $request['book_name'];
            $data['description'] = $request['description'];
            $data['publisher'] = $request['publisher'];
            $data['year'] = $request['year'];
            $data['stock'] = $request['stock'];
            Book::find($id)->update($data);
            $res = Book::find($id);
            return $this->sendResponse($res);
        } catch (\Throwable $th) {
            return $this->sendError([ 'error' => $th->getMessage()], 500);
        }
    }
  
    public function delete($id){
        try {
            $res = Book::find($id)->delete();
            return $this->sendResponse([ "deleted" => $res ]);
        } catch (\Throwable $th) {
            return $this->sendError([ 'error' => $th->getMessage()], 500);
        }
    }
}

