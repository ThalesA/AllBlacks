$(document).ready(() => {
	
	let ativo = $("#oculto").val();
	let sim = $('#sim').val();
	let nao = $('#nao').val();

	if (ativo == sim ) {
		$("#sim").attr('checked',true);
	} else {
		$("#nao").attr('checked',true);
	}

	$('#cep').mask('00000-000');
	$('#documento').mask('000.000.000-00');
	$('#telefone').mask('(00) 0000-00009');
	$('#telefone').blur(function(event) {
	   if($(this).val().length == 15){
	      $('#telefone').mask('(00) 00000-0009');
	   } else {
	      $('#telefone').mask('(00) 0000-00009');
	   }
	});

});