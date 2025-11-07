<?php
class CadastroService{

    public function salvarFoto($filesArray, $index){
        if(!isset($filesArray['name'][$index])
        || $filesArray['error'][$index] 
        !== UPLOAD_ERR_OK){
            return null;// Caso não envie a foto
        }
        $uploadDir= _DIR_. "/uploads/";
        if (!is_dir ($uploadDir)){
        mkdir($uploadDir,077,true);
    }
    $nomeArquivo = uniqid() ."_". basename
    ($filesArray['name'][$index]);
    $destino = $uploadDir .$nomeArquivo;

    if(move_uploaded_file($filesArray
    ['tmp'][$index], $destino)){
        return "uploads/" . 
        $nomeArquivo;// salva a foto
    } else{
        return null;
    }

    }


}


?>