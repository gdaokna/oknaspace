<?php
// home.php — лендинговая главная
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>KABAN — оборудование для производства окон</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Общие стили -->
    <link rel="stylesheet" href="assets/styles.css">
    <link rel="stylesheet" href="assets/styles_home.css">
</head>
<body class="page-home">

<?php include 'header.php'; ?>

<main>

  <!-- HERO / MAIN SLIDER -->
<section class="hero-section">
    <div class="hero-slider" id="heroSlider">

        <div class="hero-slide active" style="background-image:url('images/hero/slide1.jpg')">
            <div class="hero-overlay"></div>
            <div class="hero-content">
                <h1>Оборудование для производства окон</h1>
                <p>ПВХ и алюминиевые линии. Запуск под ключ</p>
                <a href="index.php" class="btn-primary">Перейти в каталог</a>
            </div>
        </div>

        <div class="hero-slide" style="background-image:url('images/hero/slide2.jpg')">
            <div class="hero-overlay"></div>
            <div class="hero-content">
                <h1>Автоматизация оконных производств</h1>
                <p>Подбор решений под ваш бюджет и задачи</p>
                <a href="index.php?category=automation" class="btn-primary">
                    Смотреть решения
                </a>
            </div>
        </div>

        <div class="hero-slide" style="background-image:url('images/hero/slide3.jpg')">
            <div class="hero-overlay"></div>
            <div class="hero-content">
                <h1>Станки KABAN в реальном производстве</h1>
                <p>Поставка, монтаж, обучение персонала</p>
                <a href="#production" class="btn-primary">
                    Посмотреть в работе
                </a>
            </div>
        </div>

        <!-- Навигация -->
        <button class="hero-arrow prev" aria-label="Предыдущий слайд">‹</button>
        <button class="hero-arrow next" aria-label="Следующий слайд">›</button>

        <!-- Точки -->
        <div class="hero-dots"></div>

    </div>
</section>



   <!-- POPULAR CATEGORIES -->
<section class="info-section popular-categories">
    <div class="layout content-full">
        <h2>Популярные разделы</h2>
        <p class="lead">
            Основные направления оборудования для оконных производств
        </p>

        <div class="card-grid categories-grid">

            <a href="index.php?category=pvc" class="machine-card category-card">
                <div class="card-image-wrapper">
                    <img src="images/categories/pvc.png" alt="Линии ПВХ">
                </div>
                <div class="card-body">
                    <h3 class="card-title">Линии ПВХ</h3>
                    <p class="card-text">
                        Полные линии и отдельные станки для ПВХ окон
                    </p>
                </div>
            </a>

            <a href="index.php?category=aluminum" class="machine-card category-card">
                <div class="card-image-wrapper">
                    <img src="images/categories/aluminum.png" alt="Алюминиевые линии">
                </div>
                <div class="card-body">
                    <h3 class="card-title">Алюминиевые линии</h3>
                    <p class="card-text">
                        Оборудование для алюминиевых профилей
                    </p>
                </div>
            </a>

            <a href="index.php?category=machines" class="machine-card category-card">
                <div class="card-image-wrapper">
                    <img src="images/categories/machines.png" alt="Станки">
                </div>
                <div class="card-body">
                    <h3 class="card-title">Станки</h3>
                    <p class="card-text">
                        Отдельные станки для разных этапов производства
                    </p>
                </div>
            </a>

            <a href="index.php?category=automation" class="machine-card category-card">
                <div class="card-image-wrapper">
                    <img src="images/categories/automation.png" alt="Автоматизация">
                </div>
                <div class="card-body">
                    <h3 class="card-title">Автоматизация</h3>
                    <p class="card-text">
                        Решения для роста производительности
                    </p>
                </div>
            </a>

            <a href="index.php?category=tools" class="machine-card category-card">
                <div class="card-image-wrapper">
                    <img src="images/categories/tools.png" alt="Оснастка">
                </div>
                <div class="card-body">
                    <h3 class="card-title">Оснастка</h3>
                    <p class="card-text">
                        Инструмент и вспомогательное оборудование
                    </p>
                </div>
            </a>

            <a href="index.php?category=spares" class="machine-card category-card">
                <div class="card-image-wrapper">
                    <img src="images/categories/spares.png" alt="Запчасти">
                </div>
                <div class="card-body">
                    <h3 class="card-title">Запчасти</h3>
                    <p class="card-text">
                        Оригинальные комплектующие и расходники
                    </p>
                </div>
            </a>

        </div>
    </div>
