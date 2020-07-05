<?php
       // echo <<<myflag
       //  <b>world</b>
       // myflag

?>

<form method="post" action="test2.php">

       <table>
              <tr><td>1</td><td>rohit</td><td><input type="checkbox" name="mycheckbox[]" value="c1"></td>
              <td>
              <select id="cars1" name="1">
              <?php
                     for($x=1; $x<=4; $x++)
                     {
                      echo "<option value=\"" .$x. "\">" .$x. "</option>" ; 
                     }
              ?>       
              </select>
              </td>
              </tr>


              <tr><td>2</td><td>mohit</td><td><input type="checkbox" name="mycheckbox[]" value="c2"></td>
              <td>
              <select id="cars2" name="2">
              <?php
                     for($x=1; $x<=4; $x++)
                     {
                      echo "<option value=\"" .$x. "\">" .$x. "</option>" ; 
                     }
              ?>       
              </select>
              </td>
              </tr>

              <tr>
                     <td>
                     <input type="submit" name="submit" value="submit">
                     </td>
              </tr>
             
       </table>       

</form>



