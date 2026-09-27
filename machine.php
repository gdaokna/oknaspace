<?php

// кеш выключить 
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0"); // кеш выключить 
header("Cache-Control: post-check=0, pre-check=0", false); // кеш выключить 
header("Pragma: no-cache"); // кеш выключить 
header("Expires: 0"); // кеш выключить 

require_once __DIR__ . '/machines.php';
require_once __DIR__ . '/menu.php';


$slug = isset($_GET['slug']) ? $_GET['slug'] : '';
$current = null;
foreach ($machines as $m) {
    if ($m['slug'] === $slug) {
        $current = $m;
        break;
    }
}
if (!$current) {
    http_response_code(404);
}

// FAQ по типу станка
function getFaqForMachine(array $m): array
{
    $type = $m['type'] ?? '';
    $cat  = $m['category'] ?? '';

    $faq = [];

    switch ($type) {
        case 'Обрабатывающие центры':
            $faq = [
                [
                    'q' => 'Какой объём производства может закрыть этот обрабатывающий центр?',
                    'a' => 'Производительность зависит от конфигурации линии, длины профиля и сменности. Мы делаем расчёт под ваш завод: учитываем требуемое количество рам/смену, тип профиля и наличие других автоматизированных участков.'
                ],
                [
                    'q' => 'Можно ли интегрировать центр с моим ПО (1С, CNC, импорт из файлов)?',
                    'a' => 'Да. Обрабатывающие центры KABAN поддерживают работу с файлами раскроя и интеграцию с системами управления производством. Мы помогаем настроить связку: программа — ЧПУ — участок обработки профиля.'
                ],
                [
                    'q' => 'Насколько сложное обучение операторов на обрабатывающем центре?',
                    'a' => 'Обычно обучение занимает 1–3 дня. Наш инженер показывает работу с интерфейсом, загрузку программ, смену инструмента и базовую диагностику. После запуска оператор уверенно ведёт смену без постоянного участия технолога.'
                ],
            ];
            break;

        case 'Сварочные станки':
            $faq = [
                [
                    'q' => 'Подходит ли этот сварочный станок для моих профильных систем?',
                    'a' => 'Сварочные станки KABAN работают с большинством профильных систем ПВХ. При запуске мы подбираем режимы по температуре, времени и давлению под конкретный профиль и цвет (белый/ламинат).'
                ],
                [
                    'q' => 'Можно ли делать бесшовную сварку и сварку под зачистку?',
                    'a' => 'Конкретный режим зависит от модели станка. Часть станков работает под последующую зачистку, часть — в бесшовном исполнении. Мы подбираем решение под ваши требования к внешнему виду окна.'
                ],
                [
                    'q' => 'Сколько операторов нужно для работы на участке сварки?',
                    'a' => 'Для одного станка обычно достаточно 1 оператора. При работе в составе линии или с несколькими постами может понадобиться помощник для подготовки рам и контроля потока.'
                ],
            ];
            break;

        case 'Распиловочные станки':
            $faq = [
                [
                    'q' => 'Какую точность реза обеспечивает этот распиловочный станок?',
                    'a' => 'Станки KABAN обеспечивают высокую повторяемость реза при правильно подобранном диске и настройках подачи. При запуске мы настраиваем упоры и режимы для ваших типовых изделий.'
                ],
                [
                    'q' => 'Можно ли работать как с ПВХ, так и с алюминием?',
                    'a' => 'Часть моделей предназначена только для ПВХ или только для алюминия, а часть — комбинированные решения. Мы подбираем конкретную модель под ваш материал и задачи.'
                ],
                [
                    'q' => 'Какие требования к компрессору и электропитанию?',
                    'a' => 'Точные требования зависят от модели. В среднем необходим стабильный воздушный тракт 6–8 бар и соответствующая мощность по кВт. Мы присылаем технические требования перед запуском и помогаем проверить готовность цеха.'
                ],
            ];
            break;

        case 'Станки для зачистки углов':
            $faq = [
                [
                    'q' => 'С какими сварочными станками совместим этот станок зачистки углов?',
                    'a' => 'Станки зачистки углов KABAN совместимы с большинством сварочных станков KABAN и другим оборудованием при соблюдении стандартов по сварному шву. При запуске мы настраиваем режимы под вашу конкретную сварку.'
                ],
                [
                    'q' => 'Можно ли обрабатывать как белый профиль, так и ламинированный?',
                    'a' => 'Да, но для ламинированных профилей важен аккуратный подбор режимов и инструмента. Мы помогаем настроить станок так, чтобы сохранить декоративный слой и избежать повреждений кромки.'
                ],
                [
                    'q' => 'Сколько времени занимает настройка на новую профильную систему?',
                    'a' => 'После первичного запуска перенастройка под другую профильную систему занимает от нескольких минут до часа в зависимости от сложности. Наш инженер показывает, как это делать самостоятельно.'
                ],
            ];
            break;

        case 'Станки для фрезеровки торцов импоста':
            $faq = [
                [
                    'q' => 'С какими типами импоста может работать этот станок?',
                    'a' => 'Станок подходит для большинства импостных профилей ПВХ, применяемых в оконных системах. При запуске мы проверяем ваши конкретные профили и подбираем оптимальные настройки.'
                ],
                [
                    'q' => 'Насколько точно формируется посадочное место под соединитель?',
                    'a' => 'Фрезеровка обеспечивает стабильную геометрию торца импоста, что улучшает плотность стыка и снижает количество доработок при сборке створок и рам.'
                ],
                [
                    'q' => 'Нужно ли часто менять инструмент?',
                    'a' => 'Срок службы инструмента зависит от объёмов производства и используемых профилей. Мы рекомендуем плановый контроль состояния фрез и подскажем регламент обслуживания под ваш поток.'
                ],
            ];
            break;

        case 'Копировально-фрезерные станки':
            $faq = [
                [
                    'q' => 'Какие операции можно выполнять на копировально-фрезерном станке?',
                    'a' => 'На таких станках выполняются дренажные отверстия, пазы под фурнитуру, вырезы под ручки и дополнительные элементы. Конкретный набор операций зависит от конфигурации станка и шаблонов.'
                ],
                [
                    'q' => 'Как переходить между ПВХ и алюминием?',
                    'a' => 'Часть моделей работает только с одним материалом, часть — с несколькими. При запуске мы показываем, как корректно менять режимы, инструмент и прижимы при переходе с ПВХ на алюминий и обратно.'
                ],
                [
                    'q' => 'Насколько сложно обучить оператора?',
                    'a' => 'После запуска оператор осваивает базовые операции за 1–2 дня. Мы показываем работу с шаблонами, настройку ограничителей и контроль качества получаемых отверстий и пазов.'
                ],
            ];
            break;

        case 'Станки для привинчивания армирования':
            $faq = [
                [
                    'q' => 'Для каких профилей подходит этот станок привинчивания армирования?',
                    'a' => 'Станок рассчитан на большинство популярных профильных систем ПВХ. При запуске мы проверяем ваши профили и подбираем параметры под конкретную геометрию армирования.'
                ],
                [
                    'q' => 'Можно ли изменить шаг и глубину закрутки саморезов?',
                    'a' => 'Да, шаг и параметры закрутки настраиваются под требования технолога. Мы помогаем задать режимы, чтобы обеспечить надёжное крепление без пробоев и деформаций профиля.'
                ],
                [
                    'q' => 'Насколько станок ускоряет участок армирования?',
                    'a' => 'Автоматизация привинчивания позволяет значительно сократить ручной труд и выровнять производительность участка армирования с остальными операциями в цехе.'
                ],
            ];
            break;

        case 'Монтажное оборудование':
            $faq = [
                [
                    'q' => 'Для каких объектов подходит это монтажное оборудование?',
                    'a' => 'Оборудование KABAN используют при монтаже окон, дверей, витражей и фасадных систем. Мы подбираем решения под ваши типовые объекты: квартиры, частные дома, коммерческие здания, фасады.'
                ],
                [
                    'q' => 'Можно ли обучить монтажников правильной работе с этим оборудованием?',
                    'a' => 'Да. Мы проводим обучение монтажных бригад, показываем безопасные и эффективные приёмы работы, чтобы сократить количество повреждений и рекламаций на объектах.'
                ],
                [
                    'q' => 'Есть ли сервис и запчасти в регионе?',
                    'a' => 'Сервисные инженеры находятся в Центральной Азии, а базовые запчасти и расходники доступны со склада. Мы помогаем поддерживать оборудование в рабочем состоянии без длительных простоев.'
                ],
            ];
            break;

        case 'Станки для подрезки уплотнителей':
            $faq = [
                [
                    'q' => 'С какими типами уплотнителей может работать станок?',
                    'a' => 'Станок предназначен для подрезки большинства резиновых и ТПЕ уплотнителей, применяемых в оконных системах. При запуске мы проверяем ваши конкретные резинки и показываем оптимальные настройки.'
                ],
                [
                    'q' => 'Как подрезка влияет на герметичность и шумозащиту окна?',
                    'a' => 'Правильная подрезка уплотнителя обеспечивает плотное прилегание створки, отсутствие продуваний и посторонних шумов. Оборудование помогает стандартизировать этот процесс и снизить число рекламаций.'
                ],
                [
                    'q' => 'Нужна ли высокая квалификация оператора?',
                    'a' => 'После короткого обучения оператор легко выполняет подрезку по заданному шаблону. Мы передаём рекомендации по контролю качества и настройке станка под разные типы уплотнителя.'
                ],
            ];
            break;

        case 'Сварочно-зачистные линии':
            $faq = [
                [
                    'q' => 'Какую производительность может обеспечить эта сварочно-зачистная линия?',
                    'a' => 'Производительность линии зависит от конфигурации, количества постов и организации потока. Мы рассчитываем возможный выпуск рам/смену под ваши требования и планируем загрузку участка.'
                ],
                [
                    'q' => 'Сколько операторов нужно для обслуживания линии?',
                    'a' => 'В зависимости от модели линии и уровня автоматизации требуется от одного до нескольких операторов. При запуске мы помогаем оптимизировать распределение ролей на участке.'
                ],
                [
                    'q' => 'Можно ли интегрировать линию с другими участками и учётными системами?',
                    'a' => 'Да, линия может работать в связке с участком резки, зачистки и сборки, а также с системами управления производством. Мы подсказываем, как выстроить общий поток и обмен данными.'
                ],
            ];
            break;

        case 'Углообжимные прессы':
            $faq = [
                [
                    'q' => 'С какими алюминиевыми системами совместим этот углообжимной пресс?',
                    'a' => 'Пресс подходит для большинства фасадных и оконно-дверных систем из алюминия. При запуске мы проверяем ваши профили и рекомендуем оптимальные настройки и цулаги.'
                ],
                [
                    'q' => 'Можно ли обеспечить точную геометрию рамы при серийной сборке?',
                    'a' => 'Да, при правильно настроенных упорах, давлении и инструменте пресс обеспечивает стабильную геометрию углов. Мы показываем, как контролировать качество на старте и в процессе работы.'
                ],
                [
                    'q' => 'Насколько сложен уход и обслуживание пресса?',
                    'a' => 'Регулярный уход включает контроль гидропневматической системы, смазку и проверку прижимов. Мы даём регламент обслуживания и при необходимости берём сервис на себя.'
                ],
            ];
            break;

        default:
            $faq = [
                [
                    'q' => 'Подходит ли это оборудование под задачи моего завода?',
                    'a' => 'Мы анализируем ваш текущий объём, профильные системы и формат заказов, после чего рекомендуем конкретные модели оборудования и конфигурацию участка.'
                ],
                [
                    'q' => 'Кто занимается монтажом и запуском оборудования?',
                    'a' => 'Монтаж, запуск и обучение персонала выполняют сервисные инженеры KABANASIA. Мы остаёмся с вами и после запуска — для сервисного сопровождения и оптимизации процессов.'
                ],
                [
                    'q' => 'Работаете ли вы по всей Центральной Азии?',
                    'a' => 'Да. Мы сопровождаем проекты в Казахстане, Кыргызстане, Узбекистане, Таджикистане и Монголии, выезжаем на завод, проводим запуск и обучение на месте.'
                ],
            ];
    }

    return $faq;
}





