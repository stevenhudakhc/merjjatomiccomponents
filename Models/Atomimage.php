<?php

namespace Stevenhudakhc\Merjjatomiccomponents\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//afterupdated foldername
// based on https://www.cloudways.com/blog/models-views-laravel/

class Atomimage extends Model
{
    //
    use HasFactory;

    protected $table = 'atom_images';

    protected $fillable = ['id', 'title', 'type', 'url_desktop', 'url_mobile', 'alt', 'program_id', 'organization_id'];

    public function renderHtml()
    {
        $output_string = '';
        //$row_structure = json_decode($this->structure_json);

        $url_desktop = $this->url_desktop;
        $url_mobile = $this->url_mobile;
        $title = $this->title;
        $alt = $this->alt;
        if (isset($url_desktop)){
          $output_string .= '<img ';
          $output_string .= " src='".$url_desktop."' ";
          $output_string .= " class='d-none d-sm-block d-md-block d-lg-block d-xl-block d-xxl-block img-fluid w-100' "; // w-100 added
          $output_string .= " title='".$title."' ";
          $output_string .= " alt='".$alt."' ";
          $output_string .= '/>';
        }

        $output_string .= "\n";

        if (isset($url_mobile)){
          $output_string .= '<img ';
          $output_string .= " src='".$url_mobile."' ";
          $output_string .= " class='d-block d-sm-none img-fluid w-100' ";// w-100 added
          $output_string .= " title='".$title."' ";
          $output_string .= " alt='".$alt."' ";
          $output_string .= '/>';
        }

        return $output_string;
    }
}
