<h1><?=$title?><em><?=$user->getProperties()['acronym']?></em></h1>

<!--<pre><?=var_dump($user->getProperties())?></pre>--> 


<!-- User info -->
<img src="<?=$user->gravatar . '?s=50&d=identicon' ?>" alt="gravatar">
<p><strong>Namn:</strong> <?=$user->name?></p>
<p><strong>E-mail:</strong> <?=$user->email?></p>
<p><strong>Skapad:</strong> <?=$user->created?></p>
<p><strong>Status:</strong> <?=$user->deleted ? 'Raderad (' . $user->deleted . ')' : ($user->active ? 'Aktiv' : 'Inaktiv')?></p>

   
<p><a href='<?=$this->url->create('users')?>'>Tillbaka</a></p>
