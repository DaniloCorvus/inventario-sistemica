<?php

namespace App\Repository;

use App\Models\Empresa;
use App\Services\imgUploader;

class EmpresaRepository
{


    public function __construct(imgUploader $imgUploader)
    {
        $this->imgUploader = $imgUploader;
    }

    public function save()
    {
        try {
            Empresa::create(request()->all());
            if (request()->has('img')) {
                $this->imgUploader->saveImg(request()->file('img'));
            }
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function update()
    {
        try {
            $empresa = Empresa::first();
            $empresa->update(request()->all());
            if (request()->has('img')) {
                $this->imgUploader->saveImg(request()->file('img'));
            }
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
