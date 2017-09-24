<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Gallery
 *
 * @author namblue
 */
class Gallery extends Application
{
    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/
     * 	- or -
     * 		http://example.com/welcome/index
     *
     * So any other public methods not prefixed with an underscore will
     * map to /welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function index()
    {
        $this->data['pagetitle'] = "Gallery";
        //get all the images from our model
        $pix = $this->images->all();
        
        //build an array of formatted cells for them
        foreach ($pix as $picture)
            $cells[] = $this->parser->parse('_cell', (array) $picture, true);
        
        //prime the table class
        $this->load->library('table');
        $params = array(
            'table_open' => '<table class="gallery">',
            'table_start' => '<td class="oneimage">',
            'cell_alt_start' => '<td calss"oneimage">'
        );
        $this->table->set_template($params);
        
        //generate the table
        $rows = $this->table->make_columns($cells, 3);
        $this->data['thetable'] = $this->table->generate($rows);
        
        $this->data['pagebody'] = 'gallery';
        $this->render();
    }
}
