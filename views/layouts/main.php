<?php session_start();?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--НЕ УДАЛЯТЬ, прописывается название странички-->
    <title><?= htmlspecialchars($title ?? 'Нет названия') ?></title>
    
    <!--Bootstrap CSS-->
    <link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.min.css">

    <!--CSS-->
    <link rel="stylesheet" href="/assets/css/style.css">

    <!--FontAwesome-->
    <link rel="stylesheet" href="/assets/fontAwesome/css/all.css">

    <!--JS общий для всех страниц-->
    <script src="/assets/js/script.js" defer></script>

    <!-- js рендера (подставляется отдельно для каждой страницы)-->
    <?if (!empty($js)){
        $jsArr = explode(", ", $js);
        foreach($jsArr as $jsItem){?>
        <script src="/assets/js/<?= htmlspecialchars($jsItem) ?>" defer></script>
    <?}
    }?>
    
</head>
<body>
    <!---------------------------------------------------Шапка--------------------------------------------------->
   <header class="main-header">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-dark px-0">
                <a class="navbar-brand px-3 py-2" href="/glav"><i class="fa fa-book fa-3x black-text" aria-hidden="true"></i></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <div class="collapse navbar-collapse" id="mainNavbar">
                    <ul class="navbar-nav mx-auto text-center">
                        <li class="nav-item"><a class="nav-link" href="/library">Библиотека</a></li>
                        <li class="nav-item"><a class="nav-link" href="/about">О проекте</a></li>
                        <li class="nav-item"><a class="nav-link" href="/project">Проекты</a></li>
                        <li class="nav-item"><a class="nav-link" href="/journal">Посещаемость</a></li>
                        <li class="nav-item active"><a class="nav-link" href="#">Форум</a></li>
                        <li class="nav-item"><a class="nav-link" href="/docs">Практика</a></li>
                    </ul>
                    
                    <div class="d-flex align-items-center justify-content-center header-controls">
                        <button class="theme-toggle-btn mr-3" aria-label="Переключить тему">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
                            </svg>
                        </button>
                        <a href="login" class="btn btn-primary btn-custom px-4">Войти</a>
                    </div>
                </div>
            </nav>
        </div>
    </header>

    
    <!---------------------------------------------------Основа--------------------------------------------------->
    <main class=''>
        <!-- сюда подключится представление из папки view, НЕ УДАЛЯТЬ-->
        <?= $content ?>
    </main>


    <!---------------------------------------------------Подвал--------------------------------------------------->
    <footer class="main-footer pt-5 pb-3">
        <div class="container">
            <div class="row mb-4">
                <div class="col-md-6 mb-4 mb-md-0">
                    <h5 class="text-white-50 font-weight-bold mb-2">edication.q-pax.ru</h5>
                    <p class="text-muted small pr-md-5">Простой и понятный интерфейс для эффективной учёбы и работы</p>
                </div>
                <div class="col-md-3 col-6 mb-3">
                    <ul class="list-unstyled footer-links">
                        <li><a href="/library">Библиотека</a></li>
                        <li><a href="/about">О проекте</a></li>
                        <li><a href="/project">Проекты</a></li>
                    </ul>
                </div>
                <div class="col-md-3 col-6 mb-3">
                    <ul class="list-unstyled footer-links">
                        <li><a href="/journal">Посещаемость</a></li>
                        <li><a href="#">Практика</a></li>
                    </ul>
                </div>
            </div>
            <hr class="footer-hr">
            <div class="row">
                <div class="col-100 text-center w-100">
                    <p class="copyright-text mb-0 small">edication.q-pax.ru © 2026</p>
                </div>
            </div>
        </div>
    </footer>

    <!--Bootstrap JS-->
    <script src="/assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
