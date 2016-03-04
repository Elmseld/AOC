    <h2>Populära taggar</h2>
    <?php foreach ($tags as $tag): ?>
    <div id="tagBadge">
    <p>
        <span>
            <a id="tagBox" href='<?=$this->url->create('question/tag').'?tag='.$tag->getProperties()['id']?>' title='<?=$tag->getProperties()['description']?>'>
                <?=$tag->getProperties()['name']?> x <?=$tag->getProperties()['taggedquestions']?>
            </a>
        </span>
    </p>
    </div>
    <?php endforeach; ?>
</article>

