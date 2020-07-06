function sqlClean(value) {
  return value.replace(/\;|\)|\-\-/g, "");
}

function myKeypress(element, functionToLaunch) {
  $(`${element}`).keypress(function (e) {
    functionToLaunch(e, this);
  });
}

function myKeyUp(element, functionToLaunch) {
  $(`${element}`).keyup(function (e) {
    functionToLaunch(e, this);
  });
}

function getTweetDate(dateToConvert) {
  let date = new Date(dateToConvert);
  let day = date.getDate();
  let moisListe = [
    "janv",
    "févr",
    "mars",
    "avril",
    "mai",
    "juin",
    "juill",
    "aout",
    "sept",
    "oct",
    "nov",
    "déc"
  ];
  let mois = moisListe[date.getMonth()];
  date = day + " " + mois;
  return date;
}

function getMonthString(dateToConvert) {
  let date = new Date(dateToConvert);
  let monthList = [
    "janv",
    "févr",
    "mars",
    "avril",
    "mai",
    "juin",
    "juill",
    "aout",
    "sept",
    "oct",
    "nov",
    "déc"
  ];
  let month = monthList[date.getMonth()];
  return month;
}

function getYearFromStringDate(dateToConvert) {
  let date = new Date(dateToConvert);
  let year = date.getFullYear();
  return year;
}

function ajaxSet(path, tweet_id) {
  let data = {
    tweet_id, // possible de concatener des valeurs dedans
    user_id
  };
  return $.ajax({
    url: path,
    data: { data: data },
    method: "POST",
    dataType: "json",
    success: function (msg) {
      return msg;
    },
    error: function (jqXHR, exception) {
      handleAjaxError(jqXHR, exception);
    }
  });
}

function ajaxGet(path, data = null) {
  return $.ajax({
    url: path,
    data: { data: data },
    method: "POST",
    dataType: "json",
    success: function (result) {
      return result;
    },
    error: function (jqXHR, exception) {
      handleAjaxError(jqXHR, exception);
    }
  });
}

// function ajaxUserRequest(path) {
//   return $.ajax({
//     url: path,
//     data: {user_id:user_id}, //already available
//     method: 'POST',
//     dataType: 'json',
//     success: function (data) {
//       return data;
//     },  error: function (jqXHR, exception){
//       handleAjaxError(jqXHR, exception);
//     }
//   })
// }

function handleAjaxError(jqXHR, exception) {
  var msg = "";
  if (jqXHR.status === 0) {
    msg = "Not connect.\n Verify Network.";
  } else if (jqXHR.status == 404) {
    msg = "Requested page not found. [404]";
  } else if (jqXHR.status == 500) {
    msg = "Internal Server Error [500].";
  } else if (exception === "parsererror") {
    msg = "Requested JSON parse failed.";
  } else if (exception === "timeout") {
    msg = "Time out error.";
  } else if (exception === "abort") {
    msg = "Ajax request aborted.";
  } else {
    msg = "Uncaught Error.\n" + jqXHR.responseText;
  }
  alert(msg);
}

function refresh() {
  console.log("Refreshing...");
  $("#tweet").text("");
  if (document.location.href.match(/[^\/]+$/)[0] == "home.php") {
    ajaxGet("../..//handler/tweet/getHomeTweet.php", "all").then(
      all_tweets_for_home => {
        displayAllTweets(all_tweets_for_home);
      }
    );
  } else {
    // ajaxUserRequest('../..//handler/user/getAllUserTweets.php').then( allTweets => {
    ajaxGet("../..//handler/user/getAllUserTweets.php").then(allTweets => {
      displayAllTweets(allTweets);
    });
  }
  $("#trend-tag-container").text("");
  trendTag();
}

function myOnClick(
  element,
  functionToLaunch,
  valueToPass = null,
  value2 = null,
  value3 = null
) {
  $(element)
    .prop("onclick", null)
    .off("click");
  $(`${element}`).on("click", function (e) {
    functionToLaunch(e, this, valueToPass, value2, value3);
  });
}

