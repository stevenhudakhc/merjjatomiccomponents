<?php

namespace Stevenhudakhc\Spatietestground\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//afterupdated foldername
// based on https://www.cloudways.com/blog/models-views-laravel/

class Mediaimage extends Model
{
    //
    use HasFactory;

    protected $table = 'media_images';

    protected $fillable = ['id', 'title', 'type', 'url_desktop', 'url_mobile', 'alt', 'program_id', 'organization_id'];

    public function renderHtml()
    {
        $output_string = '';
        //$row_structure = json_decode($this->structure_json);

        $output_string .= '<img ';
        $output_string .= " src='".$url_desktop."' ";
        $output_string .= " class='d-sm-none d-md-block' ";
        $output_string .= '/>';

        $output_string .= "\n";

        $output_string .= '<img ';
        $output_string .= " src='".$url_mobile."' ";
        $output_string .= " class='d-none d-sm-block d-md-none' ";
        $output_string .= '/>';

        return $output_string;
    }
}
