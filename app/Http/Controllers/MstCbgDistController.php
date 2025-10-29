<?php

namespace App\Http\Controllers;

use App\Models\MstCbgDist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class MstCbgDistController extends Controller
{
    public function index()
    {
        $cbgDists = MstCbgDist::all();
        return view('mst_cbg_dist.index', compact('cbgDists'));
    }

    public function edit($id)
    {
        $cbgDist = MstCbgDist::find($id);
        if ($cbgDist) {
            return response()->json([
                'status' => 200,
                'cbgDist' => $cbgDist
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Data tidak ditemukan'
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        // Temukan item yang akan diperbarui
        $cbgDist = MstCbgDist::find($id);

        if (!$cbgDist) {
            return response()->json([
                'status' => 404,
                'message' => 'Item tidak ditemukan.',
            ], 404);
        }

        // Jalankan validasi
        $validator = Validator::make($request->all(), [
            'id_cbg_ph' => 'required|string|max:255',
            'kode_cbg_dist' => 'required|string|max:255',
            'nama_cbg' => 'nullable|string|max:100',
            'branch_address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:50',
            'province' => 'nullable|string|max:50',
            'postal_code' => 'nullable|string|max:10',
            'phone_number' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:100',
            'dist' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->errors(),
            ], 422);
        }

        // Update data jika validasi berhasil
        $cbgDist->id_cbg_ph = $request->id_cbg_ph;
        $cbgDist->kode_cbg_dist = $request->kode_cbg_dist;
        $cbgDist->nama_cbg = $request->nama_cbg;
        $cbgDist->branch_address = $request->branch_address;
        $cbgDist->city = $request->city;
        $cbgDist->province = $request->province;
        $cbgDist->postal_code = $request->postal_code;
        $cbgDist->phone_number = $request->phone_number;
        $cbgDist->email = $request->email;
        $cbgDist->dist = $request->dist;
        $cbgDist->is_active = $request->has('is_active');
        $cbgDist->save();

        return response()->json([
            'status' => 200,
            'message' => 'Item berhasil diperbarui.',
        ]);
    }

    public function destroy($id)
    {
        $cbgDist = MstCbgDist::find($id);

        if ($cbgDist) {
            $cbgDist->delete();

            return response()->json([
                'status' => 200,
                'message' => 'Data berhasil dihapus',
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Data tidak ditemukan',
            ]);
        }
    }
}
