<?php

namespace Stevenhudakhc\Merjjatomiccomponents\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Stevenhudakhc\Merjjatomiccomponents\Models\Organismrow as OrganismRow;

//afterupdated foldername
// based on https://www.cloudways.com/blog/models-views-laravel/

class Organismhome extends Model
{
    //
    use HasFactory;

    protected $table = 'organism_homes';

    protected $fillable = ['id', 'title', 'body', 'locale', 'organization_id', 'program_id', 'structure_json'];

    public function renderHtml()
    {
        //        var_dump($this->structure_json);

        $categories = $this;

        $output_string = '';
        $row_structure = json_decode($categories->structure_json, TRUE);

        $home_row_array = array();

        // export the rows in the JSON
        for($i = 0; $i < count($row_structure['rows']); $i++){
            $home_row_array[] = $row_structure['rows'][$i]['id'];
        }
        //
        // dd($home_row_array);

        $organism_rows = OrganismRow::whereIn('id', $home_row_array)->get();

        $display_type = 'atoms'; // default atoms

        for ($i = 0; $i < count($organism_rows); $i++) {

          $organism_row = $organism_rows[$i];

            $output_string .= "<div class='container-fluid'>";
            $output_string .= "\n";
            $output_string .= "<div class='row'>";
            $output_string .= "\n";

            $output_string .= "" . $organism_row->renderHtml();
            $output_string .= "\n";



            $output_string .= '</div>';
            $output_string .= "\n";
            $output_string .= '</div>';
            $output_string .= "\n";
          }


        return $output_string;

    }
}