// Собираем все YouTube-видео для станка
$youtubeIDs = [];

if (!empty($current['youtube'])) {
    // Если одно видео строкой
    if (is_string($current['youtube'])) {
        $id = youtube_id_from_url($current['youtube']);
        if ($id) {
            $youtubeIDs[] = $id;
        }
    }

    // Если несколько видео массивом
    if (is_array($current['youtube'])) {
        foreach ($current['youtube'] as $url) {
            $id = youtube_id_from_url($url);
            if ($id && !in_array($id, $youtubeIDs, true)) {
                $youtubeIDs[] = $id;
            }
        }
    }
}


// Функция: получаем только ID из любой YouTube-ссылки
function youtube_id_from_url($url) {
    if (preg_match('/(?:v=|youtu\.be\/|embed\/)([A-Za-z0-9_-]+)/', $url, $matches)) {
        return $matches[1];
    }
    return null;
}

$youtubeID = null;
if (!empty($current['youtube'])) {
    $youtubeID = youtube_id_from_url($current['youtube']);
}



// Собираем список картинок для галереи 
//images/{slug}.jpg — главное фото, 
//images/{slug}-N.jpg — доп. фото

$images = [];

if ($current) {
    $baseDir = __DIR__;

    // 1) главное фото из массива (если файл реально существует)
    if (!empty($current['image']) && file_exists($baseDir . '/' . $current['image'])) {
        $images[] = $current['image'];
    }

    // 2) дополнительные фото по шаблону: images/{slug}-*.*
    $slug = $current['slug'];
    $pattern = $baseDir . '/images/' . $slug . '-*.*';
    $files = glob($pattern);

    foreach ($files as $filePath) {
        // делаем относительный путь: images/slug-1.jpg
        $rel = str_replace($baseDir . '/', '', $filePath);
        if (!in_array($rel, $images, true)) {
            $images[] = $rel;
        }
    }

    // 3) если хочешь, можно ДОБАВИТЬ ещё и extra_images из массива:
    if (!empty($current['extra_images']) && is_array($current['extra_images'])) {
        foreach ($current['extra_images'] as $img) {
            if (!in_array($img, $images, true) && file_exists($baseDir . '/' . $img)) {
                $images[] = $img;
            }
        }
    }
}


