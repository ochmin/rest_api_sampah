<?php

namespace App\Http\Controllers;

use App\Models\Sampah;
use Illuminate\Http\request;
use App\Helpers\ApiFormatter;
use Exception;


class SampahController extends Controller
{
    
    public function index(request $request)
    {
       
        $search = $request->search_name;
        $limit = $request->limit;
        $sampahs = Sampah::where('kepala_keluarga', 'LIKE', '%'.$search. '%')->limit($limit)->get();
        if ($sampahs) {
            return ApiFormatter::createAPI(200, 'success', $sampahs);
        }else {
            return ApiFormatter::createAPI(400, 'failed');
        }
    }

    public function createToken()
    {
       return csrf_token();
    }

   


    public function store(request $request)
    {
        try {
                // $request->validate([
                //  'kepala_keluarga' => 'required',
                //  'no_rumah' => 'required',
                //  'rt_rw' => 'required',
                //  'total_karung_sampah' => 'required',
                //  'tanggal_pengangkutan' => 'required',
                // ]);

                return response()->json($request->all());
                
            

                $sampahs = Sampah::create([
                 'kepala_keluarga' => $request->kepala_keluarga,
                 'no_rumah' => $request->no_rumah,
                 'rt_rw' => $request->rt_rw,
                 'total_karung_sampah' => $request->total_karung_sampah,
                 'tanggal_pengangkutan' => $request->tanggal_pengangkutan,
                 'kriteria' => 'test',
            ]);
        

            $hasilTambahData = Sampah::where('id', $sampahs->id)->first();
            if ($hasilTambahData){
            return ApiFormatter::createAPI(200, 'success', $hasilTambahData);
            }else{
            return ApiFormatter::createAPI(400, 'failed');
            }
        } catch(Exception $error) {
            return ApiFormatter::createAPI(400, 'error', $error->getMessage());
        }
    }
    


     
       
    public function show($id)
    {
      try {
        $sampahs = Sampah::find($id);
        if ($sampahs) {
            return ApiFormatter::createsAPI(200, 'success', $sampahs);
        }else {
            return ApiFormatter::createAPI(400, 'failed');
        }
     }catch (Exception $error) {
        return ApiFormatter::createAPI(400, 'error', $error->getMessage());
    }
    }

    public function edit(Sampah $sampah)
    {
        //
    }

   
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                 'kepala_keluarga' => 'required',
                 'no_rumah' => 'required',
                 'rt_rw' => 'required',
                 'total_karung_sampah' => 'required',
                 'tanggal_pengangkutan' => 'required',
            ]);
                $sampahs = Sampah::find($id);
                $sampahs->update([
                    'kepala_keluarga' => $request->kepala_keluarga,
                    'no_rumah' => $request->no_rumah,
                    'rt_rw' => $request->rt_rw,
                    'total_karung_sampah' => $request->total_karung_sampah,
                    'tanggal_pengangkutan' => $request->tanggal_pengangkutan,
                ]);
                $dataTerbaru = Sampah::where('id', $sampahs->id)->first();
                if ($dataTerbaru) {
                    
                    return ApiFormatter::createAPI(200, 'success', $dataTerbaru);
                }else {
                    return ApiFormatter::createAPI(400, 'failed');
                }
             } catch (Exception $error) {
                return ApiFormatter::createAPI(400, 'error', $error->getMessage());
             }
    }

    

   
    public function destroy($id)
    {
        try {
            $sampahs = Sampah::find($id);
            $cekBerhasil = $sampahs->delete();
            if ($cekBerhasil) {
                return ApiFormatter::createAPI(200, 'success', 'Data terhapus');
            }else {
                return ApiFormatter::createsAPI(400, 'failed');
            }
         }catch (Exception $error) {
            return ApiFormatter::createsAPI(400, 'error', $error->getMessage());
        }
        
    }
      
    public function  trash()
    {
        try {
            $sampahs = Sampah::onlyTrashed()->get();
            if ($sampahs) {
                return ApiFormatter::createsAPI(200, 'success', $sampahs);
            }else {
                return ApiFormatter::createsAPI(400, 'failed');
            }
         }catch (Exception $error) {
            return ApiFormatter::createAPI(400, 'error', $error->getMessage());
        }
    }
       
      public function restore($id)
      {
        try {
            $sampahs = Sampah::onlyTrashed()->where('id', $id);
            $sampahs->restore();
            $dataRestore = Sampah::where('id', $id)->first();
            if ($dataRestore) {
                return ApiFormatter::createAPI(200, 'success', $dataRestore);
            }else {
                return ApiFormatter::createAPI(400, 'failed');
            }
         }catch (Exception $error) {
            return ApiFormatter::createAPI(400, 'error', $error->getMessage());
        }
    }

      
        public function permanentDelete($id)
        {
            try {
                $sampahs = Sampah::onlyTrashed()->where('id', $id);
                $proses = $sampahs->forceDelete();
                if ($proses ) {
                    return ApiFormatter::createAPI(200, 'success', 'data dihapus permanen!');
                }else {
                    return ApiFormatter::createAPI(400, 'failed');
                }
             }catch (Exception $error) {
                return ApiFormatter::createAPI(400, 'error', $error->getMessage());
            }
            }
        }

         