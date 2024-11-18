<?php

namespace Stevenhudakhc\Merjjatomiccomponents\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//afterupdated foldername
// based on https://www.cloudways.com/blog/models-views-laravel/

class Organismthirdpartytools extends Model
{
    //
    use HasFactory;

    protected $table = 'organism_thirdpartytools';

    protected $fillable = ['id', 'title', 'type', 'url_desktop', 'url_mobile', 'alt', 'program_id', 'organization_id'];

    public function renderHtml()
    {
        $output_string = '';
        //$row_structure = json_decode($this->structure_json);

        $url_desktop = $this->url_desktop;
        $url_mobile = $this->url_mobile;
        if (isset($url_desktop)){
          $output_string .= '<img ';
          $output_string .= " src='".$url_desktop."' ";
          $output_string .= " class='d-sm-none d-md-block img-fluid' ";
          $output_string .= '/>';
        }

        $output_string .= "\n";

        if (isset($url_mobile)){
          $output_string .= '<img ';
          $output_string .= " src='".$url_mobile."' ";
          $output_string .= " class='d-none d-sm-block d-md-none img-fluid' ";
          $output_string .= '/>';
        }

        return $output_string;
    }
    public function renderHtmlCard()
    {
      $output_string = "";

      $output_string .= "\n";
      $output_string .= "   <div class='card text-center rounded-0' style=''>";
      $output_string .= "\n";
        if (isset($this->atomic_link->url) ) {
            $output_string .= "<a href='".$this->atomic_link->url."' target='_blank'>";
        }
        $output_string .= "<img src='".$this->url_desktop."' title='".$this->atomic_link->title."' class='card-img-top rounded-0'/>";
        if (isset($this->atomic_link->url) ) {
            $output_string .= '</a>';
        }

        $output_string .= "\n";
        $output_string .= "   <div class='card-body' style='d-grid gap-2'>";
        $output_string .= "\n";
        if (isset($this->atomic_link->url) ) {
            $output_string .= "<a href='".$this->atomic_link->url."' target='_blank' style='text-decoration: none; font-color: inherit;'>";
        }
        if (isset($this->atomic_link->title) && strlen($this->atomic_link->title)){ // show the description if it exists
          $output_string .= "<button class='btn btn-primary'>" . $this->atomic_link->title .  "</button>\n";
        }
        if (isset($this->atomic_link->alt) && strlen($this->atomic_link->alt)){ // show the description if it exists
          $output_string .= "<p>" . $this->atomic_link->alt .  "</p>\n";
        }
        if (isset($this->atomic_link->url) ) {
            $output_string .= '</a>';
        }
        $output_string .= "\n";
        $output_string .= '   </div>'; // end card-body


      $output_string .= "\n";
      $output_string .= "\n";
      $output_string .= '   </div>'; // end card


        return $output_string;
    }


    public function atomic_link(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
  		return $this->hasOne(Atomlink::class, 'id', 'atom_link_id'); // use lowercase names because of Linux
  	}



}
