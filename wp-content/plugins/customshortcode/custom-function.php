<?php
function get_users_by_meta_data( $meta_key, $meta_value ) {

  // Query for users based on the meta data
  $user_query = new WP_User_Query(
    array(
      'meta_key'    =>  $meta_key,
      'meta_value'  =>  $meta_value
    )
  );

  // Get the results from the query, returning the first user
  $users = $user_query->get_results();

  return $users;

} // end get_users_by_meta_data

function str_language( $str_language ) {

  $marTViet=array("à","á","ạ","ả","ã","â","ầ","ấ","ậ","ẩ","ẫ","ă",
  "ằ","ắ","ặ","ẳ","ẵ","è","é","ẹ","ẻ","ẽ","ê","ề"
  ,"ế","ệ","ể","ễ",
  "ì","í","ị","ỉ","ĩ",
  "ò","ó","ọ","ỏ","õ","ô","ồ","ố","ộ","ổ","ỗ","ơ"
  ,"ờ","ớ","ợ","ở","ỡ",
  "ù","ú","ụ","ủ","ũ","ư","ừ","ứ","ự","ử","ữ",
  "ỳ","ý","ỵ","ỷ","ỹ",
  "đ",
  "À","Á","Ạ","Ả","Ã","Â","Ầ","Ấ","Ậ","Ẩ","Ẫ","Ă"
  ,"Ằ","Ắ","Ặ","Ẳ","Ẵ",
  "È","É","Ẹ","Ẻ","Ẽ","Ê","Ề","Ế","Ệ","Ể","Ễ",
  "Ì","Í","Ị","Ỉ","Ĩ",
  "Ò","Ó","Ọ","Ỏ","Õ","Ô","Ồ","Ố","Ộ","Ổ","Ỗ","Ơ"
  ,"Ờ","Ớ","Ợ","Ở","Ỡ",
  "Ù","Ú","Ụ","Ủ","Ũ","Ư","Ừ","Ứ","Ự","Ử","Ữ",
  "Ỳ","Ý","Ỵ","Ỷ","Ỹ",
  "Đ", " ");

  $marKoDau=array("a","a","a","a","a","a","a","a","a","a","a"
  ,"a","a","a","a","a","a",
  "e","e","e","e","e","e","e","e","e","e","e",
  "i","i","i","i","i",
  "o","o","o","o","o","o","o","o","o","o","o","o"
  ,"o","o","o","o","o",
  "u","u","u","u","u","u","u","u","u","u","u",
  "y","y","y","y","y",
  "d",
  "A","A","A","A","A","A","A","A","A","A","A","A"
  ,"A","A","A","A","A",
  "E","E","E","E","E","E","E","E","E","E","E",
  "I","I","I","I","I",
  "O","O","O","O","O","O","O","O","O","O","O","O"
  ,"O","O","O","O","O",
  "U","U","U","U","U","U","U","U","U","U","U",
  "Y","Y","Y","Y","Y",
  "D", "-");

  return str_replace($marTViet,$marKoDau,$str_language);

} // end str_language

function video_image($url,$size="large"){
  if($size=="thumb"){ 
    $size=1;
  }else{
    $size=0;
  }

  $image_url = parse_url($url);
  if($image_url['host'] == 'www.youtube.com' || $image_url['host'] == 'youtube.com'){
    // get the video code if this is an embed code  (old embed)
    preg_match('/youtube\.com\/v\/([\w\-]+)/', $url, $match);
   
    // if old embed returned an empty ID, try capuring the ID from the new iframe embed
    if($match[1] == '')
      preg_match('/youtube\.com\/embed\/([\w\-]+)/', $url, $match);
   
    // if it is not an embed code, get the video code from the youtube URL  
    if($match[1] == '')
      preg_match('/v\=(.+)&/',$url ,$match);
   
    // get the corresponding thumbnail images 
    $full_size_thumbnail_image = "http://img.youtube.com/vi/".$match[1]."/0.jpg";
   
    // return whichever thumbnail image you would like to retrieve
    return $full_size_thumbnail_image; 
  } elseif($image_url['host'] == 'www.vimeo.com' || $image_url['host'] == 'vimeo.com' || $image_url['host'] == 'player.vimeo.com'){
    $has_id = substr($image_url['path'], 1);
    $get_id = explode('/', $has_id);
    $vimeo_id = array_pop($get_id);
    $hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/".$vimeo_id.".php"));
    return $hash[0]["thumbnail_large"];
  }
}