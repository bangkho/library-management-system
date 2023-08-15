<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Models\BookType;

class BookTypeController extends BaseController
{
    public function get(){
        try {
            $data = BookType::get();
            return $this->sendResponse($data);
        } catch (\Throwable $th) {
            return $this->sendError([ 'error' => $th->getMessage()], 500);
        }
    }

    public function create(Request $request){
        try {
            $data['book_type_name'] = $request['book_type_name'];
            $res = BookType::create($data);
            return $this->sendResponse($res);
        } catch (\Throwable $th) {
            return $this->sendError([ 'error' => $th->getMessage()], 500);
        }
    }

    public function getById($id){
        try {
            $data = BookType::find($id);
            return $this->sendResponse($data);
        } catch (\Throwable $th) {
            return $this->sendError([ 'error' => $th->getMessage()], 500);
        }
    }

    public function update(Request $request,$id){
        try {
            $data['book_type_name'] = $request['book_type_name'];
            BookType::find($id)->update($data);
            $res = BookType::find($id);
            return $this->sendResponse($res);
        } catch (\Throwable $th) {
            return $this->sendError([ 'error' => $th->getMessage()], 500);
        }
    }
  
    public function delete($id){
        try {
            $res = BookType::find($id)->delete();
            return $this->sendResponse([ "deleted" => $res ]);
        } catch (\Throwable $th) {
            return $this->sendError([ 'error' => $th->getMessage()], 500);
        }
    }
}
