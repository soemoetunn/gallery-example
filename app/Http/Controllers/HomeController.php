<?php

namespace App\Http\Controllers;

use App\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class HomeController extends Controller
{

    public function index()
    {
        $galleries = Gallery::all();
        return view('home',compact('galleries'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'image'=> 'required',
            'image.*'=>'image|mimes:jpeg,png,jpg,gif,svg'
        ]);
        //dd($request->file('image'));
        if($request->hasFile('image')){
            foreach($request->file('image') as $image){
                $filename=time().'-'.$image->getClientOriginalName();
                $image->storeAs('upload',$filename);

                $gallery=new Gallery();
                $gallery->name=$filename;
                $gallery->save();

            }
        }

        return back()->with('success','Upload Successfully');
        // $filename=time().'-'.$request->file('image')->getClientOriginalName();
        // $request->file('image')->move(public_path('images'),$filename);
        // $request->file('image')->storeAs('upload',$filename);
    }

    public function destroy($id)
    {
        $gallery=Gallery::findorFail($id);
        Storage::delete('upload/'.$gallery->name);
        $gallery->delete();

        return back()->with('success','Delete Sucessfully');
    }

    public function download($id)
    {
        $gallery=Gallery::findOrFail($id);
       return Storage::download('upload/'.$gallery->name);
    }
}
