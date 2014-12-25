<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$nextPage = ($arResult["NavPageNomer"] < $arResult["nEndPage"]) ? $arResult["NavPageNomer"]+1 : $arResult["nEndPage"];
?>
<?if($arResult["NavPageNomer"] == 1):?>
<script>
	var in_process = false;
	var page = 1;
	var nEndPage = <?=$arResult["nEndPage"];?>;
	var LastPage = 1;
	
	function get_next_items() 
	{
		if (in_process || LastPage < page) return false;
		
		page = page + 1;
		LastPage = page;
		
		if(page > nEndPage) return false;
			
		url = window.location.toString();
		url = url.replace('#', '');
		
		in_process = true;			
		$.ajax({
			type: "GET",
			dataType: "html",
			data: "gt=nav-is&PAGEN_<?=$arResult["NavNum"]?>="+page,
			url: url + (window.location.search != '' ? "&" : "?") + "type=html",
			success: function( HTML ){
				if(HTML)
				{
					$(HTML).insertAfter('div.navItem:last');
					$('div.navItem:first').remove();
				}
			},
			complete: function(){
				in_process = false;
			}
		});	
	}
	
	$(window).scroll(function() {
		if  ($(window).scrollTop()+200 >= $(document).height() - $(window).height())
			get_next_items();
	});
</script>
<?endif;?>
<?if ($arResult["NavPageNomer"] < $arResult["NavPageCount"]):?>
	<div class="navItem">
	<a href="<?= $APPLICATION->GetCurPageParam("PAGEN_".$arResult["NavNum"]."=".$nextPage,array("PAGEN_".$arResult["NavNum"],"gt","type"));?>" 
	   onclick="get_next_items();return false;"
	>
		Далее..
	</a>
	</div>
<?endif;?>