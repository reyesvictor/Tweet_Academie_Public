function trendTag() {
  ajaxGet('../../handler/tweet/trendingTag.php', 'trending_tag').then( list =>  {
    let div = '';
    for (let i = 0; i < list.length; i++) {
      div = div.concat(`<div id='list[i]' class='trending' column><a class='color-theme tag-to-search'>${list[i]['tagName']}</a> (${list[i]['Number']})</div>`);
    }
    $('#trend-tag-container').append(div);
  })
}

$(document).ready(function(){
  trendTag();
})