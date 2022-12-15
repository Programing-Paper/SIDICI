<!-- <label class="check"> -->
  <input type="checkbox" id="btn-modal" class="check">
<!-- </label> -->
<!-- <input type="checkbox" id="btn-modal"> -->
<style>
    .content-modal{
      width: 100%;
      max-width: 550px;
      background-image: url("../Imagenes/fondo.svg");
      border-radius: 4px;
      border: 3px dashed black;
    }
</style>
<div class="container-modal">
                  <div class="content-modal">
                      <h3> Guardar Usuarios</h3>
                      <form action="guardar.php" method="post">
                        <div class="potextdocument">
                        <label for="r-doc"> Documento:</label> <br>
                        <input type="text" id="doc">
                        </div>
                        <div class="potextcorreo">
                        <label for="r-correo"> Correo:</label>  
                        <input type="text" name="r-correo">
                        </div>
                        <div class="potext-nombre">
                        <label  for="r-nombre"> Nombre:</label><br>
                        <input  type="text" name="r-correo">
                        </div>
                        <div class="potextapellido">
                          <label for="r-apellido"> Apellido:</label><br>
                          <input type="text" name="r-apellido">
                        </div>
                        <div>
                        <label class="podescripuser" for="desc-user"> Descripcion</label><br>
                        <textarea type="text" placeholder="informacion del usuario" class="podescripusertext"></textarea>
                        </div>
                        <select id='po-optionsede'>
                          <option> sede</option>
                          <option></option>
                          <option></option>
                          <option></option>
                        </select>  
                        <select id='po-optionrol'>
                          <option> rol</option>
                          <option></option>
                          <option></option>
                          <option></option>
                        </select>
                        <div class="estado-user">
                          <label>Estado</label><br>
                          <input type="radio" name="estadouser" value="active-user">
                          <label for="estado-user">Activo</label>
                          <input type="radio"name="estadouser" value="inactive-user">
                          <label for="inactive-user" for="estado-user">Inactivo</label>
                        </div> 
                        <select id='po-optioncargo'>
                        <option>Cargo</option>
                        <option></option>
                        <option></option>
                        <option></option>
                      </select> 
                        <div class='btn-cerrar'>
                            <label for="btn-modal">Cerrar</label>
                        </div>
                        <div class="btn-guardar">
                          <button id="guardar" onclick="guardar()">Guardar</button>
                        </div>      
                      </form>
                     
                  </div>
                <!-- <label for="btn-modal" class="cerrar-modal"></label> -->
</div>
          <!--fin del boton-->
          <!--Ventana Modal-->
          <!-- <script> 
            function ventanaSecundaria (URL){ 
              window.open(URL,"Guardar","width=500,height=500,scrollbars=NO") 
            } 
          </script> -->
          <script> 
              let documento = document.getElementById('doc');
              function guardar (){
                alert('documento:'+ documento.value);
              }
          </script>
  <!--fin de ventana modal--> 
            <strong>Agregar usuario </strong>