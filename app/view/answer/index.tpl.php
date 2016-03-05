<!-- Index page for answers -->
<article class='article1'>
    <?php foreach ($content as $answer) : ?>
        <div id='answer-<?=$answer->getProperties()['id']?>' class='anchor'></div>
        <div class='answer-shortlist-container'>
					<table> 
							<tr><td>
            <div class="answer-detail-stats">
                <p>
                <?php if (!$vote): ?>
                    <span id="smallerText"><?=$answer->getProperties()['upvotes']?></span><br>
                    <a id="title" class='upvote-active' href='<?=$this->url->create("answer/upvote/".$answer->getProperties()['id'])?>' title='Bra fråga'><i class="fa fa-caret-up fa-3x"></i></a><br>
                    <i id="votes"><?=$answer->getProperties()['upvotes'] - $answer->getProperties()['downvotes']?></i><br>
                    <a id="title" class='downvote-active' href='<?=$this->url->create("answer/downvote/".$answer->getProperties()['id'])?>' title='Mindre bra fråga'><i class="fa fa-caret-down fa-3x"></i></a><br>
                    <span id="smallerText"><?=$answer->getProperties()['downvotes']?></span>
                <?php else : ?>
                    <span id="smallerText"><?=$answer->getProperties()['upvotes']?></span><br>
                    <span class='upvote'><i id="voted" class="fa fa-caret-up fa-3x"></i></span><br>
							<i id="votes"><?=$answer->getProperties()['upvotes'] - $answer->getProperties()['downvotes']?></i><br>
                    <span class='downvote'><i id="voted" class="fa fa-caret-down fa-3x"></i></span><br>
                    <span id="smallerText"><?=$answer->getProperties()['downvotes']?></span>
                <?php endif; ?>
                </p>
                <div class='answer-accepted-section'>
                    <?php if ($questionuserid == $this->di->session->get('id') && $answer->getProperties()['accepted']) : ?>
                        <p ><a id='accepted' href='<?=$this->url->create("answer/unaccept/".$answer->getProperties()['id'])?>' title='Ångra acceptera svar'><i class="fa fa-check fa-3x"></i></a></p>
                    <?php elseif ($answer->getProperties()['accepted']) : ?>
                        <p id='accepted'><i class="fa fa-check fa-3x"></i></p>
                    <?php endif; ?>
                    <?php if ($questionuserid == $this->di->session->get('id') && !$answer->getProperties()['accepted']) : ?>
                        <p class='answer-not-accepted'><a href='<?=$this->url->create("answer/accept/".$answer->getProperties()['id'])?>' title='Acceptera svar'><i class="fa fa-check fa-2x"></i></a></p>
                    <?php endif; ?>
                </div>
            </div> <!-- answer-detail-stats -->
								</td>
            <div class="answer-detail-content">
								<td>
							<div id='questionBox'>
                <?=$answer->filteredcontent?>
									</div>
								</td>
							<td>
                <div id="userBox">
                    <?php if ($this->di->LoginController->checkLoginCorrectUser($answer->user->getProperties()['id'])) : ?>
                        <a id='smallerText' href='<?=$this->url->create("question/id/".$answer->getProperties()['questionId'] . "?editanswer=yes&answerid=" . $answer->getProperties()['id']."#answer-".$answer->getProperties()['id'])?>' title='Redigera'>
                            <i class="fa fa-pencil"></i> Redigera svar</a>
                        <?php endif; ?>
                        <?php $timestamp = strtotime($answer->getProperties()['created']); ?>
                        <div class="answer-detail-userinfo smaller-text">

                            <img src='<?=$answer->user->gravatar?>' alt='Gravatar'>
                            <div class="userinfo-text">
                                <div>
                                    <span id=smallerText>
                                        <a href='<?=$this->url->create('users/id').'/'.$answer->user->getProperties()['id']?>'>
                                            <?=$answer->user->getProperties()['acronym']?></a>
                                            &nbsp;&#8226;&nbsp;<?=$answer->user->stats?>
                                        </span></div>
                                            <div><span id=smallerText>svarade för
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
                                            </span>
                                        </div>

                                        <?php if (isset($answer->getProperties()['updated'])) : ?>
                                            <div><span id='smallerText'>Uppdaterad för
                                                <?php $timestamp = strtotime($answer->getProperties()['updated']); ?>

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
                                            </span>
                                        </div>
                                    <?php endif; ?>
                                </div> <!-- userinfo-text -->
                            </div> <!-- answer-detail-userinfo -->
                        </div> <!-- answer-detail-bottom -->
                    		</td>
										</div> <!-- answer-detail-content -->
               		</tr>
								</table> 
								<!-- answer-shortlist-container -->
							</div>
            <?php endforeach; ?>
        </article>
