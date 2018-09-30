<!DOCTYPE html> 
<html> 
<head> 
  <meta http-equiv="content-type" content="text/html; charset=UTF-8"> 
  <title> - jsFiddle demo</title> 
    
  <!-- <script type='text/javascript' src='//code.jquery.com/jquery-1.9.1.js'></script>  -->
    
    
    
  <style type='text/css'>  
  </style>  
  
<script type='text/javascript'>//<![CDATA[ 
$(window).load(function(){ 
    function readURL(input) { 
        if (input.files && input.files[0]) { 
            var reader = new FileReader(); 
              
            reader.onload = function (e) { 
                $('#blah').attr('src', e.target.result); 
            }              
            reader.readAsDataURL(input.files[0]); 
        } 
    }      
    $("#userimage").change(function(){ 
        readURL(this); 
    }); 
});//]]>  
  
</script> 
  
  
</head> 
<body> 
      <!-- <form id="form1" runat="server">  -->
    <?php  echo form_open_multipart('user/imgTest', '' ); ?>
        <input type='file' id="userimage" name="userimage" /> 
        <img id="blah" src="<?php echo base_url('assets/img/Croix.png'); ?>" alt="your image"  /> 
        <input type='submit'  value="Envoyer" /> 
    </form> 

    <?php // var_dump($pho); ?>
    
</body> 
  
  
</html>