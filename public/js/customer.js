$(document).ready(function() {
  //execute in the moment
  $("#myInput").on("keyup", function() {
    var value = $(this)
      .val()
      .toLowerCase();
    $("#TableCustom tr").filter(function() { //admin table
      $(this).toggle(
        $(this)
          .text()
          .toLowerCase()
          .indexOf(value) > -1
      );
    });
        $("#SuperAdminHome tr").filter(function() { //superAdmin table
      $(this).toggle(
        $(this)
          .text()
          .toLowerCase()
          .indexOf(value) > -1
      );
    });
    $("#ShowCompanyB tr").filter(function() { //admin table
      $(this).toggle(
        $(this)
          .text()
          .toLowerCase()
          .indexOf(value) > -1
      );
    });
  });
});

validar = false;
var NameConcept = "";
var NameTest = "";
var inTest = false; //clear maturity level

function ChangeAdmin() {
  $("#tCompany").hide();
  $("#tAdmin").show();
  document.getElementById("Customerbtn").style.borderBottomColor = "#25A1F9";
  $("#Customerbtn2").attr("style", "background-color: transparent");
}

function ChangeCompany() {
  $("#tAdmin").hide();
  $("#tCompany").show();
  document.getElementById("Customerbtn2").style.borderBottomColor = "#25A1F9";
  $("#Customerbtn").attr("style", "background-color: transparent");
}

//functions for SuperAdminView
function ShowButton() {
  var labels = document.getElementsByTagName("input");
  for (var i = labels.length - 1; i >= 0; i--) {
    labels[i].readOnly = validar;
  }
  validar = validar ? false : true;
  if (validar) {
    $("#guardar").show();
    $("#cancelar").show();
    $("#editar").hide();
    $("#eliminar").hide();
  } else {
    $("#guardar").hide();
    $("#cancelar").hide();
    $("#editar").show();
    $("#eliminar").show();
  }
}

function ShowButtonSponsor() {
    var labels = document.getElementsByTagName("input");
    for (var i = labels.length - 1; i >= 0; i--) {
        labels[i].readOnly = validar;
    }
    validar = validar ? false : true;
    if (validar) {
        $("#guardar").show();
        $("#cancelar").show();
        $("#tr-image").show();
        $("#editar").hide();
        $("#eliminar").hide();
    } else {
        $("#guardar").hide();
        $("#cancelar").hide();
        $("#editar").show();
        $("#eliminar").show();
        $("#tr-image").hide();
    }
}

function Edit(mov) {
  //Move with true or false
  var n= $("#usernameS").val();
  var a= $("#firstNameS").val();
  var p= $("#lastNameS").val();
  var e= $("#emailUserS").val();
  var nc= $("#nameCS").val();
  var ca= $("#addressCS").val();
  var cp= $("#phoneNumberCS").val();
  var ce= $("#emailcompanyCS").val();

  if(n!="" && a!="" && p!="" && e!="" && nc!="" && ca!="" && cp!="" && ce!="" && mov==true)
  {
      if (mov)
      {
        $("#from").submit();
      }
  }
  else if(mov== false)
  {
    var labels = document.getElementsByTagName("input");
    for (var i = labels.length - 1; i >= 0; i--) {
      labels[i].readOnly = validar;
    }
    $("#guardar").hide();
    $("#cancelar").hide();
    $("#editar").show();
      $("#eliminar").show();
      validar = validar ? false : true;
    document.getElementById("from").reset(); //return original
  }
  else
  {
    $("#ModalUserEdit").modal('hide');
    $("#errorDataAdmin").modal('show');
  }
}

function EditSponsor(mov) {
    //Move with true or false
        if(mov ==true)
        {
            $(".modal-body").hide();
            $(".spinner-border").show();
            $(".update").show();
            $("#from").submit();
        }
        else if(mov== false)
        {
            var labels = document.getElementsByTagName("input");
            for (var i = labels.length - 1; i >= 0; i--) {
                labels[i].readOnly = validar;
            }
            $("#guardar").hide();
            $("#editar").show();
            $("#cancelar").hide();
            $("#eliminar").show();
            $("#tr-image").hide();
            validar = validar ? false : true;
            document.getElementById("from").reset(); //return original
        }
        else
        {
            $("#myModal").modal('hide');
            $("#errorDataUser").modal('show');
        }
    }

