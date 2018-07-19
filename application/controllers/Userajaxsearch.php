<?php
  public function autocomplete()
  {
       // load model
       $this->load->model('User_Model');

       $name = $this->input->post('search');

       $result = $this->User_Model->get_user_name($name);

       if (!empty($result))
       {
            foreach ($result as $row):
                 echo "<li><a href='#'>" . $row->nama . "</a></li>";
            endforeach;
       }
       else
       {
             echo "<li> <em> Not found ... </em> </li>";
       }
 }
}
?>
