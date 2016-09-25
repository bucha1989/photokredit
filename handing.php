<?php 
  
   
if(isset($_FILES['image']['name'])){ 
      
      $_FILES['image']['size'] = 100; 
     function sanitizeString($var) 
{ 
      
     $var = strip_tags($var); 
     $var = htmlentities($var); 
     $var = stripcslashes($var); 
     return $var; 
  
} 
      
     $name = sanitizeString($_POST['name']); 
     $saveto = "images/$name.jpg"; 
      
    if(preg_match('/[а-яА-Я]/',$name)) {header("Location: http://photokredit.ho.ua/index.php?return=ERROR");break;}; 
      
      
      
      
     move_uploaded_file($_FILES['image']['tmp_name'],$saveto); 
      
     $typeok = TRUE; 
      
     switch($_FILES['image']['type']){ 
          
         case "image/gif": 
         $src = imagecreatefromgif($saveto); 
         break; 
          
         case "image/jpeg": 
         $src = imagecreatefromjpeg($saveto); 
         break; 
          
          
         case "image/png": 
         $src = imagecreatefrompng($saveto); 
         break; 
          
         default: 
         $typeok = FALSE; 
         $saveto = 'ERROR'; 
          
         break; 
          
          
     } 
      
     if($typeok){ 
          
         list($w,$h) = getimagesize($saveto); 
          
         $max = 640; 
         $tw = $w; 
         $th = $h; 
          
         if($w > $h && $max < $w){ 
              
             $th = $max/$w*$h; 
             $tw = $max; 
         } 
         elseif($h > $w && $max < $h){ 
             $tw = $max/$h*$w; 
             $th = $max; 
              
         }elseif($max<$w){ 
              
             $tw = $th = $max; 
         } 
          
          
         $tmp = imagecreatetruecolor($tw,$th); 
         imagecopyresized($tmp,$src,0,0,0,0,$tw,$th,$w,$h); 
         /** 
  * imageconvolution($tmp,array( 
  *         array(-1,-1,-1),array(-1,16,-1),array(-1,-1,-1) 
  *         ),9,0); 
  */ 
          
       $saveto = trim($saveto); 
         imagejpeg($tmp,"$saveto",50); 
         imagedestroy($tmp); 
         imagedestroy($src); 
          
          
          
     }else{ 
          
         echo "Неверный формат изображения"; 
     } 
} 
  
  
header("Location: index.php?return=$saveto"); 
  
  
  
  
?> 

