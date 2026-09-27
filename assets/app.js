document.addEventListener('DOMContentLoaded', function () {

    /* ===============================
       MOBILE MENU
    =============================== */

    const burger = document.getElementById('burgerBtn');
    const sidebar = document.getElementById('sidebar');

    function openSidebar() {
    if (!sidebar) return;
    sidebar.classList.add('open');
    document.body.classList.add('menu-open');
    scrollSidebarToActive();
}


    function closeSidebar() {
        if (!sidebar) return;
        sidebar.classList.remove('open');
        document.body.classList.remove('menu-open');
    }

    function closeSidebarOnMobile() {
         if (window.innerWidth <= 900 || document.body.classList.contains('page-machine')) {
        closeSidebar();
        }
    }

    if (burger && sidebar) {
        burger.addEventListener('click', function (e) {
            e.stopPropagation();
            sidebar.classList.contains('open') ? closeSidebar() : openSidebar();
        });

        document.addEventListener('click', function (e) {
            if (
                sidebar.classList.contains('open') &&
                !sidebar.contains(e.target) &&
                !burger.contains(e.target)
            ) {
                closeSidebar();
            }
        });
    }


/* ===============================
   LOGO RESET FILTERS
=============================== */

const logo = document.getElementById('logoReset');

if (logo) {
    logo.addEventListener('click', function (e) {

        // Если мы УЖЕ на странице каталога — сбрасываем без перезагрузки
        if (document.getElementById('machineGrid')) {
            e.preventDefault();

            // Сброс фильтров
            if (searchInput) searchInput.value = '';
            if (categoryFilter) categoryFilter.value = '';
            if (typeFilter) typeFilter.value = '';

            // Показать все карточки
            cards.forEach(card => {
                card.style.display = '';
            });

            // Сброс sidebar
            document.querySelectorAll('.tree-cat, .tree-type').forEach(el => {
                el.classList.remove('active');
            });

            document.querySelectorAll('.tree-group').forEach(g => {
                g.classList.remove('open');
            });

            // Убираем параметры из URL
            history.replaceState(null, '', 'index.php');

            // Скроллим к каталогу
            document.getElementById('catalog')?.scrollIntoView({ behavior: 'smooth' });

            // Закрываем мобильное меню
            closeSidebar?.();
        }

        // если мы НЕ на index.php — обычный переход по ссылке
    });
}


    /* ===============================
       SIDEBAR WITH STATE
    =============================== */

    const SIDEBAR_STATE_KEY = 'kaban_sidebar_state';

    function saveSidebarState(category, type) {
        localStorage.setItem(
            SIDEBAR_STATE_KEY,
            JSON.stringify({ category, type })
        );
    }

    function loadSidebarState() {
        try {
            return JSON.parse(localStorage.getItem(SIDEBAR_STATE_KEY)) || {};
        } catch {
            return {};
        }
    }

    function clearSidebarActive() {
        document.querySelectorAll('.tree-cat, .tree-type').forEach(el => {
            el.classList.remove('active');
        });
        document.querySelectorAll('.tree-group').forEach(g => {
            g.classList.remove('open');
        });
    }

    function activateSidebar(category, type) {
        clearSidebarActive();

        if (!category) return;

        document.querySelectorAll('.tree-group').forEach(group => {
            const catBtn = group.querySelector('.tree-cat');
            if (!catBtn) return;

            if (catBtn.dataset.filterCategory === category) {
                catBtn.classList.add('active');
                group.classList.add('open');

                if (type) {
                    group.querySelectorAll('.tree-type').forEach(tBtn => {
                        if (tBtn.dataset.filterType === type) {
                            tBtn.classList.add('active');
                        }
                    });
                }
            }
        });
    }

    // раскрытие групп (ТОЛЬКО раскрытие, без навигации)
    document.querySelectorAll('.tree-cat').forEach(btn => {
        btn.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();

            const group = btn.closest('.tree-group');
            if (!group) return;

            group.classList.toggle('open');
        });
    });

    // клик по типу
    document.querySelectorAll('.tree-type').forEach(btn => {
        btn.addEventListener('click', function (e) {
            e.stopPropagation();

            const category = btn.dataset.filterCategory;
            const type = btn.dataset.filterType;

            saveSidebarState(category, type);

            // если мы не на главной — уходим туда с параметрами
            if (!document.getElementById('machineGrid')) {
                const params = new URLSearchParams();
                if (category) params.set('category', category);
                if (type) params.set('type', type);

                let url = 'index.php';
                if (params.toString()) url += '?' + params.toString();
                url += '#catalog';

                window.location.href = url;
                return;
            }

            // если мы на главной — фильтруем
            if (categoryFilter) categoryFilter.value = category;
            if (typeFilter) typeFilter.value = type;

            applyFilters();
            activateSidebar(category, type);
            closeSidebarOnMobile();
        });
    });

    /* ===============================
       FILTERS (SEARCH / SELECT)
    =============================== */

    const searchInput = document.getElementById('searchInput');
    const categoryFilter = document.getElementById('categoryFilter');
    const typeFilter = document.getElementById('typeFilter');
    const cards = Array.from(document.querySelectorAll('.machine-card'));

    function applyFilters() {
        const query = (searchInput?.value || '').toLowerCase();
        const category = categoryFilter?.value || '';
        const type = typeFilter?.value || '';

        cards.forEach(card => {
            const code = (card.dataset.code || '').toLowerCase();
            const cat = card.dataset.category || '';
            const t = card.dataset.type || '';
            const text = (card.innerText || '').toLowerCase();

            let visible = true;
            if (category && cat !== category) visible = false;
            if (type && t !== type) visible = false;
            if (query && !text.includes(query) && !code.includes(query)) visible = false;

            card.style.display = visible ? '' : 'none';
        });
    }

    searchInput?.addEventListener('input', applyFilters);
    categoryFilter?.addEventListener('change', () => {
        saveSidebarState(categoryFilter.value, '');
        applyFilters();
        activateSidebar(categoryFilter.value, '');
    });

    typeFilter?.addEventListener('change', () => {
        saveSidebarState(categoryFilter.value, typeFilter.value);
        applyFilters();
        activateSidebar(categoryFilter.value, typeFilter.value);
    });

    
