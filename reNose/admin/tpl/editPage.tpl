<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
    Überschrift: <input type="text" name="headline" value="<?php echo editPage::getSitebyID($_GET['id'], 'title'); ?>" />
    Beschreibung: <input type="text" name="description" value="<?php echo editPage::getSitebyID($_GET['id'], 'description'); ?>" />
    <textarea id="ckeditor" name="pageEdit" cols="20" rows="10"><?php echo editPage::getSitebyID($_GET['id'], 'value'); ?></textarea>
    <input type="hidden" name="id" value="$_GET['id']" />
    <input type="submit" name="updatePage" value="Speichern" />
</form>

<script type="text/javascript">
    //<![CDATA[
	CKEDITOR.replace( 'ckeditor',
	    {
		skin : 'office2003',
		language: 'de'
		});
    //]]>
</script>