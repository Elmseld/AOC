<h1><?=$title?><em><?=$user->getProperties()['acronym']?></em></h1>

<!--<pre><?=var_dump($user->getProperties())?></pre>--> 


<!-- User info -->
<img src="<?=$user->gravatar . '?s=50&d=identicon' ?>" alt="gravatar">
<p><strong>Namn:</strong> <?=$user->name?></p>
<p><strong>E-mail:</strong> <?=$user->email?></p>
<p><strong>Skapad:</strong> <?=$user->created?></p>
<p><strong>Status:</strong> <?=$user->deleted ? 'Raderad (' . $user->deleted . ')' : ($user->active ? 'Aktiv' : 'Inaktiv')?></p>


<p>
<!-- Options based on user status -->
<?php if ($user->deleted) : ?>
    <a href="<?=$this->url->create('users/undo-soft-delete/' . $user->id)?>">Återställ</a>
<?php elseif ($user->active) : ?>
    <a href="<?=$this->url->create('users/update/' . $user->id)?>">Uppdatera</a><br>  
    <a href="<?=$this->url->create('users/deactivate/' . $user->id)?>">Inaktivera</a><br>
    <a href="<?=$this->url->create('users/soft-delete/' . $user->id)?>">Kasta i papperskorgen</a>
<?php else : ?>
    <a href="<?=$this->url->create('users/update/' . $user->id)?>">Uppdatera</a><br>
   	<a href="<?=$this->url->create('users/activate/' . $user->id)?>">Aktivera</a><br>
    <a href="<?=$this->url->create('users/soft-delete/' . $user->id)?>">Radera</a>
<?php endif; ?>