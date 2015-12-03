<?php
namespace Core\HTML;

/**
 * Class Form
 * @package DEVAFRICAapidement et simplement
 * Permet de generer un formulaire r
*/

class Form{
    /**
     * $data
     * @var array => Données utilisées pour le formulaire
    */
    private $data;
    /**
     * $surround
     * @var string Tag => Utilisé pour entouré les champs
    */
    public $surround = 'p';


    /**
     * __construct()
     * @param array => $data Données utilisées pour le formulaire
    */
    function __construct($data = array()){
        $this->data = $data;
    }


    /**
     * surround()
     * @param $html string => Code HTML à entourer
     * @return string
    */
    private function surround($html){
        return "<{$this->surround}>{$html}</{$this->surround}>";
    }


    /**
     * getValue()
     * @param $index string => Index de la valeur à récuperer
     * @return string
    */
    protected function getValue($index){
        if(is_object($this->data)){
          return $this->data->$index;
        }

        return isset($this->data[$index]) ? $this->data[$index] : null;
    }


    /**
     * input()
     * @param $name string => type de la valeur à récuperer
     * @param $label string => Label
     * @param $option array => Select
     * @return string
    */
    public function input($name, $label, $option = []){
        $type = isset($option['type']) ? $option['type'] : 'text';

        return $this->surround(
        '<input type="'. $type .'" name="'. $name .'" value="'. $this->getValue($name) .'" placeholder="Username">');
    }


    public function submit(){
        return $this->surround('<button type="submit" name="submit">Soumettre</button>');
    }

}
?>
