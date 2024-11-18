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

        $categories = $this;

        $output_string = '';
        $row_structure = json_decode($categories->structure_json, TRUE);
        if (!isset($row_structure['rows'])){
            return; // return if all rows are cleared out
        }
        $row_structure_rows = $row_structure['rows'];
        $home_row_array = array();

        // export the rows in the JSON
        for($i = 0; $i < count($row_structure['rows']); $i++){
            $home_row_array[] = $row_structure['rows'][$i]['id'];
        }
        $organism_rows = Organismrow::whereIn('id', $home_row_array)->get();// use lowercase names because of Linux

        $display_type = 'atoms'; // default atoms
        $rowPresentationType = null;
        for ($i = 0; $i < count($row_structure_rows); $i++) {

          if(isset($row_structure_rows[$i]['atom_type'])){
            $rowPresentationType = $row_structure_rows[$i]['atom_type'];
            $organism_row = Organismrow::find($row_structure_rows[$i]['id']);
          }
          else{
            $rowPresentationType = $row_structure_rows[$i]['molecule'];

          }

          if ( $rowPresentationType == "organism_row"){
              $output_string .= "<div class='container-fluid'>";
              $output_string .= "\n";
              $output_string .= "<div class='row'>";
              $output_string .= "\n";
              if (!is_null($organism_row)){
                $output_string .= "" . $organism_row->renderHtml();
              }
              $output_string .= "\n";
              $output_string .= '</div>';
              $output_string .= "\n";
              $output_string .= '</div>';
              $output_string .= "\n";
          }
          elseif ( $rowPresentationType == "organism_thirdpartytools"){

            $organismThirdpartytools = Organismthirdpartytools::all();// use lowercase names because of Linux

            $output_string .= "\n";
            $output_string .= "   <div class='card-group rounded-0' style=''>";

            for ($j = 0; $j < count($organismThirdpartytools); $j++){
              $output_string .= "" . $organismThirdpartytools[$j]->renderHtmlCard();
            }

            $output_string .= "\n";
            $output_string .= '   </div>'; // end card-group
          }
        }


        return $output_string;

    }
}
