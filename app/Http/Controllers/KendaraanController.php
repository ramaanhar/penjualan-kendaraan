<?php

namespace App\Http\Controllers;

use App\Http\Requests\KendaraanRequest;
use App\Models\Kendaraan;
use Symfony\Component\HttpKernel\Exception\HttpException;

class KendaraanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            $daftarKendaraan = Kendaraan::all();
            return response()->json([
                "status" => "200",
                "message" => "Success",
                "data" => $daftarKendaraan
            ]);
        } catch (HttpException $e) {
            return response()->json([
                "status" => "400",
                "message" => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(KendaraanRequest $request)
    {
        try {
            $validated = $request->validated();
            $merk = $validated['merk'];
            $tahun = $validated['tahun'];
            $harga = $validated['harga'];
            $warna = $validated['warna'];
            
            $kendaraan = Kendaraan::create([
                'merk' => $merk,
                'tahun' => $tahun,
                'harga' => $harga,
                'warna' => $warna
            ]);
            return response()->json([
                "status" => "200",
                "message" => "Success",
                "data" => $kendaraan
            ], 201);
        } catch (HttpException $e) {
           return response()->json([
                "status" => "400",
                "message" => $e->getMessage()
           ], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try {
            $kendaraan = Kendaraan::find($id);
            if (!isset($kendaraan)) {
                return response()->json([
                "status" => "404",
                "message" => "Not Found"
            ], 404);
            }
            return response()->json([
                "status" => "200",
                "message" => "Success",
                "data" => $kendaraan
            ]);
        } catch (HttpException $e) {
           return response()->json([
                "status" => "400",
                "message" => $e->getMessage()
           ], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(KendaraanRequest $request, $id)
    {
        try {
            $kendaraan = Kendaraan::find($id);
            if (!isset($kendaraan)) {
                return response()->json([
                    "status" => "404",
                    "message" => "Not Found"
               ], 404);
            }
            $validated = $request->validated();
            $kendaraan->merk = $validated['merk'];
            $kendaraan->tahun = $validated['tahun'];
            $kendaraan->harga = $validated['harga'];
            $kendaraan->warna = $validated['warna'];
            $kendaraan->save();
            return response()->json([
                "status" => "200",
                "message" => "Success",
                "data" => $kendaraan
            ]);
        } catch (HttpException $e) {
            return response()->json([
                "status" => "400",
                "message" => $e->getMessage()
           ], 400);
        }
        
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try {
            $kendaraan = Kendaraan::find($id);
            if (!isset($kendaraan)) {
                return response()->json([
                    "status" => "404",
                    "message" => "Not Found"
               ], 404);
            }
            $kendaraan->delete();

            return response()->json([
                "status" => "200",
                "message" => "Success"
            ]);
        } catch (HttpException $e) {
            return response()->json([
                "status" => "400",
                "message" => $e->getMessage()
           ], 400);
        }
    }

        /**
     * Return error 422
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function validationError()
    {
        return response()->json([
            'status' => 422,
            'message' => 'Validation error'
        ], 422);
    }
}
