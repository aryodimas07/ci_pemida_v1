<html>

   <head>
      <title>Buat program</title>

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />

   </head>

   <body onload="readonly();">
      <!-- <form action = "" method = ""> -->
         <?php echo validation_errors(); ?>
         <?php echo form_open('create'); ?>

         <p>
         <h5>Nama program</h5>
         <input type = "text" name = "nama" class="form-control" value = "<?php echo set_value('nama'); ?>" size = "127" placholder:"Masukan nama program" />

         <h5>Deskripsi program</h5>
         <textarea type = "text" name = "deskripsi" class="form-control"  style="resize:vertical" placholder:"Masukan nama program"><?php if(isset($_POST['deskripsi'])) { echo htmlentities ($_POST['deskripsi']); }?></textarea>

         <h5>Timeplan program</h5>
         <textarea name = "timeplan" class="form-control" style="resize:vertical" placholder:"Masukan nama program"><?php if(isset($_POST['timeplan'])) { echo htmlentities ($_POST['timeplan']); }?></textarea>

        <h5>Tanggal program</h5>
        <input type="text" name="date" id="datepicker" class="form-control" value= <?php echo date('Y-m-d H:i:s'); ?>/>

        <h5>Nilai release</h5>
        <input type="number" name="nilai_release" class="form-control" value = "<?php echo set_value('nilai_release'); ?>" min="0 "max="100000000000" onKeyUp="limitText(this.form.nilai_release,this.form.countdown,12);" onKeyDown="limitText(this.form.nilai_release,this.form.countdown,12);" />

        <h5>Nama PIC</h5>
        <div class="table-responsive">
                                        <table class="table table-bordered" id="dynamic_field">
                                             <tr>
                                                  <td>
                                                    <input type="text" name="name[]" id="search_1" placeholder="Masukan nama PIC" class="form-control name_list"  value = "<?php echo set_value('name[]'); ?>"/><!--onkeyup="ajaxSearch(this);"-->
                                                    <div id="display1">
                                                    <div id="autoDisplay1"> </div></div>
                                                    <input type="radio" name="role[]" value="1"> IPA
                                                    <input type="radio" name="role[]" value="2"> PMO
                                                    <input type="radio" name="role[]" value="3"> GAF
                                                    <input type="radio" name="role[]" value="4"> DEV

                                                  </td>
                                                  <td>
                                                    <input type="text" name="keterangan[]" id="keterangan_1" placeholder="Masukan keterangan" class="form-control name_list"   /><!--onkeyup="ajaxSearch(this);"-->
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
           i++; //onkeyup="ajaxSearch(this);"
           $('#dynamic_field').append('<tr id="row'+i+'"><td><input type="text" name="name[]" id="search_'+i+'" placeholder="Masukan nama PIC" class="form-control name_list"/><div id="display'+i+'""><div id="autoDisplay'+i+'""></div></div><input type="radio" name="role[]" value="1"> IPA<input type="radio" name="role[]" value="2"> PMO<input type="radio" name="role[]" value="3"> GAF<input type="radio" name="role[]" value="4"> DEV</td><td><input type="text" name="keterangan[]" id="keterangan_'+i+'" placeholder="Masukan keterangan" class="form-control name_list" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');
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

/*

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
 */
 var req = null;
 $(document).ready(function(){
   $(document).on('keyup','.name_list', function(){

    //console.log(req);

     var id = this.id;
     var splitid = id.split('_');
     var index = splitid[1];

    // console.log('test id = ' + index);
      //console.log('#display' + index);
       //console.log('#autoDisplay' + index);
       //console.log('#search_' + index);
    // if (req != null) req.abort();
       var input_data = $('#search_'+index).val();
     //var input_data = $('[id^=search]').val();
     //var input_data = $('#search2').val();\
     //  var id = this.id;
     //num = '';
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
          //   console.log(post_data);

            $.ajax({
             type: "POST",
             url: "<?php echo base_url(); ?>Program/autocomplete",
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
      // return false;
      }
    });
  });

 //To select user name
function selectUser(val) {
$("#search").val(val);
$("#display").hide();
$("#autoDisplay").hide();
}

function readonly() {
    document.getElementById('datepicker').setAttribute("readonly", true);
}
function limitText(limitField, limitCount, limitNum) {
	if (limitField.value.length > limitNum) {
		limitField.value = limitField.value.substring(0, limitNum);
	} else {
		limitCount.value = limitNum - limitField.value.length;
	}
}
</script>
