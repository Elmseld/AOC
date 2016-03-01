<h1><?=$title?></h1>

<ul id="tagsUl">
	<?php foreach ($tags as $tag) : ?>
			
        <!-- User acronym and name -->
			<li id=tags><a href="<?=$this->url->create('tags/id/' . $tag->id)?>"><?=$tag->name?></a>
				<ul><li id=tagDec><?=$tag->description?></li></ul>
		</li>
	<?php endforeach; ?>
</ul> 

<hr>

<a href="<?=$this->url->create('setupTaggar')?>">Återställ taggar i databasen</a></p>