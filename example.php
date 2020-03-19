<!-- Example CI 
    Load library pada controller  
-->
<div class="col-md-5 mt-4">
    <?php

        $form = array(
            // url pada action form
            'url' => base_url('test-proses'),
            
            // input form
            'input' => array(
                1 => array(
                    'type' => 'text', 
                    'label' => 'Nama Lengkap', 
                    'nameid' => 'nama', 
                    'value' => 'Sakti', 
                    'attribut' => ['required','readonly'], 
                ),
                2 => array(
                    'type' => 'dropdown', 
                    'label' => 'Jenis Kelamin',
                    'nameid' => 'jekel', 
                    'attribut' => ['required'],
                    'value' => 'p',

                    // tambahan untuk type dropdown 
                    'data' => array(
                        // value => Label
                        'l' => 'Laki-Laki',
                        'p' => 'Perempuan',
                   ) 
                ),
            ), 

            //membuat tampilan button 
            // 1. Label button 2.name button 3.warna button (sesuai bootstrap) 
            'button' => 'SIMPAN,simpan,success', 
        );

        $this->bsform->display($form);
    ?>
</div>

<!-- Example Native  -->
<div class="col-md-5 mt-4">
    <?php
        inlcude('Bsform.php');

        $bsform = new Bsform();

        $form = array(
            // url pada action form
            'url' => base_url('test-proses'),
            
            // input form
            'input' => array(
                1 => array(
                    'type' => 'text', 
                    'label' => 'Nama Lengkap', 
                    'nameid' => 'nama', 
                    'value' => 'Sakti', 
                    'attribut' => ['required','readonly'], 
                ),
                2 => array(
                    'type' => 'dropdown', 
                    'label' => 'Jenis Kelamin',
                    'nameid' => 'jekel', 
                    'attribut' => ['required'],
                    'value' => 'p',

                    // tambahan untuk type dropdown 
                    'data' => array(
                        // value => Label
                        'l' => 'Laki-Laki',
                        'p' => 'Perempuan',
                   ) 
                ),
            ), 

            //membuat tampilan button 
            // 1. Label button 2.name button 3.warna button (sesuai bootstrap) 
            'button' => 'SIMPAN,simpan,success', 
        );

        $bsform->display($form);
    ?>
</div>