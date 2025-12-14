<?php include __DIR__ . '/layout/header.php'; ?>

<div class="container">

    <div class="row g-4">
        <?php if (!empty($posts)): ?>
            <?php
                $parsedown = null;
                if (class_exists('Parsedown')) {
                    $parsedown = new Parsedown();
                    if (method_exists($parsedown, 'setSafeMode')) {
                        $parsedown->setSafeMode(true);
                    }
                }
            ?>
            <?php foreach ($posts as $post): ?>
                <div class="col-12 col-md-6">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($post->title, ENT_QUOTES, 'UTF-8') ?></h5>
                            <div class="card-text">
                                <?php
                                $content = isset($post->content) ? (string)$post->content : '';
                                if ($parsedown) {
                                    echo $parsedown->text($content);
                                } else {
                                    echo nl2br(htmlspecialchars($content, ENT_QUOTES, 'UTF-8'));
                                }
                                ?>
                            </div>
                        </div>
                        <div class="card-footer text-muted">
                            Опубліковано: <?= htmlspecialchars($post->created_at, ENT_QUOTES, 'UTF-8') ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12">
                <div class="alert alert-info">Нічого не знайдено<?= isset($search) && $search !== '' ? ' за запитом «' . htmlspecialchars($search, ENT_QUOTES, 'UTF-8') . '»' : '' ?>.</div>
            </div>
        <?php endif; ?>
    </div>

    <?php if (isset($totalPages) && isset($page) && $totalPages > 1): ?>
        <nav aria-label="Пагінація" class="mt-4">
            <ul class="pagination justify-content-center">
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <?php
                        $link = '?page=' . $i;
                        if (!empty($search)) { $link .= '&search=' . urlencode($search); }
                    ?>
                    <li class="page-item <?= ($page == $i) ? 'active' : '' ?>">
                        <a class="page-link" href="<?= $link ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>
            </ul>
        </nav>
    <?php endif; ?>
</div>

<?php include __DIR__ . '/layout/footer.php'; ?>
