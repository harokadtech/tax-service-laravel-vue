<?php


namespace App\EloquentQueries;


use App\Resident;

class EloquentResidentQueries
{
    public function getResidents($email)
    {
        return Resident::with('taxData')->where('email',$email)->orderBy('created_at', 'DESC')->get();
    }
    public function storeResidents($request, $image, $signName, $userId)
    {
       return Resident::create([
            'image' => $image->store('/public/images'),
            'email' => $request->input('email'),
            'zip' => $request->input('zip'),
            'address' => $request->input('address'),
            'sign' => $signName,
            'user_id' => (int) $userId,
        ]);
    }
}
