<?php
$response = '';
    // (A) PROCESS RESERVATION
if (isset($_POST["eventTime"])) {
  require "connection.php";
  if ($_RSV->save($_POST["Nombre"],
    $_POST["Telefono"],
    $_POST["Email"], 
    $_POST["Sucursal"],
    $_POST["Imagen"],
    $_POST["eventTime"])) {
    echo "HOLA";
/*
  echo '<script>
  setTimeout(function(){ window.location.href= "card.html?Nombre=XYZ";}, 5000);
  </script>';
  */
  $response =  '<img src="reserv-done.png" id="imgpremio">' ;
} else { echo "HOLA2";
echo "<div class='err'>".$_RSV->error."</div>"; }

}
?>


<!DOCTYPE html>
<html>
<head>
  <title>Registrar nuevo aventurero</title>
  <link href="3-theme.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  <script src="https://npmcdn.com/flatpickr/dist/l10n/es.js"></script>
</head>
<body>
  <form id="resForm" method="post" target="_self">
    <h1><img src="CDLOGO.jpg" id="imgprinc"></h1>

    <div class="steps">
      <div class="step current"></div>
      <div class="step"></div>
    </div>
    <div class="step-content current" data-step="1">
      <!-- (B) RESERVATION FORM -->

      <div class="fields">
        <label for="name">Nombre</label>
        <input type="text" name="Nombre" placeholder="Nombre del aventurero" required />

        <label for="res_tel">Teléfono de contacto</label>
        <input type="tel" required name="Telefono" placeholder="Solo números" maxlength="10" minlength="10" />

        <label>Email</label>
        <div class="field">
          <input type="email" Name="Email" id="mail" required>
        </div>

        <label>Fecha de nacimiento del aventurero</label>
        <div class="field">
          <input type="text" id="calendar-es" onchange="timeformat()" required>
        </div>

        <label for="Sucursal">Sucursal</label>
        <select id="Sucursal" name="Sucursal" required>
          <option disabled selected hidden>Selecciona una sucursal</option>
          <option value="Cholula">Cholula</option>
          <option value="16Sept">16 de Septiembre</option>
        </select> 

        <label>
          <input type="radio" name="Imagen" value="yopu" checked>
          <img src="yopu.png" alt="Option 1" class="IMGS">
        </label>

        <label>
          <input type="radio" name="Imagen" value="zurkarak">
          <img src="zurkarak.png" alt="Option 2" class="IMGS">
        </label>

        <label>
          <input type="radio" name="Imagen" value="hyper">
          <img src="hyper.png" alt="Option 3" class="IMGS">
        </label>

        <label>
          <input type="radio" name="Imagen" value="tyma">
          <img src="tyma.png" alt="Option 4" class="IMGS">
        </label>

        <label>
          <input type="radio" name="Imagen" value="ocra">
          <img src="ocra.png" alt="Option 5" class="IMGS">
        </label>



        <input type="hidden" name="eventTime" id="eventTime"/>
        <input type="submit" class="btn" name="submit" value="Reservar" id="checkBtn" >

      </div>
    </div>


    <div class="step-content" data-step="2">
      <div class="result"><?=$response?></div>
    </div>



  </form>

</body>

<script>
  const setStep = step => {
    document.querySelectorAll(".step-content").forEach(element => element.style.display = "none");
    document.querySelector("[data-step='" + step + "']").style.display = "block";
    document.querySelectorAll(".steps .step").forEach((element, index) => {
      index < step-1 ? element.classList.add("complete") : element.classList.remove("complete");
      index == step-1 ? element.classList.add("current") : element.classList.remove("current");
    });
  };
  document.querySelectorAll("[data-set-step]").forEach(element => {
    element.onclick = event => {
      event.preventDefault();
      setStep(parseInt(element.dataset.setStep));
    };
  });
  <?php if (!empty($_POST)): ?>
    setStep(2);
  <?php endif; ?>
</script>



<script type="text/javascript">



  flatpickr('#calendar-es', {
    "locale": "es",
    "dateFormat": "d-m-Y"
  }
  );

</script>


<script>


  function timeformat(){
    var selected_day= document.getElementById("calendar-es").value        
    var formatdate = selected_day.split("-");
    newdate = formatdate[1] + '/' + formatdate[0] + '/' + formatdate[2];
    correct_format=new Date(newdate);
    document.getElementById('eventTime').value=correct_format.valueOf();
  }

</script>
</html>
