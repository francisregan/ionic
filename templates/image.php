<?php
session_start();

    $student_data = $_SESSION["student_data"]; 
    $image = "../public/assets/images/cert1.jpg";
    $arr = json_decode($student_data, true);

    if($arr["type"] == 1){
        $image = "../public/assets/images/cert1.jpg";
    }

    $im = ImageCreateFromJPEG($image);
    
        // Replace path by your own font path
        $font = '../public/assets/font/Montserrat-Light.ttf';
        // Create some colors
        $blue = imagecolorallocate($im, 0, 103, 153);
        
        // Add the text
        imagettftext($im, 12, 0, 85, 695, $blue, $font,  $arr["unique_reference"] );

        $student_name = urldecode( $arr["student_name"]);
        $savoyefont = '../public/assets/font/Savoye LET.ttf';
        $savoyefontsize=52;

        $testchar = "ABCDEFGHIJKLMNOPQR";
        $xpixel=180;
        $ypixel=390;
        //imagettftext($im, $savoyefontsize, 0, $xpixel, $ypixel, $blue, $savoyefont, $testchar);

        $studentnameypixel=390;
        $bbox = imagettfbbox($savoyefontsize, 0, $savoyefont, $testchar);
        $studentnamebbox = imagettfbbox($savoyefontsize, 0, $savoyefont, $arr["student_name"]);

        $studentmidpoint = abs(($studentnamebbox[2] + $studentnamebbox[0])/2);
        $bbmidpoint = abs(($bbox[2] + $bbox[0])/2);
        
        $differenceMid =  abs($bbmidpoint - $studentmidpoint);
        $newposition = abs($xpixel) + $differenceMid;
        
        $studentname_new_xpixel_align = $newposition;

        imagettftext($im, $savoyefontsize, 0, $studentname_new_xpixel_align, $studentnameypixel, $blue, $savoyefont, $student_name);

        imagettftext($im, 12, 0, 450, 505, $blue, $font, $arr["course_title"]);

        imagettftext($im, 12, 0, 450, 533, $blue, $font,  $arr["from"]." - ". $arr["to"]);

      
        imagettftext($im, 12, 0, 305, 559, $blue, $font,  $arr["conducted_at"]);

        $red = imagecolorallocate($im, 255, 0, 0);
        imagettftext($im, 10, 0, 620, 765, $red, $font, "** Computer generated, no signature required. **");

        imagettftext($im, 10, 0, 115, 745, $blue, $font, "Validate at");
        imagettftext($im, 10, 0, 85, 765, $blue, $font, "education.ionic3dp.com ");
        
        header('Content-Type: image/png');

        imagepng($im);
        imagedestroy($im);
   
?>