function loadDoc() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
     document.getElementById("demo").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "ajax_info.txt", true);
  xhttp.send();
}

function refreshpage(){
  $.ajax({
    type: "POST",
    url: "spapg12.php",
    data: "data",
    dataType: "dataType",
    success: function (response) {
      
    }
  });
}

function updatePageWithAjax() {
  $.ajax({
    url: 'spapg12.html',
    method: 'POST',
    success: function(response) {
      // Mettre à jour l'élément avec la réponse
      $('#table-refresh').html(response);
    },
    error: function(error) {
      // Gérer les erreurs ici
      console.log(error);
    }
  });
}


// $(document).ready(function() {
//   updatePageWithAjax();
// });