</section>



   <!-- WHY KABAN -->
<section class="info-section why-kaban">
    <div class="layout content-full">
        <h2>Почему KABAN</h2>
        <p class="lead">
            Мы не просто поставляем оборудование — мы запускаем производства
        </p>

        <div class="why-grid">

            <div class="why-item">
                <div class="why-number">
                    <span class="counter" data-target="40">0</span><span class="plus">+</span>
                </div>
                <div class="why-text">лет опыта в оборудовании</div>
            </div>

            <div class="why-item">
                <div class="why-icon">🏭</div>
                <div class="why-text">Запуск производств под ключ</div>
            </div>

            <div class="why-item">
                <div class="why-icon">💰</div>
                <div class="why-text">Подбор под бюджет и задачи</div>
            </div>

            <div class="why-item">
                <div class="why-icon">🎓</div>
                <div class="why-text">Обучение персонала</div>
            </div>

            <div class="why-item">
                <div class="why-icon">🛠</div>
                <div class="why-text">Сервис и запчасти</div>
            </div>

        </div>
    </div>
</section>



   <!-- HOW WE WORK -->
<section class="launch-section">
    <div class="layout content-full">
        <h2>Как мы работаем</h2>

        <div class="launch-grid">

            <div class="launch-col">
                <div class="launch-step">
                    <div class="step-badge">1</div>
                    <div class="step-body">
                        <h3>Анализ задачи</h3>
                        <p>
                            Изучаем формат производства, объёмы, профиль,
                            бюджет и цели клиента.
                        </p>
                    </div>
                </div>

                <div class="launch-step">
                    <div class="step-badge">2</div>
                    <div class="step-body">
                        <h3>Подбор оборудования</h3>
                        <p>
                            Формируем оптимальную конфигурацию станков
                            под конкретные задачи.
                        </p>
                    </div>
                </div>

                <div class="launch-step">
                    <div class="step-badge">3</div>
                    <div class="step-body">
                        <h3>Поставка</h3>
                        <p>
                            Организуем логистику, таможню и доставку оборудования.
                        </p>
                    </div>
                </div>
            </div>

            <div class="launch-col">
                <div class="launch-step">
                    <div class="step-badge">4</div>
                    <div class="step-body">
                        <h3>Монтаж</h3>
                        <p>
                            Проводим установку, подключение и пусконаладку.
                        </p>
                    </div>
                </div>

                <div class="launch-step">
                    <div class="step-badge">5</div>
                    <div class="step-body">
                        <h3>Запуск и обучение</h3>
                        <p>
                            Обучаем персонал и сопровождаем запуск производства.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>



  <!-- TRUST BLOCK -->
<section class="info-section trust-block">
    <div class="layout content-full">
        <h2>Нам доверяют</h2>
        <p class="lead">
            Реальные показатели нашей работы за годы поставок и запусков
        </p>

        <div class="trust-grid">

            <div class="trust-item">
                <div class="trust-number">
                    <span class="counter" data-target="1200">0</span><span class="plus">+</span>
                </div>
                <div class="trust-text">поставленных станков</div>
            </div>

            <div class="trust-item">
                <div class="trust-number">
                    <span class="counter" data-target="150">0</span><span class="plus">+</span>
                </div>
                <div class="trust-text">запусков производств под ключ</div>
            </div>

            <div class="trust-item">
                <div class="trust-number">
                    <span class="counter" data-target="10">0</span><span class="plus">+</span>
                </div>
                <div class="trust-text">стран и регионов</div>
            </div>

            <div class="trust-item">
                <div class="trust-number">
                    <span class="counter" data-target="40">0</span><span class="plus">+</span>
                </div>
                <div class="trust-text">лет опыта в отрасли</div>
            </div>

        </div>
    </div>