// SEO
$defaultTitle = $current ? ($current['code'] . ' — ' . $current['title'] . ' | KABANASIA') : 'Оборудование не найдено | KABANASIA';
$seoTitle = $current['seo_title'] ?? $defaultTitle;
$seoDesc  = $current['seo_description'] ?? 'Оборудование KABAN для оконных и фасадных заводов в Центральной Азии: подбор, поставка, монтаж и сервис. Казахстан, Кыргызстан, Узбекистан, Таджикистан, Монголия.';

$canonical = '';
if ($current) {
    // домен можно поменять при необходимости
    $canonical = 'https://kaban.asia/machine.php?slug=' . urlencode($current['slug']);
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="theme-color" content="#000000">
    <title><?php echo htmlspecialchars($seoTitle); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php echo htmlspecialchars($seoDesc); ?>">
    <?php if ($canonical): ?>
        <link rel="canonical" href="<?php echo htmlspecialchars($canonical); ?>">
    <?php endif; ?>

     <!--  <link rel="stylesheet" href="assets/styles.css"> -->
     <!-- <script src="assets/app.js"></script> -->

 <link rel="stylesheet" href="assets/styles.css?v=<?php echo filemtime('assets/styles.css'); ?>">
 <script src="assets/app.js?v=<?php echo filemtime('assets/app.js'); ?>"></script>

    
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

    
    
    
    <script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Product",
  "name": "<?php echo htmlspecialchars($current['title']); ?>",
  "model": "<?php echo htmlspecialchars($current['code']); ?>",
  "image": [
    "<?php echo htmlspecialchars($current['image']); ?>"
  ],
  "description": "<?php echo htmlspecialchars($current['seo_description']); ?>",
  "brand": {
    "@type": "Brand",
    "name": "KABAN"
  },
  "manufacturer": {
    "@type": "Organization",
    "name": "KABAN Makina"
  },
  "offers": {
    "@type": "Offer",
    "priceCurrency": "USD",
    "availability": "https://schema.org/InStock",
    "url": "https://kaban.asia/machine.php?slug=<?php echo $current['slug']; ?>"
  }
}
</script>

