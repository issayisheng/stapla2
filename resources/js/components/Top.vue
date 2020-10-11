<template>
    <div class="home">
        <header class="header">
            <div class="header__container  container">
                <div class="header__logo">
                    <img :src="'img/common/logo.svg'" alt="stapla" />
                </div>
                <div class="header-main">
                    <ul class="header-nav list-unstyled">
                        <li class="header-nav__item">
                            <a href="">コンセプト</a>
                        </li>
                        <li class="header-nav__item">
                            <a href="">特徴</a>
                        </li>
                        <li class="header-nav__item">ご利用の流れ</li>
                    </ul>
                    <div class="header-form">
                        <router-link to="/login" class="header-form__login"
                            >ログイン</router-link
                        >
                        <router-link
                            to="/register"
                            class="header-form__register"
                            >新規登録</router-link
                        >
                    </div>
                </div>
            </div>
        </header>
        <div class="kv" :style="{ 'background-image': 'url(' + kvImage + ')' }">
            <div class="kv-main">
                <div class="container">
                    <div class="kv__title">
                        いつでも、<br />使える<span class="">個室ジム</span>
                    </div>
                    <div class="kv__desc">
                        staplaはレンタルジム専用予約サービスです。
                    </div>
                    <router-link to="/register" class="kv__btn"
                        >今すぐ登録する</router-link
                    >
                </div>
            </div>
        </div>
        <section class="concept section">
            <div class="container">
                <div class="section__title">
                    <p class="section__title--en">Concept</p>
                    <h2 class="section__title--ja">
                        コンセプト説明タイトルが入ります。<br />最大2行最大2行最大2行
                    </h2>
                </div>
                <div class="concept__content">
                    <div class="concept-body">
                        <div class="concept-body__desc">
                            この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。文字の大き
                        </div>
                    </div>
                    <div class="concept-image">
                        <img :src="'/img/top/concept.jpg'" alt="Concept" />
                    </div>
                </div>
            </div>
        </section>
        <section class="feature section">
            <div class="container">
                <div class="section__title">
                    <p class="section__title--en">Feature</p>
                    <h2 class="section__title--ja">
                        3つの特徴
                    </h2>
                </div>
                <div class="feature-items">
                    <div class="feature-item">
                        <img
                            :src="'/img/top/feature1.png'"
                            alt="エスクロー決済"
                            class="feature-item__img"
                        />
                        <h3 class="feature-item__title">エスクロー決済</h3>
                        <div class="feature-item__desc">
                            当事者間での金銭のやり取りはなく、クレジットカード安心してご利用いただけます。
                        </div>
                    </div>
                    <div class="feature-item">
                        <img
                            :src="'/img/top/feature2.png'"
                            alt="当日予約可能"
                            class="feature-item__img"
                        />
                        <h3 class="feature-item__title">当日予約可能</h3>
                        <div class="feature-item__desc">
                            予約時間の1分前まで取得可能です。今すぐ利用したい場合も大丈夫です！
                        </div>
                    </div>
                    <div class="feature-item">
                        <img
                            :src="'/img/top/feature3.png'"
                            alt="初期費用なし"
                            class="feature-item__img"
                        />
                        <h3 class="feature-item__title">初期費用なし</h3>
                        <div class="feature-item__desc">
                            ご登録・ご利用に関して初期費用は一切かかりません。お気軽にご登録ください。
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="flow section">
            <div class="container">
                <div class="section__title">
                    <p class="section__title--en">Flow</p>
                    <h2 class="section__title--ja">
                        ご利用の流れ
                    </h2>
                </div>
                <div class="flow-item">
                    <div class="flow-item-body">
                        <div class="flow-item-body__title">
                            <span class="flow-item-body__title--en">Step1</span>
                            <h3 class="flow-item-body__title--ja">
                                ジムを予約
                            </h3>
                        </div>
                        <div class="flow-item-body__desc">
                            24
                            時間のネット予約受付により、営業時間外の「予約の取りこぼし防止」はもちろん、あなたのビジネスの成長を支える機能やオプションを多数ご用意！リピーターを強化するメルマガ・DM
                            配信機能や、サービスの魅力を伝えるレビュー機能、広告の出稿をサポートする集客オプションなどをご用意しています。
                        </div>
                    </div>
                    <div class="flow-item-image">
                        <img alt="ジムを予約" src="/img/top/dummy2.jpg" />
                    </div>
                </div>
                <div class="flow-item">
                    <div class="flow-item-body">
                        <div class="flow-item-body__title">
                            <span class="flow-item-body__title--en">Step2</span>
                            <h3 class="flow-item-body__title--ja">
                                チケットを購入
                            </h3>
                        </div>
                        <div class="flow-item-body__desc">
                            24
                            時間のネット予約受付により、営業時間外の「予約の取りこぼし防止」はもちろん、あなたのビジネスの成長を支える機能やオプションを多数ご用意！リピーターを強化するメルマガ・DM
                            配信機能や、サービスの魅力を伝えるレビュー機能、広告の出稿をサポートする集客オプションなどをご用意しています。
                        </div>
                    </div>
                    <div class="flow-item-image">
                        <img alt="チケットを購入" src="/img/top/flow1.jpg" />
                    </div>
                </div>
                <div class="flow-item">
                    <div class="flow-item-body">
                        <div class="flow-item-body__title">
                            <span class="flow-item-body__title--en">Step3</span>
                            <h3 class="flow-item-body__title--ja">
                                利用開始
                            </h3>
                        </div>
                        <div class="flow-item-body__desc">
                            24
                            時間のネット予約受付により、営業時間外の「予約の取りこぼし防止」はもちろん、あなたのビジネスの成長を支える機能やオプションを多数ご用意！リピーターを強化するメルマガ・DM
                            配信機能や、サービスの魅力を伝えるレビュー機能、広告の出稿をサポートする集客オプションなどをご用意しています。
                        </div>
                    </div>
                    <div class="flow-item-image">
                        <img alt="利用開始" src="/img/top/flow3.jpg" />
                    </div>
                </div>
            </div>
        </section>
        <aside class="cta">
            <div class="cta__content container">
                <div class="cta__title">さっそくstaplaを<br />使ってみる</div>
                <router-link to="/register" class="cta__btn"
                    >無料で試してみる</router-link
                >
            </div>
        </aside>
        <footer class="footer">
            <div class="container d-md-flex justify-content-between">
                <div class="footer-logo">
                    <img
                        :src="'img/common/footer_logo.svg'"
                        alt="stapla"
                        class="footer-logo__img"
                    />
                    <p>レンタルジム専用予約サービス</p>
                </div>
                <div class="footer-nav">
                    <h5 class="footer-nav__title">About</h5>
                    <ul class="list-unstyled footer-list">
                        <li class="footer-list__item">
                            <router-link to="/about" class="footer-list__link"
                                >Staplaについて</router-link
                            >
                        </li>
                        <li class="footer-list__item">
                            <router-link to="/faq" class="footer-list__link"
                                >よくある質問</router-link
                            >
                        </li>
                        <li class="footer-list__item">
                            <router-link to="/company" class="footer-list__link"
                                >運営会社</router-link
                            >
                        </li>
                    </ul>
                </div>
                <div class="footer-nav">
                    <h5 class="footer-nav__title">Help</h5>
                    <ul class="list-unstyled footer-list">
                        <li class="footer-list__item">
                            <router-link to="/terms" class="footer-list__link"
                                >利用規約</router-link
                            >
                        </li>
                        <li class="footer-list__item">
                            <router-link to="/primacy" class="footer-list__link"
                                >プライバシーポリシー</router-link
                            >
                        </li>
                        <li class="footer-list__item">
                            <router-link to="/law" class="footer-list__link"
                                >特定商取引法に基づく表記</router-link
                            >
                        </li>
                    </ul>
                </div>
                <div class="footer-nav">
                    <h5 class="footer-nav__title">Link</h5>
                    <ul class="list-unstyled footer-list">
                        <li class="footer-list__item">
                            <router-link to="/contact" class="footer-list__link"
                                >お問い合わせ</router-link
                            >
                        </li>
                    </ul>
                </div>
            </div>
            <p class="copyright text-center">&copy; 2020 stapla</p>
        </footer>
    </div>
