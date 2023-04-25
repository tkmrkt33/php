jQuery(function (e) { e(".gallery").each(function () { e(this).modaal({ type: "image" }) }), e(".header-button").on("click", function () { e("body").toggleClass("open") }) });


window.onload = function () {
  $(".schedule ul li h3").on("click", function () {
    $(this).next().slideToggle();
    $(this).toggleClass("open");
  });
};


$('a[href*="#"]').click(function () {//全てのページ内リンクに適用させたい場合はa[href*="#"]のみでもOK
  var elmHash = $(this).attr('href'); //ページ内リンクのHTMLタグhrefから、リンクされているエリアidの値を取得
  var pos = $(elmHash).offset().top;	//idの上部の距離を取得
  $('body,html').animate({ scrollTop: pos }, 500); //取得した位置にスクロール。500の数値が大きくなるほどゆっくりスクロール
  return false;
});


jQuery(
  function (e) {
    e(".header-gnav a").on("click", function () { e("body").removeClass("open") })
  }
);