</head>


<body class="page-machine">

<header class="site-header">
    <div class="header-inner">
        <a href="https://kaban.asia" class="logo-block" target="" rel="noopener">
            <div class="logo-mark">K</div>
            <div class="logo-text">
                <div class="logo-title">KABANASIA</div>
                <div class="logo-subtitle">Оборудование KABAN • Центральная Азия</div>
            </div>
        </a>
        <nav class="main-nav">
            <a href="index.php#catalog">Каталог</a>
            <a href="index.php#automation">Автоматизация</a>
            <a href="index.php#service">Сервис</a>
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
    
<link rel="icon" type="image/png" sizes="32x32" href="/favicon.png">
<link rel="apple-touch-icon" sizes="180x180" href="/favicon.png">
<link rel="manifest" href="/site.webmanifest">



</header>

<div class="layout">
<?php require_once 'sidebar.php'; ?>
    <main class="content content-full">
        <?php if (!$current): ?>
            <section class="info-section">
                <h1>Оборудование не найдено</h1>
                <p>Проверьте корректность ссылки или вернитесь в <a href="index.php#catalog">каталог</a>.</p>
            </section>
        <?php else: ?>
            <article class="machine-detail">
                <a href="index.php#catalog" class="back-link">← Вернуться в каталог</a>
                <div class="detail-header">
                    <div>
                        <div class="detail-code"><?php echo htmlspecialchars($current['code']); ?></div>
                        <h1><?php echo htmlspecialchars($current['title']); ?></h1>
                        <div class="card-tags">
                            <span class="tag tag-red"><?php echo htmlspecialchars($current['category']); ?></span>
                            <span class="tag"><?php echo htmlspecialchars($current['type']); ?></span>
                        </div>
                    </div>
                </div>