//************************functions for AdminUserView*********************************************
function ShowButtonAdmin() {
  var labels = document.getElementsByTagName("input");
  for (var i = labels.length - 1; i >= 0; i--) {
    labels[i].readOnly = validar;
  }
  validar = validar ? false : true;

  if (validar) {
    $("#guardar").show();
    $("#cancelar").show();
    $("#editar").hide();
    $("#eliminar").hide();
    $("#check").show();
    $("#areauser").hide();
  } else {
    $("#guardar").hide();
    $("#cancelar").hide();
    $("#eliminar").show();
    $("#check").hide();
    $("#areauser").show();
    $("#editar").show();
  }
}

function EditAdminUser(mov) {
  //Move with true or false
  var n= $("#usernameU").val();
  var f= $("#firstNameU").val();
  var l= $("#lastNameU").val();
  var e= $("#emailuserU").val();
  var tt=0;
  var i = 1;

  if(n!="" && f!="" && l!="" && e!="" && mov ==true)
  {
      $("input:checkbox:checked").each(
          function() {
              if (i == 1) {
                  $(".modal-body").hide();
                  $(".spinner-border").show();
                  $(".update").show();
                  $("#from").submit();
                  i++;
              }
              tt = 1;
          }
          );
      if(tt == 0)
      {
          $("#myModal").modal('hide');
          $("#errorDataUser").modal('show');
      }
  }
  else if(mov== false)
  {
    var labels = document.getElementsByTagName("input");
    for (var i = labels.length - 1; i >= 0; i--) {
      labels[i].readOnly = validar;
    }
    $("#guardar").hide();
    $("#editar").show();
    $("#cancelar").hide();
    $("#eliminar").show();
    $("#check").hide();
    $("#areauser").show();
    validar = validar ? false : true;
    document.getElementById("from").reset(); //return original
  }
  else
  {
    $("#myModal").modal('hide');
    $("#errorDataUser").modal('show');
  }
}

function EditCompany(mov) {
    //Move with true or false
    var n= $("#nameC").val();
    var f= $("#adressC").val();
    var l= $("#phoneNumberC").val();
    var e= $("#emailC").val();
    var tt=0;

    if(n!="" && f!="" && l!="" && e!="" && mov ==true)
    {
        $(".modal-body").hide();
        $(".spinner-border").show();
        $(".update").show();
        $("#from").submit();
    }
    else if(mov== false)
    {
        var labels = document.getElementsByTagName("input");
        for (var i = labels.length - 1; i >= 0; i--) {
            labels[i].readOnly = validar;
        }
        $("#guardar").hide();
        $("#editar").show();
        $("#cancelar").hide();
        $("#eliminar").show();
        $("#check").hide();
        $("#areauser").show();
        validar = validar ? false : true;
        document.getElementById("from").reset(); //return original
    }
    else
    {
        $("#myModal").modal('hide');
        $("#errorDataUser").modal('show');
    }
}

function EditUser(mov) {
    //Move with true or false
    var n= $("#usernameS").val();
    var f= $("#firstNameS").val();
    var l= $("#lastNameS").val();
    var e= $("#emailuserS").val();
    var tt=0;

    if(n!="" && f!="" && l!="" && e!="" && mov ==true)
    {
        $(".modal-body").hide();
        $(".spinner-border").show();
        $(".update").show();
        $("#from").submit();
    }
    else if(mov== false)
    {
        var labels = document.getElementsByTagName("input");
        for (var i = labels.length - 1; i >= 0; i--) {
            labels[i].readOnly = validar;
        }
        $("#guardar").hide();
        $("#editar").show();
        $("#cancelar").hide();
        $("#eliminar").show();
        $("#check").hide();
        $("#areauser").show();
        validar = validar ? false : true;
        document.getElementById("from").reset(); //return original
    }
    else
    {
        $("#myModal").modal('hide');
        $("#errorDataUser").modal('show');
    }
}

//*****************************functions for AdminEditMaturity**************************************************
function ShowButtonMaturity() {
  var labels = document.getElementsByTagName("input");
  for (var i = labels.length - 1; i >= 0; i--) {
    labels[i].readOnly = validar;
  }
  validar = validar ? false : true;

  if (validar) {
    $("#guardar").show();
    $("#cancelar").show();
    $("#editar").hide();
  } else {
    $("#guardar").hide();
    $("#cancelar").hide();
  }
}

function EditMaturity(mov) {
  //Move with true or false
  var n= $("#0").val();
  var n1= $("#1").val();
  var n2= $("#2").val();
  var n3= $("#3").val();
  var n4= $("#4").val();

  if(n!=""&& n1!=""&& n2!=""&& n3!=""&& n4!=""&& mov ==true)
  {
      $("#from").submit();
  }
  else if(mov== false)
  {
    var labels = document.getElementsByTagName("input");
    for (var i = labels.length - 1; i >= 0; i--) {
      labels[i].readOnly = validar;
    }
    $("#guardar").hide();
    $("#cancelar").hide();
    $("#editar").show();
    validar = validar ? false : true;
    document.getElementById("from").reset(); //return original
  }
  else
  {
    $("#ModalEditML").modal('hide');
    $("#errorDataMaturity").modal('show');
  }
}

