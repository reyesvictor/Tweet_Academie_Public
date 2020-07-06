// Couleur theme
let blue= "#1EAEDB"
let green= "#17bf63"
let purple= "rgb(121, 75, 196)"
let red= "#DA413D"

function changeColor(color_theme) {
  $(".btn-color-theme-primary").css("background-color", color_theme);
  $(".btn-color-theme-primary").css("border-color", color_theme);
  $(".btn-color-theme").css("border-color", color_theme)
  $(".color-theme").css("color", color_theme)
  $(".color-theme").css("fill", color_theme)
  $(".selected").css("border-bottom", "4px solid "+color_theme)

  // // Pour les anchors hover, mais marche pas comme je voudrais...
  // $("a").hover(function() {
  //   $(this).css("color", color_theme)
  // }).mouseout(function(){
  //   $(this).css("color", "rgb (219,219,219)");
  // })
}

let theme_picker = false
  function loadColor() {
    let storage_color = localStorage.getItem("color-theme");
    if (storage_color){
      changeColor(storage_color)
    }
  }
$(document).ready(function(){
  
  loadColor();
  $("#change-theme-btn").click(function(){
    console.log('theme menu lancé');
    console.log(theme_picker);
    if (theme_picker == false) {
      $("#row-theme").removeClass("hide")
      theme_picker = true
    }
    else {
      $("#row-theme").toggleClass("hide")
      theme_picker = false
    }
  })

  $('#theme-blue').click(function(){
    color= blue
    changeColor(color);
    localStorage.setItem('color-theme', '#1EAEDB');
  })
  
  $('#theme-green').click(function(){
    color= green
    changeColor(color);
    localStorage.setItem('color-theme', '#17bf63');
  })

  $('#theme-purple').click(function(){
    color= purple
    changeColor(color);
    localStorage.setItem('color-theme', 'rgb(121, 75, 196)');
  })

  $('#theme-red').click(function(){
    color= red
    changeColor(color);
    localStorage.setItem('color-theme', '#DA413D');
  })
})

function chBackcolor(color) {
  document.body.style.background = color;
}
function chColor(color) {
  $('#menu-title').css("color", '#FFFFFF');
    $('#suggestion#1').css("color", '#FFFFFF');
    $('#suggestion#2').css("color", '#FFFFFF');
    $('#suggestion#3').css("color", '#FFFFFF');
    $('#suggestion#4').css("color", '#FFFFFF');
    $('#tweet').css("color", '#FFFFFF');
    $('#blanc').css("color", '#FFFFFF');
    $("li a").css("color", "#FFFFFF")
    $("li").css("color", "#FFFFFF")
    $("ul").css("fill", "#FFFFFF")
  }
function chColor2(color) {
  $('#menu-title').css("color", '#000000');
  $('#suggestion#1').css("color", '#000000');
  $('#suggestion#2').css("color", '#000000');
  $('#suggestion#3').css("color", '#000000');
  $('#suggestion#4').css("color", '#000000');
  $('#tweet').css("color", '#000000');
  $("li a").css("color", "#000000")
    $("li").css("color", "#000000")
    $("ul").css("fill", "#000000")
}