<?
use \Bitrix\Main\Page\Asset;

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$templateFolder     = getFolder(__DIR__);
$templateFolderHttp = CURRENT_PROTOCOL."://".SITE_NAME.str_replace(DIRECTORY_SEPARATOR, "/", $templateFolder);

CJSCore::Init(["av_form_elements", "font_awesome", "av_slider"]);
Asset::getInstance()->addString("<script>AvCatalogElementCheckPosition = \"".$templateFolderHttp."ajax/check_position.php\";</script>");

Asset::getInstance()->addCss($templateFolder."images_block/style.css");
Asset::getInstance()->addJs ($templateFolder."images_block/script.js");
Asset::getInstance()->addCss($templateFolder."ask_form/style.css");
Asset::getInstance()->addJs ($templateFolder."ask_form/script.js");

AvComponentsIncludings::getInstance()
    ->setIncludings("bitrix", "form.result.new", "ajax");