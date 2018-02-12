<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?><?

?>
<?CUtil::InitJSCore(array("image", "ajax"));?>
<script>
BX.viewImageBind(
	'blg-comment-<?=$arParams["ID"]?>',
	false, 
	{tag:'IMG', attr: 'data-bx-image'}
);
</script>
<div class="blog-comments col-md-9" id="blg-comment-<?=$arParams["ID"]?>">
<a id="commentLink"></a>
<?
if($arResult["is_ajax_post"] != "Y")
	include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/script.php");
else
{
	$APPLICATION->RestartBuffer();
	?><script>window.BX = top.BX;
		<?
		if($arResult["use_captcha"]===true)
		{
			?>
				BX('captcha').src='/bitrix/tools/captcha.php?captcha_code=' + '<?=$arResult["CaptchaCode"]?>';
				BX('captcha_code').value = '<?=$arResult["CaptchaCode"]?>';
				BX('captcha_word').value = "";
			<?
		}
	?>
	if(!top.arImages)
		top.arImages = [];
	if(!top.arImagesId)
		top.arImagesId = [];
	<?
	foreach($arResult["Images"] as $aImg)
	{
		?>
		top.arImages.push('<?=CUtil::JSEscape($aImg["SRC"])?>');
		top.arImagesId.push('<?=$aImg["ID"]?>');
		<?
	}
	?>
	</script><?
	if(strlen($arResult["COMMENT_ERROR"])>0)
	{
		?>
		<script>top.commentEr = 'Y';</script>
		<div class="blog-errors blog-note-box blog-note-error">
			<div class="blog-error-text">
				<?=$arResult["COMMENT_ERROR"]?>
			</div>
		</div>
		<?
	}
}

