<div class="container-page">
    <?php if (!empty($pages)) { ?>
        <h2><a href="/topic/<?= $topic['library_id'] ?>"><?= htmlspecialchars($topic['title']) ?></a></h2><h1><?= htmlspecialchars($pages[0]['title']) ?></h1>

        <?php 
            $currentPart = ''; // переменная для отслеживания текущей части
            foreach ($pages as $p) { 
                // если название части в БД изменилось, выводим новый заголовок
                if ($currentPart !== $p['name']) {
                    if ($currentPart !== '') { echo '</div>'; } // закрываем предыдущую сетку, если это не первая итерация
                    
                    $currentPart = $p['name']; // запоминаем новую часть
                    ?>
                    
                    <h2 class="chapter-title">
                        <?= htmlspecialchars($currentPart) ?>
                    </h2>
                    
                    <div class="lessons-grid"> <!-- ткрываем новую сетку для текущей части -->
                <?php } ?>

                <a href="/lesson/<?= $p['id'] ?>" class="lesson-card">
                    <span class="lesson-number"><?= $p['num'] ?></span>
                    <span class="lesson-name"><?= htmlspecialchars($p['lesson_name']) ?></span>
                </a>
        <?php }  ?>
        
        </div> 
        
    <?php } ?>
</div>