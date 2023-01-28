<?php
use Illuminate\Support\Facades\DB;

function prx($arr){
    echo "<pre>";
    print_r($arr);
    die();
}

function getTopNavCat(){
    $result=DB::table('categories')
     ->where(['status'=>1])
     ->get();
    $arr=[];
      foreach($result as $row){
        $arr[$row->id]['city']=$row->category_name;
        $arr[$row->id]['parent_id']=$row->parent_category_id;

     }
     $str=buildTreeView($arr,0);
     return $str;
}
$html='';
function buildTreeView($arr,$parent,$level=0,$perlevel= -1){ 
  global $html;
  foreach($arr as $id=>$data){
     if($parent==$data['parent_id']){
      if($level>$perlevel){
        if($html==''){
          $html.='<ul class="nav navbar-nav">';
        }else{
            $html.='<ul class="dropdown-menu">';
        }
    }
    if($level==$perlevel){
        $html.='</li>';
    }
    $html.='<li><a href="#">'.$data['city'].'<span class="caret"></span></a>';
      if($level>$perlevel){
        $perlevel=$level;
   }
   $level++;
   buildTreeView($arr,$id,$level,$perlevel);
   $level--;
   } 
 }
 if($level==$perlevel){
    $html.='<li></ul>';
 }
  return $html;
}

function getUserTempId(){
  if(session()->has('USER_TEMP_ID')===null){
    $rand=rand('111111111','999999999');
    session()->put('USER_TEMP_ID',$rand);
    return $rand;  
  }else{
    return session()->has('USER_TEMP_ID');
  }
}
?>