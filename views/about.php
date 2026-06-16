
<div class="container-about">

    <section class="about-hero">
        <h1>Образовательная платформа для студентов и преподавателей</h1>
        <p>Единое пространство для обучения, контроля посещаемости и реализации студенческих проектов.</p>
    </section>

    <!-- миссия -->
    <section class="about-mission">
        <div class="mission-text">
            <h2>Наша миссия</h2>
            <p>Мы создаём современную образовательную среду, которая объединяет учебные материалы, практические задачи и студенческие проекты в одном месте.</p>
        </div>
        <div class="mission-image">
            <img src="/assets/img/miss.jpg">
        </div>
    </section>

    <!-- возможности -->
    <?php if (!empty($features)) { ?>
    <section class="about-section">
        <h2 class="section-title"><?= htmlspecialchars($features[0]['title']) ?></h2>
        <div class="features-grid">
            <?php foreach ($features as $f) { ?>
                <div class="feature-card">
                    <img src="<?= $f['image'] ?>">
                    <p><?= $f['name'] ?></p> 
                </div>
            <?php } ?>
        </div>
    </section>
    <?php } ?>

    <!-- для кого -->
    <?php if (!empty($targets)) { ?>
    <section class="about-section">
        <h2 class="section-title"><?= htmlspecialchars($targets[0]['title']) ?></h2>
        <div class="features-grid">
            <?php foreach ($targets as $t) { ?>
                <div class="feature-card">
                    <img src="<?= $t['image'] ?>">
                    <p><?= $t['name'] ?></p>
                </div>
            <?php } ?>
        </div>
    </section>
    <?php } ?>

    <!-- технологии -->
    <section class="about-section">
        <h2 class="section-title">Технологический стек</h2>
        <div class="tech-stack">
            <span class="tech-badge">HTML</span>
            <span class="tech-badge">CSS</span>
            <span class="tech-badge">JavaScript</span>
            <span class="tech-badge">PHP</span>
            <span class="tech-badge">MySQL</span>
            <span class="tech-badge">React</span>
        </div>
    </section>

    <!-- команда -->
    <?php if (!empty($team)) { ?>
    <section class="about-section">
        <h2 class="section-title"><?= htmlspecialchars($team[0]['title']) ?></h2>
        <div class="team-grid">
            <?php foreach ($team as $member) { ?>
                <div class="team-card">
                    <img class="team-avatar" src="<?= $member['image'] ?>">
                    <p class="team-name"><?= $member['name'] ?></p>
                </div>
            <?php } ?>
        </div>
    </section>
    <?php } ?>

    <section class="about-bot">
        <h2>Присоединяйтесь к платформе. Начните обучение прямо сейчас</h2>
    </section>

</div>
