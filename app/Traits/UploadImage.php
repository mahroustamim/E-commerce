<?php 

namespace App\Traits;

use Illuminate\Support\Str;

trait UploadImage
{
    public function upload($file)
    {
        $fileName = Str::uuid() . $file->getClientOriginalName(); 
        $file->move(public_path('images'), $fileName);
        $path = 'images\\' . $fileName;
        return $path;
    }

    public function deleteFile($path)
    {
        if (file_exists($path)) {
            unlink($path);
        }
    }
}

?>