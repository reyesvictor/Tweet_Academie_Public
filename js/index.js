$(document).ready(function () {
	$('#inscription-form').submit(function (e) // AJAX pour l'inscription
	{
		e.preventDefault(); // Empêche l'événement 
		if ($('#inscription-pseudo').val().match(/ /)) {
			alert("Your username can't contain spaces");
			return false;
		}
		if ($('#inscription-pseudo').val() == '') {
			alert("Please fill all the inputs.");
			return false;
		}
		if ($("#inscription-pseudo").val().match(/[-!$%^&*()_+|~=`{}\[\]:";'<>?,.\/]/)) {
			alert("Your username can't contain special characters.");
			return false;
		}
		let data_send_inscription =
		{
			'pseudo': $('#inscription-pseudo').val(),
			'email': $('#inscription-email').val(),
			'date_birthday': $('#inscription-date_birthday').val(),
			'name': $('#inscription-name').val(),
			'location': $('#inscription-location').val(),
			'password': $('#inscription-password').val(),
			'passwordConfirmation': $('#inscription-passwordConfirmation').val(),
		};
		let data_inscription = data_send_inscription;
		$.ajax({
			url: "../php/handler/access/inscription.php",
			method: "POST",
			data: { data_inscription },
			dataType: 'json',
			success: function (data_inscription) {
				alert(data_inscription['msg']);
				if (data_inscription['msg'] == "Votre compte à bien été crée !") {
					$.ajax({
						method: 'POST',
						url: "../php/handler/access/inscription.php",
						data: { data_send_inscription }, //pass data1 to second request
						//dataType: 'json',
						success: window.location.href = "../php/view/home/home.php",
						// handler if second request succeeds 
					});
				}

			},
			error: function (jqXHR, exception) {
				var msg = '';
				if (jqXHR.status === 0) {
					msg = 'Not connect.\n Verify Network.';
				} else if (jqXHR.status == 404) {
					msg = 'Requested page not found. [404]';
				} else if (jqXHR.status == 500) {
					msg = 'Internal Server Error [500].';
				} else if (exception === 'parsererror') {
					msg = 'Requested JSON parse failed.';
				} else if (exception === 'timeout') {
					msg = 'Time out error.';
				} else if (exception === 'abort') {
					msg = 'Ajax request aborted.';
				} else {
					msg = 'Uncaught Error.\n' + jqXHR.responseText;
				}
				alert(msg);
			}
		});
		return false;
	});

	$('#switch_reg').click(function () {
		$('.panel').toggleClass('panel_left');
		$('.panel').removeClass('panel_right');
	});

	$('#switch_reg_right').click(function () {
		$('.panel').toggleClass('panel_right');
		$('.panel').removeClass('panel_left');
	});

	$('#connexion-form').submit(function (e) // AJAX pour la connexion
	{
		e.preventDefault(); // Empêche l'événement 
		let data_send_connexion =
		{
			'pseudo': $('#connexion-pseudo').val(),
			'password': $('#connexion-password').val(),
		};
		let data_connexion = data_send_connexion;
		$.ajax({
			url: "php/handler/access/connexion.php", //modified
			method: "POST",
			data: { data_connexion },
			dataType: 'json',
			success: function (data_connexion) {
				alert(data_connexion['msg']);
				if (data_connexion['msg'] == "Connexion réussi") {
					$.ajax({
						type: 'POST',
						url: "php/handler/access/connexion.php",
						data: { data_send_connexion }, //pass data1 to second request
						success: window.location.href = "php/view/home/home.php", //modified
						error: function (jqXHR, exception) {
							handleAjaxError(jqXHR, exception);
						}
					});
				}
			},
			error: function (jqXHR, exception) {
				var msg = '';
				if (jqXHR.status === 0) {
					msg = 'Not connect.\n Verify Network.';
				} else if (jqXHR.status == 404) {
					msg = 'Requested page not found. [404]';
				} else if (jqXHR.status == 500) {
					msg = 'Internal Server Error [500].';
				} else if (exception === 'parsererror') {
					msg = 'Requested JSON parse failed.';
				} else if (exception === 'timeout') {
					msg = 'Time out error.';
				} else if (exception === 'abort') {
					msg = 'Ajax request aborted.';
				} else {
					msg = 'Uncaught Error.\n' + jqXHR.responseText;
				}
				alert(msg);
			}
		});
		return false;
	});
});
