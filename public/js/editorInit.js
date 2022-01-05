$(document).ready(function (){
    $('#editorSummernote').summernote({
         toolbar: [
             ['style', ['style']],
             ['fontsize', ['fontsize']],
             ['font', ['bold', 'italic', 'underline']],
             ['fontname', ['fontname']],
             ['color', ['color']],
             ['para', ['ul', 'ol', 'paragraph']],
             ['height', ['height']],
             ['insert', ['picture', 'hr']],
             ['table', ['table']]
         ],
         
        lang: 'pt-BR',
        fontSizes: ['8','9','10','11','12','14','16','18','20','22','24','26','28','36','48','72'],
        lineHeights: ['0.2', '0.3', '0.4', '0.5', '0.6', '0.8', '1.0', '1.2', '1.4', '1.5', '2.0', '3.0'],
        spellCheck: true,
        height: 400,
        disableResizeEditor: true
    }) ;
 });
 function enviarForm(){
     var formulario = document.querySelector("#formulario");
     $("#rawHtml").val($("#editorSummernote").summernote('code'));
     formulario.submit();
 }

 function inserirVar(valor){
     var variavel = "{'"+valor+"'}";
     console.log(variavel);
     $("#editorSummernote").summernote('insertText',variavel);
 }