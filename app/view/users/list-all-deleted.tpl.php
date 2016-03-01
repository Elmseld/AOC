<h1><?=$title?></h1>


<table>
<?php foreach ($users as $user) : ?>
    <tr>
        <!-- <pre><?=var_dump($user->getProperties())?></pre> -->
        
        <!-- User acronym and name -->
        <td><a href="<?=$this->url->create('users/id/' . $user->id)?>"><?=$user->acronym?></a></td>
        <td>(<?=$user->name?>)</td>
        
        <!-- Is the user active or inactive? -->
        <td><?=$user->deleted ? 'Raderad' : ($user->active ? 'Aktiv' : 'Inaktiv')?></td>
        
        <!-- Delete user permanently? -->
        <td><a href="<?=$this->url->create('users/delete/' . $user->id)?>">Radera permanent</a></td>
        
    </tr> 

<?php endforeach; ?>
</table>


<hr>

<table>
    <tr>
        <td><a href="<?=$this->url->create('users')?>">Alla användare</a></td>
        <td><a href="<?=$this->url->create('users/is-active')?>">Aktiva</a></td>			
        <td><a href="<?=$this->url->create('users/is-inactive')?>">Inaktiva</a></td>
    </tr>
</table>

<p><a href="<?=$this->url->create('users/add')?>">Skapa ny användare</a>
<a href="<?=$this->url->create('setup')?>">Återställ användardatabasen</a></p> 