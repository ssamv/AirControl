//CONTROLAR UN DISPOSITIVO
function actualizar_disp(estado_sala,boton_sala) {
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
   
   if (estado != document.getElementById(estado_sala).value){
          $(boton_sala).button('toggle');
          document.getElementById(estado_sala).value = estado;
      }  

};

function mostrar_disp(formi){
  formulario= document.getElementById(formi.id);
  id_sala= formulario['id_sala'].value;
  sala= formulario['sala'].value;
  temp_sala= formulario['temp_sala'].value;
  e_dis= formulario['e_dis'].value;
  p_dis= formulario['p_dis'].value;

  var xmlhttp =  new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("popup").innerHTML = this.responseText;
      window.location.href='#popup';
      mostrar_estados_dis();
    }
  };
  xmlhttp.open("GET","ControlDisp.php?id_sala="+id_sala+"&sala="+sala+
               "&temp_sala="+temp_sala+"&e_dis="+e_dis+"&p_dis="+p_dis,true);
  xmlhttp.send();
  
};


//CONTROLAR TODOS LOS DISPOSITIVOS DE UN EDIFICIO

function actualizar_disp_e(formi){
  formulario= document.getElementById(formi.id);
  id_edificio= formulario['id_edificio'].value;
  elemento=formi.id;
  if(elemento=="T_aire"){
    valor_elemento=formulario['temp'].value;
  }
  else{
    valor_elemento=formulario['valor'].value;    
  }

  var xmlhttp = new XMLHttpRequest();

  xmlhttp.open("GET",
    "ActualizarDispE.php?id_edificio="+id_edificio+"&elemento="+elemento+
    "&valor_elemento="+valor_elemento,true);
  xmlhttp.send();

};

function control_total_e(formi){
  formulario= document.getElementById(formi.id);
  id_edificio= formulario['id_edificio'].value;
  edificio= formulario['edificio'].value;

  var xmlhttp =  new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("popup").innerHTML = this.responseText;
      window.location.href='#popup';
    }
  };
  xmlhttp.open("GET","ControlTotalE.php?id_edificio="+id_edificio+"&edificio="+edificio,true);
  xmlhttp.send();
  
};



//CONTROLAR TODOS LOS DISPOSITIVOS DE UN PISO
function actualizar_disp_p(formi){
  formulario= document.getElementById(formi.id);
  id_piso= formulario['id_piso'].value;
  elemento=formi.id;

  if(elemento=="T_aire"){
    valor_elemento=formulario['temp'].value;
  }
  else{
    valor_elemento=formulario['valor'].value;    
  }
  
  var xmlhttp = new XMLHttpRequest();

  xmlhttp.open("GET",
    "ActualizarDispP.php?id_piso="+id_piso+"&elemento="+elemento+
    "&valor_elemento="+valor_elemento,true);
  xmlhttp.send();

};

function control_total_p(formi){
  formulario= document.getElementById(formi.id);
  id_piso= formulario['id_piso'].value;
  piso= formulario['piso'].value;
  p_edificio= formulario['p_edificio'].value;

  var xmlhttp =  new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("popup").innerHTML = this.responseText;
      window.location.href='#popup';
    }
  };
  xmlhttp.open("GET","ControlTotalP.php?id_piso="+id_piso+"&piso="+piso+
               "&edificio="+p_edificio,true);
  xmlhttp.send();
  
};





//FUNCIONES ESPECIFICAS

function mostrar_estado_salas(estado,boton){
  if (document.getElementById(estado).value == "1"){
    $(boton).button('toggle');
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

  //FUNCION EVENTOS CLICKS EN BOTONES DEL DISPOSITIVO------------------------------------------------------------>
  $(document).ready(function(){

    $("#boton-sleep").click(function(){
      if(document.getElementById("sleep").value == "0"){
      document.getElementById("sleep").value = "1";
      }
      else{
      document.getElementById("sleep").value = "0";
      }
    });
    
    $("#boton-turbo").click(function(){
      if(document.getElementById("turbo").value == "0"){
      document.getElementById("turbo").value = "1";
      }
      else{
      document.getElementById("turbo").value = "0";
      }
    });
    
    $("#boton-estado").click(function(){
      if(document.getElementById("estado").value == "0"){
      document.getElementById("estado").value = "1";
      }
      else{
      document.getElementById("estado").value = "0";
      }
    });
  });

};

function cambiar_valor(formi){
  formulario=document.getElementById(formi.id);
  if(formulario['valor'].value==1){
    formulario['valor'].value=0;
  }
  else{
    formulario['valor'].value=1;
  }
  
};


function input_temp(){
  document.getElementById("text_temp").innerHTML = document.getElementById("temp").value;
};

function salir_popup_y_act(){
  window.location.href='#';
  location.reload();
};




