<?php
   require_once('config.php');

    if ($_POST['sav'])                            //сохранение изменений
{
           $ID=$_POST['ID'];
		   $vdate=get_post('datevisit');
		   $dvtime=get_post('timevis');
		   $doc=get_post('doc');
		   $pat=get_post('pat');
		   
           $q1="update visit set visitdate='".$vdate."', visittime='".$dvtime."', idD='".$doc."', idP='".$pat."' where idV='".$ID."'";
           mysql_query($q1);
		   echo $q1;
}

  if (($_POST['add']) && ($_POST['datevisit']!='')&& ($_POST['timevis']!='')&& ($_POST['doc']!='')&& ($_POST['pat']!=''))   //добавление новой информации
{
		   $vdate=get_post('datevisit');
		   $dvtime=get_post('timevis');
		   $doc=get_post('doc');
		   $pat=get_post('pat');
		   
           $q="insert into visit(visitdate,visittime,idD,idP) values('".$vdate."','".$dvtime."','".$doc."','".$pat."')";
		   echo $q;
		   
           mysql_query($q);
} 

   if (($_POST['rad']) && ($_POST['del']))        //удаление выбранной информации
          {
           $q="delete from visit where idV='".$_POST['rad']."'";
							echo $q;
           mysql_query($q);
          }
												// основной блок - вывод данных	
        $query = " select * from visit v join doctor d on d.idD = v.idD join specialization s on v.idD = s.idS join patient p on v.idP = p.idP order by doctorfio ";
        $result=mysql_query($query)or die ("Ошибка при выполнении запроса: " .mysql_error ()); 
         echo "<h2 align=center> Посещения </h2>";

         echo "<form method='post' action='".$_SERVER['PHP_SELF']."'>";
         echo "<br><br>";
         echo "<table border=2 width=80% align=center>";
         echo "<tr>
			  <th width=5%></th>
		      <th width=15%> ФИО врача (FK)</th>
			  <th width=20%> Специализация (FK)</th>
			  <th width=20%>Дата посещения</th>
			  <th width=20%>Время посещения</th>
			  <th width=30%>ФИО пациента (FK)</th>
			  <th width=30%>Мед.полис (FK)</th>
			  </tr>";
         while ($row = mysql_fetch_array ($result)) 
            { 
              echo "<tr>";
              echo "<td align=right><input type=radio name='rad' value='".$row['idV']."'>";
              echo "<td>"; echo $row ["doctorfio"]; echo "</td>";   
              echo "<td>"; echo $row ["namespec"]; echo "</td>";
			  echo "<td>"; echo $row ["visitdate"]; echo "</td>";
			  echo "<td>"; echo $row ["visittime"]; echo "</td>";
			  echo "<td>"; echo $row ["patientfio"]; echo "</td>";
			  echo "<td>"; echo $row ["medpolis"]; echo "</td>";
			  echo "</tr>";
            }
         echo "</table>";
		 
        $result1=MYSQL_QUERY("select * from doctor ") or die ("Ошибка при выполнении запроса: " .mysql_error ()); 
		$result2=MYSQL_QUERY("select * from patient ") or die ("Ошибка при выполнении запроса: " .mysql_error ());
		
         echo "<table border=0 width=10% align=center>";
         echo "<tr></tr><tr>";
			echo "<td><pre>выберите врача:";
		 
			echo "<select name=doc>";    // формирование выпадающего списка врачей
         while ($row1 = mysql_fetch_array($result1)) 
          { 
	        echo '<option value='.'"'.$row1["idD"].'"'.' >'.$row1["doctorfio"].' </option>'; 
		  }
         echo "</select></pre></td>";
		 
		 echo "<td><pre>дата приема<input type=text name=datevisit value='' size=15></pre></td>";
		 echo "<td><pre>время приема <input type=text name=timevis value='' size=15></pre></td>";
		 echo "<td><pre>выберите пациента:";
		 echo "<select name=pat>";    // формирование выпадающего списка пациентов
         while ($row2 = mysql_fetch_array($result2)) 
          { 
	        echo '<option value='.'"'.$row2["idP"].'"'.' >'.$row2["patientfio"].' | '.$row2["medpolis"].'</option>'; 
		  }
         echo "</select></pre></td>";
		 
         echo "<td><input type=submit name=add value='Добавить'></td></tr><tr></tr>";
         echo "<tr><td colspan=3 align=left><input type=submit name=del value='Удалить'>  данную запись</td></tr>";
		 echo "<tr><td colspan=3 align=left><input type=submit name=upd value='Изменить'> данную запись</td></tr>";		 
         echo "</tr></table>";


    if (($_POST['rad']) && ($_POST['upd']))			//изменение выбранной информации
        {
             echo "<table border=0 width=28% align=center>";
				echo "<tr><td colspan=3><b>Введите новые данные</b></td></tr>";				 
           $q="select * from visit where idV='".$_POST['rad']."'";
		   echo $q;
           $res=mysql_query($q); $row = mysql_fetch_array ($res);
           $result1=MYSQL_QUERY("select * from doctor ");
				$result2=MYSQL_QUERY("select * from patient ");
             echo "<tr><td>дата приема <input type=text name=datevisit value='".$row['visitdate']."' size=12></td>";
		
			 echo "<td>ФИО врача <select name=doctor>";
             while ($row1 = mysql_fetch_array($result1)) 
             { if ($row1['idD']==$row['idD']) 
			   {
			       echo '<option value='.'"'.$row1['idD'].'" selected>'.$row1["doctorfio"].' | '.$row1["namespec"].'</option>';
			   }			 
               else echo '<option value='.'"'.$row1['idD'].'"'.' >'.$row1["doctorfio"].' | '.$row1["namespec"].'</option>';}
             echo "</select></td>";
			 
			 echo "<tr><td>время посещения <input type=text name=timevis value='".$row['visittime']."' size=12></td>";
			 
	         echo "<td>ФИО пациента <select name=pat>";
             while ($row2 = mysql_fetch_array($result2)) 
             { if ($row2['idP']==$row['idP']) 
			   {
			       echo '<option value='.'"'.$row2['idP'].'" selected>'.$row2["patientfio"].' | '.$row2["medpolis"].'</option>';
			   }			 
               else echo '<option value='.'"'.$row2['idP'].'"'.' >'.$row2["patientfio"].' | '.$row2["medpolis"].'</option>';}
             echo "</select></td>";
			 
           echo "<td><input type=submit name=sav value='Сохранить'>";
           echo "<input type=hidden name=ID value='".$row['idV']."'></td></tr>";
        } 

echo "</table>";


echo "</form>";

         MYSQL_CLOSE(); 
function get_post($var)
{
return mysql_real_escape_string($_POST[$var]);
}
?> 
<pre>            




          Для добавления нового посещения:          	<i>Ввести название и <b>Добавить</b></i>
          Для удаления существующего посещения:		<i>Выбрать соответствующую строку и </i><b>Удалить</b>
          Для изменения данных посещения:         <i> Выбрать соответствующую строку и </i><b>Изменить</b>
</pre>

<a href='query.php' target='_self'> ЗАПРОСЫ</a>
		 