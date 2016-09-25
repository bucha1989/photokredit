<!DOCTYPE html>
<html>

    <head>
        <title>Фотообработчик</title>
        <script src="js/jquery-1.12.4.min.js"></script>
        <link rel="stylesheet" type="text/css" href="reset.css" />
        <link rel="stylesheet" type="text/css" href="style.css" />
        
    </head>
<body>

<script>setTimeout(function(){
    
    
    $('#ho_adv').css({display:'none'});
}, 0);</script>

<?php


echo '<div id="form"><form method="post" action="handing.php" enctype="multipart/form-data">';

if(isset($_GET['return'])){
    
    if($_GET['return'] == "ERROR"){
        
        die("<p class='error'>
        
        Неверный формат или имя файла!!!</p><p class='error'><a style='color:white;' href='index.php'>Назад</a></p>");

    }
    
    
$return = $_GET['return'];
    
echo "<p><a href='$return' download='".substr($return,7)."'><img id='img' src='$return'></a></p>";
    
    echo "<p id='delete' style='display:none;position:fixed;'>$return</p>";

echo  '<p id="save" style="color: white;">&#9650; click to save &#9650; '.substr($_GET["return"],7).' </p>';
}




?>
<script>

    



function check(value){
      $('#inp').css({color:'#428BCA'})
    $('#note').css({color:'white'})
    $('#note').css({visibility:'visible'})
    
    value = $.trim(value);
    if(value == ''){$('#note').html("Строка пуста")
    
    $('#note').css({color:'#FFED47'})
    $('#form').css({borderColor:'#FFED47'})
    }else{
  
    
  
    
   
    if(/[а-яА-я]/.test(value)) {
        $('#note').html("Только латинские буквы и цифры")
    $('#note').css({visibility:'visible'})
    $('#note').css({color:'#D92830'})
    $('#inp').css({color:'#D92830'})
    $('#form').css({borderColor:'#D92830'})
     
    }else{
    $('#note').css({color:'#4CD227'})
    $('#note').html("Это имя может быть использовано")
    $('#inp').css({color:'#4CD227'})
    $('#form').css({borderColor:'#4CD227'})
    }
    
   
    }
    
    
}



            
           
        
       
       $(function(){
        (function($,undefined){ 
        
       $('img').click(function(){
            $('#save').hide()
           $('img').slideUp(3000) 
           
           $('#button').val("Загрузка...");
           
           $('#button').css({color:'#5CB85C'})
           $('#button').attr('disabled', 'disabled');
           
           $('#form').animate({marginTop:'50px'},3000,'',function(){
            
            
            
              $.post('delete.php',{file:$('#delete').html()});
            $('#button').css({fontSize:'12px',color:'black'})
             window.location.href = "index.php";
           })
           
         })
  
  
  
})(jQuery)
        
       // jQuery.fx.off = true;
      })

</script>



<p id="note">Только латинские буквы и цифры</p>
<p><input id="inp" oninput="check(this.value)" type="text" required="" placeholder="Имя после обработки..."  name="name"/></p>
<p><input id="file_but" type="file" required="" name="image"/></p>
<p><input id="button"  type="submit" value="ОБРАБОТАТЬ"/></p></div>

</form>

</body>
</html>