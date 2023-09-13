const ham = document.querySelector('#js-hamburger'); //js-hamburgerの要素を取得し、変数hamに格納
const nav = document.querySelector('#js-nav'); //js-navの要素を取得し、変数navに格納
const a = document.querySelector('#js-a');
const b = document.querySelector('#js-b');
const c = document.querySelector('#js-c');
const d = document.querySelector('#js-d');
const e = document.querySelector('#js-e');
const f = document.querySelector('#js-f');

ham.addEventListener('click', function () { //ハンバーガーメニューをクリックしたら
    ham.classList.toggle('active'); // ハンバーガーメニューにactiveクラスを付け外し
    nav.classList.toggle('active'); // ナビゲーションメニューにactiveクラスを付け外し
});

nav.addEventListener('click', function(){
    nav.classList.toggle('active'); // ハンバーガーメニューにactiveクラスを付け外し
    ham.classList.toggle('active'); // ナビゲーションメニューにactiveクラスを付け外し
    nav.classList.remove('active');
});

a.addEventListener('click', function(){
    nav.classList.toggle('active'); // ハンバーガーメニューにactiveクラスを付け外し
    ham.classList.toggle('active'); // ナビゲーションメニューにactiveクラスを付け外し
    nav.classList.remove('active');
});
b.addEventListener('click', function(){
    nav.classList.toggle('active'); // ハンバーガーメニューにactiveクラスを付け外し
    ham.classList.toggle('active'); // ナビゲーションメニューにactiveクラスを付け外し
    nav.classList.remove('active');
});
c.addEventListener('click', function(){
    nav.classList.toggle('active'); // ハンバーガーメニューにactiveクラスを付け外し
    ham.classList.toggle('active'); // ナビゲーションメニューにactiveクラスを付け外し
    nav.classList.remove('active');
});
d.addEventListener('click', function(){
    nav.classList.toggle('active'); // ハンバーガーメニューにactiveクラスを付け外し
    ham.classList.toggle('active'); // ナビゲーションメニューにactiveクラスを付け外し
    nav.classList.remove('active');
});
e.addEventListener('click', function(){
    nav.classList.toggle('active'); // ハンバーガーメニューにactiveクラスを付け外し
    ham.classList.toggle('active'); // ナビゲーションメニューにactiveクラスを付け外し
    nav.classList.remove('active');
});
f.addEventListener('click', function(){
    nav.classList.toggle('active'); // ハンバーガーメニューにactiveクラスを付け外し
    ham.classList.toggle('active'); // ナビゲーションメニューにactiveクラスを付け外し
    nav.classList.remove('active');
});