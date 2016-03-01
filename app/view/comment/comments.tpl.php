<div class='comments-header'><h3>Kommentarer</h3></div>

<!-- Are there any comments? -->
<?php if (isset($comments)) : ?>
    
    <div class='comments'>
    <!-- If so, start loop and create html for them -->
    <?php foreach ($comments as $id => $comment) : ?>
            <div class='comment-container'>
                <div class='comment-id'><a href="<?=$this->url->create('comment/edit/' . $comment->id)?>">#<?=$id?></a></div>
                <div class='comment-text'><?=$comment->content?></div>
                <div class='comment-author-container'>
                    <div class='comment-time'><?=$comment->timestamp?></div>
                    <div class='author-name'><?=$comment->name?></div>
                    <div class='author-contact'>
                        <a href='mailto:<?=$comment->email?>'>E-mail</a> | 
                        <a href='<?=$comment->web?>'>Hemsida</a>
                    </div>
                </div>
            </div>
    <?php endforeach; ?>
    </div>
<?php else : ?>
    
    <div class ='no-comment'>Det finns inga kommentarer. Varsågod och skriv!</div>
    
<?php endif; ?> 

<a href="<?=$this->url->create('comment/remove-all/' . $pagekey)?>">Radera alla inlägg</a>
