   <div id='smallerText'>
        <div class='comments-heading-side'>
            <?php if ($sorting == 'ASC') $button_text = '<i class="fa fa-caret-down"></i>'; else $button_text = '<i class="fa fa-caret-up"></i>'; ?>
            <p class='button-right'><a class='sort-button' href='<?=$this->url->create("{$this->request->getRoute()}?sorting=$sorting#comments")?>' title='Ändra datumsortering'>Datum <?=$button_text?></a></p>
        </div>
    </div> <!-- comments-heading-container -->