<div class="detail-layout">
    <div class="detail-gallery">
        <?php if (!empty($images)): ?>
            <div class="detail-main-image">
                <img src="<?php echo htmlspecialchars('/' . $images[0]); ?>"
                     alt="<?php echo htmlspecialchars($current['code'] . ' ' . $current['title']); ?>">
            </div>

            <?php if (count($images) > 1): ?>
                <div class="detail-thumbs" id="thumbs">
                    <?php foreach ($images as $index => $img): ?>
                        <img src="<?php echo htmlspecialchars('/' . $img); ?>"
                             class="thumb <?php echo $index === 0 ? 'active' : ''; ?>"
                             data-src="<?php echo htmlspecialchars('/' . $img); ?>">
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        <?php endif; ?>

        <div class="image-hint">
        
        
       <?php if (!empty($youtubeIDs)): ?>
    <section class="video-section">
        <h3>Видеообзоры станка</h3>

        <?php
        // первое видео — главное
        $firstId = $youtubeIDs[0];
        $otherIds = array_slice($youtubeIDs, 1);
        ?>

        <!-- Главное видео (всегда видно) -->
        <div class="video-wrapper">
            <iframe
                src="https://www.youtube.com/embed/<?php echo htmlspecialchars($firstId); ?>"
                title="Видеообзор станка"
                frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                allowfullscreen>
            </iframe>
        </div>

        <!-- Остальные видео — по желанию, в сворачиваемом блоке -->
        <?php if (!empty($otherIds)): ?>
            <details class="more-videos">
                <summary>Показать ещё видео (<?php echo count($otherIds); ?>)</summary>
                <div class="video-grid">
                    <?php foreach ($otherIds as $idx => $ytId): ?>
                        <div class="video-item">
                            <div class="video-wrapper">
                                <iframe
                                    src="https://www.youtube.com/embed/<?php echo htmlspecialchars($ytId); ?>"
                                    title="Дополнительное видео <?php echo $idx + 2; ?>"
                                    frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                    allowfullscreen>
                                </iframe>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </details>
        <?php endif; ?>
    </section>
