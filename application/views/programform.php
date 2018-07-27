<html>
<html lang="en">
     <head>
       <html lang="en">
       <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

      <title>Buat program</title>

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

   </head>

   <body onload="readonly();">
      <!-- <form action = "" method = ""> -->
         <?php //echo validation_errors(); ?>
         <?php echo form_open('create'); ?>


         <label for="formnama" class="col-sm-2 col-form-label">Nama program</label>
         <div class="col-sm-10">
          <input type = "text" id='formnama' name = "nama" class="form-control" value = "<?php echo set_value('nama'); ?>" size = "127" placholder:"Masukan nama program" />
          <?php echo form_error('nama', '<div class="error">', '</div>'); ?>
         </div>

         <label for="formdeskripsi" class="col-sm col-form-label">Deskripsi program</label>
         <div class="col-sm-10">
           <textarea type = "text" id='formdeskripsi' name = "deskripsi" class="form-control"  style="resize:vertical" placholder:"Masukan nama program" rows="3"><?php if(isset($_POST['deskripsi'])) { echo htmlentities ($_POST['deskripsi']); }?></textarea>
         <?php echo form_error('deskripsi', '<div class="error">', '</div>'); ?>
         </div>
         <label for="formtimeplan" class="col-sm col-form-label">Timeplan program</label>
         <div class="col-sm-10">
           <textarea name = "timeplan" id='formtimeplan' class="form-control" style="resize:vertical" placholder:"Masukan nama program" rows="3"><?php if(isset($_POST['timeplan'])) { echo htmlentities ($_POST['timeplan']); }?></textarea>
           <?php echo form_error('timeplan', '<div class="error">', '</div>'); ?>
         </div>
        <label for="datepicker" class="col-sm-2 col-form-label">Tanggal program</label>
        <div class="col-sm-10">
          <input type="text" name="date" id="datepicker" class="form-control" value= <?php echo date('Y-m-d H:i:s'); ?>/>
        <div>
        <label for="formnr" class="col-sm-2 col-form-label">Nilai release</label>
        <div class="col-sm-10">
          <input type="number" name="nilai_release" id='formnr' class="form-control" value = "<?php echo set_value('nilai_release'); ?>" min="0 "max="100000000000" onKeyUp="limitText(this.form.nilai_release,this.form.countdown,12);" onKeyDown="limitText(this.form.nilai_release,this.form.countdown,12);" />
          <?php echo form_error('nilai_release', '<div class="error">', '</div>'); ?>
        </div>
        <label for="dynamic_field" class="col-sm-2 col-form-label">Nama PIC</label>
        <div class="table-responsive">
                                        <table class="table" id="dynamic_field">
                                          <td>
                                                    <div class="form-row">
                                                      <div class="col-auto">
                                                        <input type="text" name="name[]" id="search_1" placeholder="Masukan nama PIC" class="form-control name_list"  value = "<?php echo set_value('name[]'); ?>" requiered><!--onkeyup="ajaxSearch(this);"-->
                                                        <div id="display1">
                                                          <div id="autoDisplay1">

                                                          </div>
                                                        </div>
                                                            <input type="radio" name="role[0]" value="1"> IPA
                                                            <input type="radio" name="role[0]" value="2"> PMO
                                                            <input type="radio" name="role[0]" value="3"> GAF
                                                            <input type="radio" name="role[0]" value="4"> DEV
                                                          </div>


                                                    <div class="col">
                                                     <input type="text" name="keterangan[]" id="keterangan_1" placeholder="Masukan keterangan" class="form-control name_list"   /><!--onkeyup="ajaxSearch(this);"-->
                                                   </div>
                                                  <div class="col-auto">
                                                  <button type="button" name="add" id="add" class="btn btn-success">Add More</button>
                                                  </div>
                                                </div>
                                                <?php echo form_error('name[]', '<div class="error">', '</div>'); ?>
                                                  <?php echo form_error('role[]', '<div class="error">', '</div>'); ?>
                                              </td>
                                              </table>
                                 <!--  <input type="button" name="submit" id="submit" class="btn btn-info" value="Submit" /> -->
                                   </div>


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
           $('#dynamic_field').append('<tr id="row'+i+'"><td><div class="form-row"><div class="col-auto"><input type="text" name="name[]" id="search_'+i+'" placeholder="Masukan nama PIC" class="form-control name_list"/><div id="display'+i+'""><div id="autoDisplay'+i+'""></div></div><input '+i--+' type="radio" name="role['+i+']" value="1"> IPA<input type="radio" name="role['+i+']" value="2"> PMO<input type="radio" name="role['+i+']" value="3"> GAF<input type="radio" name="role['+i+']" value="4"> DEV'+i+++'</div><div class="col"><input type="text" name="keterangan[]" id="keterangan_'+i+'" placeholder="Masukan keterangan" class="form-control name_list"/></div><div class="col-auto"><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></div></div></td></tr>');
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
		//limitCount.value = limitNum - limitField.value.length;
	}
}
</script>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
