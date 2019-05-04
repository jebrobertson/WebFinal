$(document).ready(function(){
    $(".colorBlock").each(
    
    function(i, block){
         var id = $(block).attr('id');
         if(id == "chosenColor"){
             $("#chosenColor").droppable({
                 drop: function(event, ui) {
                     var block = ui.draggable
                     var color = block.css("background-color");
                     
                     var hex = parseRGB(color);
                     updateColor(hex);
                 }
             });
             return;
         }
         var r = Math.floor(i/16);
         var g = Math.floor((i-r*16)/4);
         var b = (i-16*r-4*g);
         var color = "#";
         var rp = (4*r).toString(16);
         var gp = (4*g).toString(16);
         var bp = (4*b).toString(16);
         color += rp+rp+gp+gp+bp+bp;
         $(block).css("background-color", color);
         $(block).draggable({snap: "#chosenColor", snapMode: "inner", revert: "valid"});
    });
});

function parseRGB(s){
   s = s.split("(");
   s = s[1];
   s = s.split(")");
   s = s[0];
   var val = s.split(",");
   var r = parseInt(val[0], 10);
   var g = parseInt(val[1], 10);
   var b = parseInt(val[2], 10);
   var hex = "#"
   if(r < 16)
       hex += "0";
   hex += r.toString(16);
   if(g < 16)
       hex += "0";
   hex += g.toString(16);
   if(b < 16)
       hex += "0";
   hex += b.toString(16);
   return hex;
}


function updateColor(color){
    $.post("updateColor.php", {color: color},
         function(data, status){
             console.log(data);
         });
    $("#chosenColor").css("background-color", color);
}


function updateColorFromPicker(){
     updateColor($("#manualColor").val());
}
