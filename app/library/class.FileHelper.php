<?php
/**
 * Created on 06/Jan/2010
 *
 * Classe com métodos encadeados para criar
 * ou ler arquivos.
 *
 * @author Gustavo Paes (http://gustavopaes.net/)
 * @version 1.0124.01
 **/
class FileHelper {

    /**
     * @access private
     **/
    private $path      = null;
    private $file_name = null;
    private $content   = "";

    /**
     * @access public
     **/
    public $error = "";

    /**
     * @access public
     * @description Reinicaliza todas as variáveis
     * @return Object Class
     */
    function clear()
    {
        $this->path      = null;
        $this->file_name = null;
        $this->content   = "";
        $this->error     = "";

        return $this;
    }

    /**
     * @access public
     * @description Define o Path do arquivo
     * @param String $path Path completo do arquivo
     * @return Object Class
     **/
    function path($path = ".")
    {
        $this->path = $path;
        return $this;
    }

    /**
     * @access public
     * @description Define o nome do arquivo
     * @param String $file_name Nome do arquivo
     * @return Object Class
     **/
    function file($file_name = null)
    {
        $this->file_name = $file_name;
        return $this;
    }

    /**
     * @access public
     * @description Define o conteúdo do arquivo
     * @param String $content Conteúdo do arquivo
     * @return Object Class
     **/
    function content($content = "")
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @access public
     * @descriptin Concatena conteudo ao arquivo
     * @param String $content Conteudo
     * @return Object Class
     **/
    function append($content = "")
    {
        $this->content .= $this->read() . $content;
        return $this;
    }

    /**
     * @access public
     * @description Remove o arquivo
     * @return Bool
     **/
    function delete()
    {
        if( !$this->file_name || !$this->path )
        {
            return false;
        }
        
        try
        {
            @unlink("{$this->path}/{$this->file_name}");
            return true;
        }
        catch(Exception $err)
        {
            $this->error = $err->getMessage();
            return false;
        }
    }

    /**
     * @access public
     * @description Cria o arquivo com o conteúdo passado
     * @return Bool
     **/
    function save()
    {
        // Verifica se o nome e path do arquivo foram informados
        if( !$this->file_name || !$this->path )
        {
            return false;
        }

        // Tenta criar o arquivo
        try
        {
            // Abre para escrita (se não existir, cria o arquivo)
            $file = @fopen("{$this->path}/{$this->file_name}", "w+");
            
            // Exceção ao abrir arquivo
            if(!$file)
            {
                throw new Exception('permission denied');
            }

            // Tenta escrever o conteúdo no arquivo
            if( !@fwrite($file, $this->content) )
            {
                throw new Exception('error');
                @fclose($file);
            }

            @fclose($file);

        }
        catch(Exception $err)
        {
            $this->error = $err->getMessage();
            return false;
        }
        return true;
    }

    /**
     * @access public
     * @description Retorna todo o conteúdo de um arquivo
     * @return String
     **/
    function read()
    {
        if( !$this->file_name || !$this->path )
        {
            return false;
        }

        // Verifica se o arquivo existe
        if( file_exists($this->path . "/" . $this->file_name) )
            return @file_get_contents($this->path . "/" . $this->file_name);
        else
            return "";
    }

} // class

?>