//Appelé a la fin de displayAllTweet
function like() {
  myOnClick('.likes', getLikeID);
  function getLikeID(e, here) {
    id = here.getAttribute('value');
    $.ajax({
      url: '../../handler/like/like.php',
      data: { data_like: id },
      method: "POST",
      dataType: "json",
      success: function(msg) {
        alert(msg);
      },
      error: function(jqXHR, exception) {
        handleAjaxError(jqXHR, exception);
      }
    }) 
  }
}