<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use App\Models\Student;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class testcontoller extends Controller
{
    public function create(Request $request){
        $user_id = Auth::id();
        $image=$request->file('image')->store('students','public');
        DB::table('students')
            ->insert([
                'user_id'=>$user_id,
                'name'=>$request->name,
                'age'=>$request->age,
                'image'=>$image,
                'status'=>1
            ]);
        return Redirect::route('index');
    }

    public function update(Request $request){
        $student=DB::table('students')->where('id',$request->id)->first();
        $image=$student->image;
        if($request->image){
            Storage::delete('public/'.$student->image);
            $image=$request->file('image')->store('students','public');
        }
        DB::table('students')
            ->where('id',$request->id)
            ->update([
                'name'=>$request->name,
                'age'=>$request->age,
                'image'=>$image,
            ]);
        return Redirect::route('index');
    }

    public function createView(){
        return Inertia::render('create');
    }

    public function updateView($id){
        $student=DB::table('students')->where('id',$id)->first();
        return Inertia::render('update',[
            'data'=>$student
        ]);
    }

    public function delete($id){
        $student=DB::table('students')->where('id',$id)->first();
        Storage::delete('public/'.$student->image);
        DB::table('students')->where('id',$id)->delete();
        return Redirect::route('index');
    }

    public function index(){
        $user_id = Auth::id();
        return Inertia::render('index',[
            'data'=>Student::where('user_id',$user_id)->get()
        ]);
    }

    public function active($id){
        DB::table('students')
            ->where('id',$id)
            ->update([
                'status'=>1,
            ]);
        return Redirect::route('index');
    }

    public function inactive($id){
        DB::table('students')
            ->where('id',$id)
            ->update([
                'status'=>0,
            ]);
        return Redirect::route('index');
    }
}
