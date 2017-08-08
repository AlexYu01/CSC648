<style>
    #stuff {
        padding-top: 40px;
    }

    .error-message {
        font-size: smaller;
        color: #cc0000;
        padding-left: 25px;
    }
</style>

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
    echo $this->Form->create( $searchFields );




    echo $this->Form->Control( 'search', ['label' => false, 'class' => 'sb-search',
        'placeholder' => 'E.g music, photography', 'type' => 'text', 'tab-index' => '0',
        'autofocus' => true, 'error' => false] );



    echo $this->Form->error( 'search', null, ['class' => 'error-message text-center'] );
    ?>

    <hr class="sb-separator -blue">
    <div id="stuff" >
        <?=
        $this->Form->select( 'dropDown', $genreList, ['empty' => 'All',
            'class' => 'select', 'id' => 'dropDown', 'style' => 'width:80px;', 'label' => false] )
        ?>
        <?= $this->Form->button( 'Submit', ['class' => 'button', 'type' => 'submit'] ) ?>
    </div>

    <?php
    echo $this->Form->end();
    ?>


    <h2>View by</h2>
    <ul class="sb-filters">
        <li> <?=
            $this->Html->link( 'NEW!', ['controller' => 'Results', 'action' => 'search',
                '?' => ['sort' => 'upload_date', 'direction' => 'desc']] );
            ?></li>
        <li> <?=
            $this->Html->link( 'Most Popular', ['controller' => 'Results',
                'action' => 'search', '?' => ['sort' => 'sold_count', 'direction' => 'desc']] );
            ?></li>
    </ul>

    <hr class="sb-separator">

    <h2>Categories</h2>
    <ul class="sb-categories">

        <li name="all" class="sb-lvl-1-cat -no-icon "><label>&nbsp;</label>
            <a href="search?">See All Images / Videos</a></li>

        <?php foreach ( $genresData as $genre ): ?>
            <li name="<?= $genre->genre_name ?>" class="sb-lvl-1-cat  "><input
                    type="checkbox" id="sb-cat-<?= $genre->genre_id ?>"> <label
                    for="sb-cat-<?= $genre->genre_id ?>">&nbsp;</label> <a href="search?searchGenre=<?= $genre->genre_id ?>">
                        <?= $genre->genre_name ?>
                </a></li>
        <?php endforeach; ?>

    </ul>
</aside>
<div id="div-tg-padding" class="tg-padding"></div>