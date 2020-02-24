<?php

namespace App\Http\Controllers;

use App\Client;
use App\Resident;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

//        $images = $request->file('file' /*file*/);
//        foreach ($images as $image) { //массовая загрузка фото
//            Image::create([
//                'title' => $image->getClientOriginalName(),
//                'path' => $image->store('public/storage'),
        //]);

        $this->validate($request, [
            'image' => 'required',
            'email' => 'required|email', //|unique:residents,email
            'zip' => 'postal_code:CH',
            'address' => 'required',
            'sign' => 'required'
        ]);
        $image = $request->file('image'); //одиночная загрузка фото
        $sign = $request->sign; // your base64 encoded
        $sign = str_replace('data:image/png;base64,', '', $sign);
        $data = base64_decode($sign);
        $signName = '/public/signs/'.uniqid() . time() . '.png';
        Storage::put($signName, $data);

        Resident::create([
            'image' => $image->store('/public/images'),
            'email' => $request->input('email'),
            'zip' => $request->input('zip'),
            'address' => $request->input('address'),
            'sign' => $signName,
        ]);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
