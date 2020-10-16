<template>
    <div class="home">
        <app-header></app-header>
        <div class="kv" :style="{ 'background-image': 'url(' + kvImage + ')' }">
            <div class="kv-main">
                <div class="container">
                    <div class="kv__title">
                        いつでも、<br />使える<span class="">個室ジム</span>
                    </div>
                    <div class="kv__desc">
                        STAPLAはレンタルジム専用予約サービスです。
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
                        用途は自由<br />予約した時間はあなただけの空間です。
                    </h2>
                </div>
                <div class="concept__content">
                    <div class="concept-body">
                        <div class="concept-body__desc">
                            個人のトレーニングを周りに邪魔されず、集中してトレーニングが可能です。<br />もちろんご自身のクライアントへパーソナルトレーニングを提供することも可能です。<br />予約枠は90分／コマです。
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
                            まずはお好きな施設と使用開始時間を選択ください。予約は利用開始の1分前からでも取得可能です。（チケット残数がある場合は、Step3利用開始へお進みください。）
                        </div>
                    </div>
                    <div class="flow-item-image">
                        <img alt="ジムを予約" src="/img/top/flow1.jpg" />
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
                            初めての方やチケット残数が０の場合は、予約時にチケット購入画面へと遷移します。決済方法はクレジットカードのみで、大手決済サービスのStripeを通してご購入いただきます。
                        </div>
                    </div>
                    <div class="flow-item-image">
                        <img alt="チケットを購入" src="/img/top/flow2.jpg" />
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
                            お時間になりましたら現地にて鍵の解錠を行っていただき利用開始です。ルーム内の設備はご自由にご利用いただけます。トレーニング後は、ルームの片付けを行っていただき、終了時間までに退出・施錠を行い利用終了です。
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
                <div class="cta__title">さっそくSTAPLAを<br />使ってみる</div>
                <router-link to="/register" class="cta__btn"
                    >無料で試してみる</router-link
                >
            </div>
        </aside>
        <app-footer></app-footer>
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
    background: #fa8231;
    color: #fff;
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
}
</style>
