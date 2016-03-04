<h1><?=$title?></h1>

<ul id="tagsUl">
	<?php foreach ($tags as $tag) : ?>
			
        <!-- User acronym and name -->
			<li id=tags><a href='<?=$this->url->create('question/tag').'?tag='.$tag->getProperties()['id']?>'title='<?=$tag->getProperties()['description']?>'><?=$tag->name?>&nbsp;x&nbsp;<?=$tag->getProperties()['taggedquestions']?></a>
				<ul><li id=tagDec><?=$tag->getProperties()['description']?></li></ul>
		</li>
	<?php endforeach; ?>
</ul> 