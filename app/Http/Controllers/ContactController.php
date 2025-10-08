<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class ContactController extends Controller
{
    public function addContact(Request $req){
        // $req->validate([
        //     'name'=>'required',
        //     'email'=>'required|email',
        //     'phone'=>['required','regex:\d{10}'],
        //     'title'=>"required|max:150",
        //     'content'=>"required"
        // ]);
        $contact=DB::table('contacts')->insert([
            'name'=>$req->name,
            'email'=>$req->email,                                                                               
            'phone'=>$req->phone,
            'title'=>$req->title,
            'content'=>$req->content
        ]);
        return view('viewContact',['name'=>$req->name,'email'=>$req->email,'phone'=>$req->phone,'title'=>$req->title,'content'=>$req->content]);
    }
}
