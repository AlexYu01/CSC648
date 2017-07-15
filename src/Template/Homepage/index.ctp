<?php

echo $this->Form->create($search);
echo $this->Form->Control('search', ['style' => 'width:25%; height:25%;', 'autofocus' => true]);
echo $this->Form->select('dropDown', $genreList, ['empty' => 'All', 'style' => 'width:25%; height:25%;']);
echo $this->Form->button('Search');
echo $this->Form->end();
?>

