function actualizar_disp() {
  formulario = document.forms['dispositivo'];
  id= formulario['id'].value;
  mode= formulario['mode'].value;
  fan= formulario['fan'].value;
  sleep= formulario['sleep'].value;
  turbo= formulario['turbo'].value;
  estado= formulario['estado'].value;
  temp= document.getElementById("temp").value;

  if (id === ""){ 
      return;
   } 
   else {
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.open("GET",
      "ActualizarDisp.php?id="+id+"&temp="+temp+"&mode="+mode+"&fan="+
      fan+"&sleep="+sleep+"&turbo="+turbo+"&estado="+estado,
      true);
      xmlhttp.send();
   }

   window.location.href = '#';

};

function mostrar_estado_salas(){
  if (document.getElementById("estado_dis").value == "1"){
    $("#ver_dispositivos").button('toggle');
  }
};

function mostrar_estados_dis(){
  if (document.getElementById("sleep").value == "1"){
      $("#boton-sleep").button('toggle');
  }
  
  if (document.getElementById("turbo").value == "1"){
      $("#boton-turbo").button('toggle');
  }

  if (document.getElementById("estado").value == "1"){
      $("#boton-estado").button('toggle');
  }
  
  document.getElementById("mode").value = document.getElementById("in_mode").value;
  document.getElementById("fan").value = document.getElementById("in_fan").value;
  document.getElementById("text_temp").innerHTML = document.getElementById("temp").value;

};

function input_temp(){
  document.getElementById("text_temp").innerHTML = document.getElementById("temp").value;
};