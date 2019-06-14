<?php
use yii\helpers\Html;
?>
<main class="container">
    <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
            <div class="pb-5 pt-5">
                <h1 class=""><?= $page->title ?></h1>
                <p><?= $page->content ?></p>
            </div>
        </div>

        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 pt-5">
            <div class="card mb-2">
                <ul class="list-group list-group-flush">
                    <?php foreach ($pagesInCategory as $page): ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <?= Html::a($page->title , ['page/index', 'id' => $page->id], ['class' => 'text-success']) ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</main>