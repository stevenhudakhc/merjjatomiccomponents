<?php

namespace Stevenhudakhc\Merjjatomiccomponents\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//afterupdated foldername
// based on https://www.cloudways.com/blog/models-views-laravel/

class Atomlink extends Model
{
    //
    use HasFactory;

    protected $table = 'atom_links';

    protected $fillable = ['id', 'title', 'type', 'url', 'alt', 'program_id', 'organization_id'];

    public function renderHtml()
    {
        $output_string = '';
        //$row_structure = json_decode($this->structure_json);

        $url_desktop = $this->url_desktop;
        $url_mobile = $this->url_mobile;
        if (isset($url)){
          $output_string .= '<a ';
          $output_string .= " href='".$url."' ";
          $output_string .= "  class='btn btn-info' role='button' ";
          $output_string .= '>';
          $output_string .= "".$url."";
          $output_string .= '</a>';
        }


        return $output_string;
    }




}
