<?php

class EditfieldHelper extends AppHelper {

    public $helpers = array('Html');
    
    public function inputfield($name, $field, $id, $data = null, $options = array())
    {
        $inputfield = '';
        $options = array_merge(array(
            'newline' => true,
            'id' => 'inputfield-' . $field,
            'class' => 'input',
            'inner_class' => 'inputfield edit-container',
            'type' => 'text',
            'required' => false
        ), $options);
        
        $inputfield .= $this->Html->div($options['class']);
        
        if($name != null)
        {
            $inputfield .= $this->Html->tag('label', $name, array('for' => $options['id']));
            
            if($options['newline'])
                $inputfield .= '<br/>';
        }
        
        $inputfield .= $this->Html->tag('input', null, array(
            'id' => $options['id'],
            'class' => $options['inner_class'],
            'type' => $options['type'],
            'data-id' => $id,
            'data-field' => $field,
            'value' => $data,
            'required' => $options['required']
        ));
        
        $inputfield .= '</div>';
        return $inputfield;
    }

    public function editfield($field, $id, $data = null, $options = array())
    {
        $editfield = '';
        $options = array_merge(array(
            'delete' => true,
            'id' => 'editfield-' . $field,
            'class' => 'editfield edit-container'
        ), $options);
        
        if($options['delete'])
            $options['class'] .= ' delete-container';
        
        $editfield .= $this->Html->tag('div', $data, array(
            'id' => $options['id'],
            'class' => $options['class'],
            'data-id' => $id,
            'data-field' => $field
        ));
        
        return $editfield;
    }

    public function editbox($field, $id, $data = null, $options = array())
    {
        $editbox = '';
        $options = array_merge(array(
            'id' => 'editbox-' . $field,
            'class' => 'edit-container editbox',
            'inner_class' => 'edit-textbox',
            'delete_icon' => 'icons/delete.png',
            'delete_text' => 'löschen',
            'delete_class' => 'edit-delete'
        ), $options);
        
        $editbox .= $this->Html->div($options['class'], null, array(
            'data-id' => $id,
            'data-field' => $field,
        ));
        
        $editbox .= $this->Html->tag('div', $data, array(
            'class' => $options['inner_class'],
            'data-exists' => $data ? 'true' : 'false'
        ));
        
        $editbox .= $this->Html->image($options['delete_icon'], array(
            'class' => $options['delete_class'],
            'alt' => $options['delete_text']
        ));
        
        $editbox .= '<div style="clear: both;"></div>';
        $editbox .= '</div>';
        
        return $editbox;
    }

}