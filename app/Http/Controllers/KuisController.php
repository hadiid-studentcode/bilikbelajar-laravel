<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NilaiKuis;

class KuisController extends Controller
{
    public function updateCatatan(Request $request, $id)
    {
        $nilaiKuis = NilaiKuis::findOrFail($id);
        $nilaiKuis->update([
            'catatan' => $request->catatan
        ]);

        return redirect()->back()->with('success', 'Catatan berhasil diperbarui');
    }
}
