<?
require $_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php";

$APPLICATION->SetTitle("Наше производство");
$APPLICATION->SetPageProperty("title",       "Производство компании АВ металл групп | 🏠 Украина, г. Днепр, ул. Шолом-Алейхема, 5, ☎ (056) 790-01-22 | ™ ru.avmg.com.ua");
$APPLICATION->SetPageProperty("description", "АВ металл груп ™ ✓Национальный производитель ✓Современное оборудование ✓Низкие цены ☎ (056)790-01-22 Звоните!");

$APPLICATION->IncludeComponent("av:visit_site.menu.tablet", "", array("MENU_TYPE" => "left"));

require $_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php";