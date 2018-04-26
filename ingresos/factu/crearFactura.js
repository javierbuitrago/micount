$(document).on('ready', funcPrincipal);

var i = 1; 



function funcPrincipal() 
{
	$("#btnNuevoItem").on('click', funcNuevoItem);
      

	$("body").on('click', ".btn-danger", funcEliminarFila);

}

function funcEliminarFila() 
{
	$(this).parent().parent().fadeOut( "slow", function() { $(this).remove(); } );
}



function funcNuevoItem() 



{
	$("#tablaItems")
	.append
	(
		$('<tr>')
        .append
        (
        	$('<td>')
            .append
            (
            	$('<input>').attr('type', 'text').attr('id', 'item' + i).addClass('form-control calcTotal').attr('name', 'item' + i).attr('placeholder', 'buscar Item')
            )
        )
        .append
        (
        	$('<td>')
            .append
            (
            	$('<input>').attr('type', 'text').attr('id', 'referencia'+ i).addClass('form-control calcTotal').attr('name', 'referencia'+ i).attr('placeholder', 'referencia')
            )
        )
        
        .append
        (
        	$('<td>')
            .append
            (
            	$('<input>').attr('type', 'text').attr('id', 'precio'+ i).addClass('form-control calcTotal').attr('name', 'precio'+ i).attr('placeholder', 'precio').attr('value', '0.00')
            )
        )
        .append
        (
        	$('<td>')
            .append
            (
            	$('<input>').attr('type', 'text').attr('id', 'descuento'+ i).addClass('form-control calcTotal').attr('name', 'descuento'+ i).attr('placeholder', '%').attr('value', '0.00')
            )
        )
        .append
        (
        	$('<td>')
            .append
            (
            	$('<input>').attr('type', 'text').attr('id', 'impuesto'+ i).addClass('form-control calcTotal').attr('name', 'impuesto'+ i).attr('placeholder', 'impuesto').attr('value', '0.00')
            )
        )
        .append
        (
        	$('<td>')
            .append
            (
            	$('<input>').attr('type', 'text').attr('id', 'descripcion'+ i).addClass('form-control calcTotal').attr('name', 'descripcion'+ i).attr('placeholder', 'descripcion')
            )
        )
        .append
        (
        	$('<td>')
            .append
            (
            	$('<input>').attr('type', 'text').attr('id', 'cantidad'+ i).addClass('form-control calcTotal').attr('name', 'cantidad'+ i).attr('placeholder', 'cantidad').attr('value', '1')
            )
        )
        .append
        (
        	$('<td>')
            .append
            (
            	$('<input>').attr('type', 'text').attr('id', 'total'+ i).addClass('form-control calcTotal').attr('name', 'total'+ i).attr('placeholder', '0.00').attr('value', '').attr('value', '0.00')
            )
        )
        .append
        (
        	$('<td>').addClass('text-center')
           
            .append
            (
            	$('<div>').addClass('btn btn-danger').text('x')
            )            
        )        
    );
i++;	
}

 



/*


function sumarFila(){
			var ii = document.getElementById("precio").value;	
		var i = document.getElementById("cantidad").value;				
var impuesto = document.getElementById("impuesto").value;		
var imp= 1 + "." + impuesto;
imp= parseFloat(imp);

				var res=i*ii*imp;
				
				
				
				
				
				
				
				
                document.getElementById("row_add").onclick=function(){
				
				if(i==='0'||i3==='0')
{alert('La cantindad ni el precio pueden ser igual a 0');}

else{
var x = document.getElementById("myTable").getElementsByTagName("tr").length;
                    addRow([x,i,ii,i3,r]);}
                }
            }
            
            
            
            
            
            function addRow(dataArr){
                var tr=document.createElement('tr');
                var len=dataArr.length;
                for(var i=0;i<len;i++){
                    var td=document.createElement('td');
                    td.appendChild(document.createTextNode(dataArr[i]));
                    tr.appendChild(td);
                }
                document.getElementById('tbl_bdy').appendChild(tr);
             return true;  }
    function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
	
}
function deleteRow() {
 var tt=document.getElementById("t").value;
 
 if(tt==='0'||tt===''){
 alert('No puede borrar esta columna');
 
 }else{
    document.getElementById("myTable").deleteRow(tt); 
}
	}


function getAllRows(myTable)
            {              
tabla = document.getElementById("myTable");
var total = 0;
for(var i = 1; tabla.rows[i]; i++)
total += Number(tabla.rows[i].cells[4].innerHTML);
var num = '$' + total.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
alert(num);
var t = document.getElementById("total");
t.value=num;
            }
			function borrarTodo(){			
var ii = document.getElementById("uno");
		var i = document.getElementById("dos");			
var i3 = document.getElementById("tres");
var t = document.getElementById("total");	
ii.value="";	
i.value="";	
i3.value="";
t.value="";	
window.location.reload();

			}
*/