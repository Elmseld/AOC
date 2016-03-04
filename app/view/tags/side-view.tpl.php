<article class='article2'>
    <h2><?=$title?></h2>
   <?php foreach ($tags as $tag): ?>
    <div id="tagBadge">
    <p>
        <span>
            <a id="tagBox" href='<?=$this->url->create('question/tag').'?tag='.$tag->getProperties()['id']?>' title='<?=$tag->getProperties()['description']?>'><?=$tag->getProperties()['name']?></a>
        </span>
    </p>
    <p id="smallerTextTag"><?=$tag->getProperties()['description']?><p>
    </div>
    <?php endforeach; ?>
</article>


