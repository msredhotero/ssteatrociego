

<!DOCTYPE HTML>

<html>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">



<title>Cinema Star Cartelera</title>



		<link rel="stylesheet" type="text/css" href="css/estilo.css"/>

<script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>

         <link rel="stylesheet" href="css/jquery-ui.css">

    <script src="js/jquery-ui.js"></script>

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

        <!-- Optional theme -->
        <link rel="stylesheet" href="bootstrap/css/bootstrap-theme.min.css">

        <!-- Latest compiled and minified JavaScript -->
        <script src="bootstrap/js/bootstrap.min.js"></script>
        
        <script type="text/javascript">
		
			$(document).ready(function(){
				
				
					$("#email").click(function(event) {
        			$("#email").removeClass("alert alert-danger");
					$("#email").attr('placeholder','Ingrese el Usuario');
					$("#error").removeClass("alert alert-danger");
					$("#error").text('');
        			});

        			$("#email").change(function(event) {
        			$("#email").removeClass("alert alert-danger");
        			$("#email").attr('placeholder','Ingrese el Usuario');
        			});
					
					
					$("#pass").click(function(event) {
        			$("#pass").removeClass("alert alert-danger");
					$("#pass").attr('placeholder','Ingrese el password');
        			});

        			$("#pass").change(function(event) {
        			$("#pass").removeClass("alert alert-danger");
        			$("#pass").attr('placeholder','Ingrese el password');
        			});
					
				
				function validador(){

        				$error = "";
		
        				if ($("#email").val() == "") {
        					$error = "Es obligatorio el campo Usuario.";

        					$("#error").addClass("alert alert-danger");
        					$("#error").attr('placeholder',$error);
        				}
						
						if ($("#pass").val() == "") {
        					$error = "Es obligatorio el campo Password.";

        					$("#pass").addClass("alert alert-danger");
        					$("#pass").attr('placeholder',$error);
        				}
						

						
						/*
						var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
						
						if( !emailReg.test( $("#email").val() ) ) {
							$error = "El E-Mail ingresado es inválido.";

        					$("#error").addClass("alert alert-danger");
        					$("#error").text($error);
						  }
						*/
        				return $error;
        		}
				
				
				$("#login4").click(function(event) {
        			
						if (validador() == "")
        				{
        						$.ajax({
                                data:  {usuario:		$("#email").val(),
										pass:		$("#pass").val(),
										accion:		'login'},
                                url:   'ajax/ajax.php',
                                type:  'post',
                                beforeSend: function () {
                                        $("#load").html('<img src="imagenes/load13.gif" width="50" height="50" />');
                                },
                                success:  function (response) {
      									
                                        if (response != '') {
                                            
                                            $("#error").removeClass("alert alert-danger");

                                            $("#error").addClass("alert alert-danger");
                                            $("#error").html('<strong>Error!</strong> '+response);
                                            $("#load").html('');

                                        } else {
											url = "vistas/dashboard/";
											$(location).attr('href',url);
										}
                                        
                                }
                        });
        				}
        		});
				
			});/* fin del document ready */
		
		</script>
        
        
</head>



<body>

<!--<div id="header">
	<img src="imagenes/LogoSEO1.png" width="396" height="89"> 
    
</div>
<div style="height:1px; background-color:#575a5f;"></div>-->
<div class="logueo" align="center">
	<section style="width:100%; max-width:600px; padding-top:10px; margin-top:60px; background-color:#333; border:1px solid #101010; padding:25px;box-shadow: 4px 4px 5px #464646;-webkit-box-shadow: 4px 4px 5px #464646;
  -moz-box-shadow: 4px 4px 5px #464646;">

			<div id="error" style="text-align:left;">
            
            </div>

            <div align="center">
            <img src="imagenes/logotipocine.png" style="padding-bottom:5%;"/>
				<div align="center"><p style="color:#E9E9E9; font-size:28px;">Acceso al panel de control de Cinema Star</p></div>
                <br>
            </div>
			<form role="form" class="form-horizontal" method="post" action="validar.php">
              
             <!--
                <label for="usuario" class="col-md-2 control-label" style="color:#FFF">Usuario</label>
                <br>
                  <input type="text" name="usuario" maxlength="50" />
                <br>
              

              
                <label for="ejemplo_password_2" class="col-md-2 control-label" style="color:#FFF">Contraseña</label>
                <br>
                  
                  <input type="password" name="password" maxlength="50" />
                <br>
              
             
              
                
                  <input type="submit" value="enviar">
                -->
              <div class="form-group">
                <label for="usuario" class="col-md-2 control-label" style="color:#FFF;text-align:left;">Usuario</label>
                <div class="col-lg-10 input-group">
                	<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-user"></span></span>
                	<input type="text" class="form-control" id="email" name="email" 
                         placeholder="Usuario"  aria-describedby="basic-addon1">
                </div>
              </div>

              <div class="form-group">
                <label for="ejemplo_password_2" class="col-md-2 control-label" style="color:#FFF">Contraseña</label>
                <div class="col-lg-10 input-group">
                	<span class="input-group-addon" id="basic-addon2"><span class="glyphicon glyphicon-lock"></span></span>
                    <input type="password" class="form-control" id="pass" name="pass" 
                         placeholder="password" aria-describedby="basic-addon2">
                </div>
              </div>
              
              <div class="form-group">
              	<label for="olvido" class="control-label" style="color:#FFF">¿Has olvidado tu contraseña?. <a href="recuperarpassword.php">Recuperar.</a></label>
              </div>
             
              <div class="form-group">
                <div class="col-lg-12">
                  <input type="submit" class="btn btn-default" id="login4" value="Entrar"/>
                </div>
              </div>
				
                <div id="load">
                
                </div>

            </form>

     </section>
</div>

</body>

</html>