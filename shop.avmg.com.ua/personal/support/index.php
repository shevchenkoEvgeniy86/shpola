<?
require $_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php";

$APPLICATION->SetTitle("Поддержка");

$APPLICATION->IncludeComponent(
	"bitrix:support.wizard", 
	"av", 
	array(
		"IBLOCK_TYPE" => "services",
		"IBLOCK_ID" => "80",
		"PROPERTY_FIELD_TYPE" => "",
		"PROPERTY_FIELD_VALUES" => "",
		"AJAX_MODE" => "Y",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "N",
		"AJAX_OPTION_HISTORY" => "Y",
		"AJAX_OPTION_ADDITIONAL" => "",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
		"TICKETS_PER_PAGE" => "50",
		"MESSAGES_PER_PAGE" => "20",
		"MESSAGE_MAX_LENGTH" => "70",
		"MESSAGE_SORT_ORDER" => "asc",
		"SET_PAGE_TITLE" => "N",
		"TEMPLATE_TYPE" => "standard",
		"SHOW_RESULT" => "Y",
		"SHOW_COUPON_FIELD" => "N",
		"SET_SHOW_USER_FIELD" => array(
		),
		"SECTIONS_TO_CATEGORIES" => "Y",
		"SELECTED_SECTIONS" => array(
		),
		"COMPONENT_TEMPLATE" => "av",
		"VARIABLE_ALIASES" => array(
			"ID" => "ID",
		)
	),
	false
);

require $_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php";