</template>

<script>
import KvImage from "../../../public/img/top/mv_bg.jpg";

export default {
    data() {
        return {
            kvImage: KvImage
        };
    }
};
</script>

<style>
.home {
    background: #fff;
}

img {
    max-width: 100%;
}

.header {
    height: 75px;
}

.header__container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 30px;
    height: 100%;
}

.header__logo img {
    display: block;
    width: 110px;
    height: 22px;
}

.header-main {
    display: flex;
    align-items: center;
}

.header-nav {
    display: flex;
    margin: 0;
}

.header-nav__item {
    margin: 0 40px 0 0;
}

.header-form {
    display: flex;
    align-items: center;
    padding: 0 0 0 40px;
    border-left: 1px solid #e2e2e2;
}

.header-form__login {
    font-weight: 700;
    margin: 0 24px 0 0;
}

.header-form__register {
    width: 120px;
    padding: 10px 0;
    text-align: center;
    color: #fff;
    background-color: #ff5722;
    border-radius: 3px;
}

.header-form__register:hover {
    color: #fff;
}

.kv {
    height: 540px;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
}

.kv-main {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100%;
    color: #fff;
}

.kv__title {
    font-size: 42px;
    font-weight: 700;
    margin: 0 0 20px;
    color: #fff;
    line-height: 1.3;
}

