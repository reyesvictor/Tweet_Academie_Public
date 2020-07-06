$(document).ready(function() {
  //SETTINGS SHOW INPUTS
	myOnClick("#change-pseudo", toggleInputThenHide, '#change-pseudo-input');
	// let i = 0;
  // function toggleInputThenHide(e, here, id) {
  //   if (!(i % 2)) {
	// 		$(id).slideToggle('slow');
  //   } else {
	// 		$(id).slideToggle('slow');
  //   }
  //   i++;
  // }
  $("#new-pseudo-form").submit(function(e) {
    if ( $("#pseudo").val().match(/ /) ) {
      alert("Your username can't contain spaces.");
      return false;
    }
    if ( $("#pseudo").val().match(/[-!$%^&*()_+|~=`{}\[\]:";'<>?,.\/]/) ) {
      alert("Your username can't contain special characters.");
      return false;
    }

    e.preventDefault(); // Empêche l'événement
    let data_send_newPseudo = {
      pseudo: $("#pseudo").val()
    };
    let data_newPseudo = data_send_newPseudo;
    $.ajax({
      url: "../../handler/settings/setPseudo.php",
      method: "POST",
      data: { data_newPseudo },
      dataType: "json",
      success: function(data_newPseudo) {
        alert(data_newPseudo["msg"]);
        if (data_newPseudo["msg"] == "Pseudo correctement modifié !") {
          $.ajax({
            method: "POST",
            url: "../../handler/settings/setPseudo.php",
            data: data_send_newPseudo, //pass data1 to second request
            dataType: "json"
            //success: window.location.href = "../home.php",
          });
        }
      }, error: function(jqXHR, exception) {
        handleAjaxError(jqXHR, exception);
      }
    });
    return false;
  });
});
