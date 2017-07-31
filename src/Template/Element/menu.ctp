<input type="checkbox" checked="true" class="sbs-switch -hidden"
        id="sb-switch">
<label for="sb-switch" class="sbs-icon" id="sb-toggle"> <svg
                class="sbs-stroke -absolute" x="0px" y="0px" width="50px"
                height="50px" viewBox="0 0 50 50" aria-labelledby="Toggle navigation"
                role="button">
                                <title>Toggle navigation</title>
                                <circle class="sbs-circle" cx="25" cy="25" r="23"
                        stroke="#459fed" stroke-width="2"></circle>
                                </svg>
        <div class="sbs-arrow">
                <hr class="sbs-arrow-hand">
                <hr class="sbs-arrow-hand">
        </div>
</label>

<aside id="sidebar" class="sb-sidebar">
        <button type="button" class="sbs-collapse" id="sb-collapse">
                <div class="sbs-arrow">
                        <hr class="sbs-arrow-hand">
                        <hr class="sbs-arrow-hand">
                </div>
        </button>

                <?php
                    echo $this->Form->create($searchFields);
                    echo $this->Form->Control('search', ['label' => false, 'class' => 'sb-search', 'placeholder' => 'E.g music, photography', 'type' => 'text', 'tab-index' => '0', 'autofocus' => true]);
                    echo $this->Form->end();
                ?>
                <hr class="sb-separator -blue">

        <h2>View by</h2>
        <ul class="sb-filters">
                <li name="new"><a href="#">NEW!</a></li>
                <li name="most-popular"><a href="#">Most Popular</a></li>
        </ul>

        <hr class="sb-separator">

        <h2>Categories</h2>
        <ul class="sb-categories">

                <li name="all" class="sb-lvl-1-cat -no-icon "><label>&nbsp;</label>
                        <a href="#">See All Images / Videos</a></li>

                <?php foreach ($genresData as $genre): ?>
                <li name="<?= $genre->genre_name ?>" class="sb-lvl-1-cat  "><input
                        type="checkbox" id="sb-cat-<?= $genre->genre_id ?>"> <label
                        for="sb-cat-<?= $genre->genre_id ?>">&nbsp;</label> <a href="#">
                                <?= $genre->genre_name ?>
                </a></li>
                <?php endforeach; ?>

        </ul>
</aside>
<div class="tg-padding"></div>
