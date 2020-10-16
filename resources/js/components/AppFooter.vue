<template>
    <footer class="footer">
        <div class="container d-md-flex justify-content-between">
            <div class="footer-logo">
                <img
                    :src="'img/common/footer_logo.svg'"
                    alt="STAPLA"
                    class="footer-logo__img"
                />
                <p>レンタルジム専用予約サービス</p>
            </div>
            <div class="footer-nav">
                <h5 class="footer-nav__title">About</h5>
                <ul class="list-unstyled footer-list">
                    <li class="footer-list__item">
                        <router-link to="/about" class="footer-list__link"
                            >STAPLAについて</router-link
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
                        <router-link to="/privacy" class="footer-list__link"
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
        <p class="copyright text-center">&copy; 2020 STAPLA</p>
    </footer>
</template>

<style>
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
