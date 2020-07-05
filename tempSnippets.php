echo "<td>.
              <select id=\"myselect1\" name=\"myselect1\">".
                     for($x=1; $x<=$row['quantity']; $x++)
                     {
                      ."<option value=\"" .$x. "\">" .$x. "</option>". 
                     }.
                   
              "</select>
        </td>";