function DeleteHistory() {
  $("#fromhistory").submit();
}

//**********************************FUNCTIONS TO EDIT TEST*******************************************************
var tittle = $("#title_test").text();
$("#area_test").change(function() //come in when there's a choice
{
  if($("#area_test").val() != "X"){

    $.ajax({
      //send variable to controller
      type: "GET",
      url: "/Area/Test/" + $("#area_test").val(), //controlador + Metodo
      success: function(response) {
        $("#list_test").empty();


        var obj = JSON.parse(response);

       if(obj.length != 0 ){

           $("#list_test").append('<option value="test">Selecciona la prueba</option>');

            for (var i = obj.length - 1; i >= 0; i--) {;
              $("#list_test").append('<option value="'+obj[i].testId+'">'+obj[i].name+'</option>');
            }

            $("#show_Test").show();
            $("#back_area").show();
            $("#Area_testShow").hide();
       }else{

            $("#NoteNada").modal();
       }


      }
    });

    t = $('select[name="area_test"] option:selected').text();
    $("#title_test").text(tittle+":"+t);
  }else{
    $("#title_test").text(tittle);
  }
});

var obj2;
var TestIdDelete;
var ConceptIdDelete;
$("#list_test").change(function() {
  //come in when there's a choice
  if($("#list_test").val() != "test"){


      NameTest = $("#list_test option:selected").text();
      TestIdDelete = $("#list_test").val();

      for (var i = 0; i < 5; i++) {
        for (var j = 0; j < 3; j++) {
          $("#" + i + j).val("");
          $("#" + i + j).addClass("readOnly");
        }
      }

      for (var i = 0; i < 5; i++) {
            $("#" + i).text("");
      }

      $.ajax({
        //send variable to controller
        type: "GET",
        url: "/Area/Test/Concept/" + $("#list_test").val(), //controlador + Metodo
        success: function(response) {
          $("#list_concept").empty();

          var obj = JSON.parse(response[0]);

          $("#list_concept").append('<option value="test">Selecciona el concepto</option>');
          for (var i = obj.length - 1; i >= 0; i--) {
            $("#list_concept").append('<option value="'+obj[i].conceptId+'">'+obj[i].description+'</option>');
          }
          //console.log(obj);

          obj2 = JSON.parse(response[2]);
          $("#nameUsers").val(obj2[0].firstName+" "+obj2[0].lastName);

          obj = JSON.parse(response[1]);

          $("#list_users").append('<option value="'+obj2[0].id+'">'+obj2[0].firstName+' '+obj2[0].lastName+'</option>');
          for (var i = obj.length - 1; i >= 0; i--) {
            if(obj2[0].id != obj[i].id){
              $("#list_users").append('<option value="'+obj[i].id+'">'+obj[i].firstName+' '+obj[i].lastName+'</option>');
            }

          }
        }
      });
      $("#deleteTest").show();
  }
  else{
      TestIdDelete = null;
      ConceptIdDelete = null;
      NameTest = null;
      $("#deleteTest").hide();
      $("#editTest").hide();
      document.getElementById("test").reset();
  }
});

$("#list_concept").change(function() {
    ConceptIdDelete = $("#list_concept").val();
    //come in when there's a choice
  if($("#list_concept").val() != "test"){
    if (inTest == false) {
      for (var i = 0; i < 5; i++) {
        $("#" + i).text("");
      }
    }
    var url = "/Area/Test/Concept/Attributes";
    var test = $("#list_concept").val();
    NameConcept = $("#list_concept option:selected").text();

    $.ajax({
      //send variable to controller
      type: "GET",
      url: url + "/" + test, //controlador + Metodo
      success: function(response) {
        $('input[type="text"]').val("");
        $('textarea[class="form-control"]').val("");
        var inputs = $('input[type="text"]');
        var inputsArea = $('textarea[class="form-control"]');
        var inputshidden = $('input[type="hidden"]');
        var MaturityLevel = "";
        var cal = 0;
        var index = 3;

        var obj = JSON.parse(response);

        for (var i = obj.length - 1; i >= 0; i--) {

          if (MaturityLevel != obj[i].ML) {
            // Attribute for Madurity level
            $("#" + cal).text("");
            $("#" + cal).append(obj[i].ML);
            cal++;
            MaturityLevel = obj[i].ML;
          }

          inputs[index].value = obj[i].AD;
          inputsArea[index -3].value = obj[i].AS;
          inputshidden[index].value = obj[i].attributeId;
          index++;
        }

        $("#NoteLoad").modal('hide');
        $("#nameUsers").val(obj2[0].firstName+" "+obj2[0].lastName);
      }
    });
    $("#editTest").show();
    $("#deleteConcept").show();
  }
  else{
      TestIdDelete = null;
      ConceptIdDelete = null;
      NameTest = null;
      $("#deleteTest").hide();
      $("#deleteConcept").hide();
      $("#editTest").hide();
      document.getElementById("test").reset();
  }
});