if(strlen($arResult["MESSAGE"])>0)
{
	?>
	<div class="blog-textinfo blog-note-box">
		<div class="blog-textinfo-text">
			<?=$arResult["MESSAGE"]?>
		</div>
	</div>
	<?
}
if(strlen($arResult["ERROR_MESSAGE"])>0)
{
	?>
	<div class="blog-errors blog-note-box blog-note-error">
		<div class="blog-error-text" id="blg-com-err">
			<?=$arResult["ERROR_MESSAGE"]?>
		</div>
	</div>
	<?
}
if(strlen($arResult["FATAL_MESSAGE"])>0)
{
	?>
	<div class="blog-errors blog-note-box blog-note-error">
		<div class="blog-error-text">
			<?=$arResult["FATAL_MESSAGE"]?>
		</div>
	</div>
	<?
}
else
{
	if($arResult["imageUploadFrame"] == "Y")
	{
		?>
		<script>
			<?if(!empty($arResult["Image"])):?>
				top.bxBlogImageId = top.arImagesId.push('<?=$arResult["Image"]["ID"]?>');
				top.arImages.push('<?=CUtil::JSEscape($arResult["Image"]["SRC"])?>');
				top.bxBlogImageIdWidth = '<?=CUtil::JSEscape($arResult["Image"]["WIDTH"])?>';
			<?elseif(strlen($arResult["ERROR_MESSAGE"]) > 0):?>
				top.bxBlogImageError = '<?=CUtil::JSEscape($arResult["ERROR_MESSAGE"])?>';
			<?endif;?>
		</script>
		<?
		die();
	}
	else
	{
		if($arResult["is_ajax_post"] != "Y" && $arResult["CanUserComment"])
		{
			?>
			<div id="form_comment_" style="display:none;">
				<div id="form_c_del" style="display:none;">
				<div class="blog-comment-form">
<p><u>Поля отмеченные звёздочкой считаются обязательными</u></p>
				<form method="POST" name="form_comment" id="form_comment" action="<?=POST_FORM_ACTION_URI?>">
				<input type="hidden" name="parentId" id="parentId" value="">
				<input type="hidden" name="edit_id" id="edit_id" value="">
				<input type="hidden" name="act" id="act" value="add">
				<input type="hidden" name="post" value="Y">
				<?=bitrix_sessid_post()?>


					<?if($arParams["NOT_USE_COMMENT_TITLE"] != "Y")
					{
						?>
						<div class="blog-comment-field blog-comment-field-title">
							<div class="blog-comment-field">
							<div class="blog-comment-field-text"><label for="user_name"><?=GetMessage("BPC_SUBJECT")?></label></div>
							<span><input size="170" type="text" name="subject" id="subject" value=""></span>
							<div class="blog-clear-float"></div>
							</div>
						</div>
						<?
					}

					include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/lhe.php");

					if($arResult["COMMENT_PROPERTIES"]["SHOW"] == "Y")
					{
						?><Br /><?
						$eventHandlerID = false;
						$eventHandlerID = AddEventHandler('main', 'system.field.edit.file', array('CBlogTools', 'blogUFfileEdit'));
						foreach($arResult["COMMENT_PROPERTIES"]["DATA"] as $FIELD_NAME => $arPostField)
						{
							if($FIELD_NAME=='UF_BLOG_COMMENT_DOC')
							{
								?><?
							}
							?>
							<div id="blog-comment-user-fields-<?=$FIELD_NAME?>"><?=($FIELD_NAME=='UF_BLOG_COMMENT_DOC' ? "" : $arPostField["EDIT_FORM_LABEL"].":")?>
								<?$APPLICATION->IncludeComponent(
										"bitrix:system.field.edit",
										$arPostField["USER_TYPE"]["USER_TYPE_ID"],
										array("arUserField" => $arPostField), null, array("HIDE_ICONS"=>"Y"));?>
							</div><?
						}
						if ($eventHandlerID !== false && ( intval($eventHandlerID) > 0 ))
							RemoveEventHandler('main', 'system.field.edit.file', $eventHandlerID);
					}

					if(strlen($arResult["NoCommentReason"]) > 0)
					{
						?>
						<div id="nocommentreason" style="display:none;"><?=$arResult["NoCommentReason"]?></div>
						<?
					}
					if($arResult["use_captcha"]===true)
					{
						?>
						<div class="blog-comment-field blog-comment-field-captcha">
							<div class="blog-comment-field-captcha-label">
								<label for=""><?=GetMessage("B_B_MS_CAPTCHA_SYM")?></label><span class="blog-required-field">*</span><br>
								<input type="hidden" name="captcha_code" id="captcha_code" value="">
								<input type="text" size="30" name="captcha_word" id="captcha_word" value=""  tabindex="7">
							</div>
							<div class="blog-comment-field-captcha-image">
								<div id="div_captcha">
									<img src="" width="180" height="40" id="captcha" style="display:none;">
								</div>
							</div>
						</div>
						<?
					}
					?>
<div class="blog-comment-fields">
					<?
					if(empty($arResult["User"]))
					{
						?>
						<div class="blog-comment-field blog-comment-field-user">
							<div class="blog-comment-field blog-comment-field-author"><input maxlength="255" size="30" tabindex="3" type="text" name="user_name" id="user_name" placeholder="Ваше имя *" value="<?=htmlspecialcharsEx($_SESSION["blog_user_name"])?>"></div>

							<div class="blog-comment-field blog-comment-field-email"><input maxlength="255" size="30" tabindex="4" type="text" name="user_email" id="user_email" placeholder="Ваш email" value="<?=htmlspecialcharsEx($_SESSION["blog_user_email"])?>"></div>
							<div class="blog-clear-float"></div>
						</div>
						<?
					}
					?>
					<div class="blog-comment-buttons">
						<input tabindex="10" value="<?=GetMessage("B_B_MS_SEND")?>" type="button" name="sub-post" class="post-button" onclick="submitComment()">
						<a href="javascript:void(0)" onclick="cancelComment();" class="blg-cancel-com"><?=GetMessage("BLOG_PC_COMMENT");?></a>
					</div>
				</div>
				<input type="hidden" name="blog_upload_cid" id="upload-cid" value="">
				</form>
				</div>
			</div>
			</div>
			<?
		}

		$prevTab = 0;
		function ShowComment($comment, $tabCount=0, $tabSize=2.5, $canModerate=false, $User=Array(), $use_captcha=false, $bCanUserComment=false, $errorComment=false, $arParams = array())
		{
			if($comment["SHOW_AS_HIDDEN"] == "Y" || $comment["PUBLISH_STATUS"] == BLOG_PUBLISH_STATUS_PUBLISH || $comment["SHOW_SCREENNED"] == "Y" || $comment["ID"] == "preview")
			{
				global $prevTab;
				$tabCount = IntVal($tabCount);
				if($tabCount <= 5)
					$paddingSize = 2.5 * $tabCount;
				elseif($tabCount > 5 && $tabCount <= 10)
					$paddingSize = 2.5 * 5 + ($tabCount - 5) * 1.5;
				elseif($tabCount > 10)
					$paddingSize = 2.5 * 5 + 1.5 * 5 + ($tabCount-10) * 1;
				
				if(($tabCount+1) <= 5)
					$paddingSizeNew = 2.5 * ($tabCount+1);
				elseif(($tabCount+1) > 5 && ($tabCount+1) <= 10)
					$paddingSizeNew = 2.5 * 5 + (($tabCount+1) - 5) * 1.5;
				elseif(($tabCount+1) > 10)
					$paddingSizeNew = 2.5 * 5 + 1.5 * 5 + (($tabCount+1)-10) * 1;
				$paddingSizeNew -= $paddingSize;
					
				if($prevTab > $tabCount)
					$prevTab = $tabCount;
				if($prevTab <= 5)
					$prevPaddingSize = 2.5 * $prevTab;
				elseif($prevTab > 5 && $prevTab <= 10)
					$prevPaddingSize = 2.5 * 5 + ($prevTab - 5) * 1.5;
				elseif($prevTab > 10)
					$prevPaddingSize = 2.5 * 5 + 1.5 * 5 + ($prevTab-10) * 1;

					$prevTab = $tabCount;
				?>

				<a name="<?=$comment["ID"]?>"></a>
				<div class="blog-comment" style="padding-left:<?=$paddingSize?>em;">
				<div id="blg-comment-<?=$comment["ID"]?>">
				<?
				if($comment["PUBLISH_STATUS"] == BLOG_PUBLISH_STATUS_PUBLISH || $comment["SHOW_SCREENNED"] == "Y" || $comment["ID"] == "preview")
				{
					$aditStyle = "";
					if($arParams["is_ajax_post"] == "Y" || $comment["NEW"] == "Y")
						$aditStyle .= " blog-comment-new";
					if($comment["AuthorIsAdmin"] == "Y")
						$aditStyle = " blog-comment-admin";
					if(IntVal($comment["AUTHOR_ID"]) > 0)
						$aditStyle .= " blog-comment-user-".IntVal($comment["AUTHOR_ID"]);
					if($comment["AuthorIsPostAuthor"] == "Y")
						$aditStyle .= " blog-comment-author";
					if($comment["PUBLISH_STATUS"] != BLOG_PUBLISH_STATUS_PUBLISH && $comment["ID"] != "preview")
						$aditStyle .= " blog-comment-hidden";
					if($comment["ID"] == "preview")
						$aditStyle .= " blog-comment-preview";
					?>
					<div class="blog-comment-cont<?=$aditStyle?>">
					<div class="blog-comment-cont-white">
					<div class="blog-comment-info">
						<div class="blog-comment-avatar">
							<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
								 viewBox="0 0 50 50" enable-background="new 0 0 50 50" xml:space="preserve">
<circle fill="#ECEBEC" cx="25" cy="25" r="25"/>
								<g>
									<path fill="#FFFFFF" d="M43.3,46.4H39c0-7.3-6.1-13.3-13.7-13.3s-13.7,5.9-13.7,13.3H7.3c0-9.7,8.1-17.6,18-17.6
		C35.2,28.8,43.3,36.7,43.3,46.4z"/>
									<path fill="#FFFFFF" d="M25.3,27.4c-6.5,0-11.9-5.3-11.9-11.9c0-6.5,5.3-11.9,11.9-11.9c6.6,0,11.9,5.3,11.9,11.9
		S31.9,27.4,25.3,27.4z M25.3,8c-4.2,0-7.5,3.4-7.5,7.5s3.4,7.5,7.5,7.5c4.2,0,7.6-3.4,7.6-7.5S29.5,8,25.3,8z"/>
								</g>
</svg>
						</div>
						<?if ($arParams["SHOW_RATING"] == "Y"):?>
						<div class="blog-post-rating rating_vote_graphic">
						<?
						$GLOBALS["APPLICATION"]->IncludeComponent(
							"bitrix:rating.vote", $arParams["RATING_TYPE"],
							Array(
								"ENTITY_TYPE_ID" => "BLOG_COMMENT",
								"ENTITY_ID" => $comment["ID"],
								"OWNER_ID" => $comment["arUser"]["ID"],
								"USER_VOTE" => $arParams["RATING"][$comment["ID"]]["USER_VOTE"],
								"USER_HAS_VOTED" => $arParams["RATING"][$comment["ID"]]["USER_HAS_VOTED"],
								"TOTAL_VOTES" => $arParams["RATING"][$comment["ID"]]["TOTAL_VOTES"],
								"TOTAL_POSITIVE_VOTES" => $arParams["RATING"][$comment["ID"]]["TOTAL_POSITIVE_VOTES"],
								"TOTAL_NEGATIVE_VOTES" => $arParams["RATING"][$comment["ID"]]["TOTAL_NEGATIVE_VOTES"],
								"TOTAL_VALUE" => $arParams["RATING"][$comment["ID"]]["TOTAL_VALUE"],
								"PATH_TO_USER_PROFILE" => $arParams["~PATH_TO_USER"],
							),
							$arParams["component"],
							array("HIDE_ICONS" => "Y")
						);?>
						</div>
						<?endif;?>
						<?
						if (COption::GetOptionString("blog", "allow_alias", "Y") == "Y" && (strlen($comment["urlToBlog"]) > 0 || strlen($comment["urlToAuthor"]) > 0) && array_key_exists("ALIAS", $comment["BlogUser"]) && strlen($comment["BlogUser"]["ALIAS"]) > 0)
							$arTmpUser = array(
								"NAME" => "",
								"LAST_NAME" => "",
								"SECOND_NAME" => "",
								"LOGIN" => "",
								"NAME_LIST_FORMATTED" => $comment["BlogUser"]["~ALIAS"],
							);
						elseif (strlen($comment["urlToBlog"]) > 0 || strlen($comment["urlToAuthor"]) > 0)
							$arTmpUser = array(
								"NAME" => $comment["arUser"]["~NAME"],
								"LAST_NAME" => $comment["arUser"]["~LAST_NAME"],
								"SECOND_NAME" => $comment["arUser"]["~SECOND_NAME"],
								"LOGIN" => $comment["arUser"]["~LOGIN"],
								"NAME_LIST_FORMATTED" => "",
							);

						if(strlen($comment["urlToBlog"])>0)
						{
							?>
							<div class="blog-author">
							<?
							
							$GLOBALS["APPLICATION"]->IncludeComponent("bitrix:main.user.link",
								'',
								array(
									"ID" => $comment["arUser"]["ID"],
									"HTML_ID" => "blog_post_comment_".$comment["arUser"]["ID"],
									"NAME" => $arTmpUser["NAME"],
									"LAST_NAME" => $arTmpUser["LAST_NAME"],
									"SECOND_NAME" => $arTmpUser["SECOND_NAME"],
									"LOGIN" => $arTmpUser["LOGIN"],
									"NAME_LIST_FORMATTED" => $arTmpUser["NAME_LIST_FORMATTED"],
									"USE_THUMBNAIL_LIST" => "N",
									"PROFILE_URL" => $comment["urlToAuthor"],
									"PROFILE_URL_LIST" => $comment["urlToBlog"],
									"PATH_TO_SONET_MESSAGES_CHAT" => $arParams["~PATH_TO_MESSAGES_CHAT"],
									"PATH_TO_VIDEO_CALL" => $arParams["~PATH_TO_VIDEO_CALL"],
									"DATE_TIME_FORMAT" => $arParams["DATE_TIME_FORMAT"],
									"SHOW_YEAR" => $arParams["SHOW_YEAR"],
									"CACHE_TYPE" => $arParams["CACHE_TYPE"],
									"CACHE_TIME" => $arParams["CACHE_TIME"],
									"NAME_TEMPLATE" => $arParams["NAME_TEMPLATE"],
									"SHOW_LOGIN" => $arParams["SHOW_LOGIN"],
									"PATH_TO_CONPANY_DEPARTMENT" => $arParams["~PATH_TO_CONPANY_DEPARTMENT"],
									"PATH_TO_SONET_USER_PROFILE" => ($arParams["USE_SOCNET"] == "Y" ? $comment["urlToAuthor"] : $arParams["~PATH_TO_SONET_USER_PROFILE"]),
									"INLINE" => "Y",
									"SEO_USER" => $arParams["SEO_USER"],
								),
								false,
								array("HIDE_ICONS" => "Y")
							);
							?>
							</div>
							<?
						}
						elseif(strlen($comment["urlToAuthor"])>0)
						{
							?><div class="blog-author">
							<?if($arParams["SEO_USER"] == "Y"):?>
								<noindex>
							<?endif;?>
							<?
							$GLOBALS["APPLICATION"]->IncludeComponent("bitrix:main.user.link",
								'',
								array(
									"ID" => $comment["arUser"]["ID"],
									"HTML_ID" => "blog_post_comment_".$comment["arUser"]["ID"],
									"NAME" => $arTmpUser["NAME"],
									"LAST_NAME" => $arTmpUser["LAST_NAME"],
									"SECOND_NAME" => $arTmpUser["SECOND_NAME"],
									"LOGIN" => $arTmpUser["LOGIN"],
									"NAME_LIST_FORMATTED" => $arTmpUser["NAME_LIST_FORMATTED"],
									"USE_THUMBNAIL_LIST" => "N",
									"PROFILE_URL" => $comment["urlToAuthor"],
									"PATH_TO_SONET_MESSAGES_CHAT" => $arParams["~PATH_TO_MESSAGES_CHAT"],
									"PATH_TO_VIDEO_CALL" => $arParams["~PATH_TO_VIDEO_CALL"],
									"DATE_TIME_FORMAT" => $arParams["DATE_TIME_FORMAT"],
									"SHOW_YEAR" => $arParams["SHOW_YEAR"],
									"CACHE_TYPE" => $arParams["CACHE_TYPE"],
									"CACHE_TIME" => $arParams["CACHE_TIME"],
									"NAME_TEMPLATE" => $arParams["NAME_TEMPLATE"],
									"SHOW_LOGIN" => $arParams["SHOW_LOGIN"],
									"PATH_TO_CONPANY_DEPARTMENT" => $arParams["~PATH_TO_CONPANY_DEPARTMENT"],
									"PATH_TO_SONET_USER_PROFILE" => ($arParams["USE_SOCNET"] == "Y" ? $comment["urlToAuthor"] : $arParams["~PATH_TO_SONET_USER_PROFILE"]),
									"INLINE" => "Y",
									"SEO_USER" => $arParams["SEO_USER"],
								),
								false,
								array("HIDE_ICONS" => "Y")
							);
							?>
							<?if($arParams["SEO_USER"] == "Y"):?>
								</noindex>
							<?endif;?>
							</div>
							<?
						}
						else
						{
							?>
							<div class="blog-author"><?=$comment["AuthorName"]?></div>
							<?
						}

						if(strlen($comment["urlToDelete"])>0 && strlen($comment["AuthorEmail"])>0)
						{
							?>
							(<a href="mailto:<?=$comment["AuthorEmail"]?>"><?=$comment["AuthorEmail"]?></a>)
							<?
						}

						?>

					</div>

					<div class="blog-clear-float"></div>
					<div class="blog-comment-content">
						<?if(strlen($comment["TitleFormated"])>0)
						{
							?>
							<b><?=$comment["TitleFormated"]?></b><br />
							<?
						}
						?>
						<div id="av-blog-cooment-field">
							<div class="blog-comment-date"><b><?=$comment["DateFormated"]?></b></div> <br>
							<?=$comment["TextFormated"]?></div>
						<?
						if(!empty($arParams["arImages"][$comment["ID"]]))
						{
							?>
							<div class="feed-com-files">
								<div class="feed-com-files-title"><?=GetMessage("BLOG_PHOTO")?></div>
								<div class="feed-com-files-cont">
									<?
									foreach($arParams["arImages"][$comment["ID"]] as $val)
									{
										?><span class="feed-com-files-photo"><img src="<?=$val["small"]?>" alt="" border="0" data-bx-image="<?=$val["full"]?>"></span><?
									}
									?>
								</div>
							</div>
							<?
						}

						if($comment["COMMENT_PROPERTIES"]["SHOW"] == "Y")
						{
							$eventHandlerID = false;
							$eventHandlerID = AddEventHandler('main', 'system.field.view.file', Array('CBlogTools', 'blogUFfileShow'));
							?><div><?
							foreach ($comment["COMMENT_PROPERTIES"]["DATA"] as $FIELD_NAME => $arPostField)
							{
								if(!empty($arPostField["VALUE"]))
								{
									$GLOBALS["APPLICATION"]->IncludeComponent(
										"bitrix:system.field.view", 
										$arPostField["USER_TYPE"]["USER_TYPE_ID"], 
										array("arUserField" => $arPostField), null, array("HIDE_ICONS"=>"Y"));
								}
							}
							?></div><?
							if ($eventHandlerID !== false && ( intval($eventHandlerID) > 0 ))
								RemoveEventHandler('main', 'system.field.view.file', $eventHandlerID);
						}
						?>
						<div class="blog-comment-meta">
						<?
						if($bCanUserComment===true)
						{
							?>
							<span class="blog-comment-answer"><a href="javascript:void(0)" onclick="return showComment('<?=$comment["ID"]?>')"><b><?=GetMessage("B_B_MS_REPLY")?></b></a></span>
							<span class="blog-vert-separator"></span>
							<?
						}

						if(IntVal($comment["PARENT_ID"])>0)
						{
							?>
							<span class="blog-comment-parent"><a href="#<?=$comment["PARENT_ID"]?>"><?=GetMessage("B_B_MS_PARENT")?></a></span>
							<span class="blog-vert-separator"></span>
							<?
						}
						?>
						<span class="blog-comment-link"><a href="#<?=$comment["ID"]?>"><b><?=GetMessage("B_B_MS_LINK")?></b></a></span>
						<?
						if($comment["CAN_EDIT"] == "Y")
						{
							?>
							<script>
								top.text<?=$comment["ID"]?> = text<?=$comment["ID"]?> = '<?=CUtil::JSEscape($comment["~POST_TEXT"])?>';
								top.title<?=$comment["ID"]?> = title<?=$comment["ID"]?> = '<?=CUtil::JSEscape($comment["TITLE"])?>';
							</script>
							<span class="blog-vert-separator"></span>
							<span class="blog-comment-edit"><a href="javascript:void(0)" onclick="return editComment('<?=$comment["ID"]?>')"><?=GetMessage("BPC_MES_EDIT")?></a></span>
							<?
						}
						if(strlen($comment["urlToShow"])>0)
						{
							?>
							<span class="blog-vert-separator"></span>
							<span class="blog-comment-show">
								<?if($arParams["AJAX_POST"] == "Y"):?>
								<a href="javascript:void(0)" onclick="return hideShowComment('<?=$comment["urlToShow"]."&".bitrix_sessid_get()?>', '<?=$comment["ID"]?>');" title="<?=GetMessage("BPC_MES_SHOW")?>"></a>
								<?else:?>
										<a href="<?=$comment["urlToShow"]."&".bitrix_sessid_get()?>" title="<?=GetMessage("BPC_MES_SHOW")?>"></a>
								<?endif;?>
								<?=GetMessage("BPC_MES_SHOW")?></a></span>
							<?
						}
						if(strlen($comment["urlToHide"])>0)
						{
							?>
							<span class="blog-vert-separator"></span>
							<span class="blog-comment-show">
								<?if($arParams["AJAX_POST"] == "Y"):?>
									<a href="javascript:void(0)" onclick="return hideShowComment('<?=$comment["urlToHide"]."&".bitrix_sessid_get()?>', '<?=$comment["ID"]?>');" title="<?=GetMessage("BPC_MES_HIDE")?>">
								<?else:?>
									<a href="<?=$comment["urlToHide"]."&".bitrix_sessid_get()?>" title="<?=GetMessage("BPC_MES_HIDE")?>">
								<?endif;?>
								<?=GetMessage("BPC_MES_HIDE")?></a></span>
							<?
						}
						if(strlen($comment["urlToDelete"])>0)
						{
							?>
							<span class="blog-vert-separator"></span>
							<span class="blog-comment-delete">
								<?if($arParams["AJAX_POST"] == "Y"):?>
									<a href="javascript:void(0)" onclick="if(confirm('<?=GetMessage("BPC_MES_DELETE_POST_CONFIRM")?>')) deleteComment('<?=$comment["urlToDelete"]."&".bitrix_sessid_get()?>', '<?=$comment["ID"]?>');" title="<?=GetMessage("BPC_MES_DELETE")?>">
								<?else:?>
									<a href="javascript:if(confirm('<?=GetMessage("BPC_MES_DELETE_POST_CONFIRM")?>')) window.location='<?=$comment["urlToDelete"]."&".bitrix_sessid_get()?>'" title="<?=GetMessage("BPC_MES_DELETE")?>">
								<?endif;?>
								<?=GetMessage("BPC_MES_DELETE")?></a></span>
							<?
						}
						if(strlen($comment["urlToSpam"])>0)
						{
							?>
							<span class="blog-vert-separator"></span>
							<span class="blog-comment-delete blog-comment-spam"><a href="<?=$comment["urlToSpam"]?>" title="<?=GetMessage("BPC_MES_SPAM_TITLE")?>"><?=GetMessage("BPC_MES_SPAM")?></a></span>
							<?
						}
						if ($arParams["SHOW_RATING"] == "Y")
						{
							?>
							<span class="rating_vote_text">
							<span class="blog-vert-separator"></span>
							<?$GLOBALS["APPLICATION"]->IncludeComponent(
								"bitrix:rating.vote", $arParams["RATING_TYPE"],
								Array(
									"ENTITY_TYPE_ID" => "BLOG_COMMENT",
									"ENTITY_ID" => $comment["ID"],
									"OWNER_ID" => $comment["arUser"]["ID"],
									"USER_VOTE" => $arParams["RATING"][$comment["ID"]]["USER_VOTE"],
									"USER_HAS_VOTED" => $arParams["RATING"][$comment["ID"]]["USER_HAS_VOTED"],
									"TOTAL_VOTES" => $arParams["RATING"][$comment["ID"]]["TOTAL_VOTES"],
									"TOTAL_POSITIVE_VOTES" => $arParams["RATING"][$comment["ID"]]["TOTAL_POSITIVE_VOTES"],
									"TOTAL_NEGATIVE_VOTES" => $arParams["RATING"][$comment["ID"]]["TOTAL_NEGATIVE_VOTES"],
									"TOTAL_VALUE" => $arParams["RATING"][$comment["ID"]]["TOTAL_VALUE"],
									"PATH_TO_USER_PROFILE" => $arParams["~PATH_TO_USER"],
								),
								$arParams["component"],
								array("HIDE_ICONS" => "Y")
							);?>
							</span>
							<?
						}
						?>
						</div>

					</div>
					</div>
					</div>
						<div class="blog-clear-float"></div>

					<?
					if(strlen($errorComment) <= 0 && (strlen($_POST["preview"]) > 0 && $_POST["show_preview"] != "N") && (IntVal($_POST["parentId"]) > 0 || IntVal($_POST["edit_id"]) > 0)
						&& ( (IntVal($_POST["parentId"])==$comment["ID"] && IntVal($_POST["edit_id"]) <= 0)
							|| (IntVal($_POST["edit_id"]) > 0 && IntVal($_POST["edit_id"]) == $comment["ID"] && $comment["CAN_EDIT"] == "Y")))
					{
						$commentPreview = Array(
								"ID" => "preview",
								"TitleFormated" => htmlspecialcharsEx($_POST["subject"]),
								"TextFormated" => $_POST["commentFormated"],
								"AuthorName" => $User["NAME"],
								"DATE_CREATE" => GetMessage("B_B_MS_PREVIEW_TITLE"),
							);
						ShowComment($commentPreview, (IntVal($_POST["edit_id"]) == $comment["ID"] && $comment["CAN_EDIT"] == "Y") ? $level : ($level+1), 2.5, false, Array(), false, false, false, $arParams);
					}

					if(strlen($errorComment)>0 && $bCanUserComment===true
						&& (IntVal($_POST["parentId"])==$comment["ID"] || IntVal($_POST["edit_id"]) == $comment["ID"]))
					{
						?>
						<div class="blog-errors blog-note-box blog-note-error">
							<div class="blog-error-text">
								<?=$errorComment?>
							</div>
						</div>
						<?
					}
					?>
					</div>
					<div id="err_comment_<?=$comment['ID']?>"></div>
					<div id="form_comment_<?=$comment['ID']?>"></div>
					<div id="new_comment_cont_<?=$comment['ID']?>" style="padding-left:<?=$paddingSizeNew?>em;"></div>
					<div id="new_comment_<?=$comment['ID']?>" style="display:none;"></div>

					<?
					if((strlen($errorComment) > 0 || strlen($_POST["preview"]) > 0)
						&& (IntVal($_POST["parentId"])==$comment["ID"] || IntVal($_POST["edit_id"]) == $comment["ID"])
						&& $bCanUserComment===true)
					{
						?>
						<script>
						top.text<?=$comment["ID"]?> = text<?=$comment["ID"]?> = '<?=CUtil::JSEscape($_POST["comment"])?>';
						top.title<?=$comment["ID"]?> = title<?=$comment["ID"]?> = '<?=CUtil::JSEscape($_POST["subject"])?>';
						<?
						if(IntVal($_POST["edit_id"]) == $comment["ID"])
						{
							?>editComment('<?=$comment["ID"]?>');<?
						}
						else
						{
							?>showComment('<?=$comment["ID"]?>', 'Y', '<?=CUtil::JSEscape($_POST["user_name"])?>', '<?=CUtil::JSEscape($_POST["user_email"])?>', 'Y');<?
						}
						?>
						</script>
						<?
					}
				}
				elseif($comment["SHOW_AS_HIDDEN"] == "Y")
					echo "<b>".GetMessage("BPC_HIDDEN_COMMENT")."</b>";
				?>
				</div>
				<?
			}
		}

		function RecursiveComments($sArray, $key, $level=0, $first=false, $canModerate=false, $User, $use_captcha, $bCanUserComment, $errorComment, $arSumComments, $arParams)
		{
			if(!empty($sArray[$key]))
			{
				foreach($sArray[$key] as $comment)
				{
					if(!empty($arSumComments[$comment["ID"]]))
					{
						$comment["CAN_EDIT"] = $arSumComments[$comment["ID"]]["CAN_EDIT"];
						$comment["SHOW_AS_HIDDEN"] = $arSumComments[$comment["ID"]]["SHOW_AS_HIDDEN"];
						$comment["SHOW_SCREENNED"] = $arSumComments[$comment["ID"]]["SHOW_SCREENNED"];
						$comment["NEW"] = $arSumComments[$comment["ID"]]["NEW"];
					}
					ShowComment($comment, $level, 2.5, $canModerate, $User, $use_captcha, $bCanUserComment, $errorComment, $arParams);
					if(!empty($sArray[$comment["ID"]]))
					{
						foreach($sArray[$comment["ID"]] as $key1)
						{
							if(!empty($arSumComments[$key1["ID"]]))
							{
								$key1["CAN_EDIT"] = $arSumComments[$key1["ID"]]["CAN_EDIT"];
								$key1["SHOW_AS_HIDDEN"] = $arSumComments[$key1["ID"]]["SHOW_AS_HIDDEN"];
								$key1["SHOW_SCREENNED"] = $arSumComments[$key1["ID"]]["SHOW_SCREENNED"];
								$key1["NEW"] = $arSumComments[$key1["ID"]]["NEW"];
							}
							ShowComment($key1, ($level+1), 2.5, $canModerate, $User, $use_captcha, $bCanUserComment, $errorComment, $arParams);

							if(!empty($sArray[$key1["ID"]]))
							{
								RecursiveComments($sArray, $key1["ID"], ($level+2), false, $canModerate, $User, $use_captcha, $bCanUserComment, $errorComment, $arSumComments, $arParams);
							}
						}
					}
					if($first)
						$level=0;
				}
			}
		}
		?>
		<?
		if($arResult["is_ajax_post"] != "Y")
		{
			if($arResult["CanUserComment"])
			{
				$postTitle = "";
				if($arParams["NOT_USE_COMMENT_TITLE"] != "Y")
					$postTitle = "RE: ".CUtil::JSEscape($arResult["Post"]["TITLE"]);
				?>
						<div class="blog-add-comment"><br><a href="javascript:void(0)" onclick="return showComment('0')"><b><?=GetMessage("B_B_MS_ADD_COMMENT")?></b></a></div>
				<a name="0"></a>

				<?
				if(strlen($arResult["COMMENT_ERROR"]) > 0 && strlen($_POST["parentId"]) < 2
					&& IntVal($_POST["parentId"])==0 && IntVal($_POST["edit_id"]) <= 0)
				{
					?>
					<div class="blog-errors blog-note-box blog-note-error">
						<div class="blog-error-text"><?=$arResult["COMMENT_ERROR"]?></div>
					</div>
					<?
				}
			}


			
			if($arResult["CanUserComment"])
			{
				?>
				<div id="form_comment_0">
					<div id="err_comment_0"></div>
					<div id="form_comment_0"></div>
					<div id="new_comment_cont_0"></div>
					<div id="new_comment_0" style="display:none;"></div>
				</div>
				<?
				if((strlen($arResult["COMMENT_ERROR"])>0 || strlen($_POST["preview"]) > 0)
					&& IntVal($_POST["parentId"]) == 0 && strlen($_POST["parentId"]) < 2 && IntVal($_POST["edit_id"]) <= 0)
				{
					?>
					<script>
					top.text0 = text0 = '<?=CUtil::JSEscape($_POST["comment"])?>';
					top.title0 = title0 = '<?=CUtil::JSEscape($_POST["subject"])?>';
					showComment('0', 'Y', '<?=CUtil::JSEscape($_POST["user_name"])?>', '<?=CUtil::JSEscape($_POST["user_email"])?>', 'Y');
					</script>
					<?
				}
			}


		}

		$arParams["RATING"] = $arResult["RATING"];
		$arParams["component"] = $component;
		$arParams["arImages"] = $arResult["arImages"];
		if($arResult["is_ajax_post"] == "Y")
			$arParams["is_ajax_post"] = "Y";

		if($arResult["is_ajax_post"] != "Y" && $arResult["NEED_NAV"] == "Y")
		{
			for($i = 1; $i <= $arResult["PAGE_COUNT"]; $i++)
			{
				$tmp = $arResult["CommentsResult"];
				$tmp[0] = $arResult["PagesComment"][$i];
				?>
					<div id="blog-comment-page-<?=$i?>"<?if($arResult["PAGE"] != $i) echo "style=\"display:none;\""?>><?RecursiveComments($tmp, $arResult["firstLevel"], 0, true, $arResult["canModerate"], $arResult["User"], $arResult["use_captcha"], $arResult["CanUserComment"], $arResult["COMMENT_ERROR"], $arResult["Comments"], $arParams);?></div>
				<?
			}
		}
		else
			RecursiveComments($arResult["CommentsResult"], $arResult["firstLevel"], 0, true, $arResult["canModerate"], $arResult["User"], $arResult["use_captcha"], $arResult["CanUserComment"], $arResult["COMMENT_ERROR"], $arResult["Comments"], $arParams);

		if($arResult["is_ajax_post"] != "Y")
		{
			if($arResult["CanUserComment"] && count($arResult["Comments"])>2)
			{
				if(strlen($arResult["COMMENT_ERROR"])>0 && $_POST["parentId"] == "00" && strlen($_POST["parentId"]) > 1)
				{
					?>
					<div class="blog-errors blog-note-box blog-note-error">
						<div class="blog-error-text">
							<?=$arResult["COMMENT_ERROR"]?>
						</div>
					</div>
					<?
				}
				?>

				<div id="form_comment_00">
					<div id="err_comment_00"></div>
					<div id="form_comment_00"></div>
					<div id="new_comment_cont_00"></div>
					<div id="new_comment_00" style="display:none;"></div>
				</div><br />
				
				<?
				if((strlen($arResult["COMMENT_ERROR"])>0 || strlen($_POST["preview"]) > 0)
					&& $_POST["parentId"] == "00" && strlen($_POST["parentId"]) > 1)
				{
					?>
					<script>
					top.text00 = text00 = '<?=CUtil::JSEscape($_POST["comment"])?>';
					top.title00 = title00 = '<?=CUtil::JSEscape($_POST["subject"])?>';

					showComment('00', 'Y', '<?=CUtil::JSEscape($_POST["user_name"])?>', '<?=CUtil::JSEscape($_POST["user_email"])?>', "Y");
					</script>
					<?
				}
			}
			

			if($arResult["NEED_NAV"] == "Y")
			{
				?>
				<div class="blog-comment-nav">
					<?=GetMessage("BPC_PAGE")?>&nbsp;<?
					for($i = 1; $i <= $arResult["PAGE_COUNT"]; $i++)
					{
						$style = "blog-comment-nav-item";
						if($i == $arResult["PAGE"])
							$style .= " blog-comment-nav-item-sel";
						?><a class="<?=$style?>" href="<?=$arResult["NEW_PAGES"][$i]?>" onclick="return bcNav('<?=$i?>', this)" id="blog-comment-nav-b<?=$i?>"><?=$i?></a>&nbsp;&nbsp;<?
					}
				?>
				</div>
				<?
			}

		}
	}
}
?>

