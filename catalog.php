<?php

// кеш выключить 
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0"); // кеш выключить 
header("Cache-Control: post-check=0, pre-check=0", false); // кеш выключить 
header("Pragma: no-cache"); // кеш выключить 
header("Expires: 0"); // кеш выключить 

require_once __DIR__ . '/machines.php';

require_once 'menu.php'; // подключаем массив сортировки

function normalize_youtube_url($url) {
    if (!$url) return null;

    // Убираем пробелы
    $url = trim($url);

    // Если ссылка начинается с "https//" (без ":"), исправляем
    $url = preg_replace('#^https//#', 'https://', $url);

    // Если ссылка начинается с "http//" (без ":"), исправляем
    $url = preg_replace('#^http//#', 'http://', $url);

    // Если нет протокола — добавляем https://
    if (!preg_match('#^https?://#', $url)) {
        $url = 'https://' . $url;
    }

    // Превращаем youtu.be → нормальный формат watch?v=
    if (preg_match('#youtu\.be/([A-Za-z0-9_-]+)#', $url, $m)) {
        return 'https://www.youtube.com/watch?v=' . $m[1];
    }

    // Превращаем embed/ → watch?v=
    if (preg_match('#embed/([A-Za-z0-9_-]+)#', $url, $m)) {
        return 'https://www.youtube.com/watch?v=' . $m[1];
    }

    return $url;
}

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="theme-color" content="#000000">
    <title>Оборудование KABAN для ПВХ и алюминия — KABANASIA, официальный поставщик в Центральной Азии</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="KABANASIA — официальный поставщик оборудования KABAN для оконных и фасадных заводов в Казахстане, Кыргызстане, Узбекистане, Таджикистане и Монголии. Обрабатывающие центры, сварочные и зачистные линии, распиловочные станки, штапикорезы, ЧПУ для алюминия. Подбор, поставка, автоматизация и сервис.">
    <meta name="robots" content="index,follow">


    <!-- <link rel="stylesheet" href="assets/styles.css"> -->
    <!-- <script src="assets/app.js"></script> -->


    <link rel="stylesheet" href="assets/styles.css?v=<?php echo filemtime('assets/styles.css'); ?>">
    <script src="assets/app.js?v=<?php echo filemtime('assets/app.js'); ?>"></script>
    



    <link rel="icon" type="image/png" sizes="32x32" href="/favicon.png">
<link rel="apple-touch-icon" sizes="180x180" href="/favicon.png">
<link rel="manifest" href="/site.webmanifest">
    
    <script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Organization",
  "name": "KABANASIA",
  "alternateName": "Оборудование KABAN в Центральной Азии",
  "url": "https://kaban.asia",
  "logo": "https://kaban.asia/favicon.png",
  "contactPoint": [{
    "@type": "ContactPoint",
    "telephone": "+996770551005",
    "contactType": "customer service",
    "areaServed": ["KZ", "KG", "UZ", "TJ", "MN"],
    "availableLanguage": ["ru", "en", "tr"]
  }],
  "sameAs": [
    "https://t.me/kabanasia",
    "https://instagram.com/kaban.asia",
    "https://www.facebook.com/kaban.asia",
    "https://www.youtube.com/@kabanasia",
    "https://www.tiktok.com/@kaban.asia"
  ]
}
</script>

</head>

<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-W3LTJLLZ');</script>
<!-- End Google Tag Manager -->

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-W3LTJLLZ"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<body class="page-index">
<header class="site-header">
    <div class="header-inner">
        <a href="https://kaban.asia" class="logo-block" id="logoReset" target="" rel="noopener">
            <div class="logo-mark">K</div>
            <div class="logo-text">
                <div class="logo-title">KABANASIA</div>
                <div class="logo-subtitle">Оборудование KABAN • Центральная Азия</div>
            </div>
        </a>
        <nav class="main-nav">
            <a href="index.php#catalog">Каталог</a>
            <a href="index.php#automation">Автоматизация заводов</a>
            <a href="index.php#service">Сервис и поддержка</a>
            <a href="index.php#contacts">Контакты</a>
        </nav>
        <div class="header-contacts">
           <!-- <div class="phone">+996 770 551 005</div> -->
            <div class="region">Казахстан • Кыргызстан • Узбекистан • Таджикистан • Монголия</div>
        </div>
        <button class="burger" id="burgerBtn" aria-label="Меню">
            <span></span><span></span><span></span>
        </button>
    </div>
</header>

