<?php


require "proc/vendor/myzql/myzql.php"; //Requerimos el archivo (require en lugar de require_once porque me supongo que quieren que perdure)
require "proc/DBSX.class.php"; //Clase con los metodos de cargado

    $REX = new mySQL(); //Creamos la instancia de la clase...
    $DBS = new DBSX($REX); //Instanciamos la clase usando la base de datos "ESTIMATES"

 
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>


    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css"
                           integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" 
            integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>


     <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      .list-group-item { cursor: pointer;}

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }


      .MELEMENT:hover{ background-color: lightgray;}
      .tab-pane  {padding: 2rem;}

      .grayson { background-color: lightgray;}
      #tblCompareX { border: solid thin lightgrey; }

      #tblCompareX td, th  { text-align: center;}
      #tblCompareX th  { cursor: pointer;}

      #tblCompareX td:nth-child(1), th:nth-child(1){ text-align: left; }

      #tblCompareX {display: none;}

      #loadr {top: 50%; display: none; position: absolute;}

    </style>
</head>
<body class="bg-light">

 <div class='text-center w-100' id="loadr"><div class='spinner-border text-primary' role='status'>
        <span class='visually-hidden'>Loading...</span></div>
 </div>

    <div class="py-3 text-center">          
          <h2>BDSMX</h2>
          <p class="lead">Comparativa de BD's.</p>
    </div>    



      <main>

            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Count</button>
                    <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Table Compare</button>
                    <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Contact</button>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <!-- FIRST TAB -->
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">

                        <div class="container">
                            <div class="row">
                                    <!-- PRIMER ELEMENTO-->
                                <div class="col"> 
                                    <h4 class="mb-3"> MAIN DB</h4> 
                                    <div>  <?=$DBS->getDatabaseCombo("cmbFirstDatabase");?> </div>    

                                    <ul class="list-group mb-3" id="firstTable">
                                    </ul>
                                </div> 
                                <!-- SEGUNDO ELEMENTO-->
                                <div class="col"> 
                                    <h4 class="mb-3"> Compare DB  </h4> 
                                    <div>  <?=$DBS->getDatabaseCombo("cmbSecondDatabase");?></div>    

                                    <ul class="list-group mb-3" id="secondTable">
                                    </ul>

                                </div>
                            </div>
                        </div>

                </div>
                 <!-- SECOND TAB -->
                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
 
                             <div class="container">
                                <div class="row">
                                    <!-- PRIMER ELEMENTO-->
                                <div class="col"> 
                                    <h4 class="mb-3"> MAIN DB</h4> 
                                    <div>  <?=$DBS->getDatabaseCombo("cmbFirstDatabaseCC");?> </div>    

                                    <ul class="list-group mb-3" id="firstTable">
                                    </ul>
                                </div> 
                                <!-- SEGUNDO ELEMENTO-->
                                <div class="col"> 
                                    <h4 class="mb-3"> Compare DB   </h4> 
                                    <div>  <?=$DBS->getDatabaseCombo("cmbSecondDatabaseCC");?></div>    

                                    <ul class="list-group mb-3" id="secondTable">
                                    </ul>

                                </div>
                                <div class="col-sm3"> 
                                     <button id="btnCompareDatabases" class="w-100 btn btn-primary btn-lg"> Compare >> </button>
                                </div>
                            </div>

                            <div class="pt-4">

                                <table id="tblCompareX" class="table table-hover w-100">
                                  <thead>
                                    <tr>
                                        <th scope="col" class="w-80">#</th>
                                        <th scope="col" class="w-10">
                                            <span class="d-inline-block" tabindex="0" 
                                                    data-bs-toggle="tooltip" title="Check the TABLES.">
                                                    Exists
                                            </span>
                                        </th>
                                        <th scope="col" class="w-10">
                                            <span class="d-inline-block" tabindex="0" 
                                                    data-bs-toggle="tooltip" title="Check the changes on fields (types, names, etc.).">
                                                    Has Changes 
                                            </span>
      
                                        </th>        
                                        <th scope="col" class="w-10">New Rows</th>                                    
                                    </tr>
                                  </thead>
                                  <tbody id="tblComparesBody">
                                    
                                  </tbody>
                                </table>
                                <div class="text-center "> :) </div>                                
                            </div>

                </div>
                 <!-- THIRD TAB -->
                <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                    aS asad asd qw
                </div>
            </div>

  
      </main>




    
      <footer class="my-5 pt-5 text-muted text-center text-small">
        <p class="mb-1">&copy; 2022 Fasto's Co.Ltd</p>
        <ul class="list-inline">
          <li class="list-inline-item"><a href="#">Privacy</a></li>
          <li class="list-inline-item"><a href="#">Terms</a></li>
          <li class="list-inline-item"><a href="#">Support</a></li>
        </ul>
      </footer>
    </div>
    



    
    <script>
        
        $(function(){
         
            $('#cmbFirstDatabase').on('change', function() {
                loadTableList($(this).val(),"firstTable");
            });


            $('#cmbSecondDatabase').on('change', function() {                 
                loadTableList($(this).val(),"secondTable");                
            });

            $(document).on("click", ".list-group-item", function () {
                chSelection($(this))
            });


            //----------------------------

            $("#btnCompareDatabases").click(function() {
                compareDatabases();
            });
            

        });




        function loadTableList(database, element)
        {
            $("#"+element).html("Loading ...");

                $.ajax({
                    url: "proc/DBSX.ajax.php",
                    type: "POST",
                    data: { opc: 1, dbs: database },
                    //dataType: 'json',
                    success: function (RES) { 
                        $("#"+element).html(RES);
                    },
                    error: function (jqXHR, status, error) {
                       console.log("ERROR: algo fallo por ahi... ");
                       console.log(jqXHR);
                    },
                });

        }

        function chSelection(ele){
            ele.toggleClass("grayson");        
        }


        function compareDatabases()
        {
            let DBA = $("#cmbFirstDatabaseCC").val();
            let DBB = $("#cmbSecondDatabaseCC").val();


            console.log(DBA);
            console.log(DBB);
            
        
            
            $("#tblCompareX").show();//Mostramos lo oculto (de la primera vez)
            $("#loadr").show();
            $("#tblComparesBody").html("");

 
         if(DBA.length>0 && DBB.length >0)
         {
                $.ajax({
                    url: "proc/DBSX.ajax.php",
                    type: "POST",
                    data: { opc: 2, DBA:DBA, DBB:DBB},
                    // dataType: 'json',
                    success: function (RES) {
                        
                            $("#loadr").hide();
                            $("#tblComparesBody").html(RES);

                        console.log(RES);
                    },
                    error: function (jqXHR, status, error) {
                    console.log("ERROR: algo fallo por ahi... ");
                    console.log(jqXHR);
                    },
                });
         }
         else
         {
            console.log("Please Select Databases!");
         }
 
     }
    </script>

</body>
</html>