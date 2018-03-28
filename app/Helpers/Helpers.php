<?php



class Helpers{

    /*
     * ='blogImage';
        ='foo.png';
        ='bar.png';
     */

    public static function save_img($imgType,$imgObject,$resultDir){

        $imgConfig=[
            'renterProfile'=>[
                'width'=>100,
                'height'=>100,
                'hasWatermark'=>false,
                'watermarkDir'=>'',
            ],
            'blogImage'=>[
                'width'=>377,
                'height'=>206,
                'hasWatermark'=>true,
                'watermarkDir'=>'watermark.png',
            ],
            'villaImage'=>[
                'width'=>377,
                'height'=>206,
                'hasWatermark'=>true,
                'watermarkDir'=>'watermark.png',
            ],
        ];

        $withWatermark=$imgConfig[$imgType]['hasWatermark'];
        $width=$imgConfig[$imgType]['width'];
        $height=$imgConfig[$imgType]['height'];
        $watermarkDir=$imgConfig[$imgType]['watermarkDir'];

        $img = Image::make($imgObject)->fit($width, $height,function ($constraint) {
            $constraint->upsize();
        });

        if($withWatermark){
            $minDim=min($width,$height);
            $watermarkHeight=Image::make($watermarkDir)->height();
            $watermarkWidth=Image::make($watermarkDir)->Width();
            $watermarkNewWidth=$minDim/3;
            $watermarkNewHeight=$watermarkHeight/($watermarkWidth/$watermarkNewWidth);
            $watermark=Image::make($watermarkDir)->resize($watermarkNewWidth,$watermarkNewHeight);
            $img=$img->insert($watermark, 'bottom-left', 10, 10);
        }

        $img->save($resultDir);


    }




    public static function make_slug($string, $separator = '-')
    {
        $string = trim($string);
        $string = mb_strtolower($string, 'UTF-8');
        $string = preg_replace("/[^a-z0-9_\s-ءاآؤئبپتثجچحخدذرزژسشصضطظعغفقكکگلمنوهی]/u", '', $string);
        $string = preg_replace("/[\s-_]+/", ' ', $string);
        $string = preg_replace("/[\s_]/", $separator, $string);

        return $string;
    }



    public static function space2Dash($string)
    {
        $string=trim($string);
        $string=str_replace(" ","-",$string);
        $string=str_replace("_","-",$string);

        return $string;
    }

    public static function br2nl($string)
    {
        return preg_replace('/\<br(\s*)?\/?\>/i', "", $string);
    }
    protected static function div($a,$b) {
        return (int) ($a / $b);
    }




    public static function convert_date_j_to_g($timestamp,$str){
        $temp=explode(" ",$timestamp);
        $timestamp=$temp[0];
        list($j_y, $j_m, $j_d) = explode('/', $timestamp);

        $g_days_in_month = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
        $j_days_in_month = array(31, 31, 31, 31, 31, 31, 30, 30, 30, 30, 30, 29);


        $jy = (int)($j_y)-979;
        $jm = (int)($j_m)-1;
        $jd = (int)($j_d)-1;

        $j_day_no = 365*$jy + self::div($jy, 33)*8 + self::div($jy%33+3, 4);

        for ($i=0; $i < $jm; ++$i)
            $j_day_no += $j_days_in_month[$i];

        $j_day_no += $jd;
        $g_day_no = $j_day_no+79;

        $gy = 1600 + 400*self::div($g_day_no, 146097); /* 146097 = 365*400 + 400/4 - 400/100 + 400/400 */
        $g_day_no = $g_day_no % 146097;

        $leap = true;
        if ($g_day_no >= 36525){ /* 36525 = 365*100 + 100/4 */
            $g_day_no--;
            $gy += 100*self::div($g_day_no,  36524); /* 36524 = 365*100 + 100/4 - 100/100 */
            $g_day_no = $g_day_no % 36524;

            if ($g_day_no >= 365)
                $g_day_no++;
            else
                $leap = false;

        }

        $gy += 4*self::div($g_day_no, 1461); /* 1461 = 365*4 + 4/4 */
        $g_day_no %= 1461;

        if ($g_day_no >= 366) {
            $leap = false;

            $g_day_no--;
            $gy += self::div($g_day_no, 365);
            $g_day_no = $g_day_no % 365;
        }

        for ($i = 0; $g_day_no >= $g_days_in_month[$i] + ($i == 1 && $leap); $i++)
            $g_day_no -= $g_days_in_month[$i] + ($i == 1 && $leap);
        $gm = $i+1;
        $gd = $g_day_no+1;
        if($str) return $gy.'-'.$gm.'-'.$gd ;
        return array($gy, $gm, $gd);
    }




