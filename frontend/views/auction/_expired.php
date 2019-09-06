<div class="auction-time-top alert alert-success text-center">
    <h4 class="alert-heading">Аукцион завершен123</h4>
    <hr>
    <?php if($auction->winner): ?>
        <p class="mb-2">Победитель аукциона: <span class="alert-link"><?= $auction->winner->username ?></span></p>
        <p class="mb-0">Окончательная цена: <span class="alert-link"><?= $auction->winBid->bid ?> руб.</span></p>
    <?php endif; ?>
</div>