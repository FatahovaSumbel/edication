<div class="container-detail">
    <!-- Левое меню (вкладки) -->
    <div class="right-column">
        <h5>ДОКУМЕНТАЦИЯ</h5>
        <?php foreach ($details as $index => $tab): ?>
            <button class="card-detail-doc <?= $index === 0 ? 'active' : '' ?>"
                    type="button" data-tab="<?= htmlspecialchars($tab['tab_key']) ?>">
                <span><?= htmlspecialchars($tab['tab_icon']) ?></span>
                <p class="big"><?= htmlspecialchars($tab['tab_title']) ?></p>
                <p class="small"><?= htmlspecialchars($tab['tab_subtitle']) ?></p>
            </button>
        <?php endforeach; ?>
    </div>

    <!-- Контент вкладок -->
    <div class="left-column">
        <h3><?= htmlspecialchars($doc['description']) ?></h3>

        <div class="tech-tags">
            <?php
                $tags = explode(',', $doc['tags']);
                foreach ($tags as $tag) { ?>
                    <span><?= htmlspecialchars(trim($tag)) ?></span>
            <?php } ?>
        </div>

        <!-- Блоки контента для каждой вкладки -->
        <?php foreach ($details as $index => $tab): ?>
            <div id="<?= htmlspecialchars($tab['tab_key']) ?>" 
                 class="tab-content <?= $index === 0 ? 'active' : '' ?>">
                <div class="web-app">
                    <p class="orange"><?= htmlspecialchars($tab['block_label']) ?></p>
                    <h4><?= htmlspecialchars($tab['block_title']) ?></h4>
                    <p><?= htmlspecialchars($tab['block_content']) ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>