function createTweet() {
  $("#new-content-form").submit(function (e) {
    e.preventDefault(); // Empêche l'événement
    let data_send_newTweet = {
      "content-tweet": $("#newTweet-content").val()
    };
    let data_newTweet = data_send_newTweet;
    $.ajax({
      //VERIFICATION DE LINPUT
      url: "../../handler/tweet/setNewTweet.php",
      method: "POST",
      data: { data_newTweet },
      dataType: "json",
      success: function (data_newTweet) {
        // alert(data_newTweet["msg"]);
        if (data_newTweet["msg"] == "Tweet réussi") {
          $.ajax({
            //UPLOAD DANS LE SQL
            method: "POST",
            // url: "home.php",
            url: "../../handler/tweet/setCreate.php",
            // data: data_send_newTweet,
            data: { idUser: user_id, data: data_send_newTweet },
            dataType: "json",
            success: function (data) {
              if (data == "Tweet Enregistré Dans La BDD.") {
                refresh();
                $("#newTweet-content").val("");
                $(`#cibler-list`).remove();
              }
            },
            error: function (jqXHR, exception) {
              handleAjaxError(jqXHR, exception);
            }
          });
        } else {
          alert(data_newTweet["msg"]);
        }
      },
      error: function (jqXHR, exception) {
        handleAjaxError(jqXHR, exception);
      }
    });
    return false;
  });
}

// ===== RETWEET =======
// let j = 0;
// function retweetMenu(e, here, tweet_id) {
//   if (!(j % 2)) {
//     $("#rt-menu").remove();
//     console.log("rt: user " + user_id + " retweeted / replied to " + tweet_id);
//     let rt_simple = "rt-simple";
//     let rt_comm = "rt-comme";
//     let rt_menu = `<div id='rt-menu'>
//         <button id='${rt_simple}'>Retweet</button>
//         <button id='${rt_comm}'>Reply with a comment</button>
//       </div>`;
//     $(`#${here.id}`).after(rt_menu);
//     myOnClick(`#${rt_simple}`, retweet, tweet_id);
//     myOnClick(`#${rt_comm}`, retweetComm, tweet_id);
//   } else {
//     $("#rt-menu").remove();
//   }
//   j++;
// }

function retweet(e, here, tweet_id) {
  if (confirm("Retweet this ?")) {
    ajaxSet("../../handler/retweet/setRetweetSimple.php", tweet_id);
    refresh();
  }
}

function retweetComm(e, here, tweet_id) {
  // Reply, Answer to a Tweet
  let reply = prompt("Répondre: ");
  if (!reply) {
    return false;
  }
  if (reply == "") {
    alert("Type your reply.");
    retweetComm(e, here, tweet_id);
    return false;
  }
  if (reply.length > 140) {
    alert("Your reply is too long.");
    retweetComm(e, here, tweet_id);
    return false;
  }
  ajaxSet("../../handler/retweet/SetRetweetComm.php", { tweet_id, reply }).then(
    data => {
      refresh();
    }
  )
}

let start = 0
let limit = 10
let rep = 1

function displayAllTweets(allTweets) {
  let total = allTweets.length
  let div = `<div class="next_tweets" id="next_tweets${rep}">Voir la suite...</div>`

  if (allTweets.length < 10) {
    for (let i = start; i < total; i++) {
      if (allTweets[i]["origin_id"]) {
        let div_replied = "";
        div_replied = getHtmlRepliedTo(allTweets[i]);
        displayTweet(allTweets[i], div_replied);
      } else {
        launchDisplay(allTweets[i]);
      }
    }
  }
  else {
    if (allTweets.length - start > 10) {
      for (let i = start; i < limit; i++) {
        if (allTweets[i]["origin_id"]) {
          let div_replied = "";
          div_replied = getHtmlRepliedTo(allTweets[i]);
          displayTweet(allTweets[i], div_replied);
        } else {
          launchDisplay(allTweets[i]);
        }

      }
      $("#tweet").append(div);
      $("#next_tweets" + rep).click(function () {
        $(this).remove()
        start = start + 10
        limit = limit + 10
        rep++
        displayAllTweets(allTweets);
      })
    }
    else {
      for (let i = start; i < total; i++) {
        if (allTweets[i]["origin_id"]) {
          let div_replied = "";
          div_replied = getHtmlRepliedTo(allTweets[i]);
          displayTweet(allTweets[i], div_replied);
        } else {
          launchDisplay(allTweets[i]);
        }
      }
    }
  }
  like();
}

function launchDisplay(allTweets, div_replied = "") {
  if (allTweets["rt_id"]) {
    displayTweet(allTweets, div_replied, "rt--");
  } else {
    displayTweet(allTweets, div_replied);
  }
}

