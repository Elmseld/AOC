<h1>Frågeforum</h1>

<p>Här ställer du dina frågor och/eller svarar på de du har kunskap om!</p>

<?php if ($this->di->session->has('acronym')) : ?>
	<p><strong><a href="<?=$this->url->create('question/add/')?>"><i class="fa fa-commenting-o"></i> Ställ en ny fråga</a></strong></p>
<?php endif; ?>


