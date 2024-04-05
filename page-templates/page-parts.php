<?php
    // Template Name: ページパーツ
    /**
    * @package WordPress
    * @subpackage projectname
    * @since 2024
    */

    if ( !defined('ABSPATH') ) {
        die( 'Forbidden' );
    }
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset=UTF-8>
<title>ページパーツ｜プロジェクト名</title>
<meta name=description content="★サイトディスクリプション">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, height=device-height ,initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
<link rel="icon" type="image/x-icon" href="./assets/images/favicon.ico">
<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<meta name="author" content="★サイト管理者">
<meta name="copyright" content="Copyright (C) ★★★★★★. All Rights Reserved.">
<meta property="og:site_name" content="★サイトタイトル">
<meta property="og:type" content="website">
<meta property="og:title" content="★サイトタイトル">
<meta property="og:url" content="★サイトURL">
<meta property="og:image" content="★OGPイメージのURLを絶対パスで入力">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta property="og:site_name" content="★サイトタイトル">
<meta property="og:description" content="★サイトディスクリプション">
<meta name="twitter:card" content="summary_large_image">
<link rel="stylesheet" href="<?php echo esc_url(get_template_directory_uri());?>/assets/css/style.css">
<style>
    body{
        padding: 4.0rem;
    }
    .parts-title{
        font-size: 2.4rem;
        margin-bottom: 4.0rem;
    }
    .parts-subtitle{
        font-size: 2.0rem;
        margin-bottom: 2.0rem;
        border-left: 4px solid #CCC;
        padding-left: 1.6rem;
    }
    .l-parts-index{
        margin-bottom: 8.0rem;
        border: 1px solid #CCC;
        padding: 1.6rem;
    }
    .l-parts-index li{
        list-style-type: disc;
        list-style-position: inside;
    }
    .l-parts-section{
        margin-bottom: 8.0rem;
    }
    .l-parts-block{
        margin-bottom: 4.0rem;
    }
    .l-parts-block dt{
        margin-bottom: .8rem;
    }
    .l-parts-block dd{

    }
    .parts-button{
        border: 1px solid #CCC;
        padding: .8rem 1.6rem;
        background: linear-gradient(180deg, #FFF, #EEE);
    }
    .l-parts-content{
        border: 1px solid #CCC;
        padding: 1.6rem;
        background: #F6F6F6;
    }
    .l-parts-content.is-wrapshort{
        width: 50%;
    }
    .l-parts-content.is-wrapdark{
        background-color: #e8f8ff;
    }
    .l-parts-copybtn{
        padding-top: 1.6rem;
    }
    .l-color-box{
        border: 1px solid #000;
        padding: 40px;
    }
</style>
</head>
<body class="is-home">
    <h1 class="parts-title">ページパーツ一覧</h1>

    <ul class="l-parts-index" name="headlines"></ul>

    <section class="l-parts-section">
        <h2 class="parts-subtitle" name="partsHeadLine" id="colors">カラー一覧</h2>
        <dl class="l-parts-block">
            <dt>var(--color-main);</dt>
            <dd class="l-parts-content" name="copyTarget">
                <div class="l-color-box" style="background-color:var(--color-main);color:#ffffff;">#17339c</div>
            </dd>
            <dt>var(--color-txt);</dt>
            <dd class="l-parts-content" name="copyTarget">
                <div class="l-color-box" style="background-color:var(--color-txt);color:#ffffff;">#333333</div>
            </dd>
        </dl>
    </section>

    <section class="l-parts-section">
        <h2 class="parts-subtitle" name="partsHeadLine" id="btns">タイトル</h2>
        <dl class="l-parts-block">
            <dt>ページタイトル（.c-ttl__page）</dt>
            <dd class="l-parts-content" name="copyTarget">
                <div class="c-ttl__page">
                    <p class="c-ttl__page__ja">ページタイトル</p>
                    <p class="c-ttl__page__en">PAGE TITLE</p>
                </div>
            </dd>
            <dd class="l-parts-copybtn"><button class="parts-button" name="copyBtn">コードをコピー</button></dd>
        </dl>
        <dl class="l-parts-block">
            <dt>コンテンツタイトル（.c-hline）</dt>
            <dd class="l-parts-content" name="copyTarget">
                <div class="c-hline">
                    <p class="c-hline__sub">コンテンツタイトル</p>
                    <p class="c-hline__main">コンテンツタイトル</p>
                    <p class="c-hline__en">CONTENT TITLE</p>
                </div>
            </dd>
            <dd class="l-parts-copybtn"><button class="parts-button" name="copyBtn">コードをコピー</button></dd>
        </dl>
        <dl class="l-parts-block">
            <dt>コンテンツタイトル白（.c-hline is-wht）</dt>
            <dd class="l-parts-content is-wrapdark" name="copyTarget">
                <div class="c-hline is-wht">
                    <p class="c-hline__sub">コンテンツタイトル</p>
                    <p class="c-hline__main">コンテンツタイトル</p>
                    <p class="c-hline__en">CONTENT TITLE</p>
                </div>
            </dd>
            <dd class="l-parts-copybtn"><button class="parts-button" name="copyBtn">コードをコピー</button></dd>
        </dl>
        <dl class="l-parts-block">
            <dt>破線付きタイトル（.c-hline__dashed）</dt>
            <dd class="l-parts-content" name="copyTarget">
                <p class="c-hline__dashed">コンテンツタイトル</p>
            </dd>
            <dd class="l-parts-copybtn"><button class="parts-button" name="copyBtn">コードをコピー</button></dd>
        </dl>
    </section>

    <section class="l-parts-section">
        <h2 class="parts-subtitle" name="partsHeadLine" id="headline">ボタン</h2>
        <dl class="l-parts-block">
            <dt>メインカラーボタン（.c-btn__oval）(.c-btn__oval .has-shadow)</dt>
            <dd class="l-parts-content" name="copyTarget">
                <a href="" class="c-btn__oval">ボタンテキスト</a>
            </dd>
            <dd class="l-parts-copybtn"><button class="parts-button" name="copyBtn">コードをコピー</button></dd>
            <dd class="l-parts-content" name="copyTarget" style="margin-top:1.6rem;">
                <a href="" class="c-btn__oval has-shadow">ボタンテキスト</a>
            </dd>
            <dd class="l-parts-copybtn"><button class="parts-button" name="copyBtn">コードをコピー</button></dd>
        </dl>
        <dl class="l-parts-block">
            <dt>白ボタン（.c-btn__oval .is-wht）</dt>
            <dd class="l-parts-content" name="copyTarget">
                <a href="" class="c-btn__oval is-wht">
                    <span>ボタンテキスト</span>
                </a>
            </dd>
            <dd class="l-parts-copybtn"><button class="parts-button" name="copyBtn">コードをコピー</button></dd>
        </dl>
        <dl class="l-parts-block">
            <dt>薄青ボタン（.c-btn__oval .is-paleblue）</dt>
            <dd class="l-parts-content" name="copyTarget">
                <a href="" class="c-btn__oval is-paleblue">
                    <span>ボタンテキスト</span>
                </a>
            </dd>
            <dd class="l-parts-copybtn"><button class="parts-button" name="copyBtn">コードをコピー</button></dd>
        </dl>
        <dl class="l-parts-block">
            <dt>三角アイコン（下）（.c-btn__oval .has-icon__tri-down）</dt>
            <dd class="l-parts-content" name="copyTarget">
                <a href="" class="c-btn__oval">
                    <span>ボタンテキスト<i class="c-btn__oval__icon is-tri-down"></i></span>
                </a>
            </dd>
            <dd class="l-parts-copybtn"><button class="parts-button" name="copyBtn">コードをコピー</button></dd>
        </dl>
        <dl class="l-parts-block">
            <dt>三角アイコン（右）（.c-btn__oval .has-icon__tri-right）</dt>
            <dd class="l-parts-content" name="copyTarget">
                <a href="" class="c-btn__oval">
                    <span>ボタンテキスト<i class="c-btn__oval__icon is-tri-right"></i></span>
                </a>
            </dd>
            <dd class="l-parts-copybtn"><button class="parts-button" name="copyBtn">コードをコピー</button></dd>
        </dl>
        <dl class="l-parts-block">
            <dt>＞アイコン（右）（.c-btn__oval .has-icon__arrow）（.c-btn__oval .is-wht .has-icon__arrow）</dt>
            <dd class="l-parts-content" name="copyTarget">
                <a href="" class="c-btn__oval">
                    <span>ボタンテキスト<i class="c-btn__oval__icon is-arrow"></i></span>
                </a>
            </dd>
            <dd class="l-parts-copybtn"><button class="parts-button" name="copyBtn">コードをコピー</button></dd>
            <dd class="l-parts-content" name="copyTarget" style="margin-top:1.6rem;">
                <a href="" class="c-btn__oval is-wht">
                    <span>ボタンテキスト<i class="c-btn__oval__icon is-arrow"></i></span>
                </a>
            </dd>
            <dd class="l-parts-copybtn"><button class="parts-button" name="copyBtn">コードをコピー</button></dd>
        </dl>
        <dl class="l-parts-block">
            <dt>＋アイコン（.c-btn__oval .has-icon__plus）</dt>
            <dd class="l-parts-content" name="copyTarget">
                <a href="" class="c-btn__oval is-wht">
                    <span>ボタンテキスト<i class="c-btn__oval__icon is-plus"></i></span>
                </a>
            </dd>
            <dd class="l-parts-copybtn"><button class="parts-button" name="copyBtn">コードをコピー</button></dd>
        </dl>
        <dl class="l-parts-block">
            <dt>prevボタン（.c-btn__circle .go-prev）</dt>
            <dd class="l-parts-content" name="copyTarget" style="width:10.0rem;">
                <a href="" class="c-btn__circle is-wht go-prev"></a>
            </dd>
            <dd class="l-parts-copybtn"><button class="parts-button" name="copyBtn">コードをコピー</button></dd>
        </dl>
        <dl class="l-parts-block">
            <dt>nextボタン（.c-btn__circle .go-next）</dt>
            <dd class="l-parts-content" name="copyTarget" style="width:10.0rem;">
                <a href="" class="c-btn__circle is-wht go-next"></a>
            </dd>
            <dd class="l-parts-copybtn"><button class="parts-button" name="copyBtn">コードをコピー</button></dd>
        </dl>
        <dl class="l-parts-block">
            <dt>ページトップ（.c-btn__pagetop）</dt>
            <dd class="l-parts-content" name="copyTarget">
                <a href="" class="c-btn__pagetop">ページの先頭へ</a>
            </dd>
            <dd class="l-parts-copybtn"><button class="parts-button" name="copyBtn">コードをコピー</button></dd>
        </dl>
    </section>


    <script>
        var copyBtns = document.querySelectorAll('[name="copyBtn"]');

        for(var i = 0; i < copyBtns.length; i++){
            copyBtns[i].addEventListener('click', function(){
                var parent = this.parentElement.parentElement;
                var target = parent.querySelector('[name="copyTarget"]');
                var code = target.innerHTML;
                // codeをクリップボードにコピー
                if (navigator.clipboard) { // サポートしているかを確認
                    navigator.clipboard.writeText(code);
                }else{
                    console.log('test');
                }
            });
        }

        var headlines = document.querySelectorAll('[name="headlines"]');
        var headline = document.querySelectorAll('[name="partsHeadLine"]');

        for(var i = 0; i < headline.length; i++){
            var headlineText = headline[i].textContent;
            var headlineId = headline[i].id;
            var li = document.createElement('li');
            var a = document.createElement('a');
            a.textContent = headlineText;
            a.href = '#' + headlineId;
            li.appendChild(a);
            headlines[0].appendChild(li);
        }

    </script>
    <script src="<?php echo esc_url(get_template_directory_uri());?>/assets/js/bundle.js"></script>
</body>
</html>