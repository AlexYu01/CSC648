<?php

echo $this->Form->create($newMedia);
echo $this->Form->Control('media_title');
echo $this->Form->Control('author_id');
echo $this->Form->Control('price');
echo $this->Form->Control('media_link');
echo $this->Form->Control('type_id');
echo $this->Form->Control('media_desc');
echo $this->Form->select('genre_id', $genreList);
echo $this->Form->button('Upload');
echo $this->Form->end();
?>


