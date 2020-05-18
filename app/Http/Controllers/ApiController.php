<?php

namespace App\Http\Controllers;

use App\Client;
use App\Http\Service\ApiService;
use App\Resident;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApiController extends Controller
{
    private $ApiService;

    public function __construct(ApiService $ApiService)
    {
        $this->ApiService = $ApiService;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $this->validate($request, [
            'image' => 'required',
            'email' => 'required|email', //|unique:residents,email
            'zip' => 'postal_code:CH',
            'address' => 'required',
            'sign' => 'required'
        ]);

        $this->ApiService->saveResidentFiles($request);

    }


}
