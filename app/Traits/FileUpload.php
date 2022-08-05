<?php

namespace App\Traits;

trait FileUpload
{
    public function upload($file, $folder = null, $company_id = null)
    {
        if(!$file || !$file->isValid()) {
            return response()->json(['error' => ['status' => 100, 'message' => 'Invalid file']], 100);
        }

        if (!$company_id) {
            $company_id = \Auth::user()->valud_id;
        }

        $fileName = md5($file->getClientOriginalName().microtime()).'.'.$file->getClientOriginalExtension();

        return $file->storeAs($company_id.'/'.$folder, $fileName, 'public');
    }
}
