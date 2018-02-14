<?

if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
/* -------------------------------------------------------------------- */
/* ------------------------------- item ------------------------------- */
/* -------------------------------------------------------------------- */
?>
<div class="slider">
    <div class="slides_container">
        <?foreach($arResult["ITEMS"] as $arItem):?>
            <a href="<?php if(is_array($arItem["DISPLAY_PROPERTIES"]['SLIDER_LINK'])) echo $arItem['DISPLAY_PROPERTIES']['SLIDER_LINK']['VALUE']; else echo '/catalog/'; ?>"><img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem["NAME"]?>" /></a>
        <?endforeach;?>
        <pre>

            <?print_r("$arItem");?>
        </pre>
    </div>
    <a href="#" class="prev"></a>
    <a href="#" class="next"></a>
</div>