$('#page-link a[href*="#"]').click(function () {
  var elmHash = $(this).attr('href'); //ページ内リンクのHTMLタグhrefから、リンクされているエリアidの値を取得
  var pos = $(elmHash).offset().top - 70;//idの上部の距離からHeaderの高さを引いた値を取得
  $('body,html').animate({ scrollTop: pos }, 500); //取得した位置にスクロール。500の数値が大きくなるほどゆっくりスクロール
  return false;
});

// $(".slide-items").slick();
$('.slide-items').slick({
  autoplay: true,//自動的に動き出すか。初期値はfalse。
  autoplaySpeed: 4000,//次のスライドに切り替わる待ち時間
  speed: 1500,//スライドの動きのスピード。初期値は300。
  infinite: true,//スライドをループさせるかどうか。初期値はtrue。
  arrows: true,//左右の矢印あり
  prevArrow: '<div class="slick-prev"></div>',//矢印部分PreviewのHTMLを変更
  nextArrow: '<div class="slick-next"></div>',//矢印部分NextのHTMLを変更
  dots: true,//下部ドットナビゲーションの表示
  centerMode: true,
  centerPadding: "25%",
});

//スマホ用：スライダーをタッチしても止めずにスライドをさせたい場合
$('.slide-items').on('touchmove', function (event, slick, currentSlide, nextSlide) {
  $('.slide-items').slick('slickPlay');
});

