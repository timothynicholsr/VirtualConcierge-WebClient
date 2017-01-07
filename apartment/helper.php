<?php
CONST URl='http://hoste.us:8000/api/listings/30?key=4daa6722ac1da9c6c425e618c9eb3f3f';
CONST MESSAGEURl='http://hoste.us:8181/api/messages/';
CONST Key='?key=4daa6722ac1da9c6c425e618c9eb3f3f';

/* Convert hexa code to rgb */

function hex2rgb($hex) {
   $hex = str_replace("#", "", $hex);
   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   //$rgb = array($r, $g, $b);
   
   $rgb = $r.','.$g.','.$b;
   return $rgb;
}
/*
function code_percantage($code){
$homepage = file_get_contents('Text_value.txt');


$t=explode(' ',$homepage);


foreach($t as $val){
	$t2=explode('-',$val);
	$data[$t2[1]]=$t2[0];
}
return str_replace(' ','',str_replace('%','',$data[$code]))/100;
}
*/
function argb2rgba($color)
    {
        $output = 'rgba(0,0,0,1)';

        if (empty($color))
            return $output;

        if ($color[0] == '#') {
            $color = substr($color, 1);
        }

        if (strlen($color) == 8) { //ARGB
            $opacity = round(hexdec($color[0].$color[1]) / 255, 2);
            $hex = array($color[2].$color[3], $color[4].$color[5], $color[6].$color[7]);
            $rgb = array_map('hexdec', $hex);
            $output = 'rgba(' . implode(",", $rgb) . ',' . $opacity . ')';
        }

        return $output;
    }

function SendMessage($date,$time,$roomid){
  $message_url=MESSAGEURl.$roomid;
	$post = [
    'key' => '4daa6722ac1da9c6c425e618c9eb3f3f',
    'message' => 'guest X has requested a later checkout'.$date.'',
    'subject' => 'Later Checkout Date Requested',
    'msg_type' => 1
    
];
$ch = curl_init($message_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
$response = curl_exec($ch);

curl_close($ch);
return $response;

	
}







?>
