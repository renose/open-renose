<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
    <textarea id="ckeditor" name="pageEdit" cols="20" rows="10"><?php editPage::getSiteFromDB($_GET['siteID']); ?></textarea>
    <input type="submit" value="Speichern" />
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
