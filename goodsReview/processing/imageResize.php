<?php

    function changeSizeImage($imgName){
        try{
            // リサイズ前画像ファイル名
            $imageFile1 = '../originalImages/'.$imgName;

            // リサイズ後画像ファイル名
            $thumbnail_file_path = '../changeSizeImages/'.$imgName;

            $resizeX = 300;

            if (pathinfo($imgName, PATHINFO_EXTENSION) == "png"){
                $gdimg_in = imagecreatefrompng($imageFile1);
            }else{
                $gdimg_in = imagecreatefromjpeg($imageFile1);
            }
            
            $ix = imagesx($gdimg_in);
            $iy = imagesy($gdimg_in);

            $ox = $resizeX;
            $oy = $ox * ($iy/$ix);

            $gdimg_out = imagecreatetruecolor($ox, $oy);

            imagecopyresized($gdimg_out, $gdimg_in, 0, 0, 0, 0, $ox, $oy, $ix, $iy);
            if(pathinfo($imgName, PATHINFO_EXTENSION) == "png"){
                imagepng($gdimg_out, $thumbnail_file_path);
            }else{
                imagejpeg($gdimg_out, $thumbnail_file_path);
            }

            imagedestroy($gdimg_in);
            imagedestroy($gdimg_out);

        }catch(PDOException $Exception){
            header('Location: ../display/goodsList/goodsList.php');
        }
    }
?>