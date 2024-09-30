<?php

namespace Stevenhudakhc\Merjjatomiccomponents\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//afterupdated foldername
// based on https://www.cloudways.com/blog/models-views-laravel/

class Organismrow extends Model
{
    //
    use HasFactory;

    protected $table = 'organism_rows';

    protected $fillable = ['id', 'title', 'body', 'structure_json'];

    public function renderHtml()
    {
        //        var_dump($this->structure_json);

        $categories = $this;

        $output_string = '';
        $row_structure = json_decode($categories->structure_json);
        $row_cols = explode('-', $row_structure->organism_row);
        $col_count = count($row_cols);

        // print_r($row_structure);

        $display_type = 'atoms'; // default atoms
        if (isset($row_structure->molecule)) {
            $display_type = 'molecules';
        }

        if ($display_type == 'atoms') {
            $output_string .= "<div class='container'>";
            $output_string .= "\n";
            $output_string .= "<div class='row'>";
            $output_string .= "\n";
            for ($i = 0; $i < $col_count; $i++) {
                $div_class = ''; // layout options - full width 3, 1-2 or 2-1 dual column, 3 column 1-1-1
                if ($row_cols[$i] == 1) { //
                    $div_class = ' col-md-4';
                } elseif ($row_cols[$i] == 2) {
                    $div_class = ' col-md-8';
                } else {
                    $div_class = ' col-md-12';
                }
                $output_string .= "<div class='col-sm ".$div_class." p-0'>";
                if ($row_structure->atoms[$i]->atom_type == 'image') { //image row
                    $output_string .= "<img src='".$row_structure->atoms[$i]->src."' title='".$i."' class='img-fluid w-100'/>";
                }
                if ($row_structure->atoms[$i]->atom_type == 'media_image') { // atomic image
                  $media_image_insert = Atomimage::where('id', $row_structure->atoms[$i]->id)->first();
                  $output_string .= $media_image_insert->renderHtml();
//                    $output_string .= "<img src='".$row_structure->atoms[$i]->src."' title='".$i."' class='img-fluid w-100'/>";
                }

                $output_string .= '</div>';
                $output_string .= "\n";
            }
            $output_string .= '</div>';
            $output_string .= "\n";
            $output_string .= '</div>';
            $output_string .= "\n";
        } elseif ($display_type == 'molecules') {
            $output_string .= "\n";
            $output_string .= "<div id='welcomePage2' class='carousel slide carousel-fade' data-bs-ride='carousel'>";
            $output_string .= "\n";

            $output_string .= "\n";
            $output_string .= " <div class='carousel-inner'>";
            $output_string .= "\n";
            $active_class = 'active'; //
            $molecule_count = count($row_structure->molecules);
            $output_string .= "    <div class='carousel-indicators'>";
            $output_string .= "\n";
            for ($i = 0; $i < $molecule_count; $i++) {// carousel indicators

                $output_string .= "<button type='button' data-bs-target='#welcomePage2' data-bs-slide-to='".$i."' class='active' aria-label='Slide 1'></button>";
                $output_string .= "\n";

            }// end carousel indicators
            $output_string .= '</div>';
            $output_string .= "\n";
            for ($i = 0; $i < $molecule_count; $i++) { // carousel components
                $div_class = ''; //

                $output_string .= "   <div class='carousel-item ".$div_class.' '.$active_class."'>";
                $output_string .= "\n";
                if ($row_structure->molecules[$i]->molecule_type == 'slide') { //slide row
                    if (isset($row_structure->molecules[$i]->href) && false) {
                        $output_string .= "<a href='".$row_structure->molecules[$i]->href."' target='_blank'>";
                    }
                    $output_string .= "<img src='".$row_structure->molecules[$i]->src."' title='".$i."' class='bd-placeholder-img bd-placeholder-img-lg d-block w-100'/>";
                    if (isset($row_structure->molecules[$i]->href) && false) {
                        $output_string .= '</a>';
                    }
                    $output_string .= "\n";
                }

                $output_string .= "\n";
                $output_string .= '   </div>';
                $active_class = ''; //

            } // end for loop
            $output_string .= "\n";
            $output_string .= ' </div>';

            // buttons for controls
            $output_string .= "<button class='carousel-control-prev' type='button' data-bs-target='#welcomePage2' data-bs-slide='prev'>";
            $output_string .= "\n";
            $output_string .= "  <span class='carousel-control-prev-icon' aria-hidden='true'></span>";
            $output_string .= "\n";
            $output_string .= "  <span class='visually-hidden'>Previous</span>";
            $output_string .= "\n";
            $output_string .= '</button>';
            $output_string .= "\n";
            $output_string .= "<button class='carousel-control-next' type='button' data-bs-target='#welcomePage2' data-bs-slide='next'>";
            $output_string .= "\n";
            $output_string .= "  <span class='carousel-control-next-icon' aria-hidden='true'></span>";
            $output_string .= "\n";
            $output_string .= "  <span class='visually-hidden'>Next</span>";
            $output_string .= "\n";
            $output_string .= '</button>';
            $output_string .= "\n";

            $output_string .= "\n";
            $output_string .= '</div>';

        }

        return $output_string;

    }
    /*
        Defines which row types are used in an organism row
    */
    public function rowTypes()
    {
      $output_array = array(
        "1-1-1" => "1-1-1",
        "2-1" => "2-1",
        "1-2" => "1-2",
        "3" => "3",
      );

      return $output_array;

    }

}