    public static function convert_date_g_to_j($timestamp,$str) {

        if($timestamp==Null || $timestamp==''){
            return '0000/00/00';
        }
        $temp=explode(" ",$timestamp);
        $timestamp=$temp[0];
        list($g_y, $g_m, $g_d) = explode('-', $timestamp);

        $g_days_in_month = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
        $j_days_in_month = array(31, 31, 31, 31, 31, 31, 30, 30, 30, 30, 30, 29);

        $gy = $g_y-1600;
        $gm = $g_m-1;
        $gd = $g_d-1;

        $g_day_no = 365*$gy+self::div($gy+3,4)-self::div($gy+99,100)+self::div($gy+399,400);

        for ($i=0; $i < $gm; ++$i)
            $g_day_no += $g_days_in_month[$i];
        if ($gm>1 && (($gy%4==0 && $gy%100!=0) || ($gy%400==0)))
            /* leap and after Feb */
            $g_day_no++;
        $g_day_no += $gd;

        $j_day_no = $g_day_no-79;

        $j_np = self::div($j_day_no, 12053); /* 12053 = 365*33 + 32/4 */
        $j_day_no = $j_day_no % 12053;

        $jy = 979+33*$j_np+4*self::div($j_day_no,1461); /* 1461 = 365*4 + 4/4 */

        $j_day_no %= 1461;

        if ($j_day_no >= 366) {
            $jy += self::div($j_day_no-1, 365);
            $j_day_no = ($j_day_no-1)%365;
        }

        for ($i = 0; $i < 11 && $j_day_no >= $j_days_in_month[$i]; ++$i)
            $j_day_no -= $j_days_in_month[$i];
        $jm = $i+1;
        $jd = $j_day_no+1;
        if($str) return $jy.'/'.$jm.'/'.$jd ;
        return array($jy, $jm, $jd);
    }











    public static function get_equal_str_month($month_order){
        $month=[
            1=>"فروردین",
            2=>"اردیبهشت",
            3=>"خرداد",
            4=>"تیر",
            5=>"مرداد",
            6=>"شهریور",
            7=>"مهر",
            8=>"آبان",
            9=>"آذر",
            10=>"دی",
            11=>"بهمن",
            12=>"اسفند",
        ];

        return $month[$month_order];
    }



    public static function getRelationsInArray($data,$rel_name,$parent_fields=array()){
        $data=$data->toArray();
        $resp=array();
        foreach ($data as $key => $d) {
            foreach ($parent_fields as $v) {
                foreach ($d[$rel_name] as $key2=>$c) {
                    $d[$rel_name][$key2][$v]=$d[$v];
                }
            }
            $resp=array_merge($resp,$d[$rel_name]);
        }
        return $resp;
    }
    public static function returnexplodedtime($date){
        $f = Helpers::convert_date_g_to_j($date,true);
        $fs = explode('/',$f);
        return '<span>'.$fs[2].'</span><strong>'.Helpers::get_equal_str_month($fs[1]).'</strong><span>'.$fs[0].'</span>';
    }

    public static function sendsms($number,$code){
        $from = "";
        if (substr($number, 0, 2) == "92"){
            $from = "+98100009";
        }
        else{
            $from = "+98500020403557";
        }
        $url = "37.130.202.188/services.jspd";

        $param = array
        (
            'uname'=>'mazandaranweb',
            'pass'=>'5p64g49',
            'from'=>$from,
            'message'=>'رمز عبور جدید شما:'.$code,
            'to'=>$number,
            'op'=>'send'
        );

        $handler = curl_init($url);
        curl_setopt($handler, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($handler, CURLOPT_POSTFIELDS, $param);
        curl_setopt($handler, CURLOPT_RETURNTRANSFER, true);
        $response2 = curl_exec($handler);

        $response2 = json_decode($response2);
        $res_code = $response2[0];
        //$res_data = $response2[1];


        return $res_code;
    }




}
