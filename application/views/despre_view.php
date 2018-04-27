  <?php if(! logged_in()){ ?>
  <form action="Home/cod" method="post"> 
 	Introduceti codul pentru a accesa nuta dorita: <?php
    echo form_input('cod');
    echo form_submit('code','Cauta');
    echo form_close(); 
}
    ?>
    
    