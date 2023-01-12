function habilitarcampos(contenedor) {
  $(contenedor)
    .find(".form-control")
    .filter(":visible")
    .each(function () {
      $(this).attr("disabled", false);
    });
}

function deshabilitarcampos(contenedor) {
  $(contenedor)
    .find(".form-control")
    .filter(":visible")
    .each(function () {
      $(this).attr("disabled", true);
    });
}

function limpiarcampos(contenedor) {
  var isSelect = false;
  var idSelect = "";
  $(contenedor)
    .find(".form-control")
    .each(function (event) {
      isSelect = $(this).is("select");
      if (isSelect) {
        idSelect = $(this).attr("id");
        $("#" + idSelect).val("");
        $("#" + idSelect).trigger("change");
      } else {
        $(this).val("");
      }
    });
}

function validarcampos(contenedor) {
  var banderaRespuesta = true;
  var tipoinput = "";
  var minimoCaracteres;
  var maximoCaracteres;
  var valor = "";
  var mensajeAlerta = "";
  var email_filter = /^.+@.+\..{2,3}$/;
  var campoInvalido = false;
  //var numeric_filter = /(\d{1,2}\.(?=\d{1,2}))+$/i;//float
  //var numeric_filter = /^[0-9]+([\.][0-9]+)?$/i;//numero.numero
  var email_illegalChars = /[\(\)\<\>\,\;\:\\\/\"\[\]]/;

  $(contenedor)
    .find(".form-control")
    .filter(":visible")
    .each(function () {
      var pattern = $(this).attr("pattern");
      tipoinput = $(this).attr("type");
      valor = $(this).val();
      mensajeAlerta = $(this).attr("title");
      minimoCaracteres = $(this).attr("minlength");
      maximoCaracteres = $(this).attr("maxlength");
      if ($(this).hasClass("requerido")) {
        switch (tipoinput) {
          case "email":
            if (!email_filter.test(valor) || valor.match(email_illegalChars)) {
              banderaRespuesta = false;
              $(this).val("");
              $(this).addClass("required");
              $(this)
                .parents(".form-group")
                .find(".spanValidacion")
                .text(mensajeAlerta);
              $(this).parents(".tooltips").find(".spanValidacion").fadeIn();
              $("html,body").animate(
                {
                  scrollTop:
                    $(this)
                      .parents(".form-group")
                      .find(".spanValidacion")
                      .offset().top - 80,
                },
                200,
                "swing",
                function () {
                  $(this).focus();
                }
              );
              return false;
            } else {
              banderaRespuesta = validarlenghtcampo(
                this,
                valor,
                mensajeAlerta,
                minimoCaracteres,
                maximoCaracteres,
                " caracteres"
              );
              if (!banderaRespuesta) {
                return false;
              }
            }
            break;

          case "text":
            if (valor.trim().length == 0) {
              banderaRespuesta = false;
              $(this).addClass("required");
              $(this)
                .parents(".form-group")
                .find(".spanValidacion")
                .text(mensajeAlerta);
              $(this).parents(".tooltips").find(".spanValidacion").fadeIn();
              $("html,body").animate(
                {
                  scrollTop:
                    $(this)
                      .parents(".form-group")
                      .find(".spanValidacion")
                      .offset().top - 80,
                },
                200,
                "swing",
                function () {
                  $(this).focus();
                }
              );
              return false;
            } else {
              banderaRespuesta = validarlenghtcampo(
                this,
                valor,
                mensajeAlerta,
                minimoCaracteres,
                maximoCaracteres,
                " caracteres"
              );
              if (!banderaRespuesta) {
                return false;
              }

              if (
                $(this).hasClass("decimal-one") ||
                $(this).hasClass("numero")
              ) {
                valor = valor.replace(",", ".");
                if (isNaN(valor)) {
                  banderaRespuesta = false;
                  $(this)
                    .parents(".form-group")
                    .find(".spanValidacion")
                    .text("Este campo es numerico");
                  $(this)
                    .parents(".form-group")
                    .find(".spanValidacion")
                    .fadeIn();
                  $("html,body").animate(
                    {
                      scrollTop:
                        $(this)
                          .parents(".form-group")
                          .find(".spanValidacion")
                          .offset().top - 10,
                    },
                    200,
                    "swing",
                    function () {
                      $(this).focus();
                    }
                  );
                  return false;
                } else {
                  if (
                    "min" in this.dataset === true &&
                    "max" in this.dataset === true
                  ) {
                    var min = parseInt(this.dataset.min);
                    var max = parseInt(this.dataset.max);
                    if (valor < min || valor > max) {
                      banderaRespuesta = false;
                      $(this)
                        .parents(".form-group")
                        .find(".spanValidacion")
                        .text(
                          "El valor esta por fuera de los limites, valor entre " +
                            min +
                            " y " +
                            max
                        );
                      $(this)
                        .parents(".form-group")
                        .find(".spanValidacion")
                        .fadeIn();
                      $("html,body").animate(
                        {
                          scrollTop:
                            $(this)
                              .parents(".form-group")
                              .find(".spanValidacion")
                              .offset().top - 10,
                        },
                        200,
                        "swing",
                        function () {
                          $(this).focus();
                        }
                      );
                      return false;
                    }
                  }
                }
              }
            }

            break;

          case "password":
            if (valor.trim().length == 0) {
              banderaRespuesta = false;
              mensajeAlerta = $(this).attr("title");
              $(this).addClass("required");
              $(this)
                .parents(".form-group")
                .find(".spanValidacion")
                .text(mensajeAlerta);
              $(this).parents(".tooltips").find(".spanValidacion").fadeIn();
              $("html,body").animate(
                {
                  scrollTop:
                    $(this)
                      .parents(".form-group")
                      .find(".spanValidacion")
                      .offset().top - 80,
                },
                200,
                "swing",
                function () {
                  $(this).focus();
                }
              );
              return false;
            } else {
              banderaRespuesta = validarlenghtcampo(
                this,
                valor,
                mensajeAlerta,
                minimoCaracteres,
                maximoCaracteres,
                " caracteres"
              );
              if (!banderaRespuesta) {
                return false;
              }
            }
            break;

          case "number":
            if (
              typeof pattern !== typeof undefined &&
              pattern !== false &&
              pattern != null
            ) {
              var numeric_filter = new RegExp(pattern); ///^[0-9]+$/i;//number only /^[3]{1}[0-9]{0,10}$/
              mensajeAlerta = $(this).attr("data-pattern");
            } else {
              var numeric_filter = /^[0-9]+$/i;
              mensajeAlerta = $(this).attr("title");
            }
            if (!numeric_filter.test(valor)) {
              banderaRespuesta = false;
              $(this).addClass("required");
              $(this)
                .parents(".form-group")
                .find(".spanValidacion")
                .text(mensajeAlerta);
              $(this).parents(".tooltips").find(".spanValidacion").fadeIn();
              $("html,body").animate(
                {
                  scrollTop:
                    $(this)
                      .parents(".form-group")
                      .find(".spanValidacion")
                      .offset().top - 80,
                },
                200,
                "swing",
                function () {
                  $(this).focus();
                }
              );
              return false;
            } else {
              banderaRespuesta = validarlenghtcampo(
                this,
                valor,
                mensajeAlerta,
                minimoCaracteres,
                maximoCaracteres,
                " dígitos"
              );
              if (!banderaRespuesta) {
                return false;
              }
            }
            break;

          default:
            if ($(this).is("select") == true) {
              if (valor == null || valor.length == 0) {
                banderaRespuesta = false;
                $(this)
                  .parents(".tooltips")
                  .find(".spanValidacion")
                  .text(mensajeAlerta);
                // $(this).parents('.tooltips').find(".spanValidacion").css("bottom","5px");
                $(this).parents(".tooltips").find(".spanValidacion").fadeIn();
                $("html,body").animate(
                  {
                    scrollTop:
                      $(this)
                        .parents(".tooltips")
                        .find(".spanValidacion")
                        .offset().top - 80,
                  },
                  200,
                  "swing",
                  function () {
                    $(this).focus();
                  }
                );
                return false;
              }
            } else if ($(this).is("textarea") == true) {
              if (valor.trim().length == 0) {
                banderaRespuesta = false;
                $(this).addClass("required");
                //$(this).parents('.form-group').find('.spanValidacion').text(mensajeAlerta);
                $(this)
                  .parents(".form-group")
                  .find(".spanValidacion")
                  .css("bottom", "0px")
                  .css("margin-bottom", "8px")
                  .text(mensajeAlerta)
                  .fadeIn();
                $("html,body").animate(
                  {
                    scrollTop:
                      $(this)
                        .parents(".form-group")
                        .find(".spanValidacion")
                        .offset().top - 80,
                  },
                  200,
                  "swing",
                  function () {
                    $(this).focus();
                  }
                );
                return false;
              } else {
                banderaRespuesta = validarlenghtcampo(
                  this,
                  valor,
                  mensajeAlerta,
                  minimoCaracteres,
                  maximoCaracteres,
                  " caracteres"
                );
                if (!banderaRespuesta) {
                  return false;
                }
              }
            }
        }
      } else {
        switch (tipoinput) {
          case "text":
            if (valor != null && valor != "") {
              banderaRespuesta = validarlenghtcampo(
                this,
                valor,
                mensajeAlerta,
                minimoCaracteres,
                maximoCaracteres,
                " caracteres"
              );
              if (!banderaRespuesta) {
                return false;
              }

              if (
                $(this).hasClass("decimal-one") ||
                $(this).hasClass("numero")
              ) {
                valor = valor.replace(",", ".");
                if (isNaN(valor)) {
                  banderaRespuesta = false;
                  $(this)
                    .parents(".form-group")
                    .find(".spanValidacion")
                    .text("Este campo es numerico");
                  $(this)
                    .parents(".form-group")
                    .find(".spanValidacion")
                    .fadeIn();
                  $("html,body").animate(
                    {
                      scrollTop:
                        $(this)
                          .parents(".form-group")
                          .find(".spanValidacion")
                          .offset().top - 10,
                    },
                    200,
                    "swing",
                    function () {
                      $(this).focus();
                    }
                  );
                  return false;
                } else {
                  if (
                    "min" in this.dataset === true &&
                    "max" in this.dataset === true
                  ) {
                    var min = parseInt(this.dataset.min);
                    var max = parseInt(this.dataset.max);
                    if (valor < min || valor > max) {
                      banderaRespuesta = false;
                      $(this)
                        .parents(".form-group")
                        .find(".spanValidacion")
                        .text(
                          "El valor esta por fuera de los limites, valor entre " +
                            min +
                            " y " +
                            max
                        );
                      $(this)
                        .parents(".form-group")
                        .find(".spanValidacion")
                        .fadeIn();
                      $("html,body").animate(
                        {
                          scrollTop:
                            $(this)
                              .parents(".form-group")
                              .find(".spanValidacion")
                              .offset().top - 10,
                        },
                        200,
                        "swing",
                        function () {
                          $(this).focus();
                        }
                      );
                      return false;
                    }
                  }
                }
              }
            }
            break;
        }
      }
    });
  if (banderaRespuesta == true) {
    return true;
  } else {
    return false;
  }
}
function validarlenghtcampo(
  elemento,
  valor,
  titulo,
  minimo,
  maximo,
  tipocaracteres
) {
  var valor = valor;
  var numeroCaracteres = valor.trim().length;
  var title = titulo;
  var minimoCaracteres = minimo;
  var maximoCaracteres = maximo;
  var mensajeAlerta = title + " ";
  var bandera = true;

  if (
    typeof minimoCaracteres !== typeof undefined &&
    minimoCaracteres !== false &&
    typeof maximoCaracteres !== typeof undefined &&
    maximoCaracteres !== false
  ) {
    if (
      minimoCaracteres == maximoCaracteres &&
      numeroCaracteres != minimoCaracteres
    ) {
      mensajeAlerta += "de " + minimoCaracteres + tipocaracteres;
      $(elemento).addClass("required");
      $(elemento).siblings(".spanValidacion").text(mensajeAlerta);
      $(elemento).siblings(".spanValidacion").fadeIn();
      $("html,body").animate(
        {
          scrollTop: $(elemento).siblings(".spanValidacion").offset().top - 80,
        },
        200,
        "swing",
        function () {
          $(elemento).siblings(".spanValidacion").focus();
        }
      );
      bandera = false;
    } else if (
      numeroCaracteres < minimoCaracteres ||
      numeroCaracteres > maximoCaracteres
    ) {
      mensajeAlerta +=
        "entre " + minimoCaracteres + " y " + maximoCaracteres + tipocaracteres;
      $(elemento).addClass("required");
      $(elemento).siblings(".spanValidacion").text(mensajeAlerta);
      $(elemento).siblings(".spanValidacion").fadeIn();
      $("html,body").animate(
        {
          scrollTop: $(elemento).siblings(".spanValidacion").offset().top - 80,
        },
        200,
        "swing",
        function () {
          $(elemento).siblings(".spanValidacion").focus();
        }
      );
      bandera = false;
    }
  } else if (
    typeof minimoCaracteres !== typeof undefined &&
    minimoCaracteres !== false &&
    numeroCaracteres < minimoCaracteres
  ) {
    mensajeAlerta += "de mínimo " + minimoCaracteres + tipocaracteres;
    $(elemento).addClass("required");
    $(elemento).siblings(".spanValidacion").text(mensajeAlerta);
    $(elemento).siblings(".spanValidacion").fadeIn();
    $("html,body").animate(
      { scrollTop: $(elemento).siblings(".spanValidacion").offset().top - 80 },
      200,
      "swing",
      function () {
        $(elemento).siblings(".spanValidacion").focus();
      }
    );
    bandera = false;
  } else if (
    typeof maximoCaracteres !== typeof undefined &&
    maximoCaracteres !== false &&
    numeroCaracteres > maximoCaracteres
  ) {
    mensajeAlerta += "de máximo " + maximoCaracteres + tipocaracteres;
    $(elemento).addClass("required");
    $(elemento).siblings(".spanValidacion").text(mensajeAlerta);
    $(elemento).siblings(".spanValidacion").fadeIn();
    $("html,body").animate(
      { scrollTop: $(elemento).siblings(".spanValidacion").offset().top - 80 },
      200,
      "swing",
      function () {
        $(elemento).siblings(".spanValidacion").focus();
      }
    );
    bandera = false;
  } else if (numeroCaracteres == 0) {
    var mensajeAlerta = title;
    $(elemento).addClass("required");
    $(elemento).siblings(".spanValidacion").text(mensajeAlerta);
    $(elemento).siblings(".spanValidacion").fadeIn();
    $("html,body").animate(
      { scrollTop: $(elemento).siblings(".spanValidacion").offset().top - 80 },
      200,
      "swing",
      function () {
        $(elemento).siblings(".spanValidacion").focus();
      }
    );
    bandera = false;
  }
  return bandera;
}
//funcion para validaicones con span y animated
function limite_caracteres_animated(elemento) {
  var maximoCaracteres = elemento.getAttribute("maxlength");
  var tipo = elemento.getAttribute("type");
  var caracteres = elemento.value;
  var pattern = elemento.getAttribute("pattern");
  var patternReplace;
  var patternReplaceREG;
  var campoInvalido = false;
  var mensajeInvalido = "";
  switch (tipo) {
    case "number":
      if (
        typeof pattern !== typeof undefined &&
        pattern !== false &&
        pattern != null
      ) {
        var numeric_filter = new RegExp(pattern); ///^[0-9]+$/i;//number only /^[3]{1}[0-9]{0,10}$/
        mensajeInvalido = elemento.getAttribute("data-pattern");
      } else {
        var numeric_filter = /^[0-9]+$/i;
        mensajeInvalido = "Ingresa solo números";
      }

      if (!numeric_filter.test(caracteres)) {
        campoInvalido = true;
      } else {
      }
      break;
    case "text":
      if (
        typeof pattern !== typeof undefined &&
        pattern !== false &&
        pattern != null
      ) {
        var cadenaPermitida = new RegExp(pattern);
        patternReplace = elemento.getAttribute("data-pattern-replace");
        patternReplaceREG = new RegExp(patternReplace, "g");
        mensajeInvalido = elemento.getAttribute("data-pattern");
        //console.log(cadenaPermitida);
      } else {
        //permito letras numeros vocales con tilde, espacios en blanco y comilla simple
        var cadenaPermitida = /^[a-zA-Z0-9áéíóúÁÉÍÓÚüÜ,.\s]+$/i;
        patternReplace = "[^a-zA-Z0-9áéíóúÁÉÍÓÚüÜñÑ#-s]";
        patternReplaceREG = new RegExp(patternReplace, "g");
        mensajeInvalido =
          "Solo se permiten espacios,letras,números y los caracteres '#-";
      }
      $(elemento).parent().siblings("p.msj-validacion").fadeOut("slow");
      if (!cadenaPermitida.test(caracteres) && caracteres != "") {
        campoInvalido = true;
      } else {
      }
      break;
    default:
      if ($(elemento).is("select") == true) {
      } else if ($(elemento).is("textarea") == true) {
        if (
          typeof pattern !== typeof undefined &&
          pattern !== false &&
          pattern != null
        ) {
          var cadenaPermitida = new RegExp(pattern);
          patternReplace = elemento.getAttribute("data-pattern-replace");
          patternReplaceREG = new RegExp(patternReplace, "g");
          mensajeInvalido = elemento.getAttribute("data-pattern");
        } else {
          //permito letras numeros vocales con tilde, espacios en blanco y comilla simple
          var cadenaPermitida = /^[a-zA-Z0-9áéíóú'#\-\s]+$/i;
          patternReplace = "[^a-zA-Z0-9áéíóúÁÉÍÓÚüÜñÑ#-s]";
          patternReplaceREG = new RegExp(patternReplace, "g");
          mensajeInvalido =
            "Solo se permiten espacios,letras,números y los caracteres '#-";
        }
        $(elemento)
          .parent()
          .siblings("p.msj-validacion")
          .fadeOut("slow", function () {
            $(elemento).trigger("maxlength.reposition");
          });
        if (!cadenaPermitida.test(caracteres) && caracteres != "") {
          campoInvalido = true;
        } else {
        }
      }
  }
  if (campoInvalido) {
    caracteres = caracteres.replace(patternReplaceREG, "");
    elemento.value = caracteres.substr(0, maximoCaracteres);
    $(elemento)
      .siblings("p.msj-validacion")
      .html(mensajeInvalido)
      .toggleClass("ocultar", false);
    if ($(elemento).is("textarea") == true) {
      $(elemento).trigger("maxlength.reposition");
    }
  } else if (caracteres.length > maximoCaracteres) {
    elemento.value = caracteres.substr(0, maximoCaracteres);
  }
}
//esta funcion limita la cantidad de caracteres por medio de maxlength
//ademas valida el tipo de caracter ingresado
function limitecaracteres(elemento) {
  var maximoCaracteres = elemento.getAttribute("maxlength");
  var tipo = elemento.getAttribute("type");
  var caracteres = elemento.value;
  var pattern = elemento.getAttribute("pattern");
  //seanjamu 20171026
  var patternReplace;
  var patternReplaceREG;
  //seanjamu 20171026
  var campoInvalido = false;
  var mensajeInvalido = "";
  switch (tipo) {
    case "number":
      if (
        typeof pattern !== typeof undefined &&
        pattern !== false &&
        pattern != null
      ) {
        var numeric_filter = new RegExp(pattern); ///^[0-9]+$/i;//number only /^[3]{1}[0-9]{0,10}$/
        mensajeInvalido = elemento.getAttribute("data-pattern");
      } else {
        var numeric_filter = /^[0-9]+$/i;
        mensajeInvalido = "Ingresa solo números";
      }

      if (!numeric_filter.test(caracteres)) {
        campoInvalido = true;
      } else {
      }
      break;
    case "text":
      if (
        typeof pattern !== typeof undefined &&
        pattern !== false &&
        pattern != null
      ) {
        var cadenaPermitida = new RegExp(pattern); ///^[0-9]+$/i;//number only /^[3]{1}[0-9]{0,10}$/
        patternReplace = elemento.getAttribute("data-pattern-replace");
        patternReplaceREG = new RegExp(patternReplace, "g");
        mensajeInvalido = elemento.getAttribute("data-pattern");
      } else {
        //permito letras numeros vocales con tilde, espacios en blanco y comilla simple
        var cadenaPermitida = /^[a-zA-Z0-9áéíóúÁÉÍÓÚüÜñÑ,\/.\-\s]+$/i;
        patternReplace = "[^a-zA-Z0-9áéíóúÁÉÍÓÚüÜñÑ,/.-s]";
        patternReplaceREG = new RegExp(patternReplace, "g");
        mensajeInvalido =
          "Solo se permiten letras, números, espacios y los símbolos .,-/";
      }
      if (!cadenaPermitida.test(caracteres)) {
        campoInvalido = true;
      } else {
      }
      break;
    case "password":
      if (
        typeof pattern !== typeof undefined &&
        pattern !== false &&
        pattern != null
      ) {
        var cadenaPermitida = new RegExp(pattern); ///^[0-9]+$/i;//number only /^[3]{1}[0-9]{0,10}$/
        patternReplace = elemento.getAttribute("data-pattern-replace");
        patternReplaceREG = new RegExp(patternReplace, "g");
        mensajeInvalido = elemento.getAttribute("data-pattern");
      } else {
        //permito letras numeros vocales con tilde, espacios en blanco y comilla simple
        var cadenaPermitida = /^[a-zA-Z0-9áéíóúÁÉÍÓÚüÜñÑ,\/.\-\s]+$/i;
        patternReplace = "[^a-zA-Z0-9áéíóúÁÉÍÓÚüÜñÑ,/.-s]";
        patternReplaceREG = new RegExp(patternReplace, "g");
        mensajeInvalido =
          "Solo se permiten letras, números, espacios y los símbolos .,-/";
      }
      if (!cadenaPermitida.test(caracteres)) {
        campoInvalido = true;
      } else {
      }
      break;
    default:
      if ($(elemento).is("select") == true) {
      } else if ($(elemento).is("textarea") == true) {
        if (
          typeof pattern !== typeof undefined &&
          pattern !== false &&
          pattern != null
        ) {
          var cadenaPermitida = new RegExp(pattern); ///^[0-9]+$/i;//number only /^[3]{1}[0-9]{0,10}$/
          patternReplace = elemento.getAttribute("data-pattern-replace");
          patternReplaceREG = new RegExp(patternReplace, "g");
          mensajeInvalido = elemento.getAttribute("data-pattern");
        } else {
          //permito letras numeros vocales con tilde, espacios en blanco y comilla simple
          var cadenaPermitida = /^[a-zA-Z0-9áéíóúÁÉÍÓÚüÜñÑ,\/.\-\s]+$/i;
          patternReplace = "[^a-zA-Z0-9áéíóúÁÉÍÓÚüÜñÑ,/.-s]";
          patternReplaceREG = new RegExp(patternReplace, "g");
          mensajeInvalido =
            "Solo se permiten letras, números, espacios y los símbolos .,-/";
        }
        if (!cadenaPermitida.test(caracteres)) {
          campoInvalido = true;
        } else {
        }
      }
    //mensajeInvalido = "Ingresa máximo "+maximoCaracteres+" caracteres";
    //break;
  }
  if (campoInvalido) {
    //elemento.value = "";
    caracteres = caracteres.replace(patternReplaceREG, "");
    elemento.value = caracteres.substr(0, maximoCaracteres);
    $(elemento).addClass("required");
    $(elemento).siblings(".spanValidacion").text(mensajeInvalido);
    $(elemento).siblings(".spanValidacion").fadeIn();
  } else if (caracteres.length > maximoCaracteres) {
    elemento.value = caracteres.substr(0, maximoCaracteres);
  }
}
function validaremail(elemento) {
  var valor = $(elemento).val();
  var mensajeAlerta = "Digita un correo valido, ejemplo: correo@dominio.com";
  var email_filter = /^.+@.+\..{2,3}$/;
  var email_illegalChars = /[\(\)\<\>\,\;\:\\\/\"\[\]]/;
  if (!email_filter.test(valor) || valor.match(email_illegalChars)) {
    $(elemento).val("");
    $(elemento)
      .tooltip("hide")
      .attr("data-original-title", mensajeAlerta)
      .tooltip("fixTitle");
    $(elemento).focus();
    return false;
  } else {
    $(elemento).tooltip("destroy");
    return true;
  }
}

//funcion para validar que el numero tenga decimales
function validarnumerodecimal(valor) {
  valor = valor.replace(",", ".");
  if (parseFloat(valor) != NaN && valor % 1 !== 0) {
    return true;
  } else {
    return false;
  }
}

//funcion para validar campos vacios
function validarvacio(valor) {
  valor = valor.trim();
  if (valor.length > 0) {
    return true;
  } else {
    return false;
  }
}
//funcion para validar si el numero es entero
function validarnumeroentero(valor) {
  if (parseInt(valor) != NaN && valor % 1 === 0) {
    return true;
  } else {
    return false;
  }
}
function mostrarvalidaciontitle(input) {
  var tipoInput = input.getAttribute("type");
  var mensajeAlerta = input.getAttribute("title");
  switch (tipoInput) {
    case "text":
      $(input).addClass("required");
      $(input).siblings(".spanValidacion").text(mensajeAlerta);
      $(input).parents(".tooltips").find(".spanValidacion").fadeIn();
      $("html,body").animate(
        { scrollTop: $(input).siblings(".spanValidacion").offset().top - 80 },
        200,
        "swing",
        function () {
          $(input).focus();
        }
      );
      break;
    case "email":
      break;
    case "number":
      break;
    default:
      if ($(input).is("select")) {
      } else if ($(input).is("textarea")) {
      }
      break;
  }
}

function mostrarvalidaciontitlepropio(input, mensajeAlerta) {
  var tipoInput = input.getAttribute("type");
  switch (tipoInput) {
    case "text":
      $(input).addClass("required");
      $(input).siblings(".spanValidacion").text(mensajeAlerta);
      $(input).parents(".tooltips").find(".spanValidacion").fadeIn();
      $("html,body").animate(
        { scrollTop: $(input).siblings(".spanValidacion").offset().top - 80 },
        200,
        "swing",
        function () {
          $(input).focus();
        }
      );
      break;
    case "email":
      break;
    case "number":
      break;
    default:
      if ($(input).is("select")) {
      } else if ($(input).is("textarea")) {
      }
      break;
  }
}

function validarrequerido(elemento) {
  var valor = $(elemento).val();
  if (valor.trim().length == 0) {
    return false;
  } else {
    return true;
  }
}

function validarsummernote(id) {
  var banderaRespuesta = true;
  var code = $(id).summernote("isEmpty");
  var mensajeAlerta = "Complete este campo";
  if (code) {
    banderaRespuesta = false;
    $(id).addClass("required");
    $(id).siblings(".spanValidacion").text(mensajeAlerta);
    $(id).parents(".tooltips").find(".spanValidacion").fadeIn();
    return false;
  } else {
  }
  if (banderaRespuesta == true) {
    return true;
  } else {
    return false;
  }
}

function validarcontrasenias(elemento1, elemento2) {
  var original = elemento1.val();
  var replica = elemento2.val();
  var mensajeAlerta = "Las contraseñas deben ser iguales";
  if (original === replica) {
    return true;
  } else {
    $(elemento2).addClass("required");
    $(elemento2)
      .parents(".form-group")
      .siblings(".spanValidacion")
      .text(mensajeAlerta);
    $(elemento2).parents(".tooltips").find(".spanValidacion").fadeIn();
    $("html,body").animate(
      {
        scrollTop:
          $(elemento2).parents(".tooltips").find(".spanValidacion").offset()
            .top - 80,
      },
      200,
      "swing",
      function () {
        $(elemento2).focus();
      }
    );
    return false;
  }
}

function validararchivo(idElemento, tipoArchivo) {
  var banderaRespuesta = false;
  var elemento = document.getElementById(idElemento);
  var tipoinput = elemento.type;
  var valor = elemento.value.trim();
  var mensajeAlerta = "";
  if (in_array("requerido", elemento.className.split(" "))) {
    switch (tipoinput) {
      case "file":
        mensajeAlerta = elemento.title;
        if (valor.length > 0) {
          if ("files" in elemento) {
            // Validamos el tamaño del documento ingresado
            mensajeAlerta = "El peso del archivo no es el permitido";
            if (elemento.files[0].size < 2097152) {
              // Validamos el tipo de archivo y enviamos el mensaje de alerta segun el documento de validacion
              tipoArchivo = tipoArchivo.toLowerCase();
              switch (tipoArchivo) {
                case "pdf":
                  mensajeAlerta = "El archivo debe ser en formato PDF";
                  if (elemento.files[0].type == "application/pdf") {
                    banderaRespuesta = true;
                  } else {
                    $("#" + idElemento).addClass("required");
                    $("#" + idElemento)
                      .siblings(".spanValidacion")
                      .text(mensajeAlerta);
                    $("#" + idElemento)
                      .parents(".tooltips")
                      .find(".spanValidacion")
                      .fadeIn();
                    $("html,body").animate(
                      {
                        scrollTop:
                          $("#" + idElemento)
                            .siblings(".spanValidacion")
                            .offset().top - 80,
                      },
                      200,
                      "swing",
                      function () {
                        $("#" + idElemento).focus();
                      }
                    );
                    return false;
                  }
                  break;
              }
            } else {
              $("#" + idElemento).addClass("required");
              $("#" + idElemento)
                .siblings(".spanValidacion")
                .text(mensajeAlerta);
              $("#" + idElemento)
                .parents(".tooltips")
                .find(".spanValidacion")
                .fadeIn();
              $("html,body").animate(
                {
                  scrollTop:
                    $("#" + idElemento)
                      .siblings(".spanValidacion")
                      .offset().top - 80,
                },
                200,
                "swing",
                function () {
                  $("#" + idElemento).focus();
                }
              );
              return false;
            }
          } else {
            $("#" + idElemento).addClass("required");
            $("#" + idElemento)
              .siblings(".spanValidacion")
              .text(mensajeAlerta);
            $("#" + idElemento)
              .parents(".tooltips")
              .find(".spanValidacion")
              .fadeIn();
            $("html,body").animate(
              {
                scrollTop:
                  $("#" + idElemento)
                    .siblings(".spanValidacion")
                    .offset().top - 80,
              },
              200,
              "swing",
              function () {
                $("#" + idElemento).focus();
              }
            );
            return false;
          }
        } else {
          $("#" + idElemento).addClass("required");
          $("#" + idElemento)
            .siblings(".spanValidacion")
            .text(mensajeAlerta);
          $("#" + idElemento)
            .parents(".tooltips")
            .find(".spanValidacion")
            .fadeIn();
          $("html,body").animate(
            {
              scrollTop:
                $("#" + idElemento)
                  .siblings(".spanValidacion")
                  .offset().top - 80,
            },
            200,
            "swing",
            function () {
              $("#" + idElemento).focus();
            }
          );
          return false;
        }
        break;
    }
  } else {
    if (valor.length > 0) {
      banderaRespuesta = true;
    }
  }
  return banderaRespuesta;
}

$(".requerido").on("change click mouseleave keypress", function (e) {
  if ($(this).is("select") == true) {
    $(this).siblings("span").removeClass("required");
    $(this).siblings(".tooltips").find(".spanValidacion").fadeOut();
    $(this).parents(".tooltips").find(".spanValidacion").fadeOut();
  } else {
    $(this).removeClass("required");
    $(this).parents(".tooltips").find(".spanValidacion").fadeOut();
  }
});

$(".select2").on("change click mouseleave keypress", function (e) {
  $(this).parents(".tooltips").find(".spanValidacion").fadeOut();
});

$(".container-select").on("change click mouseleave", ".select2", function (e) {
  $(this).removeClass("required");
  $(this).parents(".container-select").siblings(".spanValidacion").fadeOut();
});

$(".requeridoEspecial").on("change click mouseleave", function (e) {
  if ($(this).is("select") == true) {
    $(this).siblings(".spanValidacionEspecial").removeClass("required");
    $(this).siblings(".tooltips").find(".spanValidacionEspecial").fadeOut();
  } else {
    $(this).removeClass("required");
    $(this).parents(".tooltips").find(".spanValidacionEspecial").fadeOut();
  }
});

$(".validar").on("change click mouseleave", function (e) {
  if ($(this).is("select") == true) {
    $(this).siblings("span").removeClass("required");
    $(this).siblings(".tooltips").find("span").fadeOut();
  } else {
    $(this).removeClass("required");
    $(this).parents(".tooltips").find("span").fadeOut();
  }
});

function vercampos(contenedor, tipo) {
  //1 - Desbloquear
  //2 - Bloquear
  $(contenedor)
    .find(".form-control")
    .each(function () {
      if (tipo == 1) {
        $(this).prop("disabled", false);
      } else if (tipo == 2) {
        $(this).prop("disabled", true);
      }
    });
}

function validatipoarchivo(elemento, tipoArchivo) {
  var arrayAdobe = [
    "application/pdf",
    "application/postscript",
    "image/vnd.adobe.photoshop",
  ];

  var arrayBinarios = ["application/octet-stream"];

  var arrayComprension = [
    "application/x-bzip",
    "application/x-bzip2",
    "application/epub+zip",
  ];

  var arrayMicrosoft = [
    "application/msword",
    "application/vnd.ms-powerpoint",
    "application/vnd.ms-excel",
    "application/rtf",
    "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
    "text/csv",
  ];

  var arrayOpenOffice = [
    "application/vnd.oasis.opendocument.text",
    "application/vnd.oasis.opendocument.spreadsheet",
  ];

  var arrayTextoWeb = [
    "text/plain",
    "text/html",
    "text/html",
    "text/html",
    "text/css",
    "text/csv",
    "application/javascript",
    "application/json",
    "application/xml",
    "application/x-shockwave-flash",
    "video/x-flv",
  ];

  var arrayImagenes = [
    "image/png",
    "image/jpeg",
    "image/jpg",
    "image/gif",
    "image/bmp",
    "image/vnd.microsoft.icon",
    "image/tiff",
    "image/tiff",
    "image/svg+xml",
    "image/x-icon",
  ];

  switch (tipoArchivo) {
    case 1:
      if ($.inArray(elemento.type, arrayAdobe) !== -1) {
        return true;
      } else {
        return false;
      }
    case 2:
      if ($.inArray(elemento.type, arrayBinarios) !== -1) {
        return true;
      } else {
        return false;
      }
    case 3:
      if ($.inArray(elemento.type, arrayComprension) !== -1) {
        return true;
      } else {
        return false;
      }
    case 4:
      if ($.inArray(elemento.type, arrayMicrosoft) !== -1) {
        return true;
      } else {
        return false;
      }
    case 5:
      if ($.inArray(elemento.type, arrayOpenOffice) !== -1) {
        return true;
      } else {
        return false;
      }
    case 6:
      if ($.inArray(elemento.type, arrayTextoWeb) !== -1) {
        return true;
      } else {
        return false;
      }
    case 7:
      if ($.inArray(elemento.type, arrayImagenes) !== -1) {
        return true;
      } else {
        return false;
      }
    default:
      return false;
  }
}
