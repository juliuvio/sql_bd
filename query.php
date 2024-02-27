<?php
   require_once('config.php');
if (($_POST['rad']) && ($_POST['do']))
{
           $query=get_post('query'.$_POST['rad']);
           $par=get_post('par'.$_POST['rad']);
		   $val=get_post('val'.$_POST['rad']);
           if ($val && $_POST['rad']!=8) // если в запросе есть поле для ввода/выбора данных и не выбран запрос 8 (тк ниже для него другое дополнение)
           {
			  if($_POST['rad']==9) $query=$query.$par."'%".$val."%'"; //особый случай для запроса 10
			  elseif($_POST['rad']==10) $query=$query.$par."'%".$val."%')";
			  else $query=$query.$par."'".$val."'"; 
			  // if($_POST['rad']==9) $query=$query.$par."'%".$val."%'"; //особый случай для запроса 10
			  // elseif($_POST['rad']==10) $query=$query."'%".$val."%'".$par;	
			  // else $query=$query."'".$val."'".$par."'";			 
           }
		   if($_POST['rad']==1) $query=$query." where salary > 74000 and salary < 86000 "; //дополнение для запроса номер 1
		   if($_POST['rad']==3) $query=$query."	where round( datediff( now( ) , bdate ) /365 ) > 50 and  round( datediff( now( ) , bdate ) /365 ) < 70 "; //дополнение для запроса номер 3
		   if($_POST['rad']==4) $query=$query."	where visitdate = '2023-01-28' and visittime < '12:00:00' "; //дополнение для запроса номер 4
		   if($_POST['rad']==5) $query=$query." where (bdate > '1950.01.01' and bdate < '1990.01.01') and medication = 'направление на КТ,МРТ'"; //дополнение для запроса номер 5
		   if($_POST['rad']==6) $query=$query." where medcertificate = 'да' and medication = 'на повторный прием'"; //дополнение для запроса номер 6
		   if($_POST['rad']==7) $query=$query." where visitdate between cast( '2023-01-27' as date ) and cast( '2023-01-29' as date )"; //дополнение для запроса номер 7
		   if($_POST['rad']==8) $query=$query."((YEAR('".$val."-01-01') - YEAR(bdate))) as age from doctor"; //дополнение для запроса номер 8
		   
		   //выполнение запросов
	       $res=mysql_query($query);
           $n=mysql_num_rows($res);
           $m=mysql_num_fields($res);
           $m1=(100/$m/1.5)+60; 
		    echo "<table border='2' align='center' width='".$m1."%'>";
            echo "<tr><td colspan='".$m."'><b><i>".$query."</i></b></td></tr>";
			if ($n<>0) 
		   {
           for($i=0; $i<$n; $i++)
            {
             $row=mysql_fetch_row($res);
             echo "<tr>";
             for ($j=0; $j<$m; $j++)
               echo "<td>".$row[$j]."</td>";
             echo "</tr>";
             }
			 echo "<tr><td colspan='".$m."'>запрос вернул ".$n." запись(и,ей)</td></tr>";
		    }
		    else echo "<tr><td colspan='".$m."'>запрос вернул 0 записей</td></tr>";
			echo "</table>";
}

        echo "<form method='post' action='".$_SERVER['PHP_SELF']."'>";
        echo "<br><br>";
        echo "<table border=0 width=50% align=center>";
              echo "<h3 align='center' >Запросы</h3>";
              echo "<tr>";
              echo "<td width=10% align=right><input type=radio name='rad' value='1'>";
              echo "<td width=80%>1. Вывести врачей, у которых зарплата не менее 74000 и не более 86000 т.р. </td>";
              echo "<input type=hidden name='query1'  value=' select doctorfio, salary from doctor '>";
              echo "</tr>";

              echo "<tr>";
              echo "<td width=10% align=right><input type=radio name='rad' value='2'>";
              echo "<td width=80%>2. Вывести приемы, которые проводит врач: </td>";
			  $result1=MYSQL_QUERY("select DISTINCT doctorfio from doctor "); 
			  // формирование выпадающего списка 
			  echo "<td><select name=val2>";    
			  while ($row1 = mysql_fetch_array($result1)) 
			   { echo '<option value='.'"'.addslashes($row1['doctorfio']).'">'.$row1["doctorfio"].'</option>'; }
			  echo "</select></td>";
			  echo "<input type=hidden name='query2'  value='select doctorfio,patientfio,visitdate,visittime from visit v join patient p on v.idP = p.idP join doctor d on v.idD = d.idD'>"; 
			  echo "<input type=hidden name='par2'  value=' where doctorfio=  '>";
              echo "</tr>";

              echo "<tr>";
              echo "<td width=10% align=right><input type=radio name='rad' value='3'>";
              echo "<td width=80%>3. Вывести данные всех пациентов, которые старше 50 и младше 70  </td>";
              echo "<input type=hidden name='query3'  value=' select patientfio,bdate,medcard, round( datediff( now( ) , bdate ) /365 ) as year from patient '>";
              echo "</tr>";
			  
			  echo "<tr>";
              echo "<td width=10% align=right><input type=radio name='rad' value='4'>";
              echo "<td width=80%>4. Вывести пациентов, у которых прием врача 2023-01-28 в первой половине дня </td>";
			  echo "<input type=hidden name='query4'  value='select patientfio, visitdate, visittime from visit v join patient p on v.idP = p.idP  '>";
              echo "</tr>";
			 
			  echo "<tr>";
              echo "<td width=10% align=right><input type=radio name='rad' value='5'>";
              echo "<td width=80%>5. Вывести данные о пациентах, которые родились не ранее 1950 года и не позднее 1990 года и в мед.заключении в качестве заключения назначено направление на КТ и МРТ </td>";
			  echo "<input type=hidden name='query5'  value='select patientfio, bdate, medpolis, medcard, medication from visit v join patient p on v.idP = p.idP join medreport m on v.idV = m.idV  '>";
              echo "</tr>";
              
			  echo "<tr>";
              echo "<td width=10% align=right><input type=radio name='rad' value='6'>";
              echo "<td width=80%>6. Вывести пациентов, которым нужна справка и которын направлены на повторный осмотр </td>";			  
			  echo "<input type=hidden name='query6'  value='select patientfio, medcertificate, medication from visit v join patient p on v.idP = p.idP join medreport m on v.idV = m.idV'>";
              echo "</tr>";
			  
			  echo "<tr>";
              echo "<td width=10% align=right><input type=radio name='rad' value='7'>";
              echo "<td width=80%>7. Вывести список приемов, которые в диапазоне 2023-01-27 до 2023-01-29</td>";
			  echo "<input type=hidden name='query7'  value='select doctorfio,patientfio,visitdate,visittime from visit v join patient p on v.idP = p.idP join doctor d on v.idD = d.idD '>";
              echo "</tr>";
			  
			  echo "<tr>";
              echo "<td width=10% align=right><input type=radio name='rad' value='8'>";
              echo "<td width=80%>8. Вывести информацию о том, сколько лет исполняется каждому врачу в </td>";
			  echo "<td width=10%><input type=text name='val8' size='5' value=''>году</td>";  		  
              echo "<input type=hidden name='query8'  value='select doctorfio,bdate,'>";
              echo "</tr>";
			  
			  echo "<tr>";
              echo "<td width=10% align=right><input type=radio name='rad' value='9'>";
			  echo "<td width=80%>9. Вывести данные о всех пациентах в зависимости от необходимости справки </td>";
			  echo "<td width=10%>да<input type=radio name='val9' value='да'></td>";
			  echo "<td width=10%>нет<input type=radio name='val9' value='нет'></td>";   
              echo "<input type=hidden name='query9'  value='select patientfio, bdate, medpolis, medcertificate, medication from  patient p join visit v on p.idP = v.idP join medreport m on v.idV = m.idV '>";
              echo "<input type=hidden name='par9'  value=' WHERE medcertificate LIKE '>";
			  
			  echo "<tr>";
              echo "<td width=10% align=right><input type=radio name='rad' value='10'>";
              echo "<td width=80%>10. Вывести данные о по специальности врачах , зарплата которых выше средней зарплаты врачей</td>";
			  $result2=MYSQL_QUERY("select namespec from specialization ");
			   echo "<td><select name=val10>";    
			  while ($row2 = mysql_fetch_array($result2)) 
			   { echo '<option value='.'"'.addslashes($row2['namespec']).'">'.$row2["namespec"].'</option>'; }
			  echo "</select></td>";
			  echo "<input type=hidden name='query10' value='select doctorfio,salary from doctor '>";
			  echo "<input type=hidden name='par10' value='where salary > (select AVG(salary) from doctor d join specialization s on d.idS= s.idS where namespec like ' >";
			  //echo "<input type=hidden name='par10' value=' group by namespec,doctorfio,salary having salary > (select AVG(salary) from doctor where namespec LIKE ' >";	
			 // echo "<input type=hidden name='query10'  value='select doctorfio,salary, namespec from doctor d join specialization s on d.idS= s.idS where namespec  not like '>"; 
			 // echo "<input type=hidden name='par10'  value=' group by namespec,doctorfio,salary having salary > (select AVG(salary) from doctor where namespec LIKE   ) ' >";
              echo "</tr>";
              echo "<tr>";
			  
              echo "<td colspan=3 align='center'><input type=submit name='do' value='Отправить запрос'>";
              echo "</tr>";
        echo "</table>";


   echo "</form>";

         MYSQL_CLOSE(); 
function get_post($var)
{
return mysql_real_escape_string($_POST[$var]);
}
?> 

<a href='app.php' target='_self'> НАЗАД</a>
