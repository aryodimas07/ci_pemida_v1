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
                                                  <td><input type="text" name="name[]" id="search_1" placeholder="Enter your Name" class="form-control name_list" onkeyup="ajaxSearch(this);" />
                                                    <div id="display1">
                                                     <div id="autoDisplay1"> </div></div>
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
           $('#dynamic_field').append('<tr id="row'+i+'"><td><input type="text" name="name[]" id="search_'+i+'" placeholder="Enter your Name" class="form-control name_list" onkeyup="ajaxSearch(this);" /><div id="display'+i+'""><div id="autoDisplay"'+i+'"></div></div></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');
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


var req = null;
function ajaxSearch(passvalue)
{
    var id = passvalue.id;
    var splitid = id.split('_');
    var index = splitid[1];

    console.log('test id = ' + index);
     console.log('#display' + index);
      console.log('#autoDisplay' + index);
      console.log('#search_' + index);
    if (req != null) req.abort();
      var input_data = $('#search_'+index).val();
    //var input_data = $('[id^=search]').val();
    //var input_data = $('#search2').val();\
    //  var id = this.id;
    //num = '';
      console.log(input_data);
    if (input_data.length === 0)
    {
        $('#display'+index).hide();
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
            context : this,
            cache: false,
            success: function (data) {
                // return success
                if (data.length > 0) {
                    $('#display'+index).show();
                    $('#autoDisplay'+index).addClass('auto_list');
                    $('#autoDisplay'+index).html(data);
                }
            }
         });
         return false;
     }
 }

 //To select country name
function selectUser(val) {
$("#search").val(val);
$("#display").hide();
$("#autoDisplay").hide();
}
</script>
