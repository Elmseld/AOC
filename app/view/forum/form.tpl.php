<div class='question-form'>
    <form method=post>
        <input type=hidden name="redirect" value="<?=$this->url->create('forum')?>">
        <input type=hidden name="pagekey" value="<?=$pagekey?>">
        <fieldset>
        <legend>Skapa en fråga</legend>
        <p><label>Name:<br/><input type='text' name='name' value='<?=$name?>'/></label></p>
        <p><label>Text:<br/><textarea name='content'><?=$content?></textarea></label></p>
        <p><label>Hemsida:<br/><input type='text' name='web' value='http://<?=$web?>'/></label></p>
        <p><label>Email:<br/><input type='text' name='mail' value='<?=$mail?>'/></label></p>
        <p class=buttons>
            <input type='submit' name='doCreate' value='Fråga' onClick="this.form.action = '<?=$this->url->create('question/add')?>'"/>
            <input type='reset' value='Återställ'/>
						<input type='submit' name='doRemoveAll' value='Ta bort alla kommentarer' onClick="this.form.action = '<?=$this->url->create('question/remove-all')?>'"/>
        </p>
        <output></output>
        </fieldset>
    </form>
</div>