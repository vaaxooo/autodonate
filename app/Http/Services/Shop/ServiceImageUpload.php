<?php

namespace App\Http\Services\Shop;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ServiceImageUpload
{

    /**
     * @param $image
     * @return string
     */
    public function uploadProductImage($image)
    {
        $length = mt_rand(10, 15);
        $randomString = substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
            ceil($length / strlen($x)))), 1, $length);
        $imageName = time().$randomString.".".$image->extension();
        $image->move(public_path('static/products'), $imageName);

        $thumbnail = Image::make(public_path('static/products/').$imageName);
        $thumbnail->resize(500, 500);
        $thumbnail->save(public_path('static/products/'.$imageName));

        return 'static/products/'.$imageName;
    }

    /**
     * @param $oldImage
     * @param $image
     * @param $image_delete
     * @return string
     */
    public function changeProductImage($oldImage, $image)
    {
        if($oldImage !== $image) {
            if($oldImage !== "assets/images/product_default_image.svg") {
                unlink(public_path($oldImage));
            }
            return $this->uploadProductImage($image);
        }
        return $oldImage;
    }

}