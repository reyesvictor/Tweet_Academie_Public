$( document ).ready(function() 
{ 

  //Difference if profile is of user logged in or of another user
  id_to_search = localStorage.user_id_follow;

  $.ajax({
  url: "../../handler/follow/getFollowings.php", //handler a qui parler
  method: 'POST',
  data: {id_to_search}, //passer l'id
  dataType: 'json',
  success: function(list)
  {
    console.log(list);    
    displayAllFollowings(list);
    redirectionUserpage();

    $(".btn-abo").click(function(){
      let id = $(this).parent().parent().parent().attr('id')
      let id_sub = id.substr(8)
      console.log(id_to_search)
      console.log(id_sub)
      $.ajax({
        url: "../../handler/follow/delFollowings.php",
        method: "POST",
        data: {id_to_search, id_sub},
        dataType: 'json',
        success: function(a){
          $("#follower"+id_sub).hide()          
        }
      })
    })
  }, error: function(jqXHR, exception) {
    handleAjaxError(jqXHR, exception);
  }
  });
  //return false;
});