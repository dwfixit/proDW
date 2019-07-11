<?php
    function gerarCodigoUnico() {
        $alfabeto   = "23456789ABCDEFJGHJKMNPQRS";
        $tamanho    = 15;
        $letra      = "";
        $resultado  = "";

        for ($i = 1; $i < $tamanho ; $i++ ) {
            $letra      = substr( $alfabeto, rand(0,23), 1); 
            $resultado  .= $letra;
        }

        date_default_timezone_set('America/Sao_Paulo');
        $agora = getdate();

        $codigo_data = $agora['year'] . "_" . $agora['yday'];
        $codigo_data .= $agora['hours'] . $agora['minutes'] . $agora['seconds'];
        return "foto_" . $codigo_data . "_" . $resultado;
    }

    function getExtensao($nome) {
        return strrchr($nome,".");
    }

    function publicarImagem($imagem) {
        $arquivo_temporario = $imagem['tmp_name'];
        $nome_original      = $imagem['name'];
        $nome_novo          = gerarCodigoUnico() . getExtensao($nome_original);
        $nome_completo      = "fotos_perfil/" . $nome_novo;
        
        if(move_uploaded_file($arquivo_temporario, $nome_completo)) {
            return array("Imagem publicada com sucesso",$nome_completo);   
        } else {
            return array(retornarErro($imagem['error']), "");            
        }        
    }

    function retornarErro($numero_erro) {
        $array_erro = array(
            UPLOAD_ERR_OK =>            "Sem erro.",
            UPLOAD_ERR_INI_SIZE =>      "O arquivo enviado excede o limite definido na diretiva upload_max_filesize do php.ini.",
            UPLOAD_ERR_FORM_SIZE =>     "O arquivo excede o limite máximo de 600Kb.",
            UPLOAD_ERR_PARTIAL =>       "O upload do arquivo foi feito parcialmente.",
            UPLOAD_ERR_NO_FILE =>       "Nenhum arquivo foi enviado.",
            UPLOAD_ERR_NO_TMP_DIR =>    "Pasta temporária ausente.",
            UPLOAD_ERR_CANT_WRITE =>    "Falha em escrever o arquivo em disco.",
            UPLOAD_ERR_EXTENSION =>     "Uma extensão do PHP interrompeu o upload do arquivo."
        ); 
        
        return $array_erro[$numero_erro];
    }

    function validaCPF($cpf = null) {

        // Verifica se um número foi informado
        if(empty($cpf)) {
            return false;
        }
    
        // Elimina possivel mascara
        $cpf = preg_replace("/[^0-9]/", "", $cpf);
        $cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);
        
        // Verifica se o numero de digitos informados é igual a 11 
        if (strlen($cpf) != 11) {
            return false;
        }
        // Verifica se nenhuma das sequências invalidas abaixo 
        // foi digitada. Caso afirmativo, retorna falso
        else if ($cpf == '00000000000' || 
            $cpf == '11111111111' || 
            $cpf == '22222222222' || 
            $cpf == '33333333333' || 
            $cpf == '44444444444' || 
            $cpf == '55555555555' || 
            $cpf == '66666666666' || 
            $cpf == '77777777777' || 
            $cpf == '88888888888' || 
            $cpf == '99999999999') {
            return false;
         // Calcula os digitos verificadores para verificar se o
         // CPF é válido
         } else {   
            
            for ($t = 9; $t < 11; $t++) {
                
                for ($d = 0, $c = 0; $c < $t; $c++) {
                    $d += $cpf{$c} * (($t + 1) - $c);
                }
                $d = ((10 * $d) % 11) % 10;
                if ($cpf{$c} != $d) {
                    return false;
                }
            }
    
            return true;
        }
    }
?>
