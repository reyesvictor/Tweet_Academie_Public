$( document ).ready(function() 
{ 
  //Difference if profile is of user logged in or of another user
  id_to_search = localStorage.user_id_follow;
  //REQUETE DEMANDER LES FOLLOWERS
  $.ajax({
    url: "../../handler/follow/getFollowers.php", //handler a qui parler
    method: 'POST',
    data: {id_to_search}, //passer l'id
    dataType: 'json',
    success: function(list)
    {
      // alert();
      // console.log(list);
      displayAllFollowers(list);
      redirectionUserpage();
      
    }, error: function(jqXHR, exception) {
      handleAjaxError(jqXHR, exception);
    }
  });
  //return false;
});