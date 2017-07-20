<?php

echo $this->Form->create($searchFields);
echo $this->Form->Control('search', ['style' => 'width:25%; height:25%;']);
echo $this->Form->select('dropDown', $genreList, ['empty' => 'All', 'style' => 'width:25%; height:25%;']);
echo $this->Form->button('Search');
echo $this->Form->end();
?>
<html>
    <style type="text/css">
        body{margin: 0;padding: 0;}
        #filter{ width:210px; height: 1300px; background: #ffffff;float: left;}
        #searchField{ width:83%; height: 1300px; background: #ffffff;float: right;} 
        #titleLink{font-size: larger; font-style: italic; font-weight: 800;}
    </style>
    <style>
        .itemDisplay-left{float: left;wigth: 500px;height: 300px;}
        .itemDisplay-right{float: right; width: 600px;height: 300px;}
        .pagination{font-size: larger;}
    </style>
    
    <div id="filter">
    <h1>Filter</h1>
    </div>

    <div id="searchField">
        <h1>Result</h1>
        <?php foreach ($results as $media): ?>
        <div class="itemDisplay-left"> 
            <div id="titleOfItem">
                <div id="titleLink"><?= $this->Html->link(__($media->media_title),['controller'=>'Item','action'=>'index',$media->media_id]) ?></div>  
            </div>
                
            <tr>
                <td><?= $this->Html->image($media->media_link, ['alt' => $media->media_title, 'height' => '350px', 'width' => '350px']) ?></td>
                
            </tr>
                
        </div>  
        <div class="itemDisplay-right">
            <br></br>
            <br></br>
            <div id="titleLink">anthor id: <?= $this->Html->link(__($media->author_id),['controller'=>'Item','action'=>'index',$media->author_id]) ?></div> 
            <div id="titleLink">Description: <?= $this->Html->link(__($media->media_desc),['controller'=>'Item','action'=>'index',$media->media_desc]) ?></div>
            <div id="titleLink">Price: <?= $this->Html->link(__($media->price),['controller'=>'Item','action'=>'index',$media->price]) ?> dollars</div>

        </div>
        <?php endforeach; ?>
    </div>

</html>






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
