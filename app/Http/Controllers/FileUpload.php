<?php
namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class FileUpload extends Controller
{
    public function createForm(User $user)
    {
        return view('/userpage', [
            'user' => auth()->user()
        ]);
    }

    public function fileUpload(Request $req)
    {
        $req->validate([
            'file' => 'required|mimes:jpg,png,jpeg|max:2048'
        ]);
//        $uploadedFile = $req->file('file');
//
//        $filename = '11111111'. time().$uploadedFile->getClientOriginalName();
//
//        $place = Storage::disk('local')->putFileAs(
//            'files/'.time(),
//            $uploadedFile,
//            $filename
//        );
//        $base_path = base_path();
//        Storage::move($place, 'public/'.$filename);
//        $url = Storage::url('public/'.$filename);
//        ddd($url);


        if($req->hasFile('file')){
            $image = $req->file('file');
            $image_name = auth()->user()->username.".".$image->getClientOriginalExtension();
            $image->move(public_path('/images'),$image_name);

            $image_path = "/images/" . $image_name;
          DB::update('update users set avatar ='. '"' . $image_path . '"' .' where id = ?', [auth()->user()->id]);

        }

        return back()
            ->with('success','File has been uploaded.');
    }
}