<div class="layout">
     <?php require_once 'sidebar.php'; ?>



    <main class="content">
        <section id="catalog" class="catalog-section">
            <div class="catalog-header">
                <div>
                    <h1>Каталог оборудования KABAN</h1>
                    <p class="lead">
                        Современные обрабатывающие центры, сварочные линии и вспомогательное оборудование для производства окон и фасадов из ПВХ и алюминия.
                    </p>
                </div>
                <div class="filters">
                    <input type="text" id="searchInput" placeholder="Поиск по названию, коду или описанию…"><br>
                    <select id="categoryFilter">
                        <option value="">Все материалы</option>
                        <option value="ПВХ">ПВХ</option>
                        <option value="АЛЮМИНИЙ">АЛЮМИНИЙ</option>
                        <option value="ПРОЧЕЕ">ПРОЧЕЕ</option>
                    </select>
                    <select id="typeFilter">
                        <option value="">Все виды станков</option>
                        <?php
                        $typesList = [];
                        foreach ($machines as $m) {
                            $typesList[$m['type']] = true;
                        }
                        ksort($typesList);
                        foreach (array_keys($typesList) as $t): ?>
                            <option value="<?php echo htmlspecialchars($t); ?>"><?php echo htmlspecialchars($t); ?></option>
                        <?php endforeach; ?>
                    </select> 

                    <button type="button" class="reset-filters" id="resetFiltersBtn">Сбросить фильтры</button>

                </div>
            </div>

            <div id="machineGrid" class="card-grid">
                <?php foreach ($machines as $m): ?>
                    <article class="machine-card"
                             data-category="<?php echo htmlspecialchars($m['category']); ?>"
                             data-type="<?php echo htmlspecialchars($m['type']); ?>"
                             data-code="<?php echo htmlspecialchars($m['code']); ?>">
                        
                        <a href="machine.php?slug=<?php echo urlencode($m['slug']); ?>" class="card-link">


                            <div class="card-image-wrapper">
                                <img src="<?php echo htmlspecialchars($m['image']); ?>"
                                     alt="<?php echo htmlspecialchars($m['code'] . ' ' . $m['title']); ?>">
                            </div>
                            <div class="card-body">
    <div class="card-code"><?php echo htmlspecialchars($m['code']); ?></div>
    <h2 class="card-title"><?php echo htmlspecialchars($m['title']); ?></h2>

    <div class="card-tags">
        <span class="tag tag-red"><?php echo htmlspecialchars($m['category']); ?></span>
        <span class="tag"><?php echo htmlspecialchars($m['type']); ?></span>
    </div>

    <?php if (!empty($m['short'])): ?>
        <p class="card-text"><?php echo htmlspecialchars($m['short']); ?></p>
    <?php endif; ?>

    <div class="card-footer-row">
        <div class="card-more">Подробнее →</div>

        <?php if (!empty($m['pdf']) || !empty($m['youtube'])): ?>
            <div class="card-icons">
                <?php if (!empty($m['pdf'])): ?>
                    <a href="<?php echo htmlspecialchars($m['pdf']); ?>"
                       class="icon-btn"
                       target="_blank"
                       title="PDF-каталог станка">
                        📄
                    </a>
                <?php endif; ?>
               
               
             <?php
$videoUrl = null;

// Одно видео строкой
if (!empty($m['youtube']) && is_string($m['youtube'])) {
    $videoUrl = normalize_youtube_url($m['youtube']);
}

// Несколько видео массивом
if (!empty($m['youtube']) && is_array($m['youtube']) && count($m['youtube']) > 0) {
    $videoUrl = normalize_youtube_url($m['youtube'][0]); // берем первое
}
?>
<?php if ($videoUrl): ?>
    <a href="<?php echo htmlspecialchars($videoUrl); ?>" target="_blank"
       class="icon-btn" title="Видео">
        ▶
    </a>
<?php endif; ?>




            </div>
        <?php endif; ?>
    </div>
