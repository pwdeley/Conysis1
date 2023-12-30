<?php

    $destino = "gerencia@estrategacontable.com";
    $nombre = $_POST["nombre"];
    $correo = $_POST["correo"];
    $fecha = $_POST["fecha"];
    $mensaje = $_POST["mensaje"];
    $contenido = "Nombre: " . $nombre . "\nCorreo: " . $correo . "\nFecha: " . $fecha . "\nMensaje: " . $mensaje; 
    mail($destino,"Contacto", $contenido);
    header("Location:gracias.html");
      
?>

<!-- Código de Dalto que no funcionó
if(isset($_POST['enviar'])) {
    if(!empty($_POST['name']) && !empty($$_POST['asunto']) && !empty($_POST['msg']) && !empty($_POST['email'])) {
        $name = $_POST['name'];
        $asunto = $_POST['asunto'];
        $msg = $_POST['msg'];
        $email = $_POST['email'];
        $header = "From: gerencia@estrategacontable.com" . "\r\n";
        $header = "Reply-To: contabilidadconysis@icloud.com" . "\r\n";
        $header = "X-Mailer: PHP/". phpversion();
        $mail = @mail($email,$asunto,$msg,$header);
        if($mail) {
            echo "<h4>¡Mensaje enviado exitosamente!</h4>";
        }

    }
}
-->
<!-- Código alternativo en localhost:
?php

    $destino = $_POST['email'];
    $asunto = "comentario";

    $comentario = "
        Email:$_POST[email]
        Comentario:$_POST[msg]
        ";

        $header = 'From:'.$_POST['gerencia@estrategacontable.com']."\r\n".
                'Reply-To:'.$_POST['contabilidadconysis@icloud.com']."\r\n".
                'X-Mailer:PHP/'. phpversion();
        
        mail($destino,$asunto,$comentario,$header);
        
            echo "<h4>¡Gracias por confiar en nosotros!<br>Ya puedes abandonar esta página.</h4>";
        
?>-->