</section>



    <!-- NARROW PROMO BANNERS -->
<section class="info-section narrow-banners">
    <div class="layout content-full">

        <div class="narrow-grid">

            <a href="machine.php?id=101" class="narrow-banner"
               style="background-image:url('images/banners/banner1.jpg')">
                <div class="narrow-overlay"></div>
                <div class="narrow-content">
                    <h3>Автоматическая линия ПВХ</h3>
                    <p>Высокая производительность для серийного производства</p>
                    <span class="narrow-btn">Подробнее</span>
                </div>
            </a>

            <a href="machine.php?id=202" class="narrow-banner"
               style="background-image:url('images/banners/banner2.jpg')">
                <div class="narrow-overlay"></div>
                <div class="narrow-content">
                    <h3>Пильный центр KABAN</h3>
                    <p>Точность, надёжность, промышленный стандарт</p>
                    <span class="narrow-btn">Смотреть станок</span>
                </div>
            </a>

        </div>
    </div>
</section>



   <!-- POPULAR MACHINES -->
<section class="info-section popular-machines">
    <div class="layout content-full">
        <h2>Популярное оборудование</h2>
        <p class="lead">
            Оборудование, которое чаще всего выбирают для запуска и модернизации производств
        </p>

        <div class="card-grid">

            <?php
            // 🔧 ВРЕМЕННО: список популярных станков (ID)
            // позже заменим на динамику по просмотрам
            $popularIds = [101, 203, 305, 412, 509, 618];

            foreach ($machines as $machine) {
                if (!in_array($machine['id'], $popularIds)) continue;
                ?>
                <a href="machine.php?id=<?= $machine['id'] ?>"
                   class="machine-card">

                    <div class="card-image-wrapper">
                        <img src="<?= $machine['image'] ?>"
                             alt="<?= htmlspecialchars($machine['title']) ?>">
                    </div>

                    <div class="card-body">
                        <div class="card-code"><?= $machine['code'] ?></div>
                        <h3 class="card-title"><?= $machine['title'] ?></h3>
                        <p class="card-text"><?= $machine['short'] ?></p>

                        <div class="card-more">Подробнее →</div>
                    </div>

                </a>
                <?php
            }
            ?>

        </div>
    </div>
</section>



   <!-- PROMO STRIP -->
<section class="promo-strip">
    <div class="layout content-full promo-inner">

        <div class="promo-text">
            <h3>Специальное предложение на оборудование KABAN</h3>
            <p>
                Подбор и запуск оборудования на выгодных условиях.
                Количество предложений ограничено.
            </p>
        </div>

        <div class="promo-action">
            <a href="#contact-form" class="btn-primary promo-btn">
                Успей получить предложение
            </a>
        </div>

    </div>
</section>



    <!-- LIVE PRODUCTION -->
<section class="info-section live-production" id="production">
    <div class="layout content-full">

        <h2>Действующее производство</h2>
        <p class="lead">
            Оборудование KABAN в реальной работе на нашем заводе
        </p>

        <div class="production-grid">

            <!-- Видео / основной контент -->
            <div class="production-media">
                <div class="video-wrapper">
                    <!-- YouTube / Vimeo / локальное видео -->
                    <iframe
                        src="https://www.youtube.com/embed/VIDEO_ID"
                        title="Оборудование KABAN в работе"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen>
                    </iframe>
                </div>
            </div>

            <!-- Описание -->
            <div class="production-info">
                <h3>Станок KABAN в промышленной эксплуатации</h3>
                <ul class="feature-list">
                    <li>Непрерывная работа в сменном режиме</li>
                    <li>Серийное производство оконных конструкций</li>
                    <li>Контроль качества на каждом этапе</li>
                    <li>Обученный персонал</li>
                </ul>

                <div class="detail-actions">
                    <a href="index.php" class="btn-primary">
                        Подобрать оборудование
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>


</main>

<?php include 'footer.php'; ?>

<!-- JS -->
<script src="assets/hero-slider.js"></script>

</body>
</html>
