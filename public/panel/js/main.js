$(function(){
	$('.richText').trumbowyg({
		btns: [
			['viewHTML'],
			['undo', 'redo'], // Only supported in Blink browsers
			['formatting'],
			['strong', 'em'],
			['link'],
			['insertImage'],
			['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
			['unorderedList', 'orderedList'],
			['horizontalRule'],
			['removeformat'],
			['fullscreen'],
			['upload']
		],
		plugins: {
			upload: {
				serverPath:"upload.php",
				fileFieldName:"file",
				urlPropertyName:"file",
				statusPropertyName:"success",
			}
		}
	});

	$( document ).ready(function() {
		$(".tabs-section .tab:first-child .tabs-title").addClass("active");
		$(".tabs-section .tab:first-child .fieldRow").addClass("active");
	});

	$(".tabs-title").click(function(){
		$(".fieldRow").removeClass("active");
		$(".tabs-title").removeClass("active");
		$(this).next(".fieldRow").addClass("active");
		$(this).addClass("active");
	});


	
	$(".langSwitch input").click(function(){
		$(this).parent().parent().parent().parent().find(".inputTd").children().hide().eq( $(this).parent().index() ).show();
	});
	
	$("#gallery").tableDnD({onDragClass:"dragClassGallery", onDrop:function(tb, tr){
		
	}});
	
	if(inIframe())
	{
		$(".pickColumn").show();
		
		var pickBoxList = $(".pickBox");
		
		for(var i=0; i<pickBoxList.length; i++)
		{
			var pickBox = pickBoxList.eq(i);
			
			if( innerIsChecked(pickBox) )
			{
				pickBox.attr("checked", true);
			}
		}
	}
	else
	{
		$("#report").tableDnD({onDragClass:"dragClassEntities", onDrop:function(tb, tr){
			document.orderForm.submit();
		}});
	}
	
	$(".pickedData").tableDnD({onDragClass:"dragClassEntities", onDrop:function(tb, tr){
		document.orderForm.submit();
	}});
});

function chooseTemplate(sectionLink, templateId)
{
	window.location.assign(sectionLink + "&tpl=" + templateId);
}

function pick(pickerUrl, fieldName)
{
	window.pickFieldName = fieldName;
	
	$.fancybox.open({
		src  : pickerUrl,
		type : 'iframe'
	});
}

function innerPick(pickBox)
{
	var entityId = $(pickBox).parent().parent().attr("id");
	
	if( innerIsChecked(pickBox) )
	{
		window.parent.outerRemoveRow(entityId);
	}
	else
	{
		var titleCell = $(pickBox).parent().parent().find(".titleColumn");
		if(titleCell.length > 0)
		{
			var entityTitle = titleCell.html();
		}
		else
		{
			var entityTitle = $(pickBox).parent().parent().find(".typeColumn").html();
		}
		var entityImage = $(pickBox).parent().parent().find(".imageColumn").css("background-image");
		
		window.parent.outerPick(entityId, entityTitle, entityImage);
	}
}

function outerPick(entityId, entityTitle, entityImage)
{
	var txt = "";
	
	txt += "<tr class='pickRow_"+ entityId +"'>";
		txt +="<td class='pickedDelete'><input type='hidden' name='"+ window.pickFieldName +"[]' value='"+ entityId +"'><span onclick='removePickedRow(this)'>✖</span></td>";
		txt +="<td class='imageColumn'><div>&nbsp;</div></td>";
		txt +="<td style='font-size:25px'>✥</td>";
		txt +="<td class='pickedTitle'>"+ entityTitle +"</td>";
	txt += "</tr>";
	
	$("#"+window.pickFieldName).children("tbody").prepend(txt);
	
	if(entityImage)
	{
		$("#"+window.pickFieldName).find(".pickRow_" + entityId).find(".imageColumn").css("background-image", entityImage);
	}
}

function innerIsChecked(pickBox)
{
	var entityId = $(pickBox).parent().parent().attr("id");
	
	return window.parent.outerIsChecked(entityId);
}

function outerIsChecked(entityId)
{
	if( $("#"+window.pickFieldName).find("input[value='"+ entityId +"']").length > 0 )
	{
		return true;
	}
	else
	{
		return false;
	}
}

function outerRemoveRow(entityId)
{
	$("#"+window.pickFieldName).find(".pickRow_" + entityId).remove();
}

function removePickedRow(delButton)
{
	$(delButton).parent().parent().remove();
}

function inIframe()
{
	if(window.parent.location.href.indexOf("?editSection&") === -1 && window.parent.location.href.indexOf("?addSection&") === -1 && window.parent.location.href.indexOf("?editWidget&") === -1 && window.parent.location.href.indexOf("?addWidget&") === -1)
	{
		return false;
	}
	else
	{
		return true;
	}
}
