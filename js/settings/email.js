$(document).ready(function() {
  myOnClick("#change-mail", toggleInputThenHide, "#change-mail-input");
  // let i = 0;
  // function toggleInputThenHide(e, here, id) {
  //   if (!(i % 2)) {
  // 		$(id).slideToggle('slow');
  //   } else {
  // 		$(id).slideToggle('slow');
  //   }
  //   i++;
  // }

  $("#new-email-form").submit(function(e) {
    e.preventDefault(); // Empêche l'événement
    let data_send_newEmail = {
      password: $("#password-mail").val(),
      newEmail: $("#new-email").val(),
      idMember: $("#idMember-mail").val()
    };
    let data_newEmail = data_send_newEmail;
    $.ajax({
      url: "../../handler/settings/setEmail.php",
      method: "POST",
      data: { data_newEmail },
      dataType: "json",
      success: function(data_newEmail) {
        alert(data_newEmail["msg"]);
        if (data_newEmail["msg"] == "Email correctement modifié !") {
          $.ajax({
            method: "POST",
            url: "../../handler/settings/setEmail.php",
            data: data_send_newEmail, //pass data1 to second request
            dataType: "json",
            // success: (window.location.href = "../home.php")
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
