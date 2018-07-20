<html>

   <head>
      <title>Buat program</title>

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />

   </head>

   <body>
      <!-- <form action = "" method = ""> -->
         <?php echo validation_errors(); ?>
         <?php echo form_open('createprogramform'); ?>

         <p>
         <h5>Nama program</h5>
         <input type = "text" name = "nama" class="form-control name_list" value = "<?php echo set_value('nama'); ?>" size = "127" />

         <h5>Deskripsi program</h5>
        <input type = "text" name = "deskripsi" class="form-control name_list" value = "<?php echo set_value('deskripsi'); ?>" size = "254" />

        <h5>Nama PIC</h5>
        <div class="table-responsive">
                                        <table class="table table-bordered" id="dynamic_field">
                                             <tr>
                                                  <td><input type="text" name="name[]" id="search" placeholder="Enter your Name" class="form-control name_list" onkeyup="ajaxSearch();" />
                                                    <div id="display">
                                                     <div id="autoDisplay"> </div></div>
                                                  </td>

                                                  <td><button type="button" name="add" id="add" class="btn btn-success">Add More</button></td>
                                             </tr>
                                        </table>
                                      <!--  <input type="button" name="submit" id="submit" class="btn btn-info" value="Submit" /> -->
                                   </div></p>

        <p><div><input type = "submit" class="btn btn-info" value = "Submit" /></div></p>
        <!-- <script>
            $(document).ready(function(){ alert("jquerytest"); });
         </script> -->
      </form>
   </body>

</html>
<script>
 $(document).ready(function(){
      var i=1;
      $('#add').click(function(){
           i++;
           $('#dynamic_field').append('<tr id="row'+i+'"><td><input type="text" name="name[]" id="search'+i+'" placeholder="Enter your Name" class="form-control name_list" onkeyup="ajaxSearch();" /><div id="display'+i+'""><div id="autoDisplay"'+i+'"></div></div></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');
      });
      $(document).on('click', '.btn_remove', function(){
           var button_id = $(this).attr("id");
           $('#row'+button_id+'').remove();
      });
    /*$('#submit').click(function(){
           $.ajax({
                url:"name.php",
                method:"POST",
                data:$('#add_name').serialize(),
                success:function(data)
                {
                     alert(data);
                     $('#add_name')[0].reset();
                }
           });
      });*/
 });
</script>
<script type="text/javascript">
function ajaxSearch()
{
    var input_data = $('[id^=search]').val();
    num = '';
    if (input_data.length === 0)
    {
        $('[id^=display]'+num).hide();
    }
    else
    {
        var post_data = {
            'search': input_data,
            '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
            };
        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>createprogramform/autocomplete",
            data: post_data,
            success: function (data) {
                // return success
                if (data.length > 0) {
                    $('[id^=display]'+num).show();
                    $('[id^=autoDisplay]'+num).addClass('auto_list');
                    $('[id^=autoDisplay]'+num).html(data);
                }
            }
         });
     }
 }
 //To select country name
function selectUser(val) {
$("#search").val(val);
$("#Display").hide();
$("#autoDisplay").hide();
}
</script>
