<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use DB;
use App\Functions\Image;
use App\Functions\Watermark;


class imageController extends Controller
{
    
    public function index($type,$size,$name=null){
        if(isset($type) and isset($size)){
   
            if($type == 'book'){
                $src = url('/images/book').'/'.$name;
                if(@is_array(getimagesize($src))){
                    $image = new Image($src);
                    if($size == 'small'){
                        $image->resizeWidth(100);
                    }elseif($size == 'thumbnail'){
                        $image->resizeWidth(200);
                    }elseif($size == 'large'){
                        $image->resizeWidth(300);
                    }
                    $image->output();    
                }else{
                    $image = new Image(url('/theme/logo/book-default.png'));
                    $image->output();
                }
            
            }elseif($type == 'avatar'){
                $src = url('/images/avatar').'/'.$name;
                if(@is_array(getimagesize($src))){
                    $image = new Image($src);
                    if($size == 'small'){
                        $image->resizeCrop(100);
                    }elseif($size == 'thumbnail'){
                        $image->resizeCrop(200);
                    }elseif($size == 'large'){
                        $image->resizeCrop(300);
                    }
                    $image->output();    
                }else{
                    $image = new Image(url('/theme/logo/avatar.png'));
                    $image->output();
                }
                
            }elseif($type == 'blog'){
                $src = url('/images/blog').'/'.$name;
                if(@is_array(getimagesize($src))){
                    $image = new Image($src);
                    if($size == 'small'){
                        $image->resizeWidth(100);
                    }elseif($size == 'thumbnail'){
                        $image->resizeWidth(200);
                    }elseif($size == 'large'){
                        $image->resizeWidth(300);
                    }
                    $image->output();    
                }else{
                    $image = new Image(url('/theme/logo/avatar.png'));
                    $image->output();
                }
            }elseif($type == 'blog-upload'){
                $src = url('/images/blog').'/'.$name;
                if(@is_array(getimagesize($src))){
                    $image = new Image($src);
                    if($size == 'small'){
                        $image->resizeWidth(100);
                    }elseif($size == 'thumbnail'){
                        $image->resizeWidth(200);
                    }elseif($size == 'large'){
                        $image->resizeWidth(300);
                    }
                    $image->output();    
                }else{
                    $image = new Image(url('/theme/logo/avatar.png'));
                    $image->output();
                }
            }
        }
        $image = new Image(url('/theme/logo/avatar.png'));
        $image->output();
    }

}