function displayTweet(tweet, div_replied, rt = "") {
  let class_tweet = "class='tweet'";
  let pin_menu = "";
  let pin_msg = "";
  let rt_msg = "";
  let rt_div = "";
  let liked_div = '';
  let content = tweet["content"];
  let profile_pic = tweet['user_id'];
  //CREATION DES LIENS HASHTAGS
  if (content && content.match(/#[a-zA-Z]+/g)) {
    content = createTagLinks(content);
  }
  if (content && content.match(/@[a-zA-Z]+/g)) {
    content = createUserLinks(content);
  }
  if (rt == "") {
    rt_div = `<svg viewBox="0 0 24 24" class="logo-opt" id="rt-${tweet["tweet_id"]}"><g><path d="M23.77 15.67c-.292-.293-.767-.293-1.06 0l-2.22 2.22V7.65c0-2.068-1.683-3.75-3.75-3.75h-5.85c-.414 0-.75.336-.75.75s.336.75.75.75h5.85c1.24 0 2.25 1.01 2.25 2.25v10.24l-2.22-2.22c-.293-.293-.768-.293-1.06 0s-.294.768 0 1.06l3.5 3.5c.145.147.337.22.53.22s.383-.072.53-.22l3.5-3.5c.294-.292.294-.767 0-1.06zm-10.66 3.28H7.26c-1.24 0-2.25-1.01-2.25-2.25V6.46l2.22 2.22c.148.147.34.22.532.22s.384-.073.53-.22c.293-.293.293-.768 0-1.06l-3.5-3.5c-.293-.294-.768-.294-1.06 0l-3.5 3.5c-.294.292-.294.767 0 1.06s.767.293 1.06 0l2.22-2.22V16.7c0 2.068 1.683 3.75 3.75 3.75h5.85c.414 0 .75-.336.75-.75s-.337-.75-.75-.75z"></path></g></svg>`;
  }
  liked_div = `<svg viewBox="0 0 24 24" class="logo-opt"><g><path d="M12 21.638h-.014C9.403 21.59 1.95 14.856 1.95 8.478c0-3.064 2.525-5.754 5.403-5.754 2.29 0 3.83 1.58 4.646 2.73.814-1.148 2.354-2.73 4.645-2.73 2.88 0 5.404 2.69 5.404 5.755 0 6.376-7.454 13.11-10.037 13.157H12zM7.354 4.225c-2.08 0-3.903 1.988-3.903 4.255 0 5.74 7.034 11.596 8.55 11.658 1.518-.062 8.55-5.917 8.55-11.658 0-2.267-1.823-4.255-3.903-4.255-2.528 0-3.94 2.936-3.952 2.965-.23.562-1.156.562-1.387 0-.014-.03-1.425-2.965-3.954-2.965z"></path></g></svg>`;
  let content_and_buttons = `<div class="tweet__message">
  <p>${content}</p>
  </div>
  <div>
  ${div_replied}
  </div>
  <div class="tweet__opt row">
  <div class="tweet__opt_msg three columns" id='reply-tweet-${tweet['tweet_id']}'>
  <svg viewBox="0 0 24 24" class="logo-opt"><g><path d="M14.046 2.242l-4.148-.01h-.002c-4.374 0-7.8 3.427-7.8 7.802 0 4.098 3.186 7.206 7.465 7.37v3.828c0 .108.044.286.12.403.142.225.384.347.632.347.138 0 .277-.038.402-.118.264-.168 6.473-4.14 8.088-5.506 1.902-1.61 3.04-3.97 3.043-6.312v-.017c-.006-4.367-3.43-7.787-7.8-7.788zm3.787 12.972c-1.134.96-4.862 3.405-6.772 4.643V16.67c0-.414-.335-.75-.75-.75h-.396c-3.66 0-6.318-2.476-6.318-5.886 0-3.534 2.768-6.302 6.3-6.302l4.147.01h.002c3.532 0 6.3 2.766 6.302 6.296-.003 1.91-.942 3.844-2.514 5.176z"></path></g></svg>  
  </div>
  <div class="tweet__opt_rt three columns">
  ${rt_div}
  </div>
  <div class="tweet__opt_like three columns likes" value='${tweet['tweet_id']}'>
  ${liked_div}
  </div>
  </div>`;

  if (document.location.href.match(/[^\/]+$/)[0] == 'like.php' || rt != '') {
    content_and_buttons = `<div class="tweet__message">
  <p>${content}</p>
  </div>`;
  }
  if (tweet["is_disabled"] == "1") {
    content_and_buttons = `<h3>This tweet has been deleted.</h3>`;
  }
  if (tweet["pinned_tweet"]) {
    pin_msg = `<div class="row pinned_msg_row">
      <div class="pinned_msg">
        <svg viewBox="0 0 24 24" class="logo-pin"><g><path d="M20.235 14.61c-.375-1.745-2.342-3.506-4.01-4.125l-.544-4.948 1.495-2.242c.157-.236.172-.538.037-.787-.134-.25-.392-.403-.675-.403h-9.14c-.284 0-.542.154-.676.403-.134.25-.12.553.038.788l1.498 2.247-.484 4.943c-1.668.62-3.633 2.38-4.004 4.116-.04.16-.016.404.132.594.103.132.304.29.68.29H8.64l2.904 6.712c.078.184.26.302.458.302s.38-.118.46-.302l2.903-6.713h4.057c.376 0 .576-.156.68-.286.146-.188.172-.434.135-.59z"></path></g></svg>
        <span>Tweet épinglé</span>
      </div>
    </div>`;
    class_tweet = "class='tweet pinned'";
  }

  if (!tweet["rt_id"]) {
    tweet["rt_id"] = "";
    if (user_id == tweet["user_id"]) {
      //verification si le tweet appartient a l'utilisateur
      if (tweet["is_disabled"] == 0) {
        pin_menu = `<span id='pin-${tweet["tweet_id"]}'>
        <svg viewBox="0 0 24 24" class="logo-my_tweet logo-opt"><g><path d="M20.207 8.147c-.39-.39-1.023-.39-1.414 0L12 14.94 5.207 8.147c-.39-.39-1.023-.39-1.414 0-.39.39-.39 1.023 0 1.414l7.5 7.5c.195.196.45.294.707.294s.512-.098.707-.293l7.5-7.5c.39-.39.39-1.022 0-1.413z"></path></g></svg>
        </span>`;
      }
    }
  } else {
    profile_pic = tweet['user_rted_id'];
    let rted_by = "";
    if (tweet["rted_by"]) {
      rted_by = tweet["rted_by"];
    } else {
      rted_by = tweet["fullname"];
    }
    rt_msg = `<!-- RT Message -->
      <div class="row retweet_msg_row">
        <div class="retweet_msg">
          <svg viewBox="0 0 24 24" class="logo-rt"><g><path d="M23.615 15.477c-.47-.47-1.23-.47-1.697 0l-1.326 1.326V7.4c0-2.178-1.772-3.95-3.95-3.95h-5.2c-.663 0-1.2.538-1.2 1.2s.537 1.2 1.2 1.2h5.2c.854 0 1.55.695 1.55 1.55v9.403l-1.326-1.326c-.47-.47-1.23-.47-1.697 0s-.47 1.23 0 1.697l3.374 3.375c.234.233.542.35.85.35s.613-.116.848-.35l3.375-3.376c.467-.47.467-1.23-.002-1.697zM12.562 18.5h-5.2c-.854 0-1.55-.695-1.55-1.55V7.547l1.326 1.326c.234.235.542.352.848.352s.614-.117.85-.352c.468-.47.468-1.23 0-1.697L5.46 3.8c-.47-.468-1.23-.468-1.697 0L.388 7.177c-.47.47-.47 1.23 0 1.697s1.23.47 1.697 0L3.41 7.547v9.403c0 2.178 1.773 3.95 3.95 3.95h5.2c.664 0 1.2-.538 1.2-1.2s-.535-1.2-1.198-1.2z"></path></g></svg>
          <span>${rted_by} a retweeté</span>
        </div>
      </div>`;
  }

  let date = getTweetDate(tweet["date"]);
  let div = `<!-- Tweet classique -->
  <div ${class_tweet} id="${rt}${tweet["rt_id"]}${tweet["tweet_id"]}">
  ${rt_msg} ${pin_msg}
    <div class="row">
      <div class="two columns">
        <div class="tweet__profil_image ${tweet["user_id"]}">
          <img src="../../../css/img/pp/${profile_pic}.jpg">
        </div>
      </div>
      <div class="ten columns">
        <div class="tweet__info">
          <div class="tweet__info_name">
            <b id="fullname">${tweet["fullname"]}</b>
            <span id='verified-${rt}${tweet["rt_id"]}${tweet["tweet_id"]}'>
            </span>
          </div>
          <div class="tweet__info_username">
            <p><span class='username' id="${tweet["username"]}"><a class='color-theme user-to-search'>@${tweet["username"]}</a></span> • <span class='date_tweet' id='${tweet["date"]}'>${date}.</span> ${pin_menu} </p>
          </div>
        </div>
        ${content_and_buttons}
      </div>
    </div>
  </div>`;

  $("#tweet").append(div);
  if (tweet["verified"] == "1") {
    let verifiedLogo = `<svg viewBox="0 0 24 24" class="certified-sm color-theme"><g><path d="M22.5 12.5c0-1.58-.875-2.95-2.148-3.6.154-.435.238-.905.238-1.4 0-2.21-1.71-3.998-3.818-3.998-.47 0-.92.084-1.336.25C14.818 2.415 13.51 1.5 12 1.5s-2.816.917-3.437 2.25c-.415-.165-.866-.25-1.336-.25-2.11 0-3.818 1.79-3.818 4 0 .494.083.964.237 1.4-1.272.65-2.147 2.018-2.147 3.6 0 1.495.782 2.798 1.942 3.486-.02.17-.032.34-.032.514 0 2.21 1.708 4 3.818 4 .47 0 .92-.086 1.335-.25.62 1.334 1.926 2.25 3.437 2.25 1.512 0 2.818-.916 3.437-2.25.415.163.865.248 1.336.248 2.11 0 3.818-1.79 3.818-4 0-.174-.012-.344-.033-.513 1.158-.687 1.943-1.99 1.943-3.484zm-6.616-3.334l-4.334 6.5c-.145.217-.382.334-.625.334-.143 0-.288-.04-.416-.126l-.115-.094-2.415-2.415c-.293-.293-.293-.768 0-1.06s.768-.294 1.06 0l1.77 1.767 3.825-5.74c.23-.345.696-.436 1.04-.207.346.23.44.696.21 1.04z"></path></g></svg>`;
    let id_verified = `#verified-${rt}${tweet["rt_id"]}${tweet["tweet_id"]}`;
    $(id_verified).append(verifiedLogo);
  }
  if (tweet["is_disabled"] == 1) {
    return false;
  }
  if (rt == "") {
    // myOnClick(`#rt-${tweet["tweet_id"]}`, retweetMenu, tweet["tweet_id"]);
    myOnClick(`#rt-${tweet['tweet_id']}`, retweet, tweet["tweet_id"]);
    myOnClick(`#reply-tweet-${tweet['tweet_id']}`, retweetComm, tweet["tweet_id"]);
  }
  if (pin_msg != "") {
    myOnClick(`#pin-${tweet["tweet_id"]}`, pinMenu, tweet["tweet_id"], "Unpin");
  } else if (pin_menu != "") {
    myOnClick(`#pin-${tweet["tweet_id"]}`, pinMenu, tweet["tweet_id"], "Pin");
  }

  let storage_color = localStorage.getItem("color-theme");
  if (storage_color) {
    changeColor(storage_color);
  }
  myOnClick(`.tag-to-search`, searchTagAndTweets);
  myOnClick(`.user-to-search`, setLocalProfile);
}

//====== CREATE TAG LINKS ====
function createTagLinks(arr) {
  arr = arr.split(" ");
  $.each(arr, function (i, v) {
    if (v.charAt(0) == "#" && v.length > 1) {
      arr[i] = v.replace(v, `<a class='color-theme tag-to-search'>${v}</a>`);
      // myOnClick(`.tag-to-search`, searchTagAndTweets);
    }
  });
  return arr.join(" ");
}

function createUserLinks(arr) {
  arr = arr.split(" ");
  $.each(arr, function (i, v) {
    if (v.charAt(0) == "@" && v.length > 1) {
      arr[i] = v.replace(v, `<a class='color-theme user-to-search'>${v}</a>`);
      // myOnClick(`.user-to-search`, setLocalProfile);
    }
  });
  return arr.join(" ");
}

// ==== PIN AND DELETE TWEETS =====
let i = 0;
function pinMenu(e, here, tweet_id, option = "Pin") {
  if (!(i % 2)) {
    $("#pin-menu").remove();
    let pin = "pin";
    let del = "del";
    let pin_menu = `<div id='pin-menu' style='position: relative;'>
    <button id='${pin}'>${option} this tweet</button></br>
    <button id='${del}'>Delete this tweet</button>
    </div>`;
    $(`#${here.id}`).after(pin_menu);
    if (option == "Pin") {
      myOnClick(`#${pin}`, pinTweet, tweet_id);
    } else {
      myOnClick(`#${pin}`, unpinTweet, tweet_id);
    }
    myOnClick(`#${del}`, delTweet, tweet_id);
  } else {
    $("#pin-menu").remove();
  }
  i++;
}

function getHtmlRepliedTo(tweet) {
  console.log(tweet);

  let class_tweet = "class='tweet'";
  let rt_msg = "";
  let rt_div = "";
  let verifiedLogo = "";
  if (tweet["verified_origin"] == "1") {
    verifiedLogo = `<svg viewBox="0 0 24 24" class="certified-sm color-theme"><g><path d="M22.5 12.5c0-1.58-.875-2.95-2.148-3.6.154-.435.238-.905.238-1.4 0-2.21-1.71-3.998-3.818-3.998-.47 0-.92.084-1.336.25C14.818 2.415 13.51 1.5 12 1.5s-2.816.917-3.437 2.25c-.415-.165-.866-.25-1.336-.25-2.11 0-3.818 1.79-3.818 4 0 .494.083.964.237 1.4-1.272.65-2.147 2.018-2.147 3.6 0 1.495.782 2.798 1.942 3.486-.02.17-.032.34-.032.514 0 2.21 1.708 4 3.818 4 .47 0 .92-.086 1.335-.25.62 1.334 1.926 2.25 3.437 2.25 1.512 0 2.818-.916 3.437-2.25.415.163.865.248 1.336.248 2.11 0 3.818-1.79 3.818-4 0-.174-.012-.344-.033-.513 1.158-.687 1.943-1.99 1.943-3.484zm-6.616-3.334l-4.334 6.5c-.145.217-.382.334-.625.334-.143 0-.288-.04-.416-.126l-.115-.094-2.415-2.415c-.293-.293-.293-.768 0-1.06s.768-.294 1.06 0l1.77 1.767 3.825-5.74c.23-.345.696-.436 1.04-.207.346.23.44.696.21 1.04z"></path></g></svg>`;
  }
  rt_div = `<svg viewBox="0 0 24 24" class="logo-opt" id="rt-${tweet["tweet_id_origin"]}"><g><path d="M23.77 15.67c-.292-.293-.767-.293-1.06 0l-2.22 2.22V7.65c0-2.068-1.683-3.75-3.75-3.75h-5.85c-.414 0-.75.336-.75.75s.336.75.75.75h5.85c1.24 0 2.25 1.01 2.25 2.25v10.24l-2.22-2.22c-.293-.293-.768-.293-1.06 0s-.294.768 0 1.06l3.5 3.5c.145.147.337.22.53.22s.383-.072.53-.22l3.5-3.5c.294-.292.294-.767 0-1.06zm-10.66 3.28H7.26c-1.24 0-2.25-1.01-2.25-2.25V6.46l2.22 2.22c.148.147.34.22.532.22s.384-.073.53-.22c.293-.293.293-.768 0-1.06l-3.5-3.5c-.293-.294-.768-.294-1.06 0l-3.5 3.5c-.294.292-.294.767 0 1.06s.767.293 1.06 0l2.22-2.22V16.7c0 2.068 1.683 3.75 3.75 3.75h5.85c.414 0 .75-.336.75-.75s-.337-.75-.75-.75z"></path></g>`;
  let content_origin = tweet["content_origin"];
  //CREATION DES LIENS HASHTAGS
  if (content_origin && content_origin.match(/#[a-zA-Z]+/g)) {
    content_origin = createTagLinks(content_origin);
  }
  if (content_origin && content_origin.match(/@[a-zA-Z]+/g)) {
    content_origin = createUserLinks(content_origin);
  }
  let content = `<div class="tweet__message"> 
      <p>${content_origin}</p>
    </div>`;
  if (tweet["is_disabled_origin"] == "1") {
    content = `<h3>This tweet has been deleted.</h3>`;
  }
  if (!tweet["rt_id"]) {
    tweet["rt_id"] = "";
  }
  let date = getTweetDate(tweet["date_origin"]);
  let div = `<!-- Tweet Origin -->
  <div ${class_tweet} id="origin-${tweet["rt_id"]}${tweet["tweet_id"]}" style='margin-bottom: 2vw;'>
    <div class="row">
      <div class="two columns">
        <div class="tweet__profil_image ${tweet["user_id_origin"]}">
          <img src="../../../css/img/pp/${tweet['user_id_origin']}.jpg">
        </div>
      </div>
      <div class="ten columns">
        <div class="tweet__info">
          <div class="tweet__info_name">
            <b id="fullname">${tweet["fullname_origin"]}</b>
            <span id='verified-origin-${tweet["rt_id"]}${tweet["tweet_id_origin"]}'>
            ${verifiedLogo}
            </span>
          </div>
          <div class="tweet__info_username">
            <p><span class='username' id="${tweet["username_origin"]}"><a class='color-theme user-to-search'>@${tweet["username_origin"]}</a></span>• <span class='date_tweet' id='${tweet["date_origin"]}'>${date}.</span> </p>
          </div>
        </div>
        ${content}
      </div>
    </div>
  </div>`;
  console.log("returning origin tweet");
  return div;
}

function pinTweet(e, here, tweet_id) {
  ajaxSet("../../handler/user/setPinTweet.php", tweet_id).then(response => {
    refresh();
  });
}
function unpinTweet(e, here, tweet_id) {
  ajaxSet("../../handler/user/setUnpinTweet.php", tweet_id).then(response => {
    refresh();
  });
}
function delTweet(e, here, tweet_id) {
  ajaxSet("../../handler/tweet/delTweet.php", tweet_id).then(response => {
    refresh();
  });
}

//Showing and Hiding Div with Toggle
let incrementToggle = 0;
function toggleInputThenHide(e, here, id) {
  if (!(incrementToggle % 2)) {
    $(id).slideToggle("slow");
  } else {
    $(id).slideToggle("slow");
  }
  incrementToggle++;
}

// === DISPLAY USER LOGGED IN PAGE IF CLICKED FROM LEFT MENU
function setLocalProfile(e, here) {
  username = here.innerHTML.slice(1);
  console.log(e);
  console.log(here);

  if (here.id == "profile_from_left_menu") {
    console.log("reset");
    localStorage.setItem("username", user_id);
    window.location.href = "../user/user.php";
  } else {
    ajaxGet("../../handler/user/getVerifBeforeUserPage.php", username).then(
      user => {
        console.log();
        if (user && user.length > 0) {
          localStorage.setItem("username", username);
          window.location.href = "../user/user.php";
        } else {
          alert("This user doesnt exist.");
        }
      }
    );
  }
}
//Get Profile of User Logged In By Clicking "Profile" On left Menu
$(document).ready(function () {
  myOnClick("#profile_from_left_menu", setLocalProfile);
});

// ==== FOLLOWERS & FOLLOWINGS (by Andriy) =====

// FOLLOWINGS
function displayAllFollowings(allFollowings) {
  console.log("Displayig all followings....");
  for (let i = 0; i < allFollowings.length; i++) {
    displayFollowing(allFollowings[i]);
  }
  let storage_color = localStorage.getItem("color-theme");
  if (storage_color) {
    changeColor(storage_color);
  }
  myOnClick(`.user-to-search`, setLocalProfile);
}

function displayFollowing(following) {
  let btn_desabo = "";
  if (localStorage.user_id_follow == user_id) {
    btn_desabo = `<button class="button-primary btn-abo btn-color-theme-primary">Se désabonner</button>`;
  }
  //launch this on search of while visiting someone profile
  let bio = "Pas de bio disponible.";
  if (following["bio"] != null) {
    bio = following["bio"];
  }
  let div = `<div class="following-box row" id="follower${following["id"]}">
  <div class="two columns">
    <div class="profil_image">
      <img class="roundedImage" src="../../../css/img/face.jpg">
    </div>
  </div>
  <div class="ten columns">
    <div class="profil__info">
      <div class="profil__info_name" id="verified-${following["id"]}">
        <b>${following["fullname"]}</b>
      </div>
      <div class="following__info_username">
        <p><a class='color-theme user-to-search'>@${following["username"]}</a></p>
      </div>
    </div>
    <div class="following__info_bio">
      <p>${bio}</p>
      ${btn_desabo}
    </div>
  </div>
</div>`;
  if (following["disabled"] == "0") {
    $(".all-follow").append(div);
    if (following["verified"] == "1") {
      let verifiedLogo = `<svg viewBox="0 0 24 24" class="certified-sm"><g><path d="M22.5 12.5c0-1.58-.875-2.95-2.148-3.6.154-.435.238-.905.238-1.4 0-2.21-1.71-3.998-3.818-3.998-.47 0-.92.084-1.336.25C14.818 2.415 13.51 1.5 12 1.5s-2.816.917-3.437 2.25c-.415-.165-.866-.25-1.336-.25-2.11 0-3.818 1.79-3.818 4 0 .494.083.964.237 1.4-1.272.65-2.147 2.018-2.147 3.6 0 1.495.782 2.798 1.942 3.486-.02.17-.032.34-.032.514 0 2.21 1.708 4 3.818 4 .47 0 .92-.086 1.335-.25.62 1.334 1.926 2.25 3.437 2.25 1.512 0 2.818-.916 3.437-2.25.415.163.865.248 1.336.248 2.11 0 3.818-1.79 3.818-4 0-.174-.012-.344-.033-.513 1.158-.687 1.943-1.99 1.943-3.484zm-6.616-3.334l-4.334 6.5c-.145.217-.382.334-.625.334-.143 0-.288-.04-.416-.126l-.115-.094-2.415-2.415c-.293-.293-.293-.768 0-1.06s.768-.294 1.06 0l1.77 1.767 3.825-5.74c.23-.345.696-.436 1.04-.207.346.23.44.696.21 1.04z"></path></g></svg>`;
      let id_verified = `#verified-${following["id"]}`;
      $(id_verified).append(verifiedLogo);
    }
  }
}

// FOLLOWERS
function displayAllFollowers(allFollowers) {
  console.log("Displayig all followers....");
  for (let i = 0; i < allFollowers.length; i++) {
    displayFollower(allFollowers[i]);
  }
  let storage_color = localStorage.getItem("color-theme");
  if (storage_color) {
    changeColor(storage_color);
  }
  myOnClick(`.user-to-search`, setLocalProfile);
}

function displayFollower(follower) {
  //launch this on search of while visiting someone profile
  let bio = "Pas de bio disponible.";
  if (follower["bio"] != null) {
    bio = follower["bio"];
  }
  let div = `<div class="following-box row" id="follower${follower["id"]}">
  <div class="two columns">
    <div class="profil_image">
      <img class="roundedImage" src="../../../css/img/face.jpg">
    </div>
  </div>
  <div class="ten columns">
    <div class="profil__info">
      <div class="profil__info_name" id="verified-${follower["id"]}">
        <b>${follower["fullname"]}</b>
      </div>
      <div class="following__info_username">
        <p><a class='color-theme user-to-search'>@${follower["username"]}</a></p>
      </div>
    </div>
    <div class="following__info_bio">
      <p>${bio}</p>
    </div>
  </div>
</div>`;

  if (follower["disabled"] == "0") {
    $(".all-follow").append(div);
    if (follower["verified"] == "1") {
      let verifiedLogo = `<svg viewBox="0 0 24 24" class="certified-sm"><g><path d="M22.5 12.5c0-1.58-.875-2.95-2.148-3.6.154-.435.238-.905.238-1.4 0-2.21-1.71-3.998-3.818-3.998-.47 0-.92.084-1.336.25C14.818 2.415 13.51 1.5 12 1.5s-2.816.917-3.437 2.25c-.415-.165-.866-.25-1.336-.25-2.11 0-3.818 1.79-3.818 4 0 .494.083.964.237 1.4-1.272.65-2.147 2.018-2.147 3.6 0 1.495.782 2.798 1.942 3.486-.02.17-.032.34-.032.514 0 2.21 1.708 4 3.818 4 .47 0 .92-.086 1.335-.25.62 1.334 1.926 2.25 3.437 2.25 1.512 0 2.818-.916 3.437-2.25.415.163.865.248 1.336.248 2.11 0 3.818-1.79 3.818-4 0-.174-.012-.344-.033-.513 1.158-.687 1.943-1.99 1.943-3.484zm-6.616-3.334l-4.334 6.5c-.145.217-.382.334-.625.334-.143 0-.288-.04-.416-.126l-.115-.094-2.415-2.415c-.293-.293-.293-.768 0-1.06s.768-.294 1.06 0l1.77 1.767 3.825-5.74c.23-.345.696-.436 1.04-.207.346.23.44.696.21 1.04z"></path></g></svg>`;
      let id_verified = `#verified-${follower["id"]}`;
      $(id_verified).append(verifiedLogo);
    }
  }
}

// REDIRECTION USERPAGE
function redirectionUserpage() {
  $("[id^='verified-']").click(function () {
    let id = $(this)
      .parent()
      .parent()
      .parent()
      .attr("id");
    id = id.substr(8);
    console.log(id);
  });
}

$(document).ready(function () {
  if (document.location.href.match(/[^\/]+$/) && document.location.href.match(/[^\/]+$/)[0] != "index.php") {
    if (user_id) {
      $('#up_bar_img').attr("src", `../../../css/img/pp/${user_id}.jpg`);
      $('#profile_from_left_menu_img').attr("src", `../../../css/img/pp/${user_id}.jpg`);
    }
  }
})