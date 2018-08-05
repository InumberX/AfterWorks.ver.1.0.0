/** userAgent */
/**
var ua = {};
ua.name = window.navigator.userAgent.toLowerCase();

ua.isIE = (ua.name.indexOf('msie') >= 0 || ua.name.indexOf('trident') >= 0);
ua.isiPhone = ua.name.indexOf('iphone') >= 0;
ua.isiPod = ua.name.indexOf('ipod') >= 0;
ua.isiPad = ua.name.indexOf('ipad') >= 0;
ua.isiOS = (ua.isiPhone || ua.isiPod || ua.isiPad);
ua.isAndroid = ua.name.indexOf('android') >= 0;
ua.isTablet = (ua.isiPad || (ua.isAndroid && ua.name.indexOf('mobile') < 0));
*/

$(function(){

  $(function() {
    var $header = $('#top-head');
    /*
    // Nav Fixed
    $(window).scroll(function() {
      if ($(window).scrollTop() > 150) {
        $header.addClass('fixed');
      } else {
        $header.removeClass('fixed');
      }
    });*/

    // Nav Toggle Button
    $('#nav-toggle').click(function(){
      $header.toggleClass('open');
    });
  });

  // スムーズスクロール部分の記述
  // #で始まるアンカーをクリックした場合に処理
  $('a[href^=#]').click(function() {
    // スクロールの速度
    // ミリ秒
    var speed = 400;
    // アンカーの値取得
    var href= $(this).attr("href");
    // 移動先を取得
    var target = $(href == "#" || href == "" ? 'html' : href);
    // 移動先を数値で取得
    var position = target.offset().top;
    // スムーススクロール
    $('body,html').animate({scrollTop:position}, speed, 'swing');
    // メニューを閉じる
    var $header = $('#top-head');
    $header.toggleClass('open');
    return false;
  });

  // 「PAGE TOP」ボタン押下時の処理
  var topBtn = $('#page-top');
  topBtn.hide();
  //スクロールが100に達したらボタン表示
  $(window).scroll(function () {
    if ($(this).scrollTop() > 100) {
      topBtn.fadeIn();
    } else {
      topBtn.fadeOut();
    }
  });

  //スクロールしてトップ
  topBtn.click(function () {
    $('body,html').animate({
      scrollTop: 0
    }, 500);
    return false;
  });

  /*
  // 菱形の画像を生成する処理
  $(".diamondswrap").diamonds({
    //画像サイズ
    size : 150,
    //マージン
    gap :  3,
    //レイアウト調整で最後のイメージを非表示にする
    hideIncompleteRow : true,
    //ウィンドウサイズリサイズの際に再配置
    autoRedraw : true,
    //適用するCSS
    itemSelector : ".item"
  });
  */

});
