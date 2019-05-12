<?php
class ValidaCpf{
    private $cpf;

    public function __construct()
    {
        
    }

    public function getCpf(){
        return $this->cpf;
    }
    public function setCpf($cpf){
        $resultado = ValidaCpf::validarCpf($cpf);
        if($resultado === false){
            throw new Exception("Cpf informado invalido", 1);   
        }
        $this->cpf = $cpf;
    }

    public static function validarCpf($cpf): bool{
        // verifica se há algo digitado na variavel Cpf
        if(empty($cpf)) {
            return false;
        }
        
        // verifica se foi usado algum tipo de mascará.
        $cpf = preg_match('/[0-9]/', $cpf)?$cpf:0;
    
        $cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);
         
        // verifica se há um numero verdadeiro do tamanho de cpf.
        if (strlen($cpf) != 11) {
            echo "length";
            return false;
        }
        
        // verifica se não foi usado um dos formatos invalidos abaixo.
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

}

$cpf = new ValidaCpf();
$cpf->setCpf("53265475620");

var_dump($cpf->getCpf()); 
?>