<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Upload;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class UploadController extends Controller
{
    public function showUpload()
    {
        $permissions = Gate::allows('permission') ? Upload::get() : Upload::where('status', 'approved')->get();
        return view('upload', compact('permissions'));
    }

    public function showIndex()
    {
        $permissions = Gate::allows('permissao') ? Upload::get() : Upload::where('status', 'approved')->get();
        return view('index', compact('permissions'));
    }

    public function insertFile(Request $request)
    {
        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $requestImage = $request->file;
            $extension = $requestImage->extension();
            $fileName = md5($requestImage->getClientOriginalName() . strtotime("now")). "." . $extension;
            $requestImage->move(public_path('file'), $fileName);
            $file = Upload::create([
                'user_id' => Auth::id(),
                'file_path' => $fileName
            ]);
        };
        return redirect()->route('showPending');
    }

    public function showPending()
    {
        $uploads = Upload::with('user')->where('status', 'pending')->get();
        // dd($uploads);
        return view('pending', compact('uploads'));
    }

    public function approve($approve)
{
    $upload = Upload::findOrFail($approve);
    $upload->status = 'approved';
    $upload->save();
    $approve = Upload::where('status', 'pending')->first();
    return $approve ? redirect()->route('showPending') : redirect()->route('showIndex');
}

    public function reject($reject)
    {
        $upload = Upload::findOrFail($reject);
        $upload->status = 'rejected';
        $upload->save();
        $reject = Upload::where('status', 'rejected')->first();
        return $reject ? redirect()->route('showPending') : redirect()->route('showIndex');
    }

}
