<?php

namespace App\Http\Controllers\API\Version_1\Update_Campus;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Version_1\Update_Campus\Upload_Gallery_Image;
use App\Services\Version_1\Update_Campus\Delete_Gallery_Image;

class GalleryController extends Controller
{
    public function upload(Request $request, Upload_Gallery_Image $uploadGalleryImage)
    {
        return $uploadGalleryImage->handle($request);
    }

    public function upload_Multiple(Request $request, Upload_Gallery_Image $uploadGalleryImage)
    {
        return $uploadGalleryImage->handleMultiple($request);
    }

    public function delete(Request $request, Delete_Gallery_Image $deleteGalleryImage)
    {
        return $deleteGalleryImage->handle($request);
    }
}