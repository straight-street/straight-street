<?php
require('_header.php');

if (!isUserAtLeastAdmin() && !isUserAtLeastEditor())
{
	include('_footer.php');
	exit();
}

if (!isUserAtLeastAdmin() && isUserAtLeastEditor())
{
?>
<div class="blue_content_div" id="sec2">
<div class="innerdivspacer">
<strong>Media administration</strong><br/>
[ <a href='ad_applyMediaTags.php'>Manage Tags</a> ]<br/>
</div></div>

<script type="text/javascript">	
	Rounded("div#sec2","#FFFFFF","#ECECFF");
</script>

<?php
} else {

if  (isset($_GET['cmd']) && $_GET['cmd'] == 'cleantemp')
{
    $tempdir = './tmp';
    $files = scandir($tempdir);
    array_shift($files); // loose .
    array_shift($files); // loose ..
    foreach ($files as $file)
    {
        unlink($tempdir.'/'.$file);
    }
}

function getTempFileCount()
{
    $files = scandir('./tmp');
    array_shift($files); // loose .
    array_shift($files); // loose ..
    $nfiles = count($files);
    return $nfiles;
}

?>

<div class="blue_content_div" id="sec1">
<div class="innerdivspacer">
<strong>User administration</strong><br/>
[ <a href='ad_editUsers.php'>User Authority</a> ] [ <a href='ad_authFuncs.php'>Authority functions</a> ]<br/>
[ <a href='ad_delUsers.php'>User Deletion</a> ]<br/>
[ <a href='ad_renameUser.php'>User Rename</a> ]<br/>
</div></div>
<br/>

<div class="blue_content_div" id="sec2">
<div class="innerdivspacer">
<strong>Media administration</strong><br/>
[ <a href='ad_editMedia.php?cmd=add'>Add</a> ]<br/>
[ <a href='ad_renameMedia.php'>Rename</a> ]<br/>
[ <a href='ad_uploadedMedia.php'>Upload</a> ]<br/>
[ <a href='ad_setMediaStatus.php'>Set Status</a> ] (from/to Dev, Uploaded, Review, Live, Rejected)<br/>
<?php if (isUserAtLeastEditor()) { ?>
[ <a href='ad_applyMediaTags.php'>Manage Tags</a> ]<br/>
<?php } ?>
[ <a href='ad_editMedia.php?cmd=edit'>Database Edit</a> ]<br/>
[ <a href='ad_editMedia.php?cmd=batchedit'>Database Batch Edit</a> ]<br/>
<br/>
[ <a href='ad_fixupVocab.php?cmd=batchedit'>Fixup vocab</a> ]<br/>
</div></div>
<br/>

<div class="blue_content_div" id="sec3">
<div class="innerdivspacer">
<strong>Version administration</strong><br/>
[ <a href='ad_manageSiteVersion.php'>Amend website version</a> ]<br/>
[ <a href='ad_manageLangVersions.php'>Amend language versions</a> ]<br/>
</div></div>

<div class="blue_content_div" id="sec3">
<div class="innerdivspacer">
<strong>Miscellaneous administration</strong><br/>
[ <a href='ad_apps.php'>Applications</a> ]<br/>
[ <a href='ad_lic.php'>Licences</a> ]<br/>
[ <a href='ad_spon.php'>Sponsors</a> ]<br/>
[ <a href='<?=htmlenc($_SERVER['PHP_SELF']).'?cmd=cleantemp'; ?>'>Delete <?=getTempFileCount();?> temp files</a> ]<br/>
</div></div>

<script type="text/javascript">	
	Rounded("div#sec1","#FFFFFF","#ECECFF");
	Rounded("div#sec2","#FFFFFF","#ECECFF");
	Rounded("div#sec3","#FFFFFF","#ECECFF");
</script>

<?
}
include('_footer.php');
?>