<?php endif; ?>

        
        
        
            <!-- твой блок соцсетей оставляем как есть -->
            <div class="social-note">
                <p>Все видеообзоры и запуск оборудования — в наших соцсетях.</p>
                <p>
                   <div class="social-buttons">
    <a href="https://t.me/kabanasia" target="_blank" rel="noopener"
       class="social-btn telegram" aria-label="Telegram KABANASIA">
        <svg viewBox="0 0 24 24">
            <path d="M9.993 15.674 9.82 19.3c.36 0 .517-.155.707-.34l1.695-1.618 3.512 2.57c.643.355 1.103.168 1.262-.596l2.286-10.74c.204-.95-.343-1.323-.97-1.094L4.27 9.97c-.92.36-.907.875-.168 1.107l3.58 1.116 8.318-5.244c.392-.26.75-.116.456.144z"/>
        </svg>
    </a>

    <a href="https://instagram.com/kabanasia" target="_blank" rel="noopener"
       class="social-btn instagram" aria-label="Instagram KABANASIA">
        <svg viewBox="0 0 24 24">
            <path d="M7 2h10a5 5 0 0 1 5 5v10a5 5 0 0 1-5 5H7a5 5 0 0 1-5-5V7a5 5 0 0 1 5-5zm5 5.8a4.2 4.2 0 1 0 0 8.4 4.2 4.2 0 0 0 0-8.4zm6.4-.7a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
        </svg>
    </a>

    <a href="https://www.youtube.com/@kabanasia" target="_blank" rel="noopener"
       class="social-btn youtube" aria-label="YouTube KABANASIA">
        <svg viewBox="0 0 24 24">
            <path d="M23.5 6.2s-.23-1.63-.93-2.35c-.9-.93-1.9-.94-2.36-1C16.9 2.5 12 2.5 12 2.5h-.01s-4.9 0-8.21.35c-.46.06-1.46.07-2.36 1-.7.72-.93 2.35-.93 2.35S0 8.1 0 10v1.9c0 1.9.49 3.8.49 3.8s.23 1.63.93 2.35c.9.93 2.08.9 2.6 1 1.88.18 7.98.35 7.98.35s4.9 0 8.21-.35c.46-.06 1.46-.07 2.36-1 .7-.72.93-2.35.93-2.35s.49-1.9.49-3.8V10c0-1.9-.49-3.8-.49-3.8zM9.5 14.5V7.5l6 3.5-6 3.5z"/>
        </svg>
    </a>

    <a href="https://www.tiktok.com/@kaban.asia" target="_blank" rel="noopener"
       class="social-btn tiktok" aria-label="TikTok KABANASIA">
        <svg viewBox="0 0 24 24">
            <path d="M16 1c.3 2.2 1.7 3.9 3.9 4.1v3.2c-1.5.1-3-.4-4.3-1.3v6.1a6.2 6.2 0 1 1-6.2-6.2c.3 0 .7 0 1 .1v3.4a2.9 2.9 0 1 0 2.3 2.8V1h3.3z"/>
        </svg>
    </a>
</div>
                </p>
            </div>
        </div>
    </div>
  
                    <div class="detail-info">
                        <h2>Ключевые преимущества</h2>
                        <ul class="feature-list">
                            <?php foreach ($current['features'] as $f): ?>
                                <li><?php echo htmlspecialchars($f); ?></li>
                            <?php endforeach; ?>
                        </ul>

                        <?php if (!empty($current['application'])): ?>
                            <h3>Назначение</h3>
                            <p><?php echo htmlspecialchars($current['application']); ?></p>
                        <?php endif; ?>
                       
                        <div class="alert success">
                        ✔ Поставка напрямую с завода KABAN <br>  
                        ✔ Запуск и обучение на вашем предприятии <br> 
                        ✔ Сервис и запчасти в Центральной Азии 
                        </div>

<h3>Кому подходит этот станок</h3>
<ul class="feature-list">
    <li>Оконным заводам с объёмом от <?php echo htmlspecialchars($current['min_volume'] ?? '—'); ?> рам в смену</li>
    <li>Производствам, где важна стабильная геометрия и повторяемость</li>
    <li>Цехам, планирующим рост и автоматизацию</li>
</ul>

                        <h3>Консультация и расчёт проекта</h3>
                        <p>
                            Укажите в заявке код станка <strong><?php echo htmlspecialchars($current['code']); ?></strong>,
                            требуемую производительность (рам/смену) и страну, где расположен завод.
                        </p>

                      <div class="detail-actions">
    <a href="https://wa.me/996770551005?text=<?php echo urlencode('Здравствуйте! Интересует станок ' . $current['code'] . '. Хочу получить расчёт производительности и рекомендации под мой завод — ' . $current['title']); ?>"
       class="btn-primary" target="_blank" rel="noopener">
        Написать в WhatsApp по этому станку
    </a>

    <?php if (!empty($current['pdf']) || !empty($current['youtube'])): ?>
        <div class="detail-icons">
            <?php if (!empty($current['pdf'])): ?>
                <a href="<?php echo htmlspecialchars($current['pdf']); ?>"
                   class="icon-btn icon-btn-text"
                   target="_blank"
                   title="PDF-каталог станка">
                    📄PDF Станка
                </a>
            <?php endif; ?>
            
        </div>
        
               
        
    <?php endif; ?>
    
    <div class="machine-card special-card">
    <h3>Общий каталог оборудования KABAN</h3>
    <div class="special-links">
        <a href="docs/KATALOG-RU.pdf" target="_blank">📄 Скачать PDF</a>
        <a href="catalog-viewer.php" target="_blank">📘 Смотреть онлайн</a>
    </div>