</div>

                        </a>
                    </article>
                <?php endforeach; ?>
            </div>
        </section>
        
        <section id="seo-home" class="info-section seo-section">
            <h2>Оборудование KABAN для заводов ПВХ и алюминия в Центральной Азии</h2>
            <p>
                KABANASIA — специализированный поставщик оборудования KABAN для оконных и фасадных заводов
                в <strong>Казахстане, Кыргызстане, Узбекистане, Таджикистане и Монголии</strong>. Мы работаем
                с производствами, которые хотят повысить скорость, качество и предсказуемость своих линий за счёт
                правильного подбора станков и продуманной автоматизации.
            </p>
            <p>
                В нашем каталоге собраны <strong>обрабатывающие центры для ПВХ и алюминия, сварочно-зачистные комплексы,
                распиловочные станки, штапикорезы и ЧПУ-оборудование</strong> для серийного выпуска окон, дверей,
                витражей и фасадов. Мы учитываем ваши задачи по мощности (рам/смену), номенклатуре и бюджету, чтобы
                подобрать оптимальную конфигурацию линии — от отдельных станков до полностью автоматизированного завода.
            </p>
            <p>
                KABANASIA обеспечивает <strong>поставку, пусконаладку, обучение персонала и сервисную поддержку</strong>.
                Наши инженеры проходят обучение на заводе KABAN в Турции, а склады расходников и запчастей находятся ближе
                к вашим объектам в Центральной Азии, что уменьшает простои и снижает риски остановки производства.
            </p>
            <p>
                Если вы планируете запуск нового производства или модернизацию существующего цеха,
                <strong>напишите нам в WhatsApp или оставьте заявку</strong> — мы поможем спроектировать линию так,
                чтобы она была конкурентной по скорости, себестоимости и качеству готовых изделий на рынках
                Казахстана, Кыргызстана, Узбекистана, Таджикистана и Монголии.
            </p>
        </section>




<section id="launch" class="launch-section">
    <h2>Как мы запускаем завод под ключ</h2>
    <div class="launch-grid">

        <div class="launch-col">
            <div class="launch-step">
               
                <div class="step-body">
                    <h3>Аудит и стратегия</h3>
                    <p>Изучаем текущее производство, объёмы, профильные системы и цели по рынку. Формируем концепцию завода под ПВХ и/или алюминий.</p>
                </div>
            </div>

            <div class="launch-step">
              
                <div class="step-body">
                    <h3>Подбор оборудования KABAN</h3>
                    <p>Проектируем линию: распиловка, сварка, зачистка, обработка, монтажное оборудование. Делаем несколько конфигураций по бюджету и производительности.</p>
                </div>
            </div>

            <div class="launch-step">
                
                <div class="step-body">
                    <h3>Планировочное решение цеха</h3>
                    <p>Рисуем поток: склад профиля, стекло, линии ПВХ и алюминия, логистика тележек, зоны готовой продукции. Учитываем реальные площади цеха.</p>
                </div>
            </div>

            <div class="launch-step">
                
                <div class="step-body">
                    <h3>Поставка и логистика</h3>
                    <p>Организуем поставку оборудования KABAN в Казахстан, Кыргызстан, Узбекистан, Таджикистан или Монголию. Контролируем транспортировку и растаможку.</p>
                </div>
            </div>
        </div>

        <div class="launch-col">
            <div class="launch-step">
                
                <div class="step-body">
                    <h3>Монтаж и подключение</h3>
                    <p>Наши инженеры устанавливают станки, подключают к электричеству, пневматике, проверяют безопасность и готовность к пуску.</p>
                </div>
            </div>

            <div class="launch-step">
                
                <div class="step-body">
                    <h3>Пусконаладка и обучение</h3>
                    <p>Запускаем линии в работу, настраиваем режимы под ваш профиль и тип изделий. Обучаем операторов, мастеров и техспециалистов.</p>
                </div>
            </div>

            <div class="launch-step">
                
                <div class="step-body">
                    <h3>Внедрение учёта и автоматизации</h3>
                    <p>Помогаем связать оборудование с 1С, CRM, системами учёта заказов и производства. Настраиваем отчётность по сменам и участкам.</p>
                </div>
            </div>

            <div class="launch-step">
                
                <div class="step-body">
                    <h3>Сервис и развитие</h3>
                    <p>Сопровождаем завод после запуска: сервисное обслуживание, расширение парка оборудования, повышение производительности линии.</p>
                </div>
            </div>
        </div>

    </div>
