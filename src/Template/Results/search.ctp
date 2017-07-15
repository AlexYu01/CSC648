    <style>
        li {
            list-style: none;
            display: inline;
            padding: 5px;
        }
    </style>

    <h1>Retrieved Articles</h1>

    <table>
        <tr>
            <th>Id</th>
            <th>Title</th>
            <th>Created</th>
            <th>Media</th>
        </tr>

        <?php foreach ($results as $media): ?>
        <tr>
            <td><?= $media->media_id ?> </td>
            <td><?= $media->media_title ?></td>
            <td><?= $media->created ?></td>
            <td><?= $this->Html->image($media->media_link, ['alt' => $media->media_title, 'height' => '100px', 'width' => '100px']) ?></td>
        </tr>
        <?php endforeach; ?>
    </table>


<?php/*
echo $this->Paginator->first('< first');
echo $this->Paginator->prev(' << ' . __('previous'));
echo $this->Paginator->numbers(['first' => 'First Page']);
echo $this->Paginator->next(' >> ' . __('next'));
echo $this->Paginator->last('last >');
*/?>

<?php
echo $this->Paginator->counter([
    'format' => 'Page {{page}} of {{pages}}, showing {{current}} records out of
             {{count}} total, starting on record {{start}}, ending on {{end}}'
])
?>
