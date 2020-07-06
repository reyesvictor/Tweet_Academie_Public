$(document).ready(function() {
	myOnClick("#change-pwd", toggleInputThenHide, '#change-pwd-input');
	// let i = 0;
  // function toggleInputThenHide(e, here, id) {
  //   if (!(i % 2)) {
	// 		$(id).slideToggle('slow');
  //   } else {
  //     $(id).slideToggle('slow');
  //   }
  //   i++;
	// }
	
  $("#new-password-form").submit(function(e) {
    e.preventDefault(); // Empêche l'événement
    let data_send_newPassword = {
      password: $("#password").val(),
      newPassword: $("#new-password").val(),
      newPasswordConfirmation: $("#new-passwordConfirmation").val(),
      idMember: $("#idMember").val()
    };
    let data_newPassword = data_send_newPassword;
    $.ajax({
      url: "../../handler/settings/setPassword.php",
      method: "POST",
      data: { data_newPassword },
      dataType: "json",
      success: function(data_newPassword) {
        alert(data_newPassword["msg"]);
        if (data_newPassword["msg"] == "Mot de passe correctement modifié !") {
          $.ajax({
            method: "POST",
            url: "../../handler/settings/setPassword.php",
            data: data_send_newPassword, //pass data1 to second request
            dataType: "json"
            //success: window.location.href = "../home.php",
          });
        }
      },
      error: function(jqXHR, exception) {
        handleAjaxError(jqXHR, exception);
      }
    });
    return false;
  });
});
