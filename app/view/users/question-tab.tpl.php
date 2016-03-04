<div class="tab-section">
    <div class='userTab'><a href='<?=$this->url->create("users/id/".$user->getProperties()['id']."?tab=comment")?>' title='Kommentarer'>
        <i class="fa fa-comments"></i> <?=$cCount?> <?php $word = $cCount == 1 ? 'Kommentar' : 'Kommentarer'; echo $word; ?>
    </a></div>
    <div class='userTab'><a href='<?=$this->url->create("users/id/".$user->getProperties()['id']."?tab=answer")?>' title='Svar'>
        <i class="fa fa-exclamation"></i> <?=$aCount?> Svar
    </a></div>
    <div class='userTabSelected'><a href='<?=$this->url->create("users/id/".$user->getProperties()['id']."?tab=question")?>' title='Frågor'>
        <i class="fa fa-question"></i> <?=$qCount?> <?php $word = $qCount == 1 ? 'Fråga' : 'Frågor'; echo $word; ?>
    </a></div>
</div>

<?php if ($qCount > 0): ?>
    <table class="userdetails-tab-table">
        <thead>
            <tr>
                <td>Fråga</td>
                <td class="center-align">Rank</td>
                <td class="center-align">Antal svar</td>
                <td class="right-align">Datum tid</td>
            </tr>
        </thead>
        <?php foreach ($content as $question): ?>
            <tr>
                <td class="userdetails-tab-table-td">
                    <div class="question-tags-cell">
                    <a href='<?=$this->url->create('question/id').'/'.$question->getProperties()['id']?>'>
                    <?=mb_substr($question->getProperties()['title'], 0, 64)?></a></div>
                    <div>
                        <?php foreach ($question->tags as $tag) : ?>
                            <span class="smaller-text"><span class="tagBadge"><a href='<?=$this->url->create('question/tag').'/'.$tag->getProperties()['id']?>' title='<?=$tag->getProperties()['description']?>'>
                                <?=$tag->getProperties()['name']?></a></span></span>
                            <?php endforeach; ?>
                        </div>
                    </td>
                    <td class="center-align"><?=$question->getProperties()['upvotes'] - $question->getProperties()['downvotes']?></td>
                    <td class="center-align"><?=$question->noOfAnswers?></td>
                    <td class="right-align"><?=$question->getProperties()['created']?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</article>
