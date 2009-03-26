<?php
/************************************************************************/
/* AChecker                                                             */
/************************************************************************/
/* Copyright (c) 2008 by Greg Gay, Cindy Li                             */
/* Adaptive Technology Resource Centre / University of Toronto			    */
/*                                                                      */
/* This program is free software. You can redistribute it and/or        */
/* modify it under the terms of the GNU General Public License          */
/* as published by the Free Software Foundation.                        */
/************************************************************************/

define('AC_INCLUDE_PATH', '../include/');

include(AC_INCLUDE_PATH.'vitals.inc.php');
include(AC_INCLUDE_PATH.'header.inc.php');
include_once(AC_INCLUDE_PATH.'classes/Utility.class.php');
include_once(AC_INCLUDE_PATH.'classes/DAO/ChecksDAO.class.php');
include_once(AC_INCLUDE_PATH.'classes/DAO/GuidelinesDAO.class.php');
include_once(AC_INCLUDE_PATH.'classes/DAO/TestProcedureDAO.class.php');
include_once(AC_INCLUDE_PATH.'classes/DAO/TestExpectedDAO.class.php');
include_once(AC_INCLUDE_PATH.'classes/DAO/TestFailDAO.class.php');

$check_id = intval($_GET["id"]);

$checksDAO = new ChecksDAO();
$row = $checksDAO->getCheckByID($check_id);

$guidelinesDAO = new GuidelinesDAO();
$guideline_rows = $guidelinesDAO->getEnabledGuidelinesByCheckID($check_id);

?>
<div class="output-form">
	
<h2><? echo _AC("html_tag"); ?></h2>
<span class="msg"><?php echo $row["html_tag"]; ?></span>

<?php if (is_array($guideline_rows)) {?> 
<h2><? echo _AC("guidelines"); ?></h2>
<span class="msg">
	<ul>
<?php 	foreach ($guideline_rows as $guideline) {?>
		<li><a title="<?php echo $guideline['title']._AC('link_open_in_new'); ?>" target="_new" href="<?php echo AC_BASE_HREF; ?>guideline/view_guideline.php?id=<?php echo $guideline['guideline_id']; ?>"><?php echo $guideline["title"]; ?></a></li>
<?php } // end of foreach?>
	</ul>
</span>
<?php } // end of if?>

<h2><? echo _AC("requirement"); ?></h2>
<span class="msg"><?php echo _AC($row["name"]); ?></span>

<h2><? echo _AC("error"); ?></h2>
<span class="msg"><?php echo _AC($row["err"]); ?></span>

<?php
if ($row["description"] <> "")
{
?>

<h2><? echo _AC("short_desc"); ?></h2>
<span class="msg"><?php echo _AC($row["description"]); ?></span>

<?php
}
?>

<?php
if ($row["long_description"] <> "")
{
?>

<h2><? echo _AC("long_desc"); ?></h2>
<span class="msg"><?php echo _AC($row["long_description"]); ?></span>

<?php
}
?>

<?php
if ($row["rationale"] <> "")
{
?>

<h2><? echo _AC("rationale"); ?></h2>
<span class="msg"><?php echo _AC($row["rationale"]); ?></span>

<?php
}
?>

<?php
if ($row["how_to_repair"] <> "")
{
?>

<h2><? echo _AC("how_to_repair"); ?></h2>
<span class="msg"><?php echo _AC($row["how_to_repair"]); ?></span>

<?php
}
?>

<?php
if ($row["repair_example"] <> "")
{
?>

<h2><? echo _AC("repair_example"); ?></h2>
<span class="msg"><pre><?php echo htmlentities(_AC($row["repair_example"])); ?></pre></span>

<?php
}
?>

<?php
if ($row["question"] <> "")
{
?>

<h2><? echo _AC("how_to_determine"); ?></h2>
<table>
	<tr>
		<th align="left"><? echo _AC("question"); ?></th>
		<td><span class="msg"><?php echo _AC($row["question"]); ?></span></td>
	</tr>
	<tr>
		<th align="left"><? echo _AC("pass"); ?></th>
		<td><span class="msg"><?php echo _AC($row["decision_pass"]); ?></span></td>
	</tr>
	<tr>
		<th align="left"><? echo _AC("fail"); ?></th>
		<td><span class="msg"><?php echo _AC($row["decision_fail"]); ?></span></td>
	</tr>
</table>

<?php
}

if ($row["test_procedure"] <> "")
{
?>

<h2><? echo _AC("steps_to_check"); ?></h2>
	<h3><? echo _AC("procedure"); ?></h3>
	<span class="msg"><?php echo Utility::convertHTMLNewLine(_AC($row["test_procedure"])); ?></span><br />
<?php
}

if ($row["test_expected_result"] <> "")
{
?>

	<h3><? echo _AC("expected_result"); ?></h3>
	<span class="msg"><?php echo Utility::convertHTMLNewLine(_AC($row["test_expected_result"])); ?></span><br />
<?php
}

if ($row["test_failed_result"] <> "")
{
?>

	<h3><? echo _AC("failed_result"); ?></h3>
	<span class="msg"><?php echo Utility::convertHTMLNewLine(_AC($row["test_failed_result"])); ?></span><br />
<?php
}
?>
</div>
<?php
// display footer
include(AC_INCLUDE_PATH.'footer.inc.php');

?>
