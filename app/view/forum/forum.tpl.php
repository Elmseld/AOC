<hr>
<h2><?=$title?></h2>
<?php if (is_array($questions)) : ?>

<?php foreach ($questions as $id => $question) : ?>
    <div class='question-box'>
        <h3><i class="fa fa-question"></i> Fråga <?=$id += 1?></h3>
            <div class='question-info'>
                <p><img src="<?=$question->gravatar . '?s=20&d=identicon' ?>" alt="gravatar"> 
									<?=$question->name?> <small><?=$question->timestamp?></small></p>
                <div class='question-content'>
                    <p><?=$question->content?></p>
                </div>
            </div>
            <div class='question-links'>
                <p><a href=" <?=$this->url->create('question/edit-view/' . $question->id)?>">ändra</a></p>
            </div>
    </div>

<?php endforeach; ?>
<br>
    <p><a href="<?=$this->url->create('question/remove-all/' . $pagekey)?>"><i class="fa fa-trash"></i>Radera alla kommentarer på denna sida!</a> |
    <a href="<?=$this->url->create('question/reset-forum/')?>"><i class="fa fa-refresh"></i> Återställ databasen</a>

<?php endif; ?>