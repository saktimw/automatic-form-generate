<?php

class Bsform {

    // set url form
    private function setUrl ($url = NULL)
    {
        if (!empty($url))
        {
            return $url;
        }
        else
        {
            return '';
        }
    }

    private function setButton ($btn = NULL)
    {
        if (!empty($btn))
        {
            $btnParse = explode(',', $btn);
            $btn = '<button type="submit" name="'.$btnParse[1].'" class="btn btn-sm btn-'.$btnParse[2].'">'; 
            $btn .= $btnParse[0];
            $btn .= '</button>';

            return $btn;
        }
        else
        {
            $btn = '<button type="submit" name="submit" class="btn btn-sm btn-default">'; 
            $btn .= 'SUBMIT';
            $btn .= '</button>';

            return $btn;
        }
    }

    private function parseAttribut($data = NULL)
    {
        $attr = array(
            'required' => 'required',
            'readonly' => 'readonly',
            'autocomplete-off' => 'autocomplete = "off"'
        );
        
        $lab = array(
            'required' => ' <span class="text-danger">*</span>',
            'readonly' => '',
            'autocomplete-off' => ''
        );

        if (!empty($data))
        {
            $attribut['attr'] = NULL;
            $attribut['lbl'] = NULL;

            foreach ($data as $a)
            {
                $attribut['attr'] .= ' '.$attr[$a];
                $attribut['lbl'] .= ' '.$lab[$a];
            }

            return $attribut;
        }
        else
        {
            $attribut['attr'] = '';
            $attribut['lbl'] = '';

            return $attribut;
        }
    }

    private function parseNameId($ni = NULL)
    {
        if (!empty($ni))
        {
            $data = ' name="n_'.$ni.'" id="i_'.$ni.'" ';
            
            return $data;
        }
        else
        {
            $data = ' name="" id="" ';
             
            return $data ;
        }
    }

    private function parseLabel($lab = NULL, $atr = NULL, $ni = NULL)
    {
        if (!empty($lab))
        {
            $label['open'] = ' <label for="'.$ni.'">'.$lab;
            $label['close'] = $atr['lbl']; 
            $label['close'] .= ' </label> '; 
            
            return $label;
        }
        else
        {
            $label['open'] = ''; 
            $label['close'] = '';
             
            return $label ;
        }
    }

    public function parseForm($type = NULL, $ni = NULL, $data = NULL, $value = NULL)
    {
        switch ($type)
        {
            case 'text' :
                $form['open'] = '<input type="text" class="form-control" '.$ni;
                $form['close'] = ' >';
            break;

            case 'text' :
                $form['open'] = '<input type="hidden" '.$ni;
                $form['close'] = ' >';
            break;
            
            case 'number' :
                $form['open'] = '<input type="number" class="form-control" '.$ni;
                $form['close'] = ' >';
            break;

            case 'date' :
                $form['open'] = '<input type="date" class="form-control"'.$ni;
                $form['close'] = ' >';
            break;

            case 'password' :
                $form['open'] = '<input type="password" class="form-control" '.$ni;
                $form['close'] = ' >';
            break;

            case 'email' :
                $form['open'] = '<input type="email" class="form-control"'.$ni;
                $form['close'] = ' >';
            break;

            case 'textarea' :
                $form['open'] = '<textarea class="form-control" '.$ni;
                $form['close'] = ' >'.$value.'</textarea>';
            break;

            case 'dropdown' :
                $form['open'] = '<select class="form-control" '.$ni;
                $form['close'] = '>';
                
                if ($data != NULL)
                {
                    foreach ($data as $key => $val)
                    {
                        $slc = $key == $value ? 'selected' : NULL;
                        $form['close'] .= '<option value="">-- Pilih --</option>';
                        $form['close'] .= '<option value="'.$key.'"'.$slc.'>'.$val.'</option>';
                    }
                }
                else
                {
                    $form['close'] .= '<option value="">-- Pilih --</option>';
                }

                $form['close'] .= '</select>';
            break;
        }

        return $form;
    }

    private function parseValue($type = NULL, $value = NULL)
    {
        if (!empty($type))
        {
            switch ($type) {
                case 'text':
                    $val = ' value="'.$value.'" ';   
                break;

                case 'hidden':
                    $val = ' value="'.$value.'" ';   
                break;
                
                case 'number' :
                    $val = ' value="'.$value.'" ';
                break;
    
                case 'date' :
                    $val = ' value="'.$value.'" ';
                break;
    
                case 'password' :
                    $val = ' value="'.$value.'" ';
                break;
    
                case 'email' :
                    $val = ' value="'.$value.'" ';
                break;

                case 'textarea' :
                    $val = NULL;
                break;
                
                case 'dropdown' :
                    $val = NULL;
                break;

            }
            
            return $val;
        }
        else
        {
            return $val = NULL;
        }
    }

    private function makeTemplate($data = NULL)
    {
        if (!empty($data))
        {
            $input = [];
            foreach ($data as $dt)
            {
                // attribut
                $data = isset($dt['data']) ? $dt['data'] : NULL;
                $lbl = isset($dt['label']) ? $dt['label'] : NULL;
                $nmid = isset($dt['nameid']) ? $dt['nameid'] : NULL;
                $type = isset($dt['type']) ? $dt['type'] : NULL;
                $vl = isset($dt['value']) ? $dt['value'] : NULL;
                $att = isset($dt['attribut']) ? $dt['attribut'] : NULL;

                $attr = $this->parseAttribut($att);
                $ni = $this->parseNameId($nmid);
                $label = $this->parseLabel($lbl, $attr, $nmid);
                $form = $this->parseForm($type, $ni, $data, $vl);
                $value = $this->parseValue($type, $vl);

                $grp = '<div class="form-group">';
                $grp .= $label['open'];
                $grp .= $label['close'];
                $grp .= $form['open'];
                $grp .= $value;
                $grp .= $attr['attr'];
                $grp .= $form['close'];
                $grp .= '</div>';

                $input[] .= $grp;
            }

            return $input;
        }
    }

    public function display($data = NULL)
    {
        if (is_array($data))
        {
            $u = isset($data['url']) ? $this->setUrl($data['url']) : base_url();
            $i = isset($data['input']) ? $this->makeTemplate($data['input']) : NULL;
            $b = isset($data['button']) ? $this->setButton($data['button']) : $this->setButton();
            
            $form = '<form method="POST" action="'.$u.'">';
            
            foreach ($i as $out)
            {
                $form .= $out;
            }
            $form .= $b;
            $form .= '</form>';
            
            return $form;
        }
    }

}

?>