function BackAreaTest() {
  //back to showarea in edit test
    document.getElementById("test").reset();
    document.getElementById("area_test").selectedIndex = "0";
  $("#list_concept")
    .empty()
    .append('<option value="test">Selecciona el concepto</option>');
  $("#list_users").empty()
  $("#show_Test").hide();
  $("#back_area").hide();
  $("#Area_testShow").show();
  $("#editTest").hide();
  $("#deleteTest").hide();
  $("#deleteConcept").hide();
  $("#nameTestS").show(); //back to select
  $("#nameTest").hide();
  $("#nameConcept").hide();
  $("#nameConceptS").show();
  $("#nameUsers").val("");
  $("#nameTests").css('border-color','gray');
  $("#nameTests").css('background-color','white');
  $("#nameConcepts").css('border-color','gray');
  $("#nameConcepts").css('background-color','white');
  for (var i = 0; i < 5; i++) {
      for (var j = 0; j < 3; j++) {
        $('#'+i+""+j).css('border-color','gray');
      }
    }

  var tex = $("#title_test").text();
  console.log();
  var end = tex.replace(": " + tittle, " ");
  document.getElementById("title_test").innerHTML = end;

  //attribute & maturityLevel empty
  for (var i = 0; i < 5; i++) {
    for (var j = 0; j < 3; j++) {
      $("#" + i + j).val("");
      $("#" + i + j).addClass("readOnly");
      $("#" + i + j + i).vale("");
      $("#" + i + j + i).addClass("readonly");
    }
  }
  for (var i = 0; i < 5; i++) {
    $("#" + i).text("");
  }

  $("#AreaInfo").load("/admins/area/test/area", function() {
    obj = JSON.parse(document.getElementById("AreaInfo").innerHTML);

    alert(obj[1].name);
  });
}

function ShowEditar() {
  $("#back_area").hide();
  $("#editTest").hide();
  $("#deleteTest").hide();
  $("#deleteConcept").hide();
  $("#nameTestS").hide();
  $("#nameTest").show();
  $("#nameConcept").show();
  $("#nameConceptS").hide();
  $("#nameUser").hide();
  $("#nameUserS").show();

  //val to input
  $("#nameTests").val(NameTest);
  $("#nameConcepts").val(NameConcept);

  //deactivate readonly
  for (var i = 0; i < 5; i++) {
    for (var j = 0; j < 3; j++) {
        $("#" + i + j).removeAttr("readonly");
        $("#" + i + j + i).removeAttr("readonly");

    }
  }


    //show button
  $("#SaveTest").show();
  $("#CancelTest").show();
}

var Lista_Atributos = [];
var ValiadarTest = true;

function EditarTest(op) {

  ValiadarTest = true;
  Lista_Atributos = [];

  if (op == true) {
    $("#NoteUpdate").modal('hide');
    var inputshidden = $('input[type="hidden"]');
    var x = 0;

    for (var i = 0; i < 5; i++) {
      for (var j = 0; j < 3; j++) {
        Lista_Atributos.push({
            AtributoId: inputshidden[x + 3].value,
            AtributoName: validartexto(i+""+j),
            AtributoSuggestion: validartexto(i+""+j+""+i),
        });
        x++;
      }
    }

    var ConceptName = validartexto("nameConcepts");
    var TestName = validartexto("nameTests");


    if (ValiadarTest) {
       var myJSON = JSON.stringify(Lista_Atributos);
       var TestId = $("#list_test option:selected").val();
       var myJSONTest = JSON.stringify({ Id: TestId, Name: TestName });
       var ConceptId = $("#list_concept option:selected").val();
       var myJSONConcept = JSON.stringify({ Id: ConceptId, Name: ConceptName });
       var UsuarioId = $("#list_users option:selected").val();

       $.ajax({
         //send variable to controller
         type: "GET",
         url: "/Areaf/" + myJSON + "/" + myJSONTest + "/" + myJSONConcept+"/"+UsuarioId, //controlador + Metodo
         success: function(response) {}
       });

       for (var i = 0; i < 5; i++) {
         for (var j = 0; j < 3; j++) {
           $("#" + i + j).attr("readonly", true);
           $("#" + i + j + i).attr("readonly", true);
         }
       }
       $("#back_area").show();
       $("#editTest").show();
       $("#deleteTest").show();
       $("#deleteConcept").show();
       $("#SaveTest").hide();
       $("#CancelTest").hide();
       $("#nameUserS").hide();
       $("#nameUser").show();
       $("#nameUsers").val("");
       BackAreaTest();
       $("#TestReload").modal("show");
    }else{
       $("#NoteError").modal();
    }

  }

  else if (op == false) {
      location.reload();
  }
}

