
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../assets/js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>

        <script src="../assets/js/jquery.dataTables.min.js"></script>
        <script src="../assets/js/dataTables.bootstrap4.min.js"></script>
        <script src="../assets/demo/datatables-demo.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.css" integrity="sha512-0nkKORjFgcyxv3HbE4rzFUlENUMNqic/EzDIeYCgsKa/nwqr2B91Vu/tNAu4Q0cBuG4Xe/D1f/freEci/7GDRA==" crossorigin="anonymous" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
<script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script> 
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js" integrity="sha512-zMfrMAZYAlNClPKjN+JMuslK/B6sPM09BGvrWlW+cymmPmsUT1xJF3P4kxI3lOh9zypakSgWaTpY6vDJY/3Dig==" crossorigin="anonymous"></script>
        <script src="//cdn.ckeditor.com/4.15.0/full/ckeditor.js"></script>
      <script   >
         var config = "message_text";

             CKEDITOR.replace(config);

         $(document).ready(function () {

             CKEDITOR.config.toolbarGroups = [
                 { name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
                 { name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
                 { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
                 { name: 'document', groups: [ 'document', 'doctools', 'mode' ] },
                 { name: 'forms', groups: [ 'forms' ] },
                 { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
                 { name: 'links', groups: [ 'links' ] },
                 { name: 'insert', groups: [ 'insert' ] },
                 { name: 'styles', groups: [ 'styles' ] },
                 { name: 'colors', groups: [ 'colors' ] },
                 { name: 'tools', groups: [ 'tools' ] },
                 { name: 'others', groups: [ 'others' ] },
                 { name: 'about', groups: [ 'about' ] }
             ];

             CKEDITOR.config.removeButtons = 'Cut,Undo,Find,Scayt,Save,Templates,Form,HiddenField,Replace,Checkbox,Radio,SelectAll,Redo,Copy,Paste,PasteText,PasteFromWord,NewPage,ExportPdf,Preview,Print,TextField,Textarea,Select,Button,ImageButton,Subscript,Superscript,NumberedList,Outdent,Blockquote,JustifyLeft,BidiLtr,BulletedList,Indent,CreateDiv,JustifyCenter,BidiRtl,Link,Unlink,JustifyRight,Language,Anchor,JustifyBlock,Table,Flash,Image,HorizontalRule,Smiley,SpecialChar,PageBreak,Iframe,Styles,TextColor,Maximize,About,ShowBlocks,BGColor,Format,Font,FontSize,RemoveFormat,CopyFormatting';

             CKEDITOR.config.enterMode = CKEDITOR.ENTER_BR;
             //CKEDITOR.config.shiftEnterMode = CKEDITOR.ENTER_BR
             CKEDITOR.config.autoParagraph = false;
            // CKEDITOR.config.enterMode = CKEDITOR.ENTER_P;
             CKEDITOR.config.disallowedContent = 'br';
             CKEDITOR.config.disallowedContent = 'p';
         });


      </script>

        <script>
  
var notyf = new Notyf();

$(function() {
    $(".sb-sidenav-menu").niceScroll();
  
});</script>