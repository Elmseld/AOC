<h2><?=$title?></h2>


<table id="userList"> 
	<tr>
<?php foreach ($users as $user) : ?>
   <div id="userSingle">
        <!-- <pre><?=var_dump($user->getProperties())?></pre> -->
        
        <!-- User acronym and name -->
        <td><img src="<?=$user->gravatar . '?s=50&d=identicon'?>" alt="gravatar">
				<a href="<?=('users/id/' . $user->id)?>"><?=$user->acronym?></a>
				(<?=$user->name?>)
        
        <!-- Is the user active or inactive? -->
        <?=$user->deleted ? 'Raderad' : ($user->active ? 'Aktiv' : 'Inaktiv')?></td>
</div>
<?php endforeach; ?>
	    </tr> 
</table>