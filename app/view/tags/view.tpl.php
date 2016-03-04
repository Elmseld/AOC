<article class='article2'>
    <h3><?=$title?></h3>
    <?php if ($tags): ?>
        <div>
            <p>
                <span>
                    <a id="tagBox" href='<?=$this->url->create('question/tag').'?tag='.$tags->getProperties()['id']?>' title='<?=$tags->getProperties()['description']?>'><?=$tags->getProperties()['name']?></a>
                </span>
            </p>
            <p id="smallerTextTag"><?=$tags->getProperties()['description']?><p>
            </div>
        <?php endif; ?>
    </article>