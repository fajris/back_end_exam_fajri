<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\support\Facades\DB;
use App\UnitRumah;

class ProductController extends Controller
{
    function CreateUnit(Request $req){
        DB::beginTransaction();
        try{
            $this->validate($req, [
                'kavling' => 'required',
                'blok' => 'required',
                'no_rumah' => 'required',
                'harga_rumah' => 'required',
                'luas_tanah' => 'required',
                'luas_bangunan' => 'required'
            ]);

            $obj = new UnitRumah;
            $obj->kavling = $req->kavling;
            $obj->blok = $req->blok;
            $obj->no_rumah = $req->no_rumah;
            $obj->harga_rumah = $req->harga_rumah;
            $obj->luas_tanah = $req->luas_tanah;
            $obj->luas_bangunan = $req->luas_bangunan;
            $obj->save();

            DB::commit();

            return response()->json(['message'=>'Successfully create unit'], 200);
        }
        catch(\Exception $e){
            DB::rollback();
            return response()->json(['message'=>'Failed to create unit, exception:' + $e], 500);
        }
    }

    function DeleteUnit(Request $req) {
        DB::beginTransaction();
        try{
            $this->validate($req, [
                'id' => 'required'
            ]);
            $id = $req->id;
            // ada 2 cara untuk delete data,
            // cara 1 delete data secara langsung di database
            DB::delete(DB::raw('delete from unit_rumahs where id = :id'), ['id' => $id]);

            // cara 2 delete data dalam artian di hide datanya dari user tapi tetap ter record di database. dengan cara menambah column deleted pada table sebagai kontrol
            // DB::update(DB::raw('update unit_rumahs set deleted = 1 where id = :id'), ['id' => $id]);

            DB::commit();

            return response()->json(['message'=>'Successfully delete unit'], 200);
        }
        catch(\Exception $e){
            DB::rollback();
            return response()->json(['message'=>'Failed to delete unit, exception:' + $e], 500);
        }
    }

}
