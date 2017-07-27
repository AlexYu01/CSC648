<?php

echo $this->Form->create($newMedia, ['type' => 'file']);
echo $this->Form->Control('media_title');
echo $this->Form->select('author_id', $userList);
echo $this->Form->Control('price');
echo $this->Form->Control('permission');
echo $this->Form->select('type_id', $typeList);
echo $this->Form->Control('media_desc');
echo $this->Form->select('genre_id', $genreList);
echo $this->Form->input('file', ['type' => 'file', 'accept' => 'image/*, video/*']);
echo $this->Form->button('Upload');
echo $this->Form->end();
?>
