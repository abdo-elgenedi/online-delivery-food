<?php

namespace App\Traits\Admin;


trait AdminImages
{
   public function upload($save_path,$image){
       $file_extension=$image->getClientOriginalExtension();
       $filename=time().'.'.$file_extension;
       $path=$save_path;
       $image->move($path,$filename);
       return $filename;
   }
}