.kv__desc {
    margin: 0 0 30px;
    font-size: 18px;
    text-shadow: 2px 2px rgba(0, 0, 0, 0.2);
}

.kv__btn {
    width: 200px;
    display: inline-block;
    color: #fff;
    padding: 11px 0;
    font-size: 16px;
    background: #ff5722;
    border-radius: 4px;
    text-align: center;
}

.section {
    padding: 32px 0px 40px;
}

.section__title {
    margin: 0 0 20px;
}

.section__title--en {
    color: #ff5722;
    font-size: 16px;
    font-weight: 700;
}

.section__title--ja {
    font-weight: 700;
    line-height: 1.55;
    margin: 0;
}

.concept-body {
    margin: 0 0 32px;
}

.concept-body__desc {
    color: #777;
    text-align: justify;
}

.feature {
    background: #f5f5f5;
}

.feature-item {
    padding: 30px 25px;
    text-align: center;
    background: #fff;
    border-radius: 4px;
    margin: 0 0 30px;
}

.feature-item__title {
    font-size: 21px;
    margin: 0 0 16px;
}

.feature-item__desc {
    text-align: justify;
}

.flow {
    background: #fff;
}

.flow-item {
    margin: 0 0 50px;
}

.flow-item-body {
    margin: 0 0 30px;
}

.flow-item-body__title {
    margin: 0 0 20px;
    display: flex;
}

.flow-item-body__title--ja {
    margin: 0;
}

.flow-item-body__title--en {
    border-radius: 4px;
    padding: 2px 10px;
    margin: 0 10px 0 0;
    background: #e5e5e5;
}

.flow-item-body__desc {
    color: #777;
    text-align: justify;
}

.flow-item-image {
    margin: 0;
}

.cta {
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 55px 0;
    background: #fa8231;
}

.cta__title {
    margin: 0 0 24px;
    text-align: center;
    font-size: 24px;
    font-weight: 700;
}

.cta__btn {
    padding: 13px 0;
    font-size: 16px;
    color: #fa8231;
    font-weight: 700;
    display: block;
    width: 100%;
    background: #fff;
    border-radius: 4px;
    text-align: center;
}

.footer {
    padding: 72px 0 0;
    background: #333;
    color: rgba(255, 255, 255, 0.7);
}

.footer-logo {
    margin: 0 0 30px;
}

.footer-logo__img {
    width: 100px;
    margin: 0 0 10px;
}

.footer-list {
    margin: 0;
}

.footer-list__link {
    color: #fff;
    font-size: 13px;
    margin: 0 0 16px;
    display: block;
}

.footer-list__link:hover {
    color: inherit;
    text-decoration: underline;
}

.footer-nav {
    margin: 0 0 40px;
}

.footer-nav:last-child {
    margin: 0;
}

.footer-nav__title {
    font-size: 16px;
    margin: 0 0 16px;
    padding: 0 0 16px;
    border-bottom: solid 1px rgba(255, 255, 255, 0.2);
}

.copyright {
    margin: 0;
    padding: 20px 0px;
    color: #fff;
    font-size: 12px;
}

@media screen and (min-width: 768px) {
    .kv__title {
        font-size: 75px;
        margin: 0 0 20px;
    }

    .section {
        padding: 64px 0px 80px;
    }

    .section__title {
        margin: 0 0 40px;
    }

    .concept__content {
        display: flex;
        justify-content: space-between;
    }

    .concept-body {
        width: 40%;
        margin: 0;
    }

    .concept-body__desc {
        font-size: 16px;
        line-height: 1.9;
    }

    .concept-image {
        width: 50%;
    }

    .feature-items {
        display: flex;
        justify-content: space-between;
    }

    .feature-item {
        width: 30%;
        margin: 0;
    }

    .flow-item {
        display: flex;
        justify-content: space-between;
        margin: 0 0 60px;
    }

    .flow-item-body {
        width: 40%;
        margin: 0;
    }

    .flow-item-image {
        width: 50%;
        margin: 0 0 0 10%;
    }

    .flow-item-body__desc {
        font-size: 16px;
        line-height: 1.9;
    }

    .cta {
        padding: 70px 0;
    }

    .cta__title {
        margin: 0 0 45px;
        font-size: 32px;
    }

    .cta__btn {
        width: 280px;
        margin: 0 auto;
    }

    .footer-logo {
        margin: 0;
    }

    .footer-nav {
        margin: 0;
    }

    .footer-nav__title {
        padding: 0;
        border-bottom: none;
    }

    .copyright {
        margin: 40px 0 0;
    }
}
</style>