</div>
	<div class="blog-posts-same">

		<?
		$APPLICATION->IncludeComponent(
		"bitrix:blog.blog",
		"av-steel-blog-post-same-post",
		Array(
		
		"MESSAGE_COUNT"			=> $arResult["MESSAGE_COUNT"],
		"BLOG_VAR"				=> $arParams["BLOG_VAR"],
		"POST_VAR"				=> $arParams["POST_VAR"],
		"USER_VAR"				=> $arParams["USER_VAR"],
		"PAGE_VAR"				=> $arParams["PAGE_VAR"],
		"PATH_TO_BLOG"			=> $arResult["urlToCategory"],
		"PATH_TO_BLOG_CATEGORY"	=> $arResult["Category"]["0"]["urlToCategory"],

		"PATH_TO_POST_EDIT"		=> $arParams["PATH_TO_POST_EDIT"],
		"PATH_TO_USER"			=> $arParams["PATH_TO_USER"],
		"PATH_TO_SMILE"			=> $arParams["PATH_TO_SMILE"],
		"BLOG_URL"				=> $arParams["BLOG_URL"],
		"YEAR"					=> $arParams["VARIABLES"]["year"],
		"MONTH"					=> $arParams["VARIABLES"]["month"],
		"DAY"					=> $arParams["VARIABLES"]["day"],
		"CATEGORY_ID"			=> $arResult["Post"]["CATEGORY_ID"],
		"CACHE_TYPE"			=> $arParams["CACHE_TYPE"],
		"CACHE_TIME"			=> $arParams["CACHE_TIME"],
		"CACHE_TIME_LONG"		=> $arParams["CACHE_TIME_LONG"],
		"SET_NAV_CHAIN"			=> $arParams["SET_NAV_CHAIN"],
		"SET_TITLE"				=> $arParams["SET_TITLE"],
		"POST_PROPERTY_LIST"	=> $arParams["POST_PROPERTY_LIST"],
		"DATE_TIME_FORMAT"		=> $arParams["DATE_TIME_FORMAT"],
		"NAV_TEMPLATE"			=> $arParams["NAV_TEMPLATE"],

		"SEO_USER"				=> $arParams["SEO_USER"],
		"NAME_TEMPLATE" 		=> "red2",
		"SHOW_LOGIN" 			=> $arParams["SHOW_LOGIN"],
		"PATH_TO_CONPANY_DEPARTMENT"	=> $arParams["PATH_TO_CONPANY_DEPARTMENT"],
		"PATH_TO_SONET_USER_PROFILE"	=> $arParams["PATH_TO_SONET_USER_PROFILE"],
		"PATH_TO_MESSAGES_CHAT"	=> $arParams["PATH_TO_MESSAGES_CHAT"],
		"PATH_TO_VIDEO_CALL"	=> $arParams["PATH_TO_VIDEO_CALL"],
		"USE_SHARE" 			=> $arParams["USE_SHARE"],
		"SHARE_HIDE" 			=> $arParams["SHARE_HIDE"],
		"SHARE_TEMPLATE" 		=> $arParams["SHARE_TEMPLATE"],
		"SHARE_HANDLERS" 		=> $arParams["SHARE_HANDLERS"],
		"SHARE_SHORTEN_URL_LOGIN"	=> $arParams["SHARE_SHORTEN_URL_LOGIN"],
		"SHARE_SHORTEN_URL_KEY" => $arParams["SHARE_SHORTEN_URL_KEY"],
		"SHOW_RATING" => $arParams["SHOW_RATING"],
		"IMAGE_MAX_WIDTH" => $arParams["IMAGE_MAX_WIDTH"],
		"IMAGE_MAX_HEIGHT" => $arParams["IMAGE_MAX_HEIGHT"],
		"ALLOW_POST_CODE" => $arParams["ALLOW_POST_CODE"],
		"RATING_TYPE" => $arParams["RATING_TYPE"],
		),
		$component
		);
		?>
		</div>	




<?
if($arResult["is_ajax_post"] == "Y")
	die();
?>