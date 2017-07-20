<?php

echo $this->Form->create($searchFields);
echo $this->Form->Control('search', ['style' => 'width:25%; height:25%;']);
echo $this->Form->select('dropDown', $genreList, ['empty' => 'All', 'style' => 'width:25%; height:25%;']);
echo $this->Form->button('Search');
echo $this->Form->end();
?>

<h3><?php 
$session = $this->request->session();
        echo $session->read('searchResults');
        ?>
</h3>
<table>
    <tr>
        <th>Id</th>
        <th>Title</th>
        <th>Description</th>
        <th>Created</th>
        <th>Author</th>
        <th>Media</th>
    </tr>

        <?php foreach ($results as $media): ?>
    <tr>
        <td><?= $media->media_id ?> </td>
        <td><?= $media->media_title ?></td>
        <td><?= $media->media_desc ?></td>
        <td><?= $media->upload_date->format(DATE_RFC850) ?></td>
        <td><?= $media->u['username'] ?></td>
        <td><?= $this->Html->image($media->media_link, ['alt' => $media->media_title, 'height' => '200px', 'width' => '200px']) ?></td>
    </tr>
        <?php endforeach; ?>
</table>

<div class="pagination pagination-large">
    <ul class="pagination">
<?php
echo $this->Paginator->first('< first');
echo $this->Paginator->prev(' << ' . __('previous'));
echo $this->Paginator->numbers(['first' => 'First Page']);
echo $this->Paginator->next(__('next') . ' >> ');
echo $this->Paginator->last('last >');
?>
    </ul>
</div>
<?php
echo $this->Paginator->counter([
    'format' => 'Page {{page}} of {{pages}}, showing {{current}} records out of
             {{count}} total, starting on record {{start}}, ending on {{end}}'
])
?>