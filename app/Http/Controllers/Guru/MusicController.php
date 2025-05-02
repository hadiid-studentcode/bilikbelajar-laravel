<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Music_settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MusicController extends Controller
{
    protected $title = 'Music';

    public function index()
    {
        $title = $this->title;
        $musikKuis = Music_settings::where('type', 'kuisEvaluasi')->first();
        $musikMateri = Music_settings::where('type', 'materi')->first();

        return view('guru.pengaturan.music.index', compact('title', 'musikKuis', 'musikMateri'));
    }

    public function store(Request $request)
    {

        try {
            // Validate the request
            $request->validate([
                'type' => 'required|in:kuisEvaluasi,materi',
                'music' => 'required',
            ]);

            // Store the music file
            if (! $request->hasFile('music')) {
                return back()->with('error', 'File not found');
            }
            if ($request->type == 'kuisEvaluasi') {
                $path = $request->file('music')->store('settings/music/kuisEvaluasi');
            } elseif ($request->type == 'materi') {
                $path = $request->file('music')->store('settings/music/materi');
            }

            Music_settings::create([
                'type' => $request->type,
                'file_name' => $path,
            ]);

            // Return a success response
            return back()->with('success', 'Music file uploaded successfully');
        } catch (\Throwable $th) {
            dd($th->getMessage());

            // Return an error response
            return back()->with('error', 'Failed to upload music file');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            // Validate the request
            $request->validate([
                'type' => 'required|in:kuisEvaluasi,materi',
                'music' => 'required',
            ]);

            // Store the music file
            if (! $request->hasFile('music')) {
                return back()->with('error', 'File not found');
            }
            if ($request->type == 'kuisEvaluasi') {
                // hapus file lama
                $music = Music_settings::find($id);
                if ($music->file_name) {
                    Storage::delete($music->file_name);
                }
                $path = $request->file('music')->store('settings/music/kuisEvaluasi');
            } elseif ($request->type == 'materi') {
                // hapus file lama
                $music = Music_settings::find($id);
                if ($music->file_name) {
                    Storage::delete($music->file_name);
                }
                $path = $request->file('music')->store('settings/music/materi');
            }

            Music_settings::where('id', $id)->update([
                'type' => $request->type,
                'file_name' => $path,
            ]);

            // Return a success response
            return back()->with('success', 'Music file updated successfully');
        } catch (\Throwable $th) {
            dd($th->getMessage());

            // Return an error response
            return back()->with('error', 'Failed to update music file');
        }
    }

    public function destroy($id)
    {
        try {
            $music = Music_settings::find($id);
            if ($music->file_name) {
                Storage::delete($music->file_name);
            }
            $music->delete();

            return back()->with('success', 'Music file deleted successfully');
        } catch (\Throwable $th) {
            dd($th->getMessage());

            return back()->with('error', 'Failed to delete music file');
        }
    }
}
