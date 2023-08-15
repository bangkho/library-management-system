<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends BaseController
{
    public function get(){
        try {
            $data = User::get();
            return $this->sendResponse($data);
        } catch (\Throwable $th) {
            return $this->sendError([ 'error' => $th->getMessage()], 500);
        }
    }

    public function create(Request $request){
        try {
            $data['name'] = $request['name'];
            $data['email'] = $request['email'];
            $data['password'] = $request['password'];
            $data['role'] = $request['role'];
            $res = User::create($data);
            return $this->sendResponse($res);
        } catch (\Throwable $th) {
            return $this->sendError([ 'error' => $th->getMessage()], 500);
        }
    }

    public function getById($id){
        try {
            $data = User::find($id);
            return $this->sendResponse($data);
        } catch (\Throwable $th) {
            return $this->sendError([ 'error' => $th->getMessage()], 500);
        }
    }

    public function update(Request $request,$id){
        try {
            $data['name'] = $request['name'];
            $data['email'] = $request['email'];
            $data['password'] = $request['password'];
            $data['role'] = $request['role'];
            User::find($id)->update($data);
            $res = User::find($id);
            return $this->sendResponse($res);
        } catch (\Throwable $th) {
            return $this->sendError([ 'error' => $th->getMessage()], 500);
        }
    }
  
    public function delete($id){
        try {
            $res = User::find($id)->delete();
            return $this->sendResponse([ "deleted" => $res ]);
        } catch (\Throwable $th) {
            return $this->sendError([ 'error' => $th->getMessage()], 500);
        }
    }
}
