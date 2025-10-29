<?php

namespace App\Http\Controllers;

use App\Models\MstCbgPH;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MstCbgPHController extends Controller
{
    public function index()
    {
        $cbgPH = MstCbgPH::all();
        return view('mst_cbg_ph.index', compact('cbgPH'));
    }

    public function edit($id)
    {
        $cbgPH = MstCbgPH::find($id);
        if ($cbgPH) {
            return response()->json([
                'status' => 200,
                'cbgPH' => $cbgPH
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
        $cbgPH = MstCbgPH::find($id);

        if (!$cbgPH) {
            return response()->json([
                'status' => 404,
                'message' => 'Item tidak ditemukan.',
            ], 404);
        }

        // Jalankan validasi
        $validator = Validator::make($request->all(), [
            'nama_cbg' => 'nullable|string|max:100',
            'region' => 'nullable|string|max:50',
            'branch_address' => 'nullable|string|max:50',
            'city' => 'nullable|string|max:50',
            'province' => 'nullable|string|max:50',
            'postal_code' => 'nullable|string|max:10',
            'phone_number' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->errors(),
            ], 422);
        }

        // Update data jika validasi berhasil
        $cbgPH->nama_cbg = $request->nama_cbg;
        $cbgPH->region = $request->region;
        $cbgPH->branch_address = $request->branch_address;
        $cbgPH->city = $request->city;
        $cbgPH->province = $request->province;
        $cbgPH->postal_code = $request->postal_code;
        $cbgPH->phone_number = $request->phone_number;
        $cbgPH->email = $request->email;
        $cbgPH->is_active = $request->has('is_active');
        $cbgPH->save();

        return response()->json([
            'status' => 200,
            'message' => 'Item berhasil diperbarui.',
        ]);
    }

    public function destroy($id)
    {
        $cbgPH = MstCbgPH::find($id);

        if ($cbgPH) {
            $cbgPH->delete();

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
