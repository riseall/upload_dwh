<?php

namespace App\Http\Controllers;

use App\Models\MstAM;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class MstAMController extends Controller
{
    public function index()
    {
        return view('mst_am.index');
    }

    public function getData(Request $request)
    {
        // if ($request->ajax()) {
        $query = MstAM::query();
        return DataTables::of($query)->addIndexColumn()
            ->make(true);
        // }
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:csv,txt|max:2048',
        ]);

        try {
            $path = $request->file('file')->getRealPath();
            $file = fopen($path, 'r');

            $today = now()->toDateString();

            MstAM::whereDate('created_at', $today)->delete();

            $header = fgetcsv($file, 0, ';', '"');
            $headerColumnCount = count($header);
            $lineNumber = 1;

            $validSubdivValues = ['REGULER', 'NON-REGULER'];

            DB::beginTransaction();
            while (($row = fgetcsv($file, 0, ';', '"')) !== false) {
                $lineNumber++;

                // Lewati baris yang kosong
                if (empty(array_filter($row, fn($value) => $value !== null && $value !== ''))) {
                    continue;
                }

                if (count($row) !== $headerColumnCount) {
                    throw new \Exception("Kesalahan pada baris {$lineNumber}: Jumlah kolom tidak sesuai dengan header. Mohon periksa file csv anda.");
                }

                $subdivValue = trim($row[4]);

                if (!in_array($subdivValue, $validSubdivValues)) {
                    throw new \Exception("Kesalahan pada baris {$lineNumber}: Nilai kolom pasar tidak valid. Nilai yang diizinkan adalah REGULER atau NON-REGULER.");
                }

                try {
                    MstAM::create([
                        'am_nik' => trim($row[0]),
                        'sam_nik' => trim($row[1]),
                        'nama_am' => trim($row[2]),
                        'pilar' => trim($row[3]),
                        'subdiv' => $subdivValue
                    ]);
                } catch (\Exception $e) {
                    throw new \Exception("Kesalahan pada baris {$lineNumber}: " . $e->getMessage());
                }
            }

            fclose($file);
            DB::commit();

            return redirect()->route('mst_am.index')->with('success', 'Data CSV berhasil diupload dan disimpan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('mst_am.index')->with('error', 'Terjadi kesalahan saat memproses file: ' . $e->getMessage());
        }
    }
}
