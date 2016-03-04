<!-- Index page for questions -->
<article class='article1'>
    <h2><?=$title?></h2>
		<table id="forumTable">
			
			<tr>
				<?php foreach ($content as $question) : ?>
        <div id='question-<?=$question->getProperties()['id']?>'>
					<td>
            <div class='question-stats'>
                <p id="statsBox"><?=$question->getProperties()['upvotes'] - $question->getProperties()['downvotes']?><br>rank</p>
                <?php if ($question->getProperties()['noOfAnswers'] > 0): ?>
                    <p id="statsDifBox"><?=$question->getProperties()['noOfAnswers']?><br>svar</p>
                    <?php else : ?>
                        <p id="statsBox"><?=$question->getProperties()['noOfAnswers']?><br>svar</p>
                <?php endif; ?>

            </div>
					</td>
					
            <div>
   					<td>
     <h3 id="questionTitle"><a id="questionTitle" href='<?=$this->url->create('question/id/'.$question->getProperties()['id'])?>'><?=$question->getProperties()['title']?></a></h3>
        <div>
        <?php if (strlen($question->filteredcontent) > 130): ?>
            <?=mb_substr($question->filteredcontent, 0, 130)?>...
        <?php else : ?>
            <?=$question->filteredcontent?>
        <?php endif; ?>
    </div>
        <?php foreach ($question->tags as $tag) : ?>
            <div id="tagBadge"><a id="tagBoxSmall" href='<?=$this->url->create('question/tag').'?tag='.$tag->getProperties()['id']?>' title='<?=$tag->getProperties()['description']?>'><?=$tag->getProperties()['name']?></a></div>
        <?php endforeach; ?>
							</td>	
						<td>
							
							<div>
								<?php $timestamp = strtotime($question->getProperties()['created']); ?>
								<p id=smallerText><img src='<?=$question->user->gravatar?>' alt='Gravatar'>
										<?php $timeinterval = time() - $timestamp; ?>
										<?php if (($timeinterval) < 60): ?>
												<?=round($timeinterval)?> sekunder sedan
										<?php elseif (($timeinterval/60) < 1.5): ?>
												<?=round($timeinterval/60)?> minut sedan
										<?php elseif (($timeinterval/60) < 60): ?>
												<?=round($timeinterval/60)?> minuter sedan
										<?php elseif (($timeinterval/(60*60)) < 1.5): ?>
												<?=round($timeinterval/(60*60))?> timme sedan
										<?php elseif (($timeinterval/(60*60)) < 24): ?>
												<?=round($timeinterval/(60*60))?> timmar sedan
										<?php elseif (($timeinterval/(60*60*24)) < 7): ?>
												<?=round($timeinterval/(60*60*24))?> dygn sedan
										<?php elseif (($timeinterval/(60*60*24)) < 10.5) : ?>
												<?=round($timeinterval/(60*60*24*7))?> vecka sedan
										<?php elseif (($timeinterval/(60*60*24)) < 30) : ?>
												<?=round($timeinterval/(60*60*24*7))?> veckor sedan
										<?php elseif (($timeinterval/(60*60*24)) < 45) : ?>
												<?=round($timeinterval/(60*60*24*7))?> månad sedan
										<?php else : ?>
												<?=round($timeinterval/(60*60*24*30))?> månader sedan
										<?php endif; ?>
										<br><a href='<?=$this->url->create('users/id').'/'.$question->user->getProperties()['id']?>'>
										<?=$question->user->getProperties()['acronym']?></a><br>
										Karma: <?=$question->user->stats?></p>
        				</div>
							</td>
        			</div>
    				</div> 
					</tr>
    		<?php endforeach; ?>
			</table>

<?php if($title === 'Alla frågor') : ?>
</article>
<?php endif ?>
