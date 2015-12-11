<?php
namespace Core\HTML;

/**
 * Class DafstyleForm
 * @package DAVAFRICA
*/

class DafstyleForm extends Form{

    protected function surround($html){
        return "<div class=\"form-group\">{$html}</div>";
    }


    public function input($name, $label, $option = []){
        $type = isset($option['type']) ? $option['type'] : 'text';
        $label = '<label>'. $label .'</label>';
        if($type === 'textarea'){
            $input = '<textarea name="' . $name . '" class="daf-form-ctrl" placeholder="' . ucfirst($name) . '">'. $this->getValue($name) .'</textarea>';
        }elseif($type === 'file'){
            $input = '<input type="' . $type . '" name="' . $name . '" class="daf-form-ctrl">';
        }else{
            $input = '<input type="' . $type . '" name="' . $name . '" value="' . $this->getValue($name) . '" placeholder="' . ucfirst($name) . '" class="daf-form-ctrl">';
        }

        return $this->surround($label . $input);
    }


    public function select($name, $label, $options){
        $label = '<label>'. $label .'</label>';
        $input = '<select class="daf-form-ctrl" name="'. $name .'">';
        foreach ($options as $k => $v){
            $attributes = '';
            if($k == $this->getValue($name)){
                $attributes = ' selected';
            }
            $input .= "<option value='$k'$attributes>$v</option>";
        }
        $input .= '</select>';

        return $this->surround($label . $input);
    }


    public function submit(){
        return $this->surround('<button type="submit" class="btn btn-primary">Envoyer</button>');
    }

}
?>
