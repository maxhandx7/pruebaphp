var script = document.createElement('script');
script.src = 'https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js';
script.type = 'text/javascript';
document.getElementsByTagName('head')[0].appendChild(script);
$(document).ready(function() {
    $("#form-val").validate({
      
      rules: {
        txtnom : {
          required: true,
          minlength: 3,
          alphanumeric: true
        },
        txtmail: {
          required: true,
          email: true
          
        },
        sex: {
          required: true,
          
        },
        Area: {
          required: true
          },

          txtarea: {
            required: true
            },
        },
      messages : {
        txtnom: {
        required: "por favor introduce un nombre",
        
          minlength: "El nombre debe tener al menos 3 caracteres no se admiten caracteres especiales", 
          number: "no se admiten numeros"
        },
        
        txtmail: {
            required: "por favor introduce un correo",
          email: "El correo electrónico debe tener el formato: pepito@dominio.com"
        },    
        sex: {
            required: "por favor elija un Sexo",
          
        },    
        Area: {
            required: "por favor elija un Area"
        },
        txtarea: {
          required: "Por favor Agregue una descripcion"
          
        }
      }
     
    });
    
;  });

jQuery.validator.addMethod("alphanumeric", function(value, element) {
    return this.optional(element) || /^\w+$/i.test(value);
}, "Letters, numbers, and underscores only please");
