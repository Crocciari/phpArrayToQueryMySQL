<?php

// define o vetor com dados da tabela

// tabela detalhes
$struct[] = array(
  "table" => "produtos",
  "struct" => array(
                        array("field" => "idproduto", "type" => "varchar(25)", "details" => "NOT NULL DEFAULT ''"),
                        array("field" => "descricao", "type" => "varchar(250)", "details" => "DEFAULT ''"),
                        array("field" => "observacao", "type" => "text", "details" => ""),
                        array("field" => "detalhe", "type" => "text", "details" => ""),
                        array("field" => "peso", "type" => "decimal(15,5)", "details" => "DEFAULT '0.00000'"),
                        array("field" => "altura", "type" => "decimal(15,5)", "details" => "DEFAULT '0.00000'"),
                        array("field" => "largura", "type" => "decimal(15,5)", "details" => "DEFAULT '0.00000'"),
                        array("field" => "comprimento", "type" => "decimal(15,5)", "details" => "DEFAULT '0.00000'"),
                        array("field" => "qtde_multiplo", "type" => "float", "details" => "NOT NULL DEFAULT '0'"),
                        array("field" => "destaque", "type" => "enum('S','N')", "details" => "DEFAULT 'N' COMMENT 'Destaque'"),
                        array("field" => "promocao", "type" => "enum('S','N')", "details" => "DEFAULT 'N' COMMENT 'Promoção'"),
                        array("field" => "novidade", "type" => "enum('S','N')", "details" => "DEFAULT 'N' COMMENT 'Novidade'"),
                        array("field" => "vitrine", "type" => "enum('S','N')", "details" => "DEFAULT 'S' COMMENT 'Mostrar na vitrine'"),
                        array("field" => "tipo", "type" => "char(1)", "details" => "NOT NULL DEFAULT 'P'"),
                        array("field" => "lastupdate", "type" => "timestamp", "details" => "NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Última alteração'")
                      ),
  "details" => "ENGINE=InnoDB DEFAULT CHARSET=utf8"
);

// tabela grupos
$struct[] = array(
  "table" => "grupos",
  "struct" => array(
                        array("field" => "idgrupo", "type" => "varchar(25)", "details" => "NOT NULL DEFAULT ''"),
                        array("field" => "descricao", "type" => "varchar(250)", "details" => "DEFAULT ''"),
                        array("field" => "ativo", "type" => "enum('S','N')", "details" => "DEFAULT 'S'"),
                        array("field" => "lastupdate", "type" => "timestamp", "details" => "NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Última alteração'")
                      ),
  "details" => "ENGINE=InnoDB DEFAULT CHARSET=utf8"
);



// percorre o vetor das tabelas
foreach ($struct as $key => $value) {

  // chama a funcao de montagem da query envio o campo atual do vetor
  $query = geraQuery($value);
  echo $query;
  echo "<hr>";

}





// Script que cria uma query baseada no phparray definido
function geraQuery($struct) {

    // inicia a query com os dados de criacao da tabela
    $query = "CREATE TABLE `{$struct['table']}` (";

    // percorre o vetor struct
    foreach ($struct["struct"] as $key => $value) {

      // coloca na query a linha do campo a ser criado
      $query .= "`{$value['field']}` {$value['type']} {$value['details']},";

    }

    // retira a ultima virguja, pois ja terminou os campos
    $query = substr($query,0,-1);

    // acrescenta os detalhes finais do script
    $query .= " ) {$struct['details']};";

    // retorna a string query gerada, pronta para ser executada no mysqli
    return $query;

}
