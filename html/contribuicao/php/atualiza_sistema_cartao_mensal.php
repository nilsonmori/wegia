<?php

    include("conexao.php");

    $SISTEMA = $_POST['id_sistema'];

    $QUERY_M = mysqli_query($conexao, "SELECT id, valor, link FROM doacao_cartao_mensal WHERE id_sistema = $SISTEMA");
    $QTD = mysqli_num_rows($QUERY_M);
    echo ("<input type='hidden' name='cod_cartao' value=".$SISTEMA.">");

    if($QTD > 0)
    {
        echo("<table class='table table-bordered mb-none'>
                <tr>
                <th>VALOR</th>
                <th>LINK</th>
                </tr>");
            for($i = 0; $i < $QTD; $i++)
            {
                $RESULTADO = mysqli_fetch_row($QUERY_M);
                $id = $RESULTADO[0];
                $valor = $RESULTADO[1];
                $url = $RESULTADO[2];
                $soma1 = $i + 1;
                echo"<tr>";
                echo("<td><input type='number' class='form-control' readonly='true' name='valor[".$id."]' value=".$valor."></td>");
                echo("<td><input type='text' class='form-control' readonly='true' name='link[".$id."]' value=".$url."></td>");
                echo"</tr>";   
            }
                
        echo"</table>";
        
    } 
    else{
        echo"ERR";
    }
   
?>