var expanded = false;


function validartexto(id) {
  $('#'+id).css('border-color','gray');

  var patt = new RegExp("[A-Za-z0-9]");


  if(!(patt.test($('#'+id).val()))){
    $('#'+id).css('border-color','red');
    ValiadarTest = false;
  }
  return $('#'+id).val();
}

function showCheckboxes() {
  var checkboxes = document.getElementById("checkboxes");
  if (!expanded) {
    checkboxes.style.display = "block";
    expanded = true;
  } else {
    checkboxes.style.display = "none";
    expanded = false;
  }
}

window.setTimeout("closeMessage();", 3000);

function closeMessage() {
  document.getElementById("message").style.display = "none";
}

function DeleteTest()
{
    $.ajax({
    //send variable to controller
    type: "GET",
    url: "/admins/area/test/edit/delete/" + TestIdDelete, //controlador + Metodo
    success: function(response) {
      console.log(response);
    }
  });
     location.reload();
}

function DeleteConcept()
{
    $.ajax({
        //send variable to controller
        type: "GET",
        url: "/admins/area/concept/edit/delete/" + ConceptIdDelete, //controlador + Metodo
        success: function(response) {
            console.log(response);
        }
    });
    location.reload();
}


//**********************************FUNCTIONS TO EDIT COMPANY*******************************************************
function ShowButtonCompany() {
  var labels = document.getElementsByTagName("input");
  for (var i = labels.length - 1; i >= 0; i--) {
    labels[i].readOnly = validar;
  }
  validar = validar ? false : true;
  if (validar) {
    $("#guardar").show();
    $("#cancelar").show();
    $("#editar").hide();
  } else {
    $("#guardar").hide();
    $("#cancelar").hide();
    $("#editar").show();
  }
}

function EditCompany(mov) {
  //Move with true or false
  var n= $("#nameC").val();
  var a= $("#addressC").val();
  var p= $("#phoneNumberC").val();
  var e= $("#emailC").val();

  if(n!="" && a!="" && p!="" && e!="" && mov)
  {
      if (mov)
      {
        $("#formCompany").submit();
      }
  }
  else if(mov== false)
  {
    var labels = document.getElementsByTagName("input");
    for (var i = labels.length - 1; i >= 0; i--) {
      labels[i].readOnly = validar;
    }
    $("#guardar").hide();
    $("#cancelar").hide();
    $("#editar").show();
    validar = validar ? false : true;
    document.getElementById("formCompany").reset(); //return original
  }
  else
  {
    $("#errorDataCompany").modal('show');
  }
}

//**********************************editArea******************************************************
function ShowButtonEditArea() {
  var labels = document.getElementsByTagName("input");
  for (var i = labels.length - 1; i >= 0; i--) {
    labels[i].readOnly = validar;
  }
  validar = validar ? false : true;

  if (validar) {
    $("#guardarA").show();
    $("#cancelarA").show();
    $("#editarA").hide();
    $("#deleteA").hide();
  } else {
    $("#guardarA").hide();
    $("#cancelarA").hide();
  }
}

function EditAreaAD(mov) {
  var n= $("#areaEdi").val();

  if(n!="" && mov==true)
  {
    $("#formEditArea").submit();
  }
  else if(mov== false)
  {
    var labels = document.getElementsByTagName("input");
    for (var i = labels.length - 1; i >= 0; i--) {
      labels[i].readOnly = validar;
    }
    $("#guardarA").hide();
    $("#cancelarA").hide();
    $("#editarA").show();
    $("#deleteA").show();
    validar = validar ? false : true;
    document.getElementById("formEditArea").reset(); //return original
  }
  else
  {
    $("#ModalareaE").modal('hide');
    $("#errorDataArea").modal('show');
  }
}