</div>
</div>




                    </div>
                      </div>
                    
                     
        <?php
$faqItems = getFaqForMachine($current);
if (!empty($faqItems)):
?>
<section class="faq-block">
    <h2>Часто задаваемые вопросы по этому оборудованию</h2>

    <?php foreach ($faqItems as $item): ?>
        <div class="faq-item">
            <div class="faq-question">
                <?php echo htmlspecialchars($item['q']); ?>
            </div>
            <div class="faq-answer">
                <?php echo nl2br(htmlspecialchars($item['a'])); ?>
            </div>
        </div>
    <?php endforeach; ?>
</section>
<?php endif; ?>
             
                     
              
                
 
 
    <?php
// === Похожее оборудование ===
$related = [];
foreach ($machines as $m) {
    if ($m['slug'] === $current['slug']) continue; // пропустить текущий
    if ($m['category'] === $current['category'] && $m['type'] === $current['type']) {
        $related[] = $m;
    }
    if (count($related) >= 3) break;
}

if (!empty($related)):
?>
<section class="related-section">
    <h2>Похожее оборудование</h2>
    <div class="related-list">
        <?php foreach ($related as $r): ?>
            <a href="machine.php?slug=<?php echo urlencode($r['slug']); ?>" class="related-card">
                <img src="<?php echo htmlspecialchars($r['image']); ?>"
                     alt="<?php echo htmlspecialchars($r['code'].' '.$r['title']); ?>">
                <div class="related-info">
                    <div class="related-code"><?php echo htmlspecialchars($r['code']); ?></div>
                    <div class="related-title"><?php echo htmlspecialchars($r['title']); ?></div>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
</section>
<?php endif; ?>

               
       
          

            <!-- Мини-блок про запуск завода под ключ -->
            <section class="turnkey-mini">
                <h2>Запуск завода под ключ с KABAN</h2>
                <p class="turnkey-mini-text">
                    Если вы планируете запуск нового цеха или хотите перестроить существующее производство,
                    мы поможем спроектировать и запустить линию KABAN «под ключ» — от подбора станков до обучения персонала.
                </p>

                <div class="turnkey-mini-steps">
                    <div class="turnkey-mini-step">
                        
                        <h3>Аудит и цель по производительности</h3>
                        <p>Разбираем текущий цех или планы с нуля, профильные системы и требуемые объёмы в смену.</p>
                    </div>
                    <div class="turnkey-mini-step">
                       
                        <h3>Проект потока и подбор линии</h3>
                        <p>Проектируем поток ПВХ/алюминий, подбираем оборудование KABAN под ваши задачи и бюджет.</p>
                    </div>
                    <div class="turnkey-mini-step">
                       
                        <h3>Запуск, обучение и сервис</h3>
                        <p>Поставка, монтаж, пуско-наладка, обучение операторов и дальнейшее сервисное сопровождение.</p>
                    </div>
                </div>

                <div class="turnkey-mini-cta">
                    <p>
                        Напишите, если хотите обсудить запуск или модернизацию завода с учётом оборудования
                        <strong><?php echo htmlspecialchars($current['code']); ?></strong>.
                    </p>
                    <a href="https://wa.me/996770551005?text=<?php echo urlencode('Здравствуйте! Хочу обсудить запуск/модернизацию завода под ключ с оборудованием ' . $current['code'] . ' — ' . $current['title']); ?>"
                       class="btn-primary" target="_blank" rel="noopener">
                        Обсудить запуск завода в WhatsApp
                    </a>
                </div>
            </section>
            <!-- /Мини-блок -->

     
                
                
            </article>
        <?php endif; ?>
    </main>
</div>

<a href="https://wa.me/996770551005?text=<?php echo urlencode('Интересует оборудование, пишу вам с сайта КабанАзия.'); ?> " class="whatsapp-widget" target="_blank" rel="noopener">
    WhatsApp
</a>

<!-- Полноэкранный просмотр картинки -->
<div id="imageViewer" class="image-viewer">
    <button class="viewer-arrow viewer-prev" type="button">&#10094;</button>
    <img id="viewerImg" src="" alt="">
    <button class="viewer-arrow viewer-next" type="button">&#10095;</button>
    <span class="viewer-close">&times;</span>
</div>






<?php require_once 'footer.php'; ?>



</body>
</html>