</section>






        <section id="automation" class="info-section">
            <h2>Полная автоматизация оконных заводов</h2>
            <div class="info-columns">
                <div>
                    <p>
                        Мы проектируем и поставляем комплексные решения KABAN для заводов по производству
                        пластиковых и алюминиевых окон: от одиночных станков до полностью автоматических линий
                        с интеграцией в ERP/MES системы.
                    </p>
                    <ul>
                        <li>Проектирование производственных линий под вашу мощность и номенклатуру;</li>
                        <li>Подбор обрабатывающих центров, сварочно-зачистных комплексов и вспомогательного оборудования;</li>
                        <li>Интеграция с программами расчёта окон и системами управления производством;</li>
                        <li>Обучение операторов и технологов, сопровождение пуско-наладки.</li>
                    </ul>
                </div>
                <div>
                    <p>
                        Региональная экспертиза по рынкам Центральной Азии позволяет учесть особенности
                        логистики, сервиса и кадров в Казахстане, Кыргызстане, Узбекистане, Таджикистане и Монголии.
                    </p>
                    <p>
                        Для консультации по автоматизации завода напишите нам в WhatsApp или оставьте заявку
                        через форму обратной связи.
                    </p>
                </div>
            </div>
        </section>

        <section id="service" class="info-section">
            <h2>Сервисная поддержка и запасные части</h2>
            <div class="info-columns">
                <div>
                    <p>
                        Наши сервис-инженеры проходят обучение на заводе KABAN в Турции и обеспечивают
                        полный цикл обслуживания оборудования на территории Центральной Азии.
                    </p>
                    <ul>
                        <li>Пуско-наладка и обучение персонала;</li>
                        <li>Регламентное обслуживание и модернизация линий;</li>
                        <li>Диагностика и ремонт с выездом на предприятие;</li>
                        <li>Удалённая поддержка и консультации по технологическим режимам.</li>
                    </ul>
                </div>
                <div>
                    <p>
                        Склад основных расходников и запасных частей находится ближе к вашим производствам,
                        что сокращает простои и повышает надёжность работы завода.
                    </p>
                    <p>
                        Для сервисного обращения отправьте фото таблички станка и описание проблемы в WhatsApp —
                        мы возьмём заявку в работу в кратчайшие сроки.
                    </p>
                </div>
            </div>
        </section>

        <section id="contacts" class="info-section contacts-section">
            <h2>Контакты</h2>
            <div class="contacts-grid">
                <div>
                    <h3>Региональное представительство KABANASIA</h3>
                    <p><strong>Телефон / WhatsApp:</strong> +996 770 551 005</p>
                    <p><strong>E-mail:</strong> info@kaban.asia</p>
                    <p><strong>Регионы работы:</strong> Казахстан, Кыргызстан, Узбекистан, Таджикистан, Монголия</p>
                    <p>
                        Подбор оборудования, автоматизация производств, сервисная поддержка и поставка
                        запасных частей для заводов по производству окон и фасадов.
                    </p>
                </div>
                
                
                
             


                <div>
                
                   <?php if (isset($_GET['sent']) && $_GET['sent'] == 1): ?>
    <div class="alert success">Ваше сообщение отправлено! Мы свяжемся с вами.</div>
<?php elseif (isset($_GET['sent']) && $_GET['sent'] == 0): ?>
    <div class="alert error">Ошибка отправки. Попробуйте позже.</div>
<?php endif; ?>
                    <!--
                    <h3>Форма быстрой связи</h3>
                    <form class="contact-form" method="post" action="send.php">
                        <div class="form-row">
                            <label>Имя</label>
                            <input type="text" name="name" required>
                        </div>
                        <div class="form-row">
                            <label>Компания</label>
                            <input type="text" name="company">
                        </div>
                        <div class="form-row">
                            <label>Телефон / WhatsApp</label>
                            <input type="text" name="phone" required>
                        </div>
                        <div class="form-row">
                            <label>Интересующее оборудование</label>
                            <input type="text" name="interest" placeholder="Например: FA 1010, линия на 300 рам/смену">
                        </div>
                        <div class="form-row">
                            <label>Комментарий</label>
                            <textarea name="message" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn-primary">Отправить заявку</button>
                        <p class="form-note">Нажимая кнопку, вы соглашаетесь на обработку персональных данных.</p>
                    </form> -->
                </div>
            </div>
        </section>
    </main>
</div>

<a href="https://wa.me/996770551005?text=<?php echo urlencode('Здравствуйте. Интересует оборудование, пишу вам с сайта КабанАзия.'); ?> " class="whatsapp-widget" target="_blank" rel="noopener">
    WhatsApp



<!--
<div class="whatsapp-question-widget" id="waQuestionWidget">
    <div class="waq-text" id="waQuestionText">
        <!-- текст вопроса подставим через JS -->
   <!--  </div>
    <div class="waq-actions">
        <button class="waq-btn" id="waQuestionYes">
            Да, написать в WhatsApp
        </button>
        <button class="waq-close" id="waQuestionClose" aria-label="Закрыть">
            ×
        </button>
    </div>
</div>-->
</a> 





<?php require_once 'footer.php'; ?>

</body>
</html>
