<?php


namespace App\Http\Service;


use App\EloquentQueries\EloquentResidentQueries;
use App\Resident;
use Illuminate\Support\Facades\Storage;

class ApiService
{
    private $eloquentResidentQueries;

    public function __construct(EloquentResidentQueries $eloquentResidentQueries)
    {
        $this->eloquentResidentQueries = $eloquentResidentQueries;
    }

    public function saveResidentFiles($request)
    {
        $image = $request->file('image'); //одиночная загрузка фото
        $sign = str_replace('data:image/png;base64,', '', $request->sign);
        $data = base64_decode($sign);
        $signName = '/public/signs/' . uniqid() . time() . '.png';
        Storage::put($signName, $data);

        $this->eloquentResidentQueries->storeResidents($request, $image, $signName);

    }
}
