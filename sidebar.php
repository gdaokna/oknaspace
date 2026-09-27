<?php
// Счётчики станков по категории + типу
$typeCounts = [];

foreach ($machines as $m) {
    $cat  = $m['category'] ?? '';
    $type = $m['type'] ?? '';

    if (!$cat || !$type) continue;

    if (!isset($typeCounts[$cat])) {
        $typeCounts[$cat] = [];
    }

    $typeCounts[$cat][$type] = ($typeCounts[$cat][$type] ?? 0) + 1;
}
?>


<aside class="sidebar" id="sidebar">
    <div class="sidebar-title">Каталог оборудования</div>
    <div class="sidebar-tree">
        <?php foreach ($menuOrder as $cat => $types): ?>
            <div class="tree-group" data-category="<?= htmlspecialchars($cat) ?>">
                
                <button class="tree-cat"
                        data-filter-category="<?= htmlspecialchars($cat) ?>">
                    <span class="tree-cat-title"><?= htmlspecialchars($cat) ?></span>
                    <span class="tree-arrow"></span>
                </button>

                <div class="tree-types">
                    <?php foreach ($types as $type): ?>
                    
                    <?php $count = $typeCounts[$cat][$type] ?? 0; ?>
                        <button class="tree-type"
                                data-filter-category="<?= htmlspecialchars($cat) ?>"
                                data-filter-type="<?= htmlspecialchars($type) ?>">
                            <span class="tree-type-title"><?= htmlspecialchars($type) ?></span>
                            <span class="tree-type-count"><?= $count ?></span>
                        </button>
                    <?php endforeach; ?>
                </div>

            </div>
        <?php endforeach; ?>
    </div>
</aside>

