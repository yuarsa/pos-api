<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Models\Master\Product;
use Illuminate\Queue\Events\WorkerStopping;
use Illuminate\Support\Facades\File;

/**
 * @group Masters
 */
class CommonController extends Controller
{
    public function productImage($id)
    {
        $image = Product::where('prod_id', $id)->first()->prod_image;

        $path = storage_path('app/public/'. $image);

        if (file_exists($path)) {
            $file = file_get_contents($path);
            return response($file, 200)->header('Content-Type', 'image/jpeg');
        }
    }
}
