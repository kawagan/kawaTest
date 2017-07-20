
 <script language="javascript">
 $('ul.pagination').addClass('no-margin pagination-sm');
 $("#title").on('blur',function(){
      var str=this.value.toLowerCase().trim();
      var replace=str.replace(/^&|&$/g,'')
                     .replace(/&/g,'-and-')
                     .replace(/[^a-z0-9-]+/g,'-')
                     .replace(/^-+|-+$/g,'')
                     .replace(/\-\-+/g,'-');                  
    $("#slug").val(replace);
 });
 
 $(function () {
    $('#datetimepicker1').datetimepicker({
        format: 'YYYY-MM-DD HH:mm:ss',
        showClear: true
    });
 });
 
 $("#btn-draft").click(function(e){
     e.preventDefault();
     $("#published_at").val("");
     $("#post-form").submit();
 });
 </script>
