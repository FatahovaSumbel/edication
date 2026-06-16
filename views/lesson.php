<div class="container-lesson">
    <?php if ($lesson) { ?>
        <h2><a href="/page/<?= $lesson['page_id'] ?>"> <?= htmlspecialchars($lesson['title']) ?></a> ></h2> <h1>Содержание главы</h1>
        
        <div class="lesson-nav">
            <!-- кнопка НАЗАД -->
            <?php if ($prev_id) { ?>
                <a href="/lesson/<?= $prev_id ?>" class="nav-btn">&lt;</a>
            <?php } else { ?>
                <span class="nav-btn">&lt;</span>
            <?php } ?>

            <!-- название текущей главы -->
            <span class="lesson-title"><?= htmlspecialchars($lesson['name']) ?></span>

            <!-- кнопка ВПЕРЕД -->
            <?php if ($next_id) { ?>
                <a href="/lesson/<?= $next_id ?>" class="nav-btn">&gt;</a>
            <?php } else { ?>
                <span class="nav-btn">&gt;</span>
            <?php } ?>
        </div>

        <div class="lesson-content">
            <?= $lesson['content'] ?>
        </div>
        
    <?php } ?>
</div>