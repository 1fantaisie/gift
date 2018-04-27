 <form method="post" action="Organizator/add">
    <?php  // Adaugare nunta noua
    	  echo "Numele mirelui: ";
    	  	echo form_input('numeB');
    	  echo "<br/>Prenumele mirelui: ";
    	  	echo form_input('prenumeB');
          echo "<br/>Numele miresei: ";
    	  	echo form_input('numeF');
          echo "<br/>Prenumele miresei: ";
    	  	echo form_input('prenumeF');
    	  echo "<br/>Locatie: ";
          	echo form_input('loc');
          echo "<br/>Data: ";
          	echo form_input ('data');
          echo "<br/>".form_submit('submit','Adauga');
   echo form_close();
   
   ?>