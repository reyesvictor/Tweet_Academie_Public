$( document ).ready(function() 
{
createTweet(); //Important, create a tweet
displayUser();
  function displayUser() {
    // ajaxUserReturn('../..//handler/user/getInfo.php').then( user_inf => {
      ajaxGet('../../handler/user/getInfo.php', localStorage.getItem('username')).then( user_inf => {
        displayUserInf(user_inf);
      }); 
    // ajaxUserReturn('../..//handler/user/getInfo.php').then( user_inf => {
    if ( document.location.href.match(/[^\/]+$/)[0] == 'user.php' ) {
      ajaxGet('../../handler/user/getAllUserTweets.php', localStorage.getItem('username')).then( allTweets => {
      displayAllTweets(allTweets);
      }); 
    }
    else if ( document.location.href.match(/[^\/]+$/)[0] == 'like.php' ) {
      ajaxGet('../../handler/user/getAllUserLikes.php', localStorage.getItem('username')).then( allLikes => {
        displayAllTweets(allLikes);
      });
    }
  }

  function displayUserInf(user) {
    window.id_abo = user['id'];
    if ( user['id'] == user_id ) {
      localStorage.setItem('user_id_follow', user_id);
    } else {
      localStorage.setItem('user_id_follow', user['username']);
    }
    let verifiedDiv = '';
    if ( user['verified'] == '1' ) {
      verifiedDiv = `<svg viewBox="0 0 24 24" class="certified color-theme"><g><path d="M22.5 12.5c0-1.58-.875-2.95-2.148-3.6.154-.435.238-.905.238-1.4 0-2.21-1.71-3.998-3.818-3.998-.47 0-.92.084-1.336.25C14.818 2.415 13.51 1.5 12 1.5s-2.816.917-3.437 2.25c-.415-.165-.866-.25-1.336-.25-2.11 0-3.818 1.79-3.818 4 0 .494.083.964.237 1.4-1.272.65-2.147 2.018-2.147 3.6 0 1.495.782 2.798 1.942 3.486-.02.17-.032.34-.032.514 0 2.21 1.708 4 3.818 4 .47 0 .92-.086 1.335-.25.62 1.334 1.926 2.25 3.437 2.25 1.512 0 2.818-.916 3.437-2.25.415.163.865.248 1.336.248 2.11 0 3.818-1.79 3.818-4 0-.174-.012-.344-.033-.513 1.158-.687 1.943-1.99 1.943-3.484zm-6.616-3.334l-4.334 6.5c-.145.217-.382.334-.625.334-.143 0-.288-.04-.416-.126l-.115-.094-2.415-2.415c-.293-.293-.293-.768 0-1.06s.768-.294 1.06 0l1.77 1.767 3.825-5.74c.23-.345.696-.436 1.04-.207.346.23.44.696.21 1.04z"></path></g></svg>`; 
    }
    let bio = '';
    if ( user['bio'] == null || user['bio'] == "" ) {
      bio = "This is my bio. Please respect me.";
    } else {
      bio = user['bio'];
    }
    let btn_abo = '';
    if ( user['id'] != user_id ) {
      btn_abo = `<button class='' id='btn-follow'>Suivre</button>`;
    }
    let registerDate = getMonthString(user['registerDate']) + ' ' + getYearFromStringDate(user['registerDate']);

    let div = `<!-- User info part -->
    <div class="row user">
      <div class="user--banner">
        <img src="../../../css/img/banner.png">
      </div>
      <div class="user--info">
        <div class="user--info__profil_img">
          <img src="../../../css/img/pp/${user['id']}.jpg" id="profil_img">
        </div>
        <div class="user--info__button">
          ${btn_abo}
        </div>
        <div class="user--info__profil">
          <div class="user--info__profil_name">
            <h2><b>${user['fullname']}</b>
            <span>
            ${verifiedDiv}
            </span></h2>
          </div>
          <a class='color-theme'>@${user['username']}</a>
          <div class="bio">
            <p>${bio}</p>
          </div>
          <div class="link">
              <p>📍 ${user['location']}</p>
              <p>🔗 <a class='color-theme' href="#">https://www.instagram.com/realDonaldTrump/</a></p>
              <p>📅 A rejoint Twitter en ${registerDate}</p>
          </div>
          <div class="follow-data">
            <div class="following">
              <a href='following.php'>
                <b>${user['following']}</b> Following
              </a>
            </div>
            <div class="followers">
              <a href='followers.php'>
                <b>${user['followers']}</b> Followers
              </a>
            </div>
          </div>
          </div>
          </div>`;
          $('#user_profile_information').append(div);
          
          let storage_color = localStorage.getItem("color-theme");
          if (storage_color){
            changeColor(storage_color)
          }
          andriyAbo();
        }
        
        // ============================================== RAJOUT CODE POUR S'ABONNER ou SE DESABONNER DEPUIS LA PAGE PROFIL (by Andriy)
        
        // Ajouter la variable id_abo qui correspondra de l'id du user auxquelles ont veut s'abonner, et mashallah c'est bon.
        // let id_abo = 1;
        
        
        // Fonction permettant de s'abonner ou se desabonner a l'infini, permettant la recursivite
        function modifAbo() {
          if (window.already == true) {
              $.ajax({
                url: "../../handler/follow/delFollowings.php",
                method: "POST",
                data: {user_id, id_sub: id_abo},
                dataType: 'json',
                success: function(){
                  $("#btn-follow").html("Suivre");
                  $("#btn-follow").removeAttr("style");
                  $("#btn-follow").removeClass("button-primary");
                  $("#btn-follow").removeClass("btn-color-theme-primary");
                  $("#btn-follow").toggleClass("color-theme btn-color-theme");
                  $("#btn-follow").css('background-color', 'white');
                  window.already = false
                  loadColor();
              }
            })
          }
          else {
            $.ajax({
              url: "../../handler/follow/createFollowings.php",
              method: "POST",
              data: {user_id, id_abo},
              dataType: 'json',
              success: function(){
                $("#btn-follow").html("Abonné");
                $("#btn-follow").removeAttr("style");
                $("#btn-follow").removeClass("color-theme");
                $("#btn-follow").removeClass("btn-color-theme");
                $("#btn-follow").toggleClass("button-primary btn-color-theme-primary");
                $("#btn-follow").css('color', 'white');
                window.already = true
                loadColor();
              }
            })
          }
      }
      
      function andriyAbo() {
        let alreadyFollowing = false
        let id_to_search = window.id_abo;
        // Verification si deja abonne ou non, puis personnalise le bouton en fonction de ca
        $.ajax({
          url: "../../handler/follow/getFollowers.php",
          method: "POST",
          data: {id_to_search},
          dataType: 'json',
          success: function(a){
            // console.log(a)
            a.forEach(element => {
              // console.log(element.id)
              if (element.id == user_id) {
                window.already = true;
                console.log("EGAL");
                $("#btn-follow").html("Abonné");
                $("#btn-follow").toggleClass("button-primary btn-color-theme-primary");
                loadColor();
              }
            });
            myOnClick('#btn-follow', modifAbo);
          }
        })
      }
      
      // ============================================== FIN RAJOUT CODE

});



