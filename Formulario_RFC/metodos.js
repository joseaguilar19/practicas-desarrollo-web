$(document).ready(function(){

    //------ GENERAR RFC -------
    $('#gen_rfc').click(function(){

        //var p_l_nom = ($('#nombre').val()).charAt(0);
        var p_l_pat = ($('#ap_pat').val()).charAt(0);
        var p_l_mat = ($('#ap_mat').val()).charAt(0);

        var t_pat = $('#ap_pat').val().length;
        var t_nom = $('#nombre').val().length;

        var arreglo = [];
        var nombre = [];

        var indice = 0;

        //GUARDA EN UN ARREGLO LAS LETRAS DEL APELLIDO PATERNO
        for(x=0;x<t_pat;x++){
            arreglo.push($('#ap_pat').val().charAt(x));
        }

        //LEE EL ARREGLO LETRA POR LETRA DEL APELLIDO PATERNO HASTA ENCONTRAR UNA VOCAL
        for(y=1;y<t_pat;y++){
            if(arreglo[y] == "a" || arreglo[y] == "e" || arreglo[y] == "i" ||
            arreglo[y] == "o" || arreglo[y] == "u"){
                var vocal = arreglo[y];
                y = t_pat;
            }
        }

        //VALIDA SI HAY UN ESPACIO ENTRE NOMBRES
        //ESTO SOLO SI EL USUARIO TIENE 2 NOMBRES
        for(i=0;i<t_nom;i++){
            if($('#nombre').val().charAt(i) == " "){
                indice = i;
            }
        }

        //GUARDA EN UN ARREGLO LA PRIMER LETRA DE CADA NOMBRE
        nombre.push($('#nombre').val().charAt(0));
        nombre.push($('#nombre').val().charAt(indice + 1));
        //SE ORDENA ALFABETICAMENTE DE FORMA DESCENDENTE (A-Z)
        nombre.sort();
        //SE GUARDA EN UNA VARIABLE LA PRIMERA LETRA DEL ARREGLO
        var p_l_nom = nombre[0];

        //SE OBTIENEN LOS NUMEROS DE LA FECHA DE NACIMIENTO
        var nacimiento = $('#nacimiento').val();
        var anio = nacimiento.substr(2,2);
        var mes = nacimiento.substr(5,2);
        var dia = nacimiento.substr(8,2);

        //SE CREAN "ARREGLOS" QUE CONTIENEN TODO EL ALFABETO Y LOS NUMEROS
        var numeros = "0123456789";
        var letras = "abcdefghijklmnopqrstuvwxyz";
        //SE MEZCLAN LOS ARREGLOS
        var todo = numeros + letras;
        //SE GENERA UNA CLAVE ALEATORIA
        const generarclave = (longitud) => {
            var clave = "";

            for(x=0;x<longitud;x++){
                var aleatorio = Math.floor(Math.random()*todo.length);
                clave += todo.charAt(aleatorio);
            }
            return clave;
        }

        //SE IMPRIME LO NECESARIO PARA CREAR EL RFC
        $('#rfc').val(p_l_pat + vocal + p_l_mat + p_l_nom + anio + mes + dia + generarclave(3));

    });

    //------ CONSULTAR API -------
    //http://pabletoreto.blogspot.com
    ///2019/01/consumir-web-api-utilizando-jqueryajax.html
    $('#api').click(function(){
        
        // GENERA UN NUMERO ALEATORIO
        var x = Math.ceil(Math.random()*10);
        
        $.ajax({

            type: "GET",
            url: "https://jsonplaceholder.typicode.com/users/" + x, 
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            success: function(data, textStatus, jqXHR){
                
                $('#api_name').val(data.name);
                $('#api_email').val(data.email);

                // MUESTRA EL NUMERO ALEATORIO PARA
                // PODER IDENTIFICAR SI ES VERDADERO
                alert("Exito al conectar, el id es: " + x);

            },
            failure: function(data){
                alert(data.responseText + " No existe dato...");
            },
            error: function(data){
                alert(data.responseText + " Fallo de conexion...");
            }
        });
    }); 
});