/* ===============================
   RESET FILTERS BUTTON
=============================== */

const resetBtn = document.getElementById('resetFiltersBtn');

if (resetBtn) {
    resetBtn.addEventListener('click', () => {

        // Сброс значений
        if (searchInput) searchInput.value = '';
        if (categoryFilter) categoryFilter.value = '';
        if (typeFilter) typeFilter.value = '';

        // Показать все карточки
        cards.forEach(card => {
            card.style.display = '';
        });

        // Очистить sidebar
        document.querySelectorAll('.tree-cat, .tree-type').forEach(el => {
            el.classList.remove('active');
        });

        document.querySelectorAll('.tree-group').forEach(g => {
            g.classList.remove('open');
        });

        // Убрать параметры из URL
        history.replaceState(null, '', 'index.php');

        // Скролл к каталогу
        document.getElementById('catalog')?.scrollIntoView({ behavior: 'smooth' });
    });
}


    /* ===============================
       APPLY STATE FROM URL / STORAGE
    =============================== */

    const urlParams = new URLSearchParams(window.location.search);
    const urlCategory = urlParams.get('category');
    const urlType = urlParams.get('type');

    const stored = loadSidebarState();
    const finalCategory = urlCategory || stored.category || '';
    const finalType = urlType || stored.type || '';

    if (categoryFilter && finalCategory) categoryFilter.value = finalCategory;
    if (typeFilter && finalType) typeFilter.value = finalType;

    if (finalCategory || finalType) {
        applyFilters();
        activateSidebar(finalCategory, finalType);
    }

    /* ===============================
       DETAIL PAGE GALLERY
    =============================== */

    const thumbs = document.querySelectorAll('.detail-thumbs .thumb');
    const mainImage = document.querySelector('.detail-main-image img');

    const galleryImages = [];
    let currentIndex = 0;

    thumbs.forEach((th, index) => {
        const src = th.dataset.src;
        if (src) galleryImages.push(src);
        if (th.classList.contains('active')) currentIndex = index;

        th.addEventListener('click', () => {
            if (!mainImage) return;
            mainImage.src = src;
            thumbs.forEach(t => t.classList.remove('active'));
            th.classList.add('active');
            currentIndex = index;
        });
    });

    if (mainImage && galleryImages.length === 0) {
        galleryImages.push(mainImage.src);
    }

    /* ===============================
       FULLSCREEN IMAGE VIEWER
    =============================== */

    const viewer = document.getElementById('imageViewer');
    const viewerImg = document.getElementById('viewerImg');
    const viewerClose = document.querySelector('.viewer-close');
    const viewerPrev = document.querySelector('.viewer-prev');
    const viewerNext = document.querySelector('.viewer-next');

    function showImageByIndex(index) {
        if (!galleryImages.length) return;
        if (index < 0) index = galleryImages.length - 1;
        if (index >= galleryImages.length) index = 0;
        currentIndex = index;
        viewerImg.src = galleryImages[currentIndex];
        if (mainImage) mainImage.src = galleryImages[currentIndex];
    }

    if (mainImage && viewer && viewerImg && viewerClose) {
        mainImage.addEventListener('click', () => {
            viewer.style.display = 'flex';
            showImageByIndex(currentIndex);
        });

        viewerClose.addEventListener('click', () => viewer.style.display = 'none');

        viewer.addEventListener('click', e => {
            if (e.target === viewer) viewer.style.display = 'none';
        });

        viewerPrev?.addEventListener('click', e => {
            e.stopPropagation();
            showImageByIndex(currentIndex - 1);
        });

        viewerNext?.addEventListener('click', e => {
            e.stopPropagation();
            showImageByIndex(currentIndex + 1);
        });

        document.addEventListener('keydown', e => {
            if (viewer.style.display !== 'flex') return;
            if (e.key === 'ArrowLeft') showImageByIndex(currentIndex - 1);
            if (e.key === 'ArrowRight') showImageByIndex(currentIndex + 1);
            if (e.key === 'Escape') viewer.style.display = 'none';
        });
    }

    /* ===============================
       FAQ
    =============================== */

    document.querySelectorAll('.faq-item').forEach(item => {
        const q = item.querySelector('.faq-question');
        const a = item.querySelector('.faq-answer');
        if (!q || !a) return;

        q.addEventListener('click', () => {
            item.classList.toggle('open');
            a.style.display = item.classList.contains('open') ? 'block' : 'none';
        });
    });

});

function scrollSidebarToActive() {
    const sidebar = document.getElementById('sidebar');
    const active = sidebar?.querySelector('.tree-type.active, .tree-cat.active');

    if (sidebar && active) {
        setTimeout(() => {
            active.scrollIntoView({
                block: 'center',
                behavior: 'smooth'
            });
        }, 150);
    }
}

