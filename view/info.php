<h2>Información</h2>
<?php 
if(isset($_SESSION)){
    echo "la sesion esta iniciada";
    print_r($_SESSION);
}else{
    echo "la sesion no esta iniciada";
}