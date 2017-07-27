<?php

echo $this->Form->create($searchFields);
echo $this->Form->Control('search', ['style' => 'width:25%; height:25%;', 'autofocus' => true]);
echo $this->Form->select('dropDown', $genreList, ['empty' => 'All', 'style' => 'width:25%; height:25%;']);
echo $this->Form->button('Search');
echo $this->Form->end();

echo $this->Html->link(__('item1'),['controller'=>'Item','action'=>'index','?'=>array('id'=>1,'what'=>'